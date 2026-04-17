@extends('layouts.app')

@section('content')
    <div class="card">
        <h2>Thêm phòng học</h2>

        @if($errors->any())
            <div class="alert alert-error">
                <ul style="margin: 0; padding-left: 18px;">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('rooms.store') }}" method="POST">
            @csrf
            @include('rooms._form', ['room' => null])
            <input type="submit" value="Lưu" class="button">
            <a class="button button-secondary" href="{{ route('rooms.index') }}">Quay lại</a>
        </form>
    </div>
@endsection
