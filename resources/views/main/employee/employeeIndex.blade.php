@extends('main.main')

@section('content_sub')

  <table>
    <thead>
      <tr>
        <td colspan="5">
          {{--  Auth::user() 會自動驗證目前登入的使用者，是否符合條件，屬於隱含呼叫 --}}   

          @can('addNewEmployee', Auth::user() )
            {{-- 使用資源型控制器的命名路由 --}}
            <!-- {{-- 
            {{ route('employee.create') }}
            --}} -->

            <form action="{{ route('employee.create') }}" method="GET">
              @csrf
              <input type="submit" value="新增員工" class="button">
            </form>            
          @endcan
        </td>
      </tr>
      <tr>
        <th id="title-employee-img" style="width: 200px;">員工相片</th>
        <th id="title-employee-code" style="width: 200px;" >員工編號</th>
        <th id="title-employee-name" style="width: 200px;" >員工姓名</th>
        <th id="title-employee-job" style="width: 200px;">員工職稱</th>
        <th id="title-employee-func" style="width: 200px;">功能選擇</th>
      </tr>
    </thead>

    <tbody>
      @foreach ( $employees as $employee )
        <tr class="employee-detail">
          <td name="employee-img">
            <!-- 如果在 JS 中字串  用 反單引號 包住 模板語法的 單引號 才可以正常反應  JS
                 如果在模板語法中  用 反單引號  模板語法  不會正常動作  但不會出現錯誤!!
            -->
            {{--  $employee->emp_imgPath; --}}

            <!-- 要注意，這段是會被伺服器執行的，沒用 HTML 註解掉  會直接印出在網頁上
            @if ( $employee->emp_imgPath )
              {{ $imgFile = 'storage/' . $employee->emp_imgPath ;}}
            @else
              {{ $imgFile = 'storage/png/001.png' ;}}
            @endif 
            -->          
  

            <img  src="{{  asset( $imgFile ) }}" alt="無法加載圖片，顯示的文字" 
                  class="employee-img">

            {{-- 
            <img src="{{  asset( $imgFile ) }}" alt="無法加載圖片，顯示的文字" 
            onerror="this.onerror=null; this.src=`{{  asset('storage/png/001.png') }}`;"
            class="employee-img">
             --}}
          </td>          
          <td name="employee-code">{{ $employee->emp_code }}</td>
          <td name="employee-name">{{ $employee->emp_name }}</td>
          <td name="employee-job">{{ $employee->emp_lv }}</td>
          <td name="employee-func">
            <!-- 
            {{-- 
            {{ session('user_id') }}
            <br>
            {{ $employee->emp_code }}
            <br>
            {{ route('employee.edit' , $employee->emp_code  ) }}
             --}} -->

            <!-- {{--  @can() 是用在授權策略使用的語法 --}} -->             
            <!-- {{--  @can() 沒設定參數時，最錯誤，因為 閘門  那裏 我有寫需要參數 --}} -->      
            <!-- {{--  @can() 設定一個參數時，自動會有二個參數的效果 !!? 第一個參數，會自動變成登入的使用者 --}} -->  
            <!-- {{--  @can() 設定一個參數時，自動會有二個參數的效果 !!? 當你有宣告第二個參數時，只要輸入第二個參數就可以了 
                           ， 就算參數輸入過多 也不會出現錯誤警告  但是會沒有用--}} -->  
            <!-- {{--  @can() 當你有宣告第二個參數時，只要輸入第二個參數就可以了 ， 就算參數輸入過多 也不會出現錯誤警告  但是會沒有用--}} -->  
            <!-- {{-- @can( 'addNewEmployee' ,[ 'employee1' => $employee ]  這個會錯誤，說複寫到原本的命名變數 )   --}} -->
            <!-- {{-- @can( 'addNewEmployee' ,[ 'employee3' => $employee ]  這個會錯誤，說沒有這個命名變數 )   --}} -->
            <!-- {{-- 當用 employee 作為驗證的模型 --}} -->
            @can( 'addNewEmployee' ,[ 'employee2' => $employee , 'sw' => 1 ] ) {{-- 這樣可以成功指定到 第二個 employee2 變數 --}}
              <form action="{{ route('employee.edit', $employee->emp_code ) }}" method="GET">
                @csrf
                <button type="submit" name="edit-button" >修改</button>  
              </form>                  
            @endcan        

            <!-- 權限為 127 才能顯示刪除按鈕，注意這裡我沒有使用參數 -->
            @can('del-permission')
              <form action="{{ route('employee.destroy', $employee->emp_code ) }}" method="POST">
                @csrf
                @method('DELETE')
                <button type="submit" name="delete-button" >刪除</button>  
              </form>
            @endcan             
          </td>
        </tr>
      @endforeach
    </tbody>
    <tfoot></tfoot>
  </table>




@endsection