<!DOCTYPE html>
<html lang="zh-Hant">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>登入介面</title>
    <!-- <link rel="stylesheet" href="{{ asset('css/app.css') }}"> -->
</head>
<body>
    <div class="container">
        <h2>高空作業車管理系統 登入</h2>
        @if(session('error'))
            <div class="alert alert-danger">
                {{ session('error') }}
            </div>
        @endif
        <form action="{{ route('login') }}" method="POST">
            @csrf
            <div class="form-group">
                <label for="emp_code">員工編號:</label>
                <input type="text" class="form-control" id="emp_code" name="emp_code" required>
            </div>
            <div class="form-group">
                <label for="emp_pwd">密碼:</label>
                <input type="password" class="form-control" id="emp_pwd" name="emp_pwd" required>
            </div>
            <button type="submit" class="btn btn-primary">登入</button>
        </form>
    </div>
</body>
</html>