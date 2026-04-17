<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quản lý sinh viên</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 0; padding: 0; background: #f4f6f8; color: #333; }
        .container { max-width: 1100px; margin: 0 auto; padding: 24px; }
        header { background: #1e3a8a; color: #fff; padding: 18px 24px; }
        header h1 { margin: 0; font-size: 28px; }
        .card { background: #fff; border-radius: 8px; box-shadow: 0 2px 14px rgba(0,0,0,.06); padding: 20px; margin-top: 20px; }
        .button, button, input[type="submit"] { display: inline-block; border: none; border-radius: 6px; background: #2563eb; color: #fff; text-decoration: none; padding: 10px 16px; cursor: pointer; font-size: 14px; }
        .button:hover, button:hover, input[type="submit"]:hover { background: #1d4ed8; }
        .button-secondary { background: #6b7280; }
        .button-secondary:hover { background: #4b5563; }
        .table { width: 100%; border-collapse: collapse; margin-top: 16px; }
        .table th, .table td { border: 1px solid #e5e7eb; padding: 10px; text-align: left; vertical-align: top; }
        .table th { background: #f3f4f6; }
        .input-group { margin-bottom: 12px; }
        .input-group label { display: block; margin-bottom: 4px; font-weight: 600; }
        .input-group input, .input-group textarea, .input-group select { width: 100%; padding: 10px; border: 1px solid #d1d5db; border-radius: 6px; }
        .alert { padding: 12px 16px; border-radius: 6px; margin: 16px 0; }
        .alert-success { background: #d1fae5; color: #065f46; }
        .alert-error { background: #fde2e1; color: #991b1b; }
        .pagination { margin-top: 16px; }
        .pagination a { margin-right: 8px; text-decoration: none; color: #2563eb; }
        .pagination .active { font-weight: 700; color: #111827; }
    </style>
</head>
<body>
    <header>
        <div class="container">
            <div style="display: flex; justify-content: space-between; align-items: center; flex-wrap: wrap; gap: 12px;">
                <h1>Quản lý sinh viên và học phần</h1>
                <div style="display: flex; gap: 10px; flex-wrap: wrap; align-items: center;">
                    @auth
                        <span style="color: #e5e7eb; margin-right: 8px;">Xin chào, {{ Auth::user()->name }}</span>
                        <a class="button button-secondary" href="{{ route('students.index') }}">Sinh viên</a>
                        <a class="button button-secondary" href="{{ route('subjects.index') }}">Học phần</a>
                        <a class="button button-secondary" href="{{ route('classrooms.index') }}">Lớp học</a>
                        <a class="button button-secondary" href="{{ route('rooms.index') }}">Phòng học</a>
                        <form method="POST" action="{{ route('logout') }}" style="display: inline; margin: 0;">
                            @csrf
                            <button type="submit" class="button">Đăng xuất</button>
                        </form>
                    @else
                        <a class="button button-secondary" href="{{ route('login') }}">Đăng nhập</a>
                        <a class="button button-secondary" href="{{ route('register') }}">Đăng ký</a>
                    @endauth
                </div>
            </div>
        </div>
    </header>
    <div class="container">
        @yield('content')
    </div>
</body>
</html>
