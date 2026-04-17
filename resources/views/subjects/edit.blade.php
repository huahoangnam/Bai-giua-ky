@extends('layouts.app')

@section('content')
    <div class="card">
        <h2>Sửa học phần</h2>

        @if($errors->any())
            <div class="alert alert-error">
                <ul style="margin: 0; padding-left: 18px;">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('subjects.update', $subject['id']) }}" method="POST">
            @csrf
            @method('PUT')
            @include('subjects._form', ['subject' => $subject])
            <input type="submit" value="Cập nhật" class="button">
            <a class="button button-secondary" href="{{ route('subjects.index') }}">Quay lại</a>
        </form>
    </div>
@endsection
