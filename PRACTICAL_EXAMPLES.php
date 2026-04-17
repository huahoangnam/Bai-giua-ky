<?php

/**
 * CHAPTER 4 - PRACTICAL USAGE EXAMPLES
 * 
 * This file demonstrates how to use all the implemented features
 * You can use these examples in controllers, artisan commands, or routes
 */

namespace App\Examples;

use App\Models\Classroom;
use App\Models\Student;
use App\Models\Subject;
use App\Repositories\Contracts\StudentRepositoryInterface;
use App\Services\QueryExamples;

class PracticalExamples
{
    /**
     * Example 1: Using Repository Pattern in a Controller
     */
    public static function exampleRepositoryUsage(StudentRepositoryInterface $studentRepository)
    {
        // Get all students (with relationships)
        $allStudents = $studentRepository->all();
        
        // Get a specific student
        $student = $studentRepository->find(5);
        
        // Get students from a specific class
        $classStudents = $studentRepository->studentsByClass(1);
        
        // Get only active students
        $activeStudents = $studentRepository->activeStudents();
        
        // Register a student for a subject
        $registered = $studentRepository->registerSubject(5, 3, ['score' => 8.5]);
        
        // Create a new student
        $newStudent = $studentRepository->create([
            'student_name' => 'Phạm Thị E',
            'class_id' => 1,
            'is_active' => true
        ]);
        
        // Update student
        $updated = $studentRepository->update(5, ['is_active' => false]);
        
        // Delete student
        $deleted = $studentRepository->delete(5);
    }

    /**
     * Example 2: Using Advanced Queries
     */
    public static function exampleAdvancedQueries()
    {
        // Query 1: Get students in class "CNTT1"
        $cntt1Students = QueryExamples::getStudentsByClassName('CNTT1');
        foreach ($cntt1Students as $student) {
            echo $student->student_name . " - " . $student->classroom->class_name;
        }

        // Query 2: Get subjects registered by student with id=5
        $subjectsForStudent5 = QueryExamples::getSubjectsByStudentId(5);
        foreach ($subjectsForStudent5 as $subject) {
            echo $subject->subject_name . " (Score: " . $subject->pivot->score . ")";
        }

        // Query 3: Count students by class
        $studentCounts = QueryExamples::countStudentsByClass();
        foreach ($studentCounts as $classroom) {
            echo $classroom->class_name . ": " . $classroom->students_count . " students";
        }

        // Query 4: Students with subject count
        $studentSubjectCounts = QueryExamples::getStudentsWithSubjectCount();
        foreach ($studentSubjectCounts as $student) {
            echo $student->student_name . " registered for " . $student->subject_count . " subjects";
        }

        // Bonus: Active students with details
        $activeStudentsDetailed = QueryExamples::getActiveStudentsWithDetails();
        
        // Bonus: Students by class with their subjects
        $classWithStudents = QueryExamples::getStudentsWithSubjectsByClassName('CNTT1');
        
        // Bonus: Subjects with student count
        $subjectsWithCount = QueryExamples::getSubjectsWithStudentCount();
    }

    /**
     * Example 3: Using Local Scope
     */
    public static function exampleLocalScope()
    {
        // Using scopeActive() - get only active students
        $activeStudents = Student::active()->get();
        
        // Chaining with other queries
        $activeStudentsOfClass = Student::active()
            ->where('class_id', 1)
            ->get();
        
        // With eager loading
        $activeWithClassroom = Student::active()
            ->with('classroom')
            ->get();
    }

    /**
     * Example 4: Using Global Scope
     */
    public static function exampleGlobalScope()
    {
        // Global scope automatically orders by name (ascending)
        $students = Student::all(); // Already sorted by name
        
        // Bypass global scope if needed
        $unsortedStudents = Student::withoutGlobalScopes()->get();
        
        // Combine with other operations
        $activeStudentsInOrder = Student::active()->get(); // Already sorted by name
    }

    /**
     * Example 5: Using Eloquent Relationships
     */
    public static function exampleRelationships()
    {
        // Classroom to Students (One to Many)
        $classroom = Classroom::find(1);
        $students = $classroom->students; // Get all students in this classroom
        
        // Add a new student to classroom
        $classroom->students()->create([
            'student_name' => 'Trần Văn F',
            'is_active' => true
        ]);

        // Student to Classroom (Belongs To)
        $student = Student::find(5);
        $classroom = $student->classroom; // Get classroom info
        echo "Student: " . $student->student_name . " belongs to " . $classroom->class_name;

        // Student to Subjects (Many to Many)
        $student = Student::find(5);
        $subjects = $student->subjects; // Get all subjects
        foreach ($subjects as $subject) {
            echo $subject->subject_name . " (Score: " . $subject->pivot->score . ")";
        }

        // Subject to Students (Many to Many)
        $subject = Subject::find(3);
        $students = $subject->students; // Get all students registered for this subject
        foreach ($students as $student) {
            echo $student->student_name . " (Score: " . $student->pivot->score . ")";
        }

        // Eager Loading - prevent N+1 queries
        $studentsWithClassroom = Student::with('classroom')->get();
        $studentsWithClassroomAndSubjects = Student::with('classroom', 'subjects')->get();
    }

    /**
     * Example 6: Using Pivot Data
     */
    public static function examplePivotData()
    {
        $student = Student::find(5);
        
        foreach ($student->subjects as $subject) {
            $score = $subject->pivot->score;
            $registeredAt = $subject->pivot->registered_at;
            
            echo $subject->subject_name . ": Score=" . $score . ", Registered=" . $registeredAt;
        }
        
        // Update pivot data
        $student->subjects()->updateExistingPivot(3, ['score' => 9.0]);
        
        // Sync subjects (replace all)
        $student->subjects()->sync([
            1 => ['score' => 8.5, 'registered_at' => now()],
            2 => ['score' => 7.5, 'registered_at' => now()],
            3 => ['score' => 9.0, 'registered_at' => now()],
        ]);
    }

    /**
     * Example 7: API Usage with cURL
     */
    public static function exampleApiUsage()
    {
        /*
        // Get all students
        GET http://localhost:8000/api/students
        
        // Create student
        POST http://localhost:8000/api/students
        Content-Type: application/json
        {
            "student_name": "Nguyễn Văn A",
            "class_id": 1,
            "is_active": true
        }
        
        // Get specific student
        GET http://localhost:8000/api/students/5
        
        // Update student
        PUT http://localhost:8000/api/students/5
        Content-Type: application/json
        {
            "student_name": "Nguyễn Văn B",
            "is_active": false
        }
        
        // Delete student
        DELETE http://localhost:8000/api/students/5
        
        // Get student's subjects
        GET http://localhost:8000/api/students/5/subjects
        
        // Register student for subject
        POST http://localhost:8000/api/students/5/register-subject/3
        Content-Type: application/json
        {
            "score": 8.5
        }
        
        // Unregister student from subject
        DELETE http://localhost:8000/api/students/5/unregister-subject/3
        */
    }

    /**
     * Example 8: Advanced Filtering
     */
    public static function exampleAdvancedFiltering()
    {
        // Get active students from a specific class
        $students = Student::active()
            ->where('class_id', 1)
            ->with('classroom', 'subjects')
            ->get();
        
        // Search and filter
        $searchedStudents = Student::active()
            ->where('student_name', 'like', '%Nguyễn%')
            ->orderBy('student_name')
            ->get();
        
        // Get students with at least 3 registered subjects
        $studentsWithMultipleSubjects = Student::active()
            ->withCount('subjects')
            ->having('subjects_count', '>=', 3)
            ->get();
        
        // Get students with average score > 7
        $topStudents = Student::active()
            ->with(['subjects' => function ($query) {
                $query->wherePivot('score', '>', 7);
            }])
            ->get();
    }

    /**
     * Example 9: Database Transactions
     */
    public static function exampleTransactions(StudentRepositoryInterface $repository)
    {
        use Illuminate\Support\Facades\DB;
        
        DB::beginTransaction();
        try {
            // Create student
            $student = $repository->create([
                'student_name' => 'Hoàng Văn G',
                'class_id' => 1,
                'is_active' => true
            ]);
            
            // Register for subjects
            $repository->registerSubject($student->id, 1, ['score' => 8.0]);
            $repository->registerSubject($student->id, 2, ['score' => 8.5]);
            
            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
            throw $e;
        }
    }

    /**
     * Example 10: Custom Query Methods
     */
    public static function exampleCustomMethods()
    {
        // You can add custom methods to models
        // Example custom query in Student model:
        // public function scopePassedSubjects($query) {
        //     return $query->whereHas('subjects', function ($q) {
        //         $q->wherePivot('score', '>=', 5);
        //     });
        // }
        
        // Then use it:
        // $passedStudents = Student::passedSubjects()->get();
    }
}

/**
 * TESTING GUIDE
 * 
 * Run tests with:
 * php artisan test
 * php artisan test --filter=StudentTest
 * 
 * Example test:
 * public function test_student_has_many_subjects() {
 *     $student = Student::factory()->create();
 *     $subject = Subject::factory()->create();
 *     
 *     $student->subjects()->attach($subject);
 *     
 *     $this->assertTrue($student->subjects()->where('subject_id', $subject->id)->exists());
 * }
 */

/**
 * ARTISAN COMMANDS
 * 
 * # Refresh migrations and seed
 * php artisan migrate:fresh --seed
 * 
 * # Clear cache
 * php artisan cache:clear
 * php artisan config:clear
 * 
 * # Check routes
 * php artisan route:list
 * php artisan route:list --name=api
 */
