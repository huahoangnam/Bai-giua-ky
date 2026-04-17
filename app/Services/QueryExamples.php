<?php

namespace App\Services;

use App\Models\Student;
use App\Models\Classroom;
use App\Models\Subject;
use Illuminate\Database\Query\Builder;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;

/**
 * Exercise 4: Query Builder & Eloquent Advanced
 * Collection of advanced queries for the student management system
 */
class QueryExamples
{
    /**
     * Query 1: Get all students in a specific class (e.g., "CNTT1")
     * 
     * @param string $className
     * @return Collection
     */
    public static function getStudentsByClassName(string $className)
    {
        return Student::whereHas('classroom', function ($query) use ($className) {
            $query->where('class_name', $className);
        })->get();

        // Alternative using JOIN:
        // return Student::join('classrooms', 'students.class_id', '=', 'classrooms.id')
        //     ->where('classrooms.class_name', $className)
        //     ->select('students.*')
        //     ->get();
    }

    /**
     * Query 2: Get all subjects that a specific student (id=5) registered for
     * 
     * @param int $studentId
     * @return Collection
     */
    public static function getSubjectsByStudentId(int $studentId)
    {
        return Student::find($studentId)
            ->subjects()
            ->get();

        // Alternative using query builder:
        // return Subject::join('student_subject', 'subjects.id', '=', 'student_subject.subject_id')
        //     ->where('student_subject.student_id', $studentId)
        //     ->select('subjects.*', 'student_subject.score', 'student_subject.registered_at')
        //     ->get();
    }

    /**
     * Query 3: Count the number of students in each class
     * 
     * @return \Illuminate\Support\Collection
     */
    public static function countStudentsByClass()
    {
        return Classroom::with('students')
            ->select('id', 'class_name')
            ->withCount('students')
            ->get();

        // Alternative using GROUP BY:
        // return DB::table('students')
        //     ->join('classrooms', 'students.class_id', '=', 'classrooms.id')
        //     ->select('classrooms.id', 'classrooms.class_name', DB::raw('count(students.id) as student_count'))
        //     ->groupBy('classrooms.id', 'classrooms.class_name')
        //     ->get();
    }

    /**
     * Query 4: Get all students with the count of their registered subjects (LEFT JOIN + groupBy)
     * 
     * @return \Illuminate\Support\Collection
     */
    public static function getStudentsWithSubjectCount()
    {
        return Student::leftJoin('student_subject', 'students.id', '=', 'student_subject.student_id')
            ->select('students.id', 'students.student_name', DB::raw('count(student_subject.subject_id) as subject_count'))
            ->groupBy('students.id', 'students.student_name')
            ->get();

        // Alternative using withCount:
        // return Student::withCount('subjects')->get();
    }

    /**
     * Bonus Query: Get active students with their classroom and subjects count
     * 
     * @return \Illuminate\Support\Collection
     */
    public static function getActiveStudentsWithDetails()
    {
        return Student::active()
            ->with('classroom')
            ->withCount('subjects')
            ->get();
    }

    /**
     * Bonus Query: Get students from a specific class with all their registered subjects
     * 
     * @param string $className
     * @return \Illuminate\Support\Collection
     */
    public static function getStudentsWithSubjectsByClassName(string $className)
    {
        return Classroom::where('class_name', $className)
            ->with('students.subjects')
            ->get();
    }

    /**
     * Bonus Query: Get subjects with their registered students count
     * 
     * @return \Illuminate\Support\Collection
     */
    public static function getSubjectsWithStudentCount()
    {
        return Subject::withCount('students')
            ->get();
    }

    /**
     * Bonus Query: Get students with score >= 5 for a specific subject
     * 
     * @param int $subjectId
     * @return \Illuminate\Support\Collection
     */
    public static function getPassedStudentsBySubject(int $subjectId)
    {
        return Subject::find($subjectId)
            ->students()
            ->wherePivot('score', '>=', 5)
            ->get();
    }
}
