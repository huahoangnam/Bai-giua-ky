<?php

namespace App\Http\Controllers;

use Illuminate\Routing\Controller;
use Illuminate\Http\Request;
use App\Models\Classroom;

class ClassroomController extends Controller
{
    private function getClassroomData(): array
    {
        if (!session()->has('classrooms')) {
            session(['classrooms' => Classroom::mockData()]);
        }

        return session('classrooms');
    }

    private function saveClassroomData(array $classrooms): void
    {
        session(['classrooms' => $classrooms]);
    }

    private function nextId(array $classrooms): int
    {
        $ids = array_column($classrooms, 'id');

        return empty($ids) ? 1 : max($ids) + 1;
    }

    public function index(Request $request)
    {
        $classrooms = $this->getClassroomData();
        $perPage = 4;
        $page = max(1, (int) $request->query('page', 1));
        $total = count($classrooms);
        $pages = (int) ceil($total / $perPage);
        $page = min($page, max(1, $pages));
        $offset = ($page - 1) * $perPage;
        $items = array_slice($classrooms, $offset, $perPage);

        return view('classrooms.index', [
            'classrooms' => $items,
            'page' => $page,
            'pages' => $pages,
            'total' => $total,
        ]);
    }

    public function create()
    {
        $rooms = $this->getRoomData();
        return view('classrooms.create', ['rooms' => $rooms]);
    }

    private function getRoomData(): array
    {
        if (!session()->has('rooms')) {
            session(['rooms' => \App\Models\Room::mockData()]);
        }
        return session('rooms');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'ma_lop' => 'required|string|max:20',
            'ten_lop' => 'required|string|max:255',
            'si_so' => 'required|integer|min:0|max:100',
            'khoa_hoc' => 'required|string|max:50',
            'nganh' => 'required|string|max:100',
            'giao_vien' => 'required|string|max:100',
            'phong_hoc' => 'nullable|string|max:20',
            'ghi_chu' => 'nullable|string|max:255',
        ]);

        $classrooms = $this->getClassroomData();
        $data['id'] = $this->nextId($classrooms);
        $classrooms[] = $data;
        $this->saveClassroomData($classrooms);

        return redirect()->route('classrooms.index')->with('success', 'Thêm lớp học thành công.');
    }

    public function edit($id)
    {
        $classrooms = $this->getClassroomData();
        $classroom = collect($classrooms)->firstWhere('id', (int) $id);

        if (!$classroom) {
            return redirect()->route('classrooms.index')->with('error', 'Lớp học không tồn tại.');
        }

        $rooms = $this->getRoomData();
        return view('classrooms.edit', ['classroom' => $classroom, 'rooms' => $rooms]);
    }

    public function update(Request $request, $id)
    {
        $data = $request->validate([
            'ma_lop' => 'required|string|max:20',
            'ten_lop' => 'required|string|max:255',
            'si_so' => 'required|integer|min:0|max:100',
            'khoa_hoc' => 'required|string|max:50',
            'nganh' => 'required|string|max:100',
            'giao_vien' => 'required|string|max:100',
            'phong_hoc' => 'nullable|string|max:20',
            'ghi_chu' => 'nullable|string|max:255',
        ]);

        $classrooms = $this->getClassroomData();
        $updated = false;

        foreach ($classrooms as &$classroom) {
            if ($classroom['id'] === (int) $id) {
                $classroom = array_merge($classroom, $data);
                $updated = true;
                break;
            }
        }

        if (!$updated) {
            return redirect()->route('classrooms.index')->with('error', 'Lớp học không tồn tại.');
        }

        $this->saveClassroomData($classrooms);

        return redirect()->route('classrooms.index')->with('success', 'Cập nhật lớp học thành công.');
    }

    public function destroy($id)
    {
        $classrooms = $this->getClassroomData();
        $classrooms = array_filter($classrooms, function ($classroom) use ($id) {
            return $classroom['id'] !== (int) $id;
        });

        $this->saveClassroomData(array_values($classrooms));

        return redirect()->route('classrooms.index')->with('success', 'Xóa lớp học thành công.');
    }
}
