@extends('layouts.app')

@section('content')
    <div class="card">
        <div style="display: flex; justify-content: space-between; align-items: center;">
            <div>
                <h2>Danh sách phòng học</h2>
                <p>Hiển thị {{ count($rooms) }} trên {{ $total }} phòng học.</p>
            </div>
            <a class="button" href="{{ route('rooms.create') }}">Thêm phòng học</a>
        </div>

        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif
        @if(session('error'))
            <div class="alert alert-error">{{ session('error') }}</div>
        @endif

        <table class="table">
            <thead>
                <tr>
                    <th>Mã phòng</th>
                    <th>Tên phòng</th>
                    <th>Tòa nhà</th>
                    <th>Tầng</th>
                    <th>Sức chứa</th>
                    <th>Loại phòng</th>
                    <th>Hành động</th>
                </tr>
            </thead>
            <tbody>
                @forelse($rooms as $room)
                    <tr>
                        <td>{{ $room['ma_phong'] }}</td>
                        <td>{{ $room['ten_phong'] }}</td>
                        <td>{{ $room['toà_nha'] }}</td>
                        <td>{{ $room['tang'] }}</td>
                        <td>{{ $room['suc_chua'] }}</td>
                        <td>{{ $room['loai_phong'] }}</td>
                        <td>
                            <a class="button button-secondary" href="{{ route('rooms.edit', $room['id']) }}">Sửa</a>
                            <form action="{{ route('rooms.destroy', $room['id']) }}" method="POST" style="display: inline-block; margin-top: 4px;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="button button-secondary" style="background: #dc2626;">Xóa</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="7">Chưa có phòng học nào.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>

        @if($pages > 1)
            <div class="pagination">
                @for($i = 1; $i <= $pages; $i++)
                    <a href="{{ route('rooms.index', ['page' => $i]) }}" class="{{ $i === $page ? 'active' : '' }}">{{ $i }}</a>
                @endfor
            </div>
        @endif
    </div>
@endsection
