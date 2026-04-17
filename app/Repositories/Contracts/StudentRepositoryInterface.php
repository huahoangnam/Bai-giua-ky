<?php

namespace App\Repositories\Contracts;

use Illuminate\Support\Collection;

/**
 * Student Repository Interface
 * Defines the contract for student data operations
 */
interface StudentRepositoryInterface
{
    /**
     * Get all students
     * 
     * @return Collection
     */
    public function all(): Collection;

    /**
     * Find a student by ID
     * 
     * @param int $id
     * @return mixed
     */
    public function find(int $id);

    /**
     * Get all students from a specific class
     * 
     * @param int $classId
     * @return Collection
     */
    public function studentsByClass(int $classId): Collection;

    /**
     * Get active students
     * 
     * @return Collection
     */
    public function activeStudents(): Collection;

    /**
     * Register a student for a subject
     * 
     * @param int $studentId
     * @param int $subjectId
     * @param array $data (optional: score, etc.)
     * @return bool
     */
    public function registerSubject(int $studentId, int $subjectId, array $data = []): bool;

    /**
     * Unregister a student from a subject
     * 
     * @param int $studentId
     * @param int $subjectId
     * @return bool
     */
    public function unregisterSubject(int $studentId, int $subjectId): bool;

    /**
     * Create a new student
     * 
     * @param array $data
     * @return mixed
     */
    public function create(array $data);

    /**
     * Update a student
     * 
     * @param int $id
     * @param array $data
     * @return bool
     */
    public function update(int $id, array $data): bool;

    /**
     * Delete a student
     * 
     * @param int $id
     * @return bool
     */
    public function delete(int $id): bool;
}
