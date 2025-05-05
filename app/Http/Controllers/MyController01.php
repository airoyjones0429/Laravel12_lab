<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
//這裡使用的都是 PHP 語法
class MyController01 extends Controller
{
    //傳回文字內容的函數，宣告為 public 才能被外部使用
    public function MyFunction1() {
        return '<H1>這是 My Function1 的內容</H1>';
    }

    //傳回子模板檔案
    public function MyFunction2() {
        return view('content3' , ['subString' => '這是從 MyFunction2 傳回的資料']);
    }

    //傳回文字內容的函數，宣告為 public 才能被外部使用
    public function MyFunction3() {
        return '<H1 style="color:green">這是 My Function3 的內容</H1>';
    }
}
