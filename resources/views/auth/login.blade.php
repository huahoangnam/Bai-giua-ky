@extends('layouts.app')

@section('content')
    <div class="card" style="max-width: 460px; margin: 0 auto;">
        <h2>Đăng nhập</h2>

        @if ($errors->any())
            <div class="alert alert-error">
                <ul style="margin: 0; padding-left: 18px;">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form method="POST" action="{{ route('login') }}">
            @csrf
            <div class="input-group">
                <label for="email">Email</label>
                <input id="email" type="email" name="email" value="{{ old('email') }}" required autofocus>
            </div>

            <div class="input-group">
                <label for="password">Mật khẩu</label>
                <input id="password" type="password" name="password" required>
            </div>

            <div class="input-group" style="display: flex; align-items: center; gap: 8px;">
                <input id="remember" type="checkbox" name="remember">
                <label for="remember" style="margin: 0;">Ghi nhớ đăng nhập</label>
            </div>

            <button type="submit">Đăng nhập</button>
        </form>

        <p style="margin-top: 16px; font-size: 14px;">
            Chưa có tài khoản? <a href="{{ route('register') }}">Đăng ký ngay</a>
        </p>
    </div>
@endsection
