<?php

namespace App\Http\Controllers;

use Illuminate\Routing\Controller;
use Illuminate\Http\Request;
use App\Models\Room;

class RoomController extends Controller
{
    private function getRoomData(): array
    {
        if (!session()->has('rooms')) {
            session(['rooms' => Room::mockData()]);
        }

        return session('rooms');
    }

    private function saveRoomData(array $rooms): void
    {
        session(['rooms' => $rooms]);
    }

    private function nextId(array $rooms): int
    {
        $ids = array_column($rooms, 'id');

        return empty($ids) ? 1 : max($ids) + 1;
    }

    public function index(Request $request)
    {
        $rooms = $this->getRoomData();
        $perPage = 4;
        $page = max(1, (int) $request->query('page', 1));
        $total = count($rooms);
        $pages = (int) ceil($total / $perPage);
        $page = min($page, max(1, $pages));
        $offset = ($page - 1) * $perPage;
        $items = array_slice($rooms, $offset, $perPage);

        return view('rooms.index', [
            'rooms' => $items,
            'page' => $page,
            'pages' => $pages,
            'total' => $total,
        ]);
    }

    public function create()
    {
        return view('rooms.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'ma_phong' => 'required|string|max:20',
            'ten_phong' => 'required|string|max:255',
            'toà_nha' => 'required|string|max:50',
            'tang' => 'required|integer|min:0|max:15',
            'suc_chua' => 'required|integer|min:1|max:200',
            'loai_phong' => 'required|string|max:50',
            'trang_bi' => 'nullable|string|max:500',
            'ghi_chu' => 'nullable|string|max:255',
        ]);

        $rooms = $this->getRoomData();
        $data['id'] = $this->nextId($rooms);
        $rooms[] = $data;
        $this->saveRoomData($rooms);

        return redirect()->route('rooms.index')->with('success', 'Thêm phòng học thành công.');
    }

    public function edit($id)
    {
        $rooms = $this->getRoomData();
        $room = collect($rooms)->firstWhere('id', (int) $id);

        if (!$room) {
            return redirect()->route('rooms.index')->with('error', 'Phòng học không tồn tại.');
        }

        return view('rooms.edit', ['room' => $room]);
    }

    public function update(Request $request, $id)
    {
        $data = $request->validate([
            'ma_phong' => 'required|string|max:20',
            'ten_phong' => 'required|string|max:255',
            'toà_nha' => 'required|string|max:50',
            'tang' => 'required|integer|min:0|max:15',
            'suc_chua' => 'required|integer|min:1|max:200',
            'loai_phong' => 'required|string|max:50',
            'trang_bi' => 'nullable|string|max:500',
            'ghi_chu' => 'nullable|string|max:255',
        ]);

        $rooms = $this->getRoomData();
        $updated = false;

        foreach ($rooms as &$room) {
            if ($room['id'] === (int) $id) {
                $room = array_merge($room, $data);
                $updated = true;
                break;
            }
        }

        if (!$updated) {
            return redirect()->route('rooms.index')->with('error', 'Phòng học không tồn tại.');
        }

        $this->saveRoomData($rooms);

        return redirect()->route('rooms.index')->with('success', 'Cập nhật phòng học thành công.');
    }

    public function destroy($id)
    {
        $rooms = $this->getRoomData();
        $rooms = array_filter($rooms, function ($room) use ($id) {
            return $room['id'] !== (int) $id;
        });

        $this->saveRoomData(array_values($rooms));

        return redirect()->route('rooms.index')->with('success', 'Xóa phòng học thành công.');
    }
}
