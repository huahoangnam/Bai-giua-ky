@extends('layouts.app')

@section('content')
    <div class="card">
        <div style="display: flex; justify-content: space-between; align-items: center;">
            <div>
                <h2>Danh sách lớp học</h2>
                <p>Hiển thị {{ count($classrooms) }} trên {{ $total }} lớp học.</p>
            </div>
            <a class="button" href="{{ route('classrooms.create') }}">Thêm lớp học</a>
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
                    <th>Mã lớp</th>
                    <th>Tên lớp</th>
                    <th>Sĩ số</th>
                    <th>Khóa học</th>
                    <th>Ngành</th>
                    <th>Phòng học</th>
                    <th>Hành động</th>
                </tr>
            </thead>
            <tbody>
                @forelse($classrooms as $classroom)
                    <tr>
                        <td>{{ $classroom['ma_lop'] }}</td>
                        <td>{{ $classroom['ten_lop'] }}</td>
                        <td>{{ $classroom['si_so'] }}</td>
                        <td>{{ $classroom['khoa_hoc'] }}</td>
                        <td>{{ $classroom['nganh'] }}</td>
                        <td>{{ $classroom['phong_hoc'] ?? 'Chưa xác định' }}</td>
                        <td>
                            <a class="button button-secondary" href="{{ route('classrooms.edit', $classroom['id']) }}">Sửa</a>
                            <form action="{{ route('classrooms.destroy', $classroom['id']) }}" method="POST" style="display: inline-block; margin-top: 4px;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="button button-secondary" style="background: #dc2626;">Xóa</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="7">Chưa có lớp học nào.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>

        @if($pages > 1)
            <div class="pagination">
                @for($i = 1; $i <= $pages; $i++)
                    <a href="{{ route('classrooms.index', ['page' => $i]) }}" class="{{ $i === $page ? 'active' : '' }}">{{ $i }}</a>
                @endfor
            </div>
        @endif
    </div>
@endsection
