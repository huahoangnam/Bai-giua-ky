<?php

namespace App\Http\Controllers;

use App\Repositories\Contracts\StudentRepositoryInterface;
use App\Models\Student;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

/**
 * Exercise 7: REST API for Student Management
 * All endpoints use Repository Pattern
 */
class StudentApiController extends Controller
{
    protected StudentRepositoryInterface $studentRepository;

    public function __construct(StudentRepositoryInterface $studentRepository)
    {
        $this->studentRepository = $studentRepository;
    }

    /**
     * GET /api/students
     * Get all students
     * 
     * @return JsonResponse
     */
    public function index(): JsonResponse
    {
        try {
            $students = $this->studentRepository->all();
            
            return response()->json([
                'success' => true,
                'message' => 'Students retrieved successfully',
                'data' => $students
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to retrieve students',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * POST /api/students
     * Create a new student
     * 
     * @param Request $request
     * @return JsonResponse
     */
    public function store(Request $request): JsonResponse
    {
        try {
            $validated = $request->validate([
                'student_name' => 'required|string|max:255',
                'class_id' => 'required|integer|exists:classrooms,id',
                'is_active' => 'boolean|default:true'
            ]);

            $student = $this->studentRepository->create($validated);

            return response()->json([
                'success' => true,
                'message' => 'Student created successfully',
                'data' => $student
            ], 201);
        } catch (ValidationException $e) {
            return response()->json([
                'success' => false,
                'message' => 'Validation failed',
                'errors' => $e->errors()
            ], 422);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to create student',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * GET /api/students/{id}
     * Get a specific student
     * 
     * @param int $id
     * @return JsonResponse
     */
    public function show(int $id): JsonResponse
    {
        try {
            $student = $this->studentRepository->find($id);

            if (!$student) {
                return response()->json([
                    'success' => false,
                    'message' => 'Student not found'
                ], 404);
            }

            return response()->json([
                'success' => true,
                'message' => 'Student retrieved successfully',
                'data' => $student
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to retrieve student',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * PUT /api/students/{id}
     * Update a student
     * 
     * @param Request $request
     * @param int $id
     * @return JsonResponse
     */
    public function update(Request $request, int $id): JsonResponse
    {
        try {
            $validated = $request->validate([
                'student_name' => 'sometimes|required|string|max:255',
                'class_id' => 'sometimes|required|integer|exists:classrooms,id',
                'is_active' => 'boolean'
            ]);

            $success = $this->studentRepository->update($id, $validated);

            if (!$success) {
                return response()->json([
                    'success' => false,
                    'message' => 'Student not found'
                ], 404);
            }

            $student = $this->studentRepository->find($id);

            return response()->json([
                'success' => true,
                'message' => 'Student updated successfully',
                'data' => $student
            ], 200);
        } catch (ValidationException $e) {
            return response()->json([
                'success' => false,
                'message' => 'Validation failed',
                'errors' => $e->errors()
            ], 422);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to update student',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * DELETE /api/students/{id}
     * Delete a student
     * 
     * @param int $id
     * @return JsonResponse
     */
    public function destroy(int $id): JsonResponse
    {
        try {
            $success = $this->studentRepository->delete($id);

            if (!$success) {
                return response()->json([
                    'success' => false,
                    'message' => 'Student not found'
                ], 404);
            }

            return response()->json([
                'success' => true,
                'message' => 'Student deleted successfully'
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to delete student',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * GET /api/students/{id}/subjects
     * Get all subjects registered by a student
     * 
     * @param int $id
     * @return JsonResponse
     */
    public function getSubjects(int $id): JsonResponse
    {
        try {
            $student = $this->studentRepository->find($id);

            if (!$student) {
                return response()->json([
                    'success' => false,
                    'message' => 'Student not found'
                ], 404);
            }

            return response()->json([
                'success' => true,
                'message' => 'Subjects retrieved successfully',
                'data' => $student->subjects
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to retrieve subjects',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * POST /api/students/{id}/register-subject/{subject_id}
     * Register a student for a subject
     * 
     * @param Request $request
     * @param int $id
     * @param int $subjectId
     * @return JsonResponse
     */
    public function registerSubject(Request $request, int $id, int $subjectId): JsonResponse
    {
        try {
            $validated = $request->validate([
                'score' => 'nullable|numeric|min:0|max:10'
            ]);

            $success = $this->studentRepository->registerSubject($id, $subjectId, $validated);

            if (!$success) {
                return response()->json([
                    'success' => false,
                    'message' => 'Failed to register subject. Student or subject not found, or student is already registered.'
                ], 400);
            }

            $student = $this->studentRepository->find($id);

            return response()->json([
                'success' => true,
                'message' => 'Subject registered successfully',
                'data' => $student->subjects
            ], 201);
        } catch (ValidationException $e) {
            return response()->json([
                'success' => false,
                'message' => 'Validation failed',
                'errors' => $e->errors()
            ], 422);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to register subject',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * DELETE /api/students/{id}/unregister-subject/{subject_id}
     * Unregister a student from a subject
     * 
     * @param int $id
     * @param int $subjectId
     * @return JsonResponse
     */
    public function unregisterSubject(int $id, int $subjectId): JsonResponse
    {
        try {
            $success = $this->studentRepository->unregisterSubject($id, $subjectId);

            if (!$success) {
                return response()->json([
                    'success' => false,
                    'message' => 'Failed to unregister subject. Student not found.'
                ], 400);
            }

            return response()->json([
                'success' => true,
                'message' => 'Subject unregistered successfully'
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to unregister subject',
                'error' => $e->getMessage()
            ], 500);
        }
    }
}
