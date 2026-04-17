@extends('layouts.app')

@section('content')
    <div class="card">
        <h2>Chỉnh sửa lớp học</h2>

        @if($errors->any())
            <div class="alert alert-error">
                <ul style="margin: 0; padding-left: 18px;">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('classrooms.update', $classroom['id']) }}" method="POST">
            @csrf
            @method('PUT')
            @include('classrooms._form', ['classroom' => $classroom, 'rooms' => $rooms ?? []])
            <input type="submit" value="Lưu" class="button">
            <a class="button button-secondary" href="{{ route('classrooms.index') }}">Quay lại</a>
        </form>
    </div>
@endsection
