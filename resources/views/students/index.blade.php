@extends('layouts.app')

@section('content')
    <div class="card">
        <div style="display: flex; justify-content: space-between; align-items: center;">
            <div>
                <h2>Danh sách sinh viên</h2>
                <p>Hiển thị {{ count($students) }} trên {{ $total }} sinh viên.</p>
            </div>
            <a class="button" href="{{ route('students.create') }}">Thêm sinh viên</a>
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
                    <th>Mã SV</th>
                    <th>Họ tên</th>
                    <th>Năm sinh</th>
                    <th>ĐT</th>
                    <th>Email</th>
                    <th>Lớp</th>
                    <th>Ngành</th>
                    <th>Hành động</th>
                </tr>
            </thead>
            <tbody>
                @forelse($students as $student)
                    <tr>
                        <td>{{ $student['ma_sv'] }}</td>
                        <td>{{ $student['ho_ten'] }}</td>
                        <td>{{ $student['nam_sinh'] }}</td>
                        <td>{{ $student['so_dt'] }}</td>
                        <td>{{ $student['email'] }}</td>
                        <td>{{ $student['lop'] }}</td>
                        <td>{{ $student['nganh'] }}</td>
                        <td>
                            <a class="button button-secondary" href="{{ route('students.edit', $student['id']) }}">Sửa</a>
                            <form action="{{ route('students.destroy', $student['id']) }}" method="POST" style="display: inline-block; margin-top: 4px;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="button button-secondary" style="background: #dc2626;">Xóa</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="8">Chưa có sinh viên nào.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>

        @if($pages > 1)
            <div class="pagination">
                @for($i = 1; $i <= $pages; $i++)
                    <a href="{{ route('students.index', ['page' => $i]) }}" class="{{ $i === $page ? 'active' : '' }}">{{ $i }}</a>
                @endfor
            </div>
        @endif
    </div>
@endsection
