<?php

namespace App\Http\Controllers;

use Illuminate\Routing\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Collection;
use App\Models\Subject;

class SubjectController extends Controller
{
    private function getSubjectData(): array
    {
        if (!session()->has('subjects')) {
            session(['subjects' => Subject::mockData()]);
        }

        return session('subjects');
    }

    private function saveSubjectData(array $subjects): void
    {
        session(['subjects' => $subjects]);
    }

    private function nextId(array $subjects): int
    {
        $ids = array_column($subjects, 'id');

        return empty($ids) ? 1 : max($ids) + 1;
    }

    public function index(Request $request)
    {
        $subjects = $this->getSubjectData();
        $perPage = 4;
        $page = max(1, (int) $request->query('page', 1));
        $total = count($subjects);
        $pages = (int) ceil($total / $perPage);
        $page = min($page, max(1, $pages));
        $offset = ($page - 1) * $perPage;
        $items = array_slice($subjects, $offset, $perPage);

        return view('subjects.index', [
            'subjects' => $items,
            'page' => $page,
            'pages' => $pages,
            'total' => $total,
        ]);
    }

    public function create()
    {
        return view('subjects.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'ma_hp' => 'required|string|max:20',
            'ten_hp' => 'required|string|max:255',
            'so_tin_chi' => 'required|integer|min:0|max:20',
            'so_tiet_ly_thuyet' => 'required|integer|min:0|max:200',
            'so_tiet_thuc_hanh' => 'required|integer|min:0|max:200',
            'hoc_ky' => 'required|integer|min:1|max:10',
            'nam_hoc' => 'required|string|max:20',
            'khoa_phu_trach' => 'required|string|max:100',
            'nganh_ap_dung' => 'required|string|max:100',
            'loai_hoc_phan' => 'required|string|max:50',
            'tien_quyet' => 'nullable|string|max:255',
            'song_hanh' => 'nullable|string|max:255',
            'mo_ta' => 'nullable|string|max:500',
            'ghi_chu' => 'nullable|string|max:255',
        ]);

        $subjects = $this->getSubjectData();
        $data['id'] = $this->nextId($subjects);
        $subjects[] = $data;
        $this->saveSubjectData($subjects);

        return redirect()->route('subjects.index')->with('success', 'Thêm học phần thành công.');
    }

    public function edit($id)
    {
        $subjects = $this->getSubjectData();
        $subject = collect($subjects)->firstWhere('id', (int) $id);

        if (!$subject) {
            return redirect()->route('subjects.index')->with('error', 'Học phần không tồn tại.');
        }

        return view('subjects.edit', ['subject' => $subject]);
    }

    public function update(Request $request, $id)
    {
        $data = $request->validate([
            'ma_hp' => 'required|string|max:20',
            'ten_hp' => 'required|string|max:255',
            'so_tin_chi' => 'required|integer|min:0|max:20',
            'so_tiet_ly_thuyet' => 'required|integer|min:0|max:200',
            'so_tiet_thuc_hanh' => 'required|integer|min:0|max:200',
            'hoc_ky' => 'required|integer|min:1|max:10',
            'nam_hoc' => 'required|string|max:20',
            'khoa_phu_trach' => 'required|string|max:100',
            'nganh_ap_dung' => 'required|string|max:100',
            'loai_hoc_phan' => 'required|string|max:50',
            'tien_quyet' => 'nullable|string|max:255',
            'song_hanh' => 'nullable|string|max:255',
            'mo_ta' => 'nullable|string|max:500',
            'ghi_chu' => 'nullable|string|max:255',
        ]);

        $subjects = $this->getSubjectData();
        $updated = false;

        foreach ($subjects as &$subject) {
            if ($subject['id'] === (int) $id) {
                $subject = array_merge($subject, $data);
                $updated = true;
                break;
            }
        }

        if (!$updated) {
            return redirect()->route('subjects.index')->with('error', 'Học phần không tồn tại.');
        }

        $this->saveSubjectData($subjects);

        return redirect()->route('subjects.index')->with('success', 'Cập nhật học phần thành công.');
    }
}
