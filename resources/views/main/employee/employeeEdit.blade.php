@extends('main.main')

@section('content_sub')
    
    <!-- {{-- 直接使用 $employee 陣列名稱，會造成錯誤，因為模板語法不支援，這種寫法 --}}
    {{-- {{ $employee['emp_imgPath']  }} --}} -->
    
    

    <div style="position: relative;">
        <!-- {{-- {{ route('employee.update', $employee['emp_code'] ) }}--}} -->
        <form action="{{ route('employee.update', $employee['emp_code'] ) }}" method="POST" >
            @csrf
            @method('PATCH')
            <table>
                <tbody>
                    <tr>
                        <!-- 員工圖片 -->
                        <td rowspan="5"
                        style="background-color: white;">
                            {{-- asset() 使用伺服器 storage/目錄下的檔案， emp_imgPath 儲存檔案目錄與檔案名稱 --}}
                            @if ( $employee['emp_imgPath'] )
                                <img    src="{{  asset( 'storage/' . $employee['emp_imgPath'] ) }}"
                                        alt="無法加載圖片，顯示的文字"
                                        class="employee-img maxIMG">
                            @else
                                <img    src="{{  asset( 'storage/png/001.png' ) }}"
                                        alt="無法加載圖片，顯示的文字"
                                        class="employee-img maxIMG">
                            @endif
                        </td>
                        <td>員工編號</td><!-- maxlength 限制輸入字元數量的屬性，我 pattern 還不會使用正則表達式 -->
                        <td><input  type="text" maxlength="6"
                                    name="emp_code"
                                    value="{{ $employee['emp_code'] }}"
                                    @if ( session('mode') == 'edit' || is_null( session('mode') ) ) readonly @endif
                                    ></td>
                    </tr>
                    <tr>
                        <td>員工姓名</td><!-- maxlength 限制輸入字元數量的屬性，只能 4 個中文字，也是輸入 4 -->
                        <!-- {{-- @can() 條件式為真，執行內部語法，@cannot() 條件式為假，執行內部語法 --}} -->
                        <td><input  type="text"
                                    required                                    
                                    @cannot( 'updateName' , [ 'empCode' => $employee['emp_code'] ] )
                                        readonly
                                    @endcannot
                                    maxlength="4"
                                    name="emp_name"
                                    value="{{ $employee['emp_name'] }}"></td>
                    </tr>
                    <tr>
                        <td>員工密碼</td><!-- maxlength 限制輸入字元數量的屬性，只能 4 個中文字，也是輸入 4 -->
                        <td>
                            <input  type="password" style="display: block;"
                                    required
                                    maxlength="20"
                                    name="emp_pwd1"
                                    value="{{ $employee['emp_pwd'] }}"><br>
                            <input  type="password" style="display: block;"
                                    required
                                    maxlength="20"
                                    name="emp_pwd2"
                                    value="{{ $employee['emp_pwd'] }}">
                        </td>
                    </tr>
                    <tr>
                        <td>員工分機</td><!-- maxlength 限制輸入字元數量的屬性，只能 4 個中文字，也是輸入 4 -->
                        <td><input  type="text"
                                    required
                                    maxlength="20"
                                    name="emp_tel"
                                    value="{{ $employee['emp_tel'] }}"></td>
                    </tr>
                    <tr>
                        <td>員工權限</td><!-- maxlength 限制輸入字元數量的屬性，只能 4 個中文字，也是輸入 4 -->
                        <td><input  type="number"
                                    required
                                    min=0
                                    max=32767
                                    name="emp_lv"
                                    value="{{ $employee['emp_lv'] }}"></td>
                    </tr>
                    <tr>
                        <td colspan="5">
                            <input type="submit" value="更新資料"  id="updateButton" class="button">
                        </td>
                    </tr>
                </tbody>
        
                <tfoot>
                    <tr>
                        <td colspan="5">
                            @if ( session('success') )
                                {{ session('success') }}
                                {{ session()->forget('success') }}
                            @endif
                        </td>
                    </tr>
                </tfoot>
            </table>
        </form>

    {{-- 自訂用 post 路由 傳遞模型物件，也只要 指定主鍵 就可以 
    {{  route('upload.photo' , $employee['emp_code']  ) }} --}}
    <form   action="{{ route('upload.photo' , $employee['emp_code']  ) }}" 
            method="POST" enctype="multipart/form-data"
            style="position: absolute;top:0px;left:35%;"
    >
        @csrf
        <!-- 顯示檔案按鈕 -->
        <input type="file" name="photo" required>
        <!-- 顯示上傳按鈕 -->
        <button type="submit">上傳照片</button>
    </form>

    <!-- 練習上傳的功能 -->
    <div>
        <label> 上傳圖片到 C:/PIC/ 目錄下 </label>
        <form action="{{ route('upload.image') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <label for="image">選擇圖片上傳:</label>
        <input type="file" name="image" id="image" required>
        <button type="submit">上傳圖片</button>
        </form>
    </div>

    <div>
        <label> 檢視 C:/PIC/ 目錄下，檔案清單 </label>
        <form action="{{ route('files.index') }}" method="GET">
        @csrf
        <button type="submit">顯示檔案清單</button>
        </form>
    </div>


    </div>









@endsection