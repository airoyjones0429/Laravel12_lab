{{-- 設定主模板檔案名稱，輸入一個單引號，就會自動跳出可以輸入的檔案 --}}
@extends('layouts.layout')

{{-- 用來取代 主模板中 @yield('content') 的部分 --}}
@section('content')
  <!-- 找到名稱為 login 的命名路由，並傳回一個可以連結的 URL 位置 -->
  <form action="{{ route('login') }}" method="POST" id="loginForm">
    <!-- 產生 CSRF 標記，用來檢查網頁有效性 -->
    @csrf
    <!-- 
      如果有 {{-- @section('center_title') ... @endsection --}}
      就會把內部的 ... 帶入到 {{-- @yield('center_title') --}}
    -->
    <h1 class="">@yield('center_title' , '請登入系統')</h1>  
    <input type="text" class="block" id="emp_code" name="emp_code"  placeholder="請輸入員工編號" required>  
    <input type="password" class="block" id="emp_pwd" name="emp_pwd" placeholder="Password"  required>  
    <button class="" type="submit">Sign in</button>    
  </form>  
  {{-- 讀取 session('error') 欄位資料，session()在這專案是儲存在資料庫中
       不用特別宣告要使用的欄位名稱，由 Laravel 自動管理 session() 欄位 --}}
  @if(session('error'))
    <h1 class="alarm text_center"> {{ session('error') }}  {{ session('error_time') }}</h1>
  @endif
@endsection
