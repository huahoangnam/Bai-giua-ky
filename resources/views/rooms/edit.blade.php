@extends('layouts.app')

@section('content')
    <div class="card">
        <h2>Chỉnh sửa phòng học</h2>

        @if($errors->any())
            <div class="alert alert-error">
                <ul style="margin: 0; padding-left: 18px;">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('rooms.update', $room['id']) }}" method="POST">
            @csrf
            @method('PUT')
            @include('rooms._form', ['room' => $room])
            <input type="submit" value="Lưu" class="button">
            <a class="button button-secondary" href="{{ route('rooms.index') }}">Quay lại</a>
        </form>
    </div>
@endsection
