@extends('layouts.layout')

@section('content')
    <!-- 如果忘記輸入 method 會什麼反應都沒有，連 dd() 都沒用!! -->
    <form action="{{ route('customer.store') }}" method="POST" >
        @csrf
        <!-- 欄位資料 1 -->
        <label  for="ctm_no">客戶編號</label>
        <input  type="text"  
                value="{{ old('ctm_no') }}"
                placeholder="請輸入客戶編號"
                id="ctm_no" maxlength="4"
                name="ctm_no" required><br>
        <!-- 欄位資料 2 -->
        <label  for="ctm_name">客戶名稱</label>
        <input  type="text"  
                value="{{ old('ctm_name') }}"
                placeholder="請輸入客戶名稱"
                id="ctm_name" maxlength="10"
                name="ctm_name" required><br>
        <!-- 欄位資料 3 -->
        <label  for="ctm_uno">客戶統一編號</label>
        <input  type="text"
                value="{{ old('ctm_uno') }}"
                placeholder="請輸入統一編號"
                id="ctm_uno" maxlength="10"
                name="ctm_uno" required><br>
        <!-- 欄位資料 4 -->
        <label  for="ctm_tel">客戶電話</label>
        <input  type="text"
                value="{{ old('ctm_tel') }}"        
                placeholder="請輸入客戶電話"
                id="ctm_tel" maxlength="10"
                name="ctm_tel" required><br>
        <!-- 欄位資料 5 -->
        <label  for="ctm_fax">客戶傳真</label>
        <input  type="text"
                value="{{ old('ctm_fax') }}"        
                placeholder="請輸入客戶傳真"
                id="ctm_fax" maxlength="10"
                name="ctm_fax" ><br>
        <!-- 欄位資料 6 -->
        <label  for="ctm_adrs1">客戶地址1</label>
        <input  type="text"
                value="{{ old('ctm_adrs1') }}"        
                placeholder="請輸入客戶地址1"
                id="ctm_adrs1"
                name="ctm_adrs1" ><br>
        <!-- 欄位資料 7 -->
        <label  for="ctm_adrs2">客戶地址2</label>
        <input  type="text"
                value="{{ old('ctm_adrs2') }}"        
                placeholder="請輸入客戶地址2"
                id="ctm_adrs2"
                name="ctm_adrs2" ><br>
        <!-- 欄位資料 8 -->
        <label  for="ctm_rp">客戶負責人</label>
        <input  type="text"
                value="{{ old('ctm_rp') }}"        
                placeholder="請輸入客戶負責人"
                id="ctm_rp"
                name="ctm_rp" ><br>   
        <!-- 欄位資料 9 -->
        <label  for="ctm_rptel">客戶負責人電話</label>
        <input  type="text"
                value="{{ old('ctm_rptel') }}"        
                placeholder="請輸入客戶負責人電話"
                id="ctm_rptel"
                name="ctm_rptel" ><br>
        <!-- 欄位資料 10 -->
        <label  for="ctm_remark">備註</label>
        <textarea   name="ctm_remark"
                    placeholder="請輸入備註資訊"
                    id="ctm_remark">{{ old('ctm_remark') }}</textarea>
        <input type="submit" value="建立資料">
        <!-- 連接雖然可以用  但要另外設定 CSS 才能好看點 -->
        <a href="{{ route('customer.index') }}"  class="button "> 返回索引頁面 </a>
        <!-- 使用按鈕搭配 JS 讓瀏覽器回到指定的 URL 中 -->
        <button type="button" onclick="window.location.href=`{{ route('customer.index') }}`" class="button">返回索引頁面</button>
    </form>

    @if( session('succees') )
        {{ session('succees') }} <br>
        {{ session('data') }}
        <!--    {{ session()->forget('data') }} 
                {{ session()->forget('succees') }} -->
    @endif

    {{-- 如果 Laravel 有錯誤，會產生 $errors 物件 --}}
    @if ($errors->any())
    <!-- 如果有錯誤，下面會有數值 -->
    {{ $errors->any() }}
    <div>
        錯誤訊息：
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif

@endsection