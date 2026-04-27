<?php

namespace App\Controllers;

use App\Controllers\BaseController;

class AuthController extends BaseController
{
    // ── Login ─────────────────────────────────────────────────────────────────

    public function login()
    {
        if (session()->get('logged_in')) {
            return redirect()->to('/employees');
        }

        return view('employees/login');
    }

    public function loginProcess()
    {
        $rules = [
            'email'    => 'required|valid_email',
            'password' => 'required|min_length[6]',
        ];

        if (! $this->validate($rules)) {
            return redirect()->back()
                ->withInput()
                ->with('error', implode(' ', $this->validator->getErrors()));
        }

        $db    = \Config\Database::connect();
        $email = $this->request->getPost('email');
        $pass  = $this->request->getPost('password');

        $user = $db->table('users')
                   ->where('email', $email)
                   ->where('is_active', 1)
                   ->get()
                   ->getRowArray();

        if (! $user || ! password_verify($pass, $user['password_hash'])) {
            return redirect()->back()
                ->withInput()
                ->with('error', 'Invalid email or password.');
        }

        $db->table('users')
           ->where('id', $user['id'])
           ->update(['last_login_at' => date('Y-m-d H:i:s')]);

        session()->set([
            'logged_in'  => true,
            'user_id'    => $user['id'],
            'user_name'  => $user['first_name'] . ' ' . $user['last_name'],
            'user_email' => $user['email'],
            'user_role'  => $user['role'],
        ]);

        return redirect()->to('/employees')
                         ->with('success', 'Welcome back, ' . $user['first_name'] . '!');
    }

    // ── Logout ────────────────────────────────────────────────────────────────

    public function logout()
    {
        session()->destroy();
        return redirect()->to('/login')->with('success', 'You have been signed out.');
    }

    // ── Register ──────────────────────────────────────────────────────────────

    public function register()
    {
        if (session()->get('logged_in')) {
            return redirect()->to('/employees');
        }

        return view('employees/register');
    }

    public function registerProcess()
    {
        $rules = [
            'first_name'       => 'required|min_length[2]|max_length[80]',
            'last_name'        => 'required|min_length[2]|max_length[80]',
            'email'            => 'required|valid_email|is_unique[users.email]',
            'password'         => 'required|min_length[8]',
            'confirm_password' => 'required|matches[password]',
            'terms'            => 'required',
        ];

        $messages = [
            'email'            => ['is_unique' => 'That email address is already registered.'],
            'confirm_password' => ['matches'   => 'Passwords do not match.'],
            'terms'            => ['required'  => 'You must agree to the Terms of Service.'],
        ];

        if (! $this->validate($rules, $messages)) {
            return redirect()->back()
                ->withInput()
                ->with('error', implode(' ', $this->validator->getErrors()));
        }

        $db = \Config\Database::connect();
        $db->table('users')->insert([
            'first_name'    => $this->request->getPost('first_name'),
            'last_name'     => $this->request->getPost('last_name'),
            'email'         => $this->request->getPost('email'),
            'password_hash' => password_hash(
                                   $this->request->getPost('password'),
                                   PASSWORD_BCRYPT,
                                   ['cost' => 12]
                               ),
            'role'       => 'staff',   // auto-assigned — no dropdown needed in form
            'is_active'  => 1,
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ]);

        return redirect()->to('/login')
                         ->with('success', 'Account created! You can now sign in.');
    }

    // ── Forgot Password ───────────────────────────────────────────────────────

    public function forgotPassword()
    {
        return view('employees/forgotpass');
    }

    public function forgotPasswordProcess()
    {
        $rules = ['email' => 'required|valid_email'];

        if (! $this->validate($rules)) {
            return redirect()->back()
                ->withInput()
                ->with('error', 'Please enter a valid email address.');
        }

        $email = $this->request->getPost('email');
        $db    = \Config\Database::connect();

        $user = $db->table('users')
                   ->where('email', $email)
                   ->where('is_active', 1)
                   ->get()
                   ->getRowArray();

        if ($user) {
            $token     = bin2hex(random_bytes(32));
            $expiresAt = date('Y-m-d H:i:s', strtotime('+30 minutes'));

            $db->table('password_resets')
               ->where('email', $email)
               ->whereNull('used_at')
               ->delete();

            $db->table('password_resets')->insert([
                'email'      => $email,
                'token'      => $token,
                'expires_at' => $expiresAt,
                'created_at' => date('Y-m-d H:i:s'),
            ]);

            log_message('info', 'Password reset link: ' . base_url('reset-password/' . $token));
        }

        return redirect()->back()
                         ->with('success', 'If that email is registered, a reset link has been sent.');
    }

    // ── Reset Password ────────────────────────────────────────────────────────

    public function resetPassword(string $token)
    {
        $db = \Config\Database::connect();

        $reset = $db->table('password_resets')
                    ->where('token', $token)
                    ->where('expires_at >=', date('Y-m-d H:i:s'))
                    ->whereNull('used_at')
                    ->get()
                    ->getRowArray();

        if (! $reset) {
            return redirect()->to('/forgot-password')
                             ->with('error', 'This reset link is invalid or has expired.');
        }

        return view('employees/resetpass', ['token' => $token]);
    }

    public function resetPasswordProcess()
    {
        $rules = [
            'token'            => 'required',
            'password'         => 'required|min_length[8]',
            'confirm_password' => 'required|matches[password]',
        ];

        if (! $this->validate($rules)) {
            return redirect()->back()
                ->withInput()
                ->with('error', implode(' ', $this->validator->getErrors()));
        }

        $token = $this->request->getPost('token');
        $db    = \Config\Database::connect();

        $reset = $db->table('password_resets')
                    ->where('token', $token)
                    ->where('expires_at >=', date('Y-m-d H:i:s'))
                    ->whereNull('used_at')
                    ->get()
                    ->getRowArray();

        if (! $reset) {
            return redirect()->to('/forgot-password')
                             ->with('error', 'This reset link is invalid or has expired.');
        }

        $db->table('users')
           ->where('email', $reset['email'])
           ->update([
               'password_hash' => password_hash(
                                      $this->request->getPost('password'),
                                      PASSWORD_BCRYPT,
                                      ['cost' => 12]
                                  ),
               'updated_at' => date('Y-m-d H:i:s'),
           ]);

        $db->table('password_resets')
           ->where('token', $token)
           ->update(['used_at' => date('Y-m-d H:i:s')]);

        return redirect()->to('/login')
                         ->with('success', 'Password updated! You can now sign in.');
    }
}