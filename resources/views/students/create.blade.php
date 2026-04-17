@extends('layouts.app')

@section('content')
    <div class="card">
        <h2>Thêm sinh viên</h2>

        @if($errors->any())
            <div class="alert alert-error">
                <ul style="margin: 0; padding-left: 18px;">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('students.store') }}" method="POST">
            @csrf
            @include('students._form', ['student' => null])
            <input type="submit" value="Lưu" class="button">
            <a class="button button-secondary" href="{{ route('students.index') }}">Quay lại</a>
        </form>
    </div>
@endsection
