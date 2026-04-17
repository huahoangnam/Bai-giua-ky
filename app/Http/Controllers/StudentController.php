<?php

namespace App\Http\Controllers;

use Illuminate\Routing\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Collection;
use App\Models\Student;

class StudentController extends Controller
{
    private function getStudentData(): array
    {
        if (!session()->has('students')) {
            session(['students' => Student::mockData()]);
        }

        return session('students');
    }

    private function saveStudentData(array $students): void
    {
        session(['students' => $students]);
    }

    private function nextId(array $students): int
    {
        $ids = array_column($students, 'id');

        return empty($ids) ? 1 : max($ids) + 1;
    }

    public function index(Request $request)
    {
        $students = $this->getStudentData();
        $perPage = 4;
        $page = max(1, (int) $request->query('page', 1));
        $total = count($students);
        $pages = (int) ceil($total / $perPage);
        $page = min($page, max(1, $pages));
        $offset = ($page - 1) * $perPage;
        $items = array_slice($students, $offset, $perPage);

        return view('students.index', [
            'students' => $items,
            'page' => $page,
            'pages' => $pages,
            'total' => $total,
        ]);
    }

    public function create()
    {
        return view('students.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'ma_sv' => 'required|string|max:20',
            'ho_ten' => 'required|string|max:100',
            'nam_sinh' => 'required|integer|min:1900|max:2100',
            'so_dt' => 'required|string|max:20',
            'email' => 'required|email|max:100',
            'dia_chi' => 'required|string|max:255',
            'que_quan' => 'required|string|max:100',
            'lop' => 'required|string|max:50',
            'nganh' => 'required|string|max:100',
            'khoa' => 'required|string|max:100',
            'ghi_chu' => 'nullable|string|max:255',
        ]);

        $students = $this->getStudentData();
        $data['id'] = $this->nextId($students);
        $students[] = $data;
        $this->saveStudentData($students);

        return redirect()->route('students.index')->with('success', 'Thêm sinh viên thành công.');
    }

    public function edit($id)
    {
        $students = $this->getStudentData();
        $student = collect($students)->firstWhere('id', (int) $id);

        if (!$student) {
            return redirect()->route('students.index')->with('error', 'Sinh viên không tồn tại.');
        }

        return view('students.edit', ['student' => $student]);
    }

    public function update(Request $request, $id)
    {
        $data = $request->validate([
            'ma_sv' => 'required|string|max:20',
            'ho_ten' => 'required|string|max:100',
            'nam_sinh' => 'required|integer|min:1900|max:2100',
            'so_dt' => 'required|string|max:20',
            'email' => 'required|email|max:100',
            'dia_chi' => 'required|string|max:255',
            'que_quan' => 'required|string|max:100',
            'lop' => 'required|string|max:50',
            'nganh' => 'required|string|max:100',
            'khoa' => 'required|string|max:100',
            'ghi_chu' => 'nullable|string|max:255',
        ]);

        $students = $this->getStudentData();
        $updated = false;

        foreach ($students as &$student) {
            if ($student['id'] === (int) $id) {
                $student = array_merge($student, $data);
                $updated = true;
                break;
            }
        }

        if (!$updated) {
            return redirect()->route('students.index')->with('error', 'Sinh viên không tồn tại.');
        }

        $this->saveStudentData($students);

        return redirect()->route('students.index')->with('success', 'Cập nhật thông tin sinh viên thành công.');
    }

    public function destroy($id)
    {
        $students = $this->getStudentData();
        $students = array_filter($students, function ($student) use ($id) {
            return $student['id'] !== (int) $id;
        });

        $this->saveStudentData(array_values($students));

        return redirect()->route('students.index')->with('success', 'Xóa sinh viên thành công.');
    }
}
