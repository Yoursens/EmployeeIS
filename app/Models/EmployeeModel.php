<?php

namespace App\Models;

use CodeIgniter\Model;

/**
 * EmployeeModel
 * Handles all database operations for the Employee Information System.
 * PC21 Advanced Web Development - Terminal Assessment 1
 */
class EmployeeModel extends Model
{
    // ─── Table & Primary Key ────────────────────────────────────────────────
    protected $table      = 'employees';
    protected $primaryKey = 'id';

    // ─── Return Type ────────────────────────────────────────────────────────
    protected $returnType = 'array';

    // ─── Allowed Fields (mass-assignment protection) ─────────────────────────
    protected $allowedFields = [
        'name',
        'position',
        'department',
        'salary',
    ];

    // ─── Timestamps ─────────────────────────────────────────────────────────
    protected $useTimestamps = true;
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';

    // ─── Validation Rules ────────────────────────────────────────────────────
    protected $validationRules = [
        'name'       => 'required|min_length[2]|max_length[100]',
        'position'   => 'required|min_length[2]|max_length[100]',
        'department' => 'required|min_length[2]|max_length[100]',
        'salary'     => 'required|numeric|greater_than[0]',
    ];

    protected $validationMessages = [
        'name' => [
            'required'   => 'Employee name is required.',
            'min_length' => 'Name must be at least 2 characters.',
            'max_length' => 'Name cannot exceed 100 characters.',
        ],
        'position' => [
            'required'   => 'Position is required.',
            'min_length' => 'Position must be at least 2 characters.',
            'max_length' => 'Position cannot exceed 100 characters.',
        ],
        'department' => [
            'required'   => 'Department is required.',
            'min_length' => 'Department must be at least 2 characters.',
            'max_length' => 'Department cannot exceed 100 characters.',
        ],
        'salary' => [
            'required'     => 'Salary is required.',
            'numeric'      => 'Salary must be a valid number.',
            'greater_than' => 'Salary must be greater than 0.',
        ],
    ];

    protected $skipValidation = false;

    // ─── Custom Methods ──────────────────────────────────────────────────────

    /**
     * Get all employees ordered by name.
     */
    public function getAllEmployees(): array
    {
        return $this->orderBy('name', 'ASC')->findAll();
    }

    /**
     * Search employees by name, position, or department.
     */
    public function searchEmployees(string $keyword): array
    {
        return $this->groupStart()
                    ->like('name', $keyword)
                    ->orLike('position', $keyword)
                    ->orLike('department', $keyword)
                    ->groupEnd()
                    ->orderBy('name', 'ASC')
                    ->findAll();
    }

    /**
     * Get employees by department.
     */
    public function getByDepartment(string $department): array
    {
        return $this->where('department', $department)
                    ->orderBy('name', 'ASC')
                    ->findAll();
    }

    /**
     * Get all distinct departments.
     */
    public function getDepartments(): array
    {
        return $this->select('department')
                    ->distinct()
                    ->orderBy('department', 'ASC')
                    ->findAll();
    }
}