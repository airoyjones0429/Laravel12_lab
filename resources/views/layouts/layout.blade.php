<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width  , initial-scale=1.0">
  <!-- 設定 CSRF 令牌 -->
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <!-- 不要快取網頁 -->
  <!-- <meta http-equiv="Cache-Control" content="no-cache, no-store, must-revalidate" />
  <meta http-equiv="Pragma" content="no-cache" />
  <meta http-equiv="Expires" content="0" /> -->

  <!-- 設定登入使用者的名稱，下列指令在 laravel 會取回目前登入使用者-->
  <!-- {{ $loginUser = Auth::user() }} -->
  <title> 
    @if( $loginUser )
      {{ $loginUser->emp_code . ' = ' . $loginUser->emp_name }}
    @endif
  </title>
  <!-- 先用自訂 CSS 樣式，比較不會有額外的問題 -->
  <style>
    body{
      background-color: black;
      color: grey;
      width: 100% ;      
      position: relative;
    }
    form[id="loginForm"] {
      background-color: brown;
      /* color: pink; */
      position: relative;
      display: block;
      margin-left: auto;
      margin-right: auto;
      justify-items: center;
      border-radius: 100px;
    }
    .block{
      display: block;
      margin: 40px;
    }
    .alarm{
      background-color: darkred;
      color: pink;
      border-radius: 20px;
    }
    .text_center{
      text-align: center;
    }
    .text_right{
      text-align: right;
    }
    tbody tr:hover {
      background-color: greenyellow;
      color: red;      
    }
    tr table tr:hover{
      background-color: black;
    }

    /* td{
      border: 2px;
      border-style: solid;
      border-color: red;
    } */

    td{
      text-align: center;
      align-content: center;
    }

    .left{
      text-align: left;
      align-content: start;
    }

    .form-button{
      background-color: darkgreen;
      border-radius: 10px  200px;
      align-items: center;
      display:flex;
      transition: all 1s;
    }
    .form-button:hover{
      background-color: goldenrod;
      border-radius: 200px 10px;
    }

    .normal-form-button{
      display: flex; /* 所有元素，必定在同一列顯示 */
      align-items: center;
    }

    input[type="text"] ,
    input[type="password"] { /* 選擇 input 標籤 type 屬性為 text 的元素 */
      width: 100px;
    }

    .form-button::before{
      content: ''; /* 可在選擇項目前面放入文字 */
      margin-left: auto;
    }

    .form-button::after{
      content: '';  /* 可在選擇項目後面放入文字 */
      margin-left: auto;
    }

    .col-sticky{  
      background-color: grey;
      text-align: center;
      align-content: center;
      color: white;
      position: sticky;
      left: 0;
    }
    .button{
      background-color:darkgray;
      color: white;
      width: 100%;
      height: 40px;
      text-align: center; /**水平 */
      align-content: center; /**垂直 */
      transition: all 1s; /* 過度效果設定 與 過度時間 */
      cursor: pointer;
    }
    .button:hover {
      background-color:darkblue;
      color:lightgoldenrodyellow;
    }

    .button:disabled {
      background-color:darkcyan;
      color:lightgoldenrodyellow;
      cursor:not-allowed;
    }

    .buttonDown {
      background-color:lightcoral;      
    }

    .new-row {
      background-color: white;
      color: black;
    }

    .employee-img {
      width: 150px;
      height: 150px;
    }

    .employee-img.maxIMG {
      width: auto;
      height: auto;
    }

    div {
      text-align: center;
      align-items: center;
      align-content: center;
      margin-left: auto;
      margin-right: auto;      
    }

    table{
      margin-left: auto;
      margin-right: auto;
    }

    table table input:disabled{
      background-color: darkblue;
      color: yellow;
    }

    table table tr input:hover{
      background-color: lightgreen;
      color: darkblue;
    }


    /*
     machineContract.blade.php 會用到 
     用來設定 input 正在編輯時的樣式    
    */
    .active  {
      background-color: darkkhaki ;
      color: black;
      border: 10px solid red;
    }

    /* 修改過內容的欄位樣式，要在 active 之後 */
    .wait-for-update{
      background-color: darkblue;
      color: yellow;
    }

    /*  DPI : 300 150
        letter : 8.5 x 11 x 1inch (2.54 cm)
          2550px (width) 1275px
          3300px (heigh) 1650px
        DPI : 150
        1/2 letter : 8.5 x 5.5 x 1inch
          1275px
          825px


    
    */
    .printScreen {
      display: block;
      position: relative;
      /* 畫布大小 不能在這裡設定!!? */
      /* width: "1275" ; 
      height: "825"  ; */
      background-color: gray;
      color: black;
    }

  </style>
</head>

<body>
  <!-- {{-- 這裡面的文字是 模板語法的 註解 --}} -->
  @yield('content')

  <!-- {{-- 顯示傳送資料成功的訊息 --}} -->
  <div id="succeesMessage" >    
    @if( session('succees') )
        {{ session('succees') }} <br>
        {{ session('data') }}
  
        {{-- 在模板中 沒辦法設定 session() 的內容
        @php
          session()->forget('data');
          session()->forget('succees');
        @endphp
         --}}
    @endif
  </div>

  <!-- {{-- 如果 Laravel 有錯誤，會產生 $errors 物件 --}} -->
  @if ($errors->any())
    <!-- 如果有錯誤，下面會有數值 -->
    <!-- {{ $errors->any() }} -->
    <div>
        錯誤訊息：
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
  @endif

<!--
  使用元件指令產生 Laravel 元件，元件名稱為 My01Component
    php artisan make:component My01Component
  執行後，會產生下面二個檔案，一個 Component 元件檔案，一個 View 視圖檔案
  INFO  Component [C:\MY_JOB\1140501_Laravel12\Machine\app\View\Components\My01Component.php] created successfully.
  INFO  View [C:\MY_JOB\1140501_Laravel12\Machine\resources\views\components/my01-component.blade.php] created successfully.

  在要使用的視圖檔案中，用 <x-元件名稱 /> 就可以套用元件的內容，到該模板中

  也可以傳遞參數到元件中 <x-My01Component 自訂屬性名稱="自訂屬性的內容" /> ，但需要再 My01Component.php 設定屬性及建構函數內容
-->
<x-My01Component myProperty1="測試的屬性值" />
  
</body>
</html>