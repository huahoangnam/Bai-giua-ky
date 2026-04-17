@extends('layouts.app')

@section('content')
    <div class="card">
        <h2>Thêm học phần</h2>

        @if($errors->any())
            <div class="alert alert-error">
                <ul style="margin: 0; padding-left: 18px;">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('subjects.store') }}" method="POST">
            @csrf
            @include('subjects._form', ['subject' => null])
            <input type="submit" value="Lưu" class="button">
            <a class="button button-secondary" href="{{ route('subjects.index') }}">Quay lại</a>
        </form>
    </div>
@endsection
