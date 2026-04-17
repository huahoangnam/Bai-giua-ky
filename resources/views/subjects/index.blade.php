@extends('layouts.app')

@section('content')
    <div class="card">
        <div style="display: flex; justify-content: space-between; align-items: center; flex-wrap: wrap; gap: 12px;">
            <div>
                <h2>Danh sách học phần</h2>
                <p>Hiển thị {{ count($subjects) }} trên {{ $total }} học phần.</p>
            </div>
            <a class="button" href="{{ route('subjects.create') }}">Thêm học phần</a>
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
                    <th>Mã HP</th>
                    <th>Tên học phần</th>
                    <th>Tín chỉ</th>
                    <th>Học kỳ</th>
                    <th>Năm học</th>
                    <th>Loại</th>
                    <th>Hành động</th>
                </tr>
            </thead>
            <tbody>
                @forelse($subjects as $subject)
                    <tr>
                        <td>{{ $subject['ma_hp'] }}</td>
                        <td>{{ $subject['ten_hp'] }}</td>
                        <td>{{ $subject['so_tin_chi'] }}</td>
                        <td>{{ $subject['hoc_ky'] }}</td>
                        <td>{{ $subject['nam_hoc'] }}</td>
                        <td>{{ $subject['loai_hoc_phan'] }}</td>
                        <td>
                            <a class="button button-secondary" href="{{ route('subjects.edit', $subject['id']) }}">Sửa</a>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="7">Chưa có học phần nào.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>

        @if($pages > 1)
            <div class="pagination">
                @for($i = 1; $i <= $pages; $i++)
                    <a href="{{ route('subjects.index', ['page' => $i]) }}" class="{{ $i === $page ? 'active' : '' }}">{{ $i }}</a>
                @endfor
            </div>
        @endif
    </div>
@endsection
