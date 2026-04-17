<?php

namespace App\Repositories;

use App\Models\Student;
use App\Repositories\Contracts\StudentRepositoryInterface;
use Illuminate\Support\Collection;

/**
 * Student Repository Implementation
 * Concrete implementation of StudentRepositoryInterface
 */
class StudentRepository implements StudentRepositoryInterface
{
    protected Student $model;

    public function __construct(Student $model)
    {
        $this->model = $model;
    }

    /**
     * Get all students
     * 
     * @return Collection
     */
    public function all(): Collection
    {
        return $this->model->with('classroom', 'subjects')->get();
    }

    /**
     * Find a student by ID
     * 
     * @param int $id
     * @return mixed
     */
    public function find(int $id)
    {
        return $this->model->with('classroom', 'subjects')->find($id);
    }

    /**
     * Get all students from a specific class
     * 
     * @param int $classId
     * @return Collection
     */
    public function studentsByClass(int $classId): Collection
    {
        return $this->model
            ->where('class_id', $classId)
            ->with('classroom', 'subjects')
            ->get();
    }

    /**
     * Get active students
     * 
     * @return Collection
     */
    public function activeStudents(): Collection
    {
        return $this->model
            ->active()
            ->with('classroom', 'subjects')
            ->get();
    }

    /**
     * Register a student for a subject
     * 
     * @param int $studentId
     * @param int $subjectId
     * @param array $data (optional: score, etc.)
     * @return bool
     */
    public function registerSubject(int $studentId, int $subjectId, array $data = []): bool
    {
        $student = $this->model->find($studentId);
        
        if (!$student) {
            return false;
        }

        // Check if already registered
        if ($student->subjects()->where('subject_id', $subjectId)->exists()) {
            return false;
        }

        // Register with default data
        $attachData = array_merge(['registered_at' => now()], $data);
        
        $student->subjects()->attach($subjectId, $attachData);
        
        return true;
    }

    /**
     * Unregister a student from a subject
     * 
     * @param int $studentId
     * @param int $subjectId
     * @return bool
     */
    public function unregisterSubject(int $studentId, int $subjectId): bool
    {
        $student = $this->model->find($studentId);
        
        if (!$student) {
            return false;
        }

        return (bool) $student->subjects()->detach($subjectId);
    }

    /**
     * Create a new student
     * 
     * @param array $data
     * @return mixed
     */
    public function create(array $data)
    {
        return $this->model->create($data);
    }

    /**
     * Update a student
     * 
     * @param int $id
     * @param array $data
     * @return bool
     */
    public function update(int $id, array $data): bool
    {
        $student = $this->model->find($id);
        
        if (!$student) {
            return false;
        }

        return $student->update($data);
    }

    /**
     * Delete a student
     * 
     * @param int $id
     * @return bool
     */
    public function delete(int $id): bool
    {
        $student = $this->model->find($id);
        
        if (!$student) {
            return false;
        }

        return (bool) $student->delete();
    }
}
