{{-- 主模板為 layouts 目錄的 layout.blade.php 檔案 --}}
@extends('layouts.layout') 

{{-- 將主模板 @yield('content') 內容用下面 @section('content') 區塊取代  --}}
@section('content')
  <div class="form-button">
      <form id="list_all_machine" action="{{ route('showMachineManager') }}" method="POST" class="">
         @csrf
         <input type="text" name="cotroller" value="這是 input 標籤的值 test1" hidden>
         <button class="button" type="submit">機具基本資料管理</button>
      </form>
   
      <form action="{{ route('showEmployeeManager') }}" method="POST" class="">
         @csrf
         <input type="text" name="cotroller" value="這是 input 標籤的值 test2" hidden>
         <button class="button" type="submit">員工基本資料管理</button>
      </form>

      <form action="{{ route('showCustomerManager') }}" method="POST" class="">
         @csrf
         <input type="text" name="cotroller" value="這是 input 標籤的值 test3" hidden>
         <button class="button" type="submit">客戶基本資料管理</button>
      </form>
   
      <form action="{{ route('showRentMachineManager' , 'test') }}" method="GET" class="">
         @csrf
         <input type="text" name="cotroller" value="這是 input 標籤的值 test4" hidden>
         <button class="button" type="submit">高空作業車出租設定</button>
      </form>
   
      <form action="{{ route('showSaleNo') }}" method="GET" class="">
         @csrf
         <input type="text" name="cotroller" value="這是 input 標籤的值 test5" hidden>
         <button class="button" type="submit">請款單管理</button>
      </form>

      <form action="{{ route('logout') }}" method="POST" >
         @csrf
         <input type="text" name="cotroller" value="這是 input 標籤的值 test6" hidden>
         <button class="button" type="submit">Sign Out</button>
      </form>
  </div>
  <hr>
  <hr>

   <!-- {{-- 其他功能的子模板 --}} -->
   @yield( 'content_sub','')

   <!-- {{-- 明細資料的子模板 --}} -->
   @yield( 'datafield' , '' )

   <!-- {{-- 如果把 @yield() 放到子模板中，會導致排版順序錯亂，被放到子模板的 @yield() 會出現在最上面 --}} -->
   @yield('receipt_sub' , '')

   @hasSection('datafield')
      <div style="margin-top:10px ;width: 100%;height:3px;background-color:blue;"></div>
   @endif

@endsection
