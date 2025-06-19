<!DOCTYPE html>
<html lang="zh-Hant">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ session('emp_name') }} 登入中</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
</head>
<body>
    <div class="container">
        <h2>歡迎, {{ session('emp_name') }}!</h2>
        <p>選擇你的功能:</p>
        <!-- 這裡可以放置功能選擇的選項 -->
    </div>
</body>
</html>