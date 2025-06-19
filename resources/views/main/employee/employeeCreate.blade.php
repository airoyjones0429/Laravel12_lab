@extends('main.main')

@section('content_sub')

    <form action="{{ route('employee.store') }}" method="POST" id="create_form">
        @csrf
        @method('POST')
        <table>
            <tbody>
                <tr>
                    <!-- 員工圖片 -->
                    <td rowspan="5"
                    style="background-color: white;position:relative"
                    >
                        <img src=" {{ asset('storage/png/001.png') }}" alt="無法加載圖片，顯示的文字"
                        class="employee-img maxIMG">
                        <!-- 設定按鈕在圖片上 -->
                        <input type="button" value="更新圖片" disabled
                        style="position:absolute;right:0px;bottom:0px;"
                        >
                    </td>
                    <td>員工編號</td><!-- maxlength 限制輸入字元數量的屬性，我 pattern 還不會使用正則表達式 -->
                    <td><input  type="text" maxlength="6" autocomplete="off"
                                id="emp_code"
                                name="emp_code"
                                value=""></td>
                </tr>
                <tr>
                    <td>員工姓名</td><!-- maxlength 限制輸入字元數量的屬性，只能 4 個中文字，也是輸入 4 -->
                    <td><input  type="text" autocomplete="off"
                                required
                                maxlength="4"
                                id="emp_name"
                                name="emp_name"
                                value=""></td>
                </tr>
                <tr>
                    <td>員工密碼</td><!-- maxlength 限制輸入字元數量的屬性，只能 4 個中文字，也是輸入 4 -->
                    <td>                    
                        <input  type="password" style="display: block;"
                                required autocomplete="off"
                                maxlength="20"
                                id="emp_pwd1"
                                name="emp_pwd1"
                                value=""><br>
                        <input  type="password" style="display: block;"
                                required autocomplete="off"
                                maxlength="20"
                                id="emp_pwd2"
                                name="emp_pwd2"
                                value="">
                    </td>
                </tr>
                <tr>
                    <td>員工分機</td><!-- maxlength 限制輸入字元數量的屬性，只能 4 個中文字，也是輸入 4 -->
                    <td><input  type="text"
                                required autocomplete="off"
                                maxlength="20"
                                id="emp_tel"
                                name="emp_tel"
                                placeholder="請輸入分機"
                                ></td>
                </tr>              
                <tr>
                    <td>員工權限</td><!-- maxlength 限制輸入字元數量的屬性，只能 4 個中文字，也是輸入 4 -->
                    <td><input  type="number"
                                required autocomplete="off"
                                min=0
                                max=127
                                id="emp_lv"
                                name="emp_lv"
                                placeholder="請輸入權限"></td>
                </tr>
                <tr>
                    <td colspan="5">
                        <input type="submit" value="更新資料"  id="updateButton" class="button">
                    </td>
                </tr>
            </tbody>
    
            <tfoot>
                <tr>
                    <td>
                        {{-- session 傳回成功訊息，顯示後就刪除該資訊 --}}
                        @if ( session('success') )
                            {{ session('success') }}
                            {{ session()->forget('success') }}
                        @endif
                    </td>
                </tr>
            </tfoot>
        </table>
    </form>



    <script>
        document.querySelectorAll('input[type="password"]').forEach(
            (input) => {
                input.addEventListener('change',
                    ()=>{
                        let pwd1= document.getElementById('emp_pwd1');
                        let pwd2= document.getElementById('emp_pwd2');
                        if ( (input === pwd1) && ( pwd1.value != pwd2.value ) ){
                            console.log( pwd1.value );
                            pwd2.focus();//設定焦點
                            pwd2.select();//設定全選輸入文字
                        }
                        if (( input === pwd2 ) && ( pwd1.value != pwd2.value ) ){
                            console.log( pwd2.value );
                            pwd1.focus();//設定焦點
                            pwd1.select();//設定全選輸入文字
                        }                        
                        // if ( pwd1.value != pw2.value){
                        //     pwd1.value="";
                        //     pwd1.focus();
                        // }
                        // alert( pwd1.value ); //顯示警告視窗 顯示密碼                    
                    }
                );
            }
        );
        document.getElementById('create_form').addEventListener('submit' , 
            (event)=>{
                event.preventDefault(); //防止預設的事件動作
                console.log('submit');

                let pwd1= document.getElementById('emp_pwd1');
                let pwd2= document.getElementById('emp_pwd2');

                if (pwd1.value != pwd2.value) {
                    //二次輸入密碼，不相同，強制重新輸入
                    pwd1.value="";
                    pwd2.value="";
                    pwd1.style.backgroundColor = "pink" ;
                    pwd2.style.backgroundColor = "pink" ;
                    pwd1.focus();//轉移焦點到 pwd1 上
                }else{
                    event.currentTarget.submit(); // 手動送出表單
                }
            }
        );
    </script>


{{--  
    <form action="{{ route('upload.photo') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <input type="file" name="photo" required>
        <button type="submit">上傳照片</button>
    </form>

--}}


@endsection