@extends('mainboard.main')

@section('title')
    測試用標題
@endsection

@section('background')
    style ='background-color:black;color:white;'
@endsection


@section('top')
    <h1> 測試用 @yield('subtop') </h1>
@endsection

