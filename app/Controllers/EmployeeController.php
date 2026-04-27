<?php

namespace App\Controllers;

use App\Models\EmployeeModel;
use CodeIgniter\Controller;

/**
 * EmployeeController
 * Handles all HTTP requests for the Employee Information System.
 * PC21 Advanced Web Development - Terminal Assessment 1
 *
 * Routes handled:
 *  GET  /employees              → index()   – list all employees
 *  GET  /employees/create       → create()  – show add form
 *  POST /employees/store        → store()   – save new record
 *  GET  /employees/edit/{id}    → edit()    – show edit form
 *  POST /employees/update/{id}  → update()  – save updated record
 *  GET  /employees/delete/{id}  → delete()  – delete record
 *  GET  /employees/view/{id}    → view()    – show single record
 */
class EmployeeController extends Controller
{
    protected EmployeeModel $model;

    public function __construct()
    {
        $this->model = new EmployeeModel();
        helper(['form', 'url']);
    }

    // ─── READ: List All ──────────────────────────────────────────────────────
    public function index(): string
    {
        $keyword    = $this->request->getGet('search');
        $employees  = $keyword
            ? $this->model->searchEmployees($keyword)
            : $this->model->getAllEmployees();

        $data = [
            'title'     => 'Employee Information System',
            'employees' => $employees,
            'keyword'   => $keyword,
        ];

        return view('employees/index', $data);
    }

    // ─── READ: Single Record ─────────────────────────────────────────────────
    public function view(int $id): string
    {
        $employee = $this->model->find($id);
        if (!$employee) {
            return redirect()->to('/employees')
                             ->with('error', 'Employee record not found.');
        }

        return view('employees/view', [
            'title'    => 'Employee Details',
            'employee' => $employee,
        ]);
    }

    // ─── CREATE: Show Form ───────────────────────────────────────────────────
    public function create(): string
    {
        return view('employees/create', [
            'title'      => 'Add New Employee',
            'validation' => \Config\Services::validation(),
        ]);
    }

    // ─── CREATE: Process Form ────────────────────────────────────────────────
    public function store()
    {
        // Server-side validation
        $rules = [
            'name'       => 'required|min_length[2]|max_length[100]',
            'position'   => 'required|min_length[2]|max_length[100]',
            'department' => 'required|min_length[2]|max_length[100]',
            'salary'     => 'required|numeric|greater_than[0]',
        ];

        if (!$this->validate($rules)) {
            return view('employees/create', [
                'title'      => 'Add New Employee',
                'validation' => $this->validator,
            ]);
        }

        // Sanitize & save
        $this->model->save([
            'name'       => esc($this->request->getPost('name')),
            'position'   => esc($this->request->getPost('position')),
            'department' => esc($this->request->getPost('department')),
            'salary'     => (float) $this->request->getPost('salary'),
        ]);

        return redirect()->to('/employees')
                         ->with('success', 'Employee record added successfully!');
    }

    // ─── UPDATE: Show Edit Form ──────────────────────────────────────────────
    public function edit(int $id): string
    {
        $employee = $this->model->find($id);
        if (!$employee) {
            return redirect()->to('/employees')
                             ->with('error', 'Employee record not found.');
        }

        return view('employees/edit', [
            'title'      => 'Edit Employee Record',
            'employee'   => $employee,
            'validation' => \Config\Services::validation(),
        ]);
    }

    // ─── UPDATE: Process Edit Form ───────────────────────────────────────────
    public function update(int $id)
    {
        $employee = $this->model->find($id);
        if (!$employee) {
            return redirect()->to('/employees')
                             ->with('error', 'Employee record not found.');
        }

        $rules = [
            'name'       => 'required|min_length[2]|max_length[100]',
            'position'   => 'required|min_length[2]|max_length[100]',
            'department' => 'required|min_length[2]|max_length[100]',
            'salary'     => 'required|numeric|greater_than[0]',
        ];

        if (!$this->validate($rules)) {
            return view('employees/edit', [
                'title'      => 'Edit Employee Record',
                'employee'   => $employee,
                'validation' => $this->validator,
            ]);
        }

        $this->model->update($id, [
            'name'       => esc($this->request->getPost('name')),
            'position'   => esc($this->request->getPost('position')),
            'department' => esc($this->request->getPost('department')),
            'salary'     => (float) $this->request->getPost('salary'),
        ]);

        return redirect()->to('/employees')
                         ->with('success', 'Employee record updated successfully!');
    }

    // ─── DELETE ──────────────────────────────────────────────────────────────
    public function delete(int $id)
    {
        $employee = $this->model->find($id);
        if (!$employee) {
            return redirect()->to('/employees')
                             ->with('error', 'Employee record not found.');
        }

        $this->model->delete($id);

        return redirect()->to('/employees')
                         ->with('success', 'Employee record deleted successfully!');
    }
}