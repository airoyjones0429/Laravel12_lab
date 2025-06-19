@extends('main.main')

@section('datafield')
<!-- isset 用來檢查該變數是否設定，有設定才檢查內部的程序 -->
    @isset($MachineManager)    
        {{-- 用 表單 驗證資料 用 fetch API 傳輸資料 --}}
        <form id="newForm" method="POST" >

            <table style="width: 100%;">
                <thead>
                    <!-- 如果只選擇 tr 這二列沒有 checkbox 會造成屬性設定錯誤的問題 -->
                    <tr> 
                        <th colspan="4"> 
                            <!-- {{-- button 標籤元素 預設 type 為 submit ，所以要改掉，因為下面已經有指定 submit 流程了--}} -->
                            <button type="button" id="POST-update-button">POST更新資料</button>
                            <button type="button" id="PUT-update-button">PUT更新資料</button>
                            <button type="button" id="PATCH-update-button">PATCH更新資料</button>
                        </th>
                    </tr>
                    <tr>      
                        <th  class="col-sticky">
                            <div id='delete_head' style="background-color:darkred;">Delete</div>
                            <div id='edit_head' style="background-color:darkgreen;">Edit</div>            
                        </th>
                        <th>Mach_No</th>
                        <th>Mach_Model</th>
                        <th>Mach_ModeNo</th>
                        <th>Mach_Date1</th>
                        <th>Mach_Date2</th>
                        <th>Mach_Years</th>
                        <th>Mach_ReMark</th>
                        <th hidden>created_at</th>
                        <th hidden>updated_at</th>
                    </tr>
                </thead>

                <tbody>
                    <!-- {{ $index = 0 }}  不會顯示在 HTML，但是有模板的效果 !! -->
                    @foreach ( $MachineManager as $Machine )
                    <tr>
                        <td class="col-sticky">
                            <input type="button" id="delete{{ ++$index }}" class="edit-button" value="刪除" hidden>
                            <input type="checkbox" id="edit{{ $index }}" class="edit-checkbox"  disabled >
                        <!-- </td>
                        <td class="col-sticky right"> -->
                        </td>                
                        <td>
                            <input 
                            type="text" id="Mach_No_{{ $index }}" 
                            name="Mach_No" value="{{ $Machine->Mach_No }}"  
                            data-origin-value="{{ $Machine->Mach_No }}" 
                            class="editable-input"
                            >
                        </td>
                        <td>
                            <input 
                            type="text" 
                            id="Mach_Model_{{ $index }}" 
                            name="Mach_Model" 
                            value="{{ $Machine->Mach_Model }}"  
                            data-origin-value="{{ $Machine->Mach_Model }}"  
                            class="editable-input">
                        </td>
                        <td>
                            <input 
                            type="text" 
                            id="Mach_ModeNo_{{ $index }}" 
                            name="Mach_ModeNo" 
                            value="{{ $Machine->Mach_ModeNo }}"   
                            data-origin-value="{{ $Machine->Mach_ModeNo }}"  
                            class="editable-input">
                        </td>            
                        <td>
                            <input 
                            type="date" 
                            id="Mach_Date1_{{ $index }}" 
                            name="Mach_Date1" 
                            value="{{ $Machine->Mach_Date1 }}"   
                            data-origin-value="{{ $Machine->Mach_Date1 }}"  
                            class="editable-input">
                        </td>
                        <td>
                            <input 
                            type="date" 
                            id="Mach_Date2_{{ $index }}" 
                            name="Mach_Date2" 
                            value="{{ $Machine->Mach_Date2 }}"  
                            data-origin-value="{{ $Machine->Mach_Date2 }}"  
                            class="editable-input">
                        </td>
                        <td>
                            <input 
                            type="number" 
                            id="Mach_Years_{{ $index }}" 
                            name="Mach_Years"  
                            value="{{ $Machine->Mach_Years }}"   
                            data-origin-value="{{ $Machine->Mach_Years }}"  
                            class="editable-input" 
                            value="1980" min="1980" max="32767">
                        </td>
                        <td>
                            <input 
                            type="text" 
                            id="Mach_ReMark_{{ $index }}" 
                            name="Mach_ReMark" 
                            value="{{ $Machine->Mach_ReMark }}"  
                            data-origin-value="{{ $Machine->Mach_ReMark }}"  
                            class="editable-input">
                        </td>

                        {{-- 這裡是 Blade 模板語法的註解  不會回應到  客戶端
                            <td hidden>
                                <input type="date" id="created_at_{{ $index }}" name="created_at" value="{{ $Machine->created_at }}"  data-origin-value="{{ $Machine->created_at }}"  class="editable-input">
                            </td>
                            <td hidden>
                                <input type="date" id="updated_at_{{ $index }}" name="updated_at" value="{{ $Machine->updated_at }}"  data-origin-value="{{ $Machine->updated_at }}"  class="editable-input">
                            </td>                    
                            --}}
                    </tr>
                    @endforeach
                </tbody>

    


                <tfoot>
                    <!-- {{-- 增加新增紀錄列 --}} -->
                    <tr id="newRow"></tr>
                    <tr>
                        <td></td>
                        <td colspan="6">
                            <!-- {{-- 雖然 div 沒辦法像 input 或 button 有 submit 功能，但可以讓 input 或 button 長得跟 div 一樣 --}}                                                                                 -->
                            <input type="submit" value="新增紀錄"  id="createNewRecord"  class="button"  >
                        </td>
                    </tr>
                </tfoot>
            </table>
        </form>
        <div id="message"></div>
        <script>
            //為表格元素增加 使用者輸入  事件
            document.querySelectorAll('.editable-input').forEach(function(input) {                
                input.addEventListener('input', function() {
                    // 獲取當前列的 checkbox
                    const checkbox = this.closest('tr').querySelector('.edit-checkbox');
                    checkbox.checked = true; // 自動勾選
                });
            });
            //限制在 DOM 載入完成，才執行 JS 指令
            document.addEventListener('DOMContentLoaded', function() {
                // 在這裡放置你的代碼
                console.log('DOM 已經加載完成，可以安全執行 JavaScript 代碼');

                // 為每個選中的元素，增加使用者自訂事件 ajaxResponseReceived
                document.querySelectorAll('input[type="checkbox"]').forEach( 
                    function( checkbox ){
                        checkbox.addEventListener('ajaxResponseReceived', function(event) {
                            const inputCheckbox = event.detail.checkbox; // 假設你在 detail 中傳遞了 input
                            // inputCheckbox.checked = false; // 取消勾選勾選
                            console.log( '執行 ajaxResponseReceived ' + inputCheckbox.Mach_No  );
                        });
                    }
                );
                //刪除按鈕觸發的程序
                function getDeleteRecord( ){
                    // console.log(this); //會列出按鈕的 HTML 元素原型編碼，這個 this 才會好用
                    const thisRecord = this.closest('tr') ; //找到離按鈕最近的 tr 標籤
                    
                    //從開 tr 標籤，用 CSS 選擇子往下搜尋到符合條件的元素
                    const Mach_No = thisRecord.querySelector('input[name="Mach_No"]') ; 
                    // console.log(Mach_No); //會列出 input 標籤的 HTML 元素原型編碼
                    console.log(Mach_No.value); //會列出 預設值 value 的內容
                    // console.log(Mach_No.hidden); //HTML 元素是否有標記 隱藏屬性
                    // console.log(Mach_No.disabled ); //HTML 元素是否有標記 唯獨屬性

                    // Mach_No.disabled = true ; //有唯獨效果
                    

                    //執行刪除邏輯
                    //刪除列不能被選取
                    thisRecord.querySelectorAll('input').forEach(
                        function( input ) {
                            input.disabled = true ;
                            console.log(input.value);
                        }
                    );

                    fetch(`{{ route('machine.DeleteRouteName') }}/${Mach_No.value}`,
                        // 設定 HTTP 方法為 DELETE 
                        {   method: 'DELETE', 
                            headers:{
                                'X-CSRF-TOKEN': '{{ csrf_token() }}' // Laravel CSRF 保護
                            },
                            // DELETE 方法不能有 body
                            // body: JSON.stringify({ 'TestName': 'test1234' }) 
                        } 
                    )
                    .then( response => response.json() )
                    .then( data => {
                            console.log(data)

                            // //成功刪除後隱藏該筆紀錄
                            thisRecord.hidden = true ; 
                        }
                    )
                    .catch(error => console.error('錯誤：',error));
                }                
                //設定所有刪除按鈕的 click 事件監聽
                document.querySelectorAll('.edit-button').forEach( button => {
                    button.addEventListener( 'click' , getDeleteRecord);
                });
            });    
            // 使用 IIFE（立即執行函式表達式）
            (function() {
                // 在這裡放置你的代碼
                console.log('DOM 已經加載完成，可以安全執行 JavaScript 代碼');
            })();
            //按下編輯標題就會計數
            function clickEditHead(){                
                // console.log( this ); //會列出完整的標籤與內容的HTML
                // console.log( (this.value)==null ); //JS檢查屬性是否為空
                // this.value = (this.value)==null ? 0 : this.value; //為空就初始化
                // console.log( (this.value)==null ); //JS檢查屬性是否為空
                // console.log( (this.value++) ); //以初始化是數字，使用++運算子

                // this 在這裡觸發事件的元素  是 id='edit_head' 元素
                console.log( (this.myValue)==null ); //JS檢查屬性是否為空
                this.myValue = (this.myValue)==null ? 0 : this.myValue; //為空就初始化
                console.log( (this.myValue)==null ); //JS檢查屬性是否為空
                console.log( (this.myValue++) ); //以初始化是數字，使用++運算子
                
                if( this.myValue % 10 == 0) {
                    document.querySelectorAll('input[type="button"]')
                    .forEach(
                        button => {
                            button.hidden=false;
                        }
                    );
                }

            }
            document.getElementById('edit_head').addEventListener('click',clickEditHead);
            //按下刪除標題 3 次 隱藏按鈕
            function clickDeleteHead(){
                //設定一自訂元素屬性當作變數的初始化方式
                this.myValue = (this.myValue == null)? 0 : this.myValue; //為空就初始化
                this.myValue++;
                if( this.myValue % 3 == 0) {
                    document.querySelectorAll('input[type="button"]')
                    .forEach(
                        button => {
                            //設定按鈕為隱藏狀態
                            button.hidden=true;
                        }
                    );
                }                
            }
            document.getElementById('delete_head').addEventListener('click',clickDeleteHead);
            //{{-- 模板語法  所以在 JS 會顯示錯誤 --}}
            //目前資料列數目，儲存在這裡，每次新增都要增加
            var rowCounter = {{ $index }} ;
            //按下新增按鈕的動作
            function clickCreateButton(){
                // console.log('clickCreateButton');
                // 直接抓回要顯示的標籤元素
                const newRow = document.querySelector('table #newRow');
                // const newRow = document.createElement('tr');
                const blankTD = document.createElement('td');
                const machNo = document.createElement('td');
                const machModel = document.createElement('td');
                const machModeNo = document.createElement('td');
                const machDate1 = document.createElement('td');
                const machDate2 = document.createElement('td');
                const machYears = document.createElement('td');
                const machReMark = document.createElement('td');
                
                rowCounter++; //新增一資料列
                blankTD.innerHTML=`<button>新</button>`;
                machNo.innerHTML='<input type="text"   name="Mach_No" class="new-record" required>';
                machModel.innerHTML=`<input type="text"   name="Mach_Model"  class="new-record" required>`;
                machModeNo.innerHTML=`<input type="text"   name="Mach_ModeNo"  class="new-record" required>`;
                machDate1.innerHTML=`<input type="date"  name="Mach_Date1"  class="new-record" required>` ;
                machDate2.innerHTML=`<input type="date"  name="Mach_Date2"  class="new-record" required>`;
                machYears.innerHTML=`<input type="number"  name="Mach_Years"  class="new-record"  
                                        value="1980"  min="1980"  max="32767" required >`;
                machReMark.innerHTML=`<input type="text"   name="Mach_ReMark"  class="new-record">`;

                //將新增的 td 元素，附加到 tr 中
                newRow.appendChild(blankTD);
                newRow.appendChild(machNo);
                newRow.appendChild(machModel);
                newRow.appendChild(machModeNo);
                newRow.appendChild(machDate1);
                newRow.appendChild(machDate2);
                newRow.appendChild(machYears);
                newRow.appendChild(machReMark);

                //表單標籤 無法 加入 tbody 標籤，用表單把 Table 包起來
                // newForm.appendChild(newRow);
                // tBody.appendChild(newRow);
                // //新增的元素  建立時不會設定所有屬性內容!?
                // console.log( machNo.innerHTML ); //有數值  因為有直接設定
                // console.log( machNo );                
                //直接 .屬性名稱不行的話  就用 getAttribute() 試試看
                // console.log( this.id );//列出 HTML 元素的 id 屬性
                // console.log( this.getAttribute('class') );//列出 HTML 元素的 class 屬性
                // console.log( this.innerHTML );//列出 HTML 元素的 id 屬性

                //移除 this 的新增按鈕事件
                document.getElementById( this.id ).removeEventListener('click', clickCreateButton );

                
                // 將新增紀錄改成儲存新增紀錄
                // id 名稱也要改成 saveNewRecord
                this.id = "saveNewRecord" ;
                this.innerHTML = "儲存新增紀錄" ;    
                this.title = 'DIV 我還沒辦法做出 能簡單驗證的 按鈕';            
                this.value = "儲存新增紀錄" ;    
                //新增 saveNewRecord click 事件
                // document.getElementById('saveNewRecord').addEventListener('click',clickSaveButton);

                // form 表單的 submit 檢查 輸入 input 標籤 是否符合條件的功能  只能使用 input 標籤 
                // document.getElementById('saveNewRecord').addEventListener('click',()=>{
                //     // 手動觸發 submit 事件
                //     // form.dispatchEvent(submitEvent);
                // });
                
                // console.log( document.getElementsByTagName('tbody').item.length );
            }
            //監聽 Form 表單 submit 事件
            document.getElementById('newForm').addEventListener('submit', function(event) {
                event.preventDefault(); // 阻止默認的提交行為

                // 執行您想要的其他函數
                console.log('newForm');

                // 執行儲存動作
                clickSaveButton()

                // 如果需要，可以手動提交表單
                // this.submit();
            });
            //按下儲存按鈕 ( 新增資料的儲存處理 )
            function clickSaveButton(){
                console.log('clickSaveButton');

                // querySelector('以CSS選擇方式選擇HTML元素')  #選特定ID .選特定類別 標籤名稱選特定標籤 ...等
                const machNo = document.querySelector('.new-record[name="Mach_No"]');
                const machModel = document.querySelector('.new-record[name="Mach_Model"]');
                const machModeNo = document.querySelector('.new-record[name="Mach_ModeNo"]');
                const machDate1 = document.querySelector('.new-record[name="Mach_Date1"]');
                const machDate2 = document.querySelector('.new-record[name="Mach_Date2"]');
                const machYears = document.querySelector('.new-record[name="Mach_Years"]');
                const machReMark = document.querySelector('.new-record[name="Mach_ReMark"]');

                //取出 input 標籤的值 OK                
                // console.log( machNo.value );
                // console.log( machModel.value );
                // console.log( machModeNo.value );
                // console.log( machDate1.value );
                // console.log( machDate2.value );
                // console.log( machNo.value );
                // console.log( machYears.value );
                // console.log( machReMark.value);

                
                // //選擇所有 .new-record 的類別元素
                // const newitems = document.querySelectorAll('.new-record');
                // console.log( newitems.length );
                // newitems.forEach(
                //     newitem => {
                //         console.log( newitem.id ); //可用
                //         console.log( newitem.name ); //可用
                //         console.log( newitem.type ); //可用
                //     }
                // );

                //增加新增資料的 JS object 格式資料
                //下面是 JS 的物件 {} 用大括號包起來的是JS物件
                const create={
                    'machNo':machNo.value ,
                    'machModel':machModel.value,
                    'machModeNo':machModeNo.value,
                    'machDate1':machDate1.value,
                    'machDate2':machDate2.value,
                    'machYears':machYears.value,
                    'machReMark':machReMark.value
                };
                //列出物件資訊
                console.log( create );
                //列出物件轉換JSON資訊，JSON 轉換可以轉換多筆物件，把物件放到陣列中，達到傳送多個物件
                console.log( JSON.stringify(create) );

                // 發送 AJAX 請求更新資料，這裡的 POST 是一次更新所有要更新的資料
                fetch( `{{ route("machine.store") }}`, {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}' // Laravel CSRF 保護
                    },
                    body: JSON.stringify(create) // 將所有更新的資料發送到後端
                })
                .then(response => response.json())
                .then(data => {
                    //顯示 伺服端的回應
                    console.log( data );
                    console.log( '以下列出，各欄位資料' );
                    console.log( data.error );      //自訂錯誤訊息屬性
                    console.log( data.message );    //自訂正常訊息屬性
                    console.log( data.newData );    //自訂新資料內容屬性
                    console.log( data.oldData );    //自訂舊資料內容屬性
                    console.log( data.otherData );  //不存在的屬性，傳回 undefined
                    
                    //自動刷新頁面，按下 list_all_machine 表單 的 submit 按鈕
                    document.getElementById('list_all_machine').submit();

                    //顯示                     
                    // if (data.success) {
                    //     console.log('資料更新成功');
                    //     console.log(data);
                    //     // 這裡可以加入一些提示用戶的訊息，例如顯示成功通知
                    // } else {
                    //     console.error('資料更新失敗');
                    // }
                })
                .catch(error => console.error('錯誤:', error));

            }
            document.getElementById('createNewRecord').addEventListener('click',clickCreateButton); 
        </script>
        <script>
            //除錯用函式
            function test(){
                alert('test1');
            }
            //批次更新多筆資料，用 POST
            //什麼事件，按鈕按下事件
            document.getElementById('POST-update-button').addEventListener('click',
                function(){
                    //什麼元素
                    //所有表格中的 tbody 元素中的 tr 元素
                    const rows = document.querySelectorAll('tbody tr');

                    //暫時儲存區
                    const updates = [] ;

                    //已經知道 rows 是可迭代物件
                    rows.forEach( row =>
                        {
                            // console.log(row); //列出每一列
                            // querySelector 選擇符合條件的第一個元素的方法
                            const checkbox = row.querySelector('input[type="checkbox"]');
                            // console.log( checkbox );
                            
                            //            querySelector 選擇input標籤 並且 name 屬性是 Mach_No 的元素
                            const machNo = row.querySelector('input[name="Mach_No"]').value;
                            const machModel = row.querySelector('input[name="Mach_Model"]').value;
                            const machModeNo = row.querySelector('input[name="Mach_ModeNo"]').value;
                            const machDate1 = row.querySelector('input[name="Mach_Date1"]').value;
                            const machDate2 = row.querySelector('input[name="Mach_Date2"]').value;
                            const machYears = row.querySelector('input[name="Mach_Years"]').value;
                            const machReMark = row.querySelector('input[name="Mach_ReMark"]').value;
                            
                            if (checkbox) {
                                //如果有元素存在，就會執行這裡
                                console.log(checkbox.checked); // 確保在訪問 checked 之前，checkbox 是存在的
                                if(checkbox.checked){
                                    updates.push(
                                        {
                                        'machNo':machNo ,
                                        'machModel':machModel,
                                        'machModeNo':machModeNo,
                                        'machDate1':machDate1,
                                        'machDate2':machDate2,
                                        'machYears':machYears,
                                        'machReMark':machReMark
                                        }
                                    );
                                }
                            } else {
                                //如果沒有 checkbox 元素，null 會執行這裡
                                console.log('該行沒有 checkbox');
                            }
                        }                    
                    );
                    
                    //列出陣列的所有內容
                    console.log(updates);
                    
                    //陣列是儲存了  物件 所以可以這樣取值
                    console.log(updates[0]['machNo']);

                    //陣列是儲存了  物件 所以也可以這樣取值
                    console.log(updates[0].machNo);
                    
                    console.log('test111');
                    console.log(JSON.stringify(updates));

                    //模板與JS資料拼接方式
                    console.log( `{{ route("machine.PutUpdate",'machno') }}/${updates[0]['machNo']} `);

                    // 發送 AJAX 請求更新資料，這裡的 POST 是一次更新所有要更新的資料
                    fetch( `{{ route("machine.PostUpdate") }}`, {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': '{{ csrf_token() }}' // Laravel CSRF 保護
                        },
                        body: JSON.stringify(updates) // 將所有更新的資料發送到後端
                    })
                    .then(response => response.json())
                    .then(data => {
                        if (data.success) {
                            console.log('資料更新成功');
                            console.log(data);
                            // 這裡可以加入一些提示用戶的訊息，例如顯示成功通知
                        } else {
                            console.error('資料更新失敗');
                        }
                    })
                    .catch(error => console.error('錯誤:', error));
                    console.log('POST-update-button  END');
                }                
            );
            //==============================================================
            //==============================================================
            //===== PUT ====================================================
            //批次，更新一筆資料，發出多個要求
            //什麼事件，按鈕按下事件
            document.getElementById('PUT-update-button').addEventListener('click',
                function(){
                    //什麼元素
                    //所有表格中的 tbody 元素中的 tr 元素
                    const rows = document.querySelectorAll('tbody tr');

                    //暫時儲存區
                    const updates = [] ;

                    //已經知道 rows 是可迭代物件
                    rows.forEach( row =>
                        {
                            // console.log(row); //列出每一列
                            // querySelector 選擇符合條件的第一個元素的方法
                            const checkbox = row.querySelector('input[type="checkbox"]');
                            // console.log( checkbox );
                            // const 只能設定一次 的變數 querySelector( 'CSS 選擇運算子' )
                            const machNo        = row.querySelector('input[name="Mach_No"]').value;
                            const machModel     = row.querySelector('input[name="Mach_Model"]').value;
                            const machModeNo    = row.querySelector('input[name="Mach_ModeNo"]').value;
                            const machDate1     = row.querySelector('input[name="Mach_Date1"]').value;
                            const machDate2     = row.querySelector('input[name="Mach_Date2"]').value;
                            const machYears     = row.querySelector('input[name="Mach_Years"]').value;
                            const machReMark    = row.querySelector('input[name="Mach_ReMark"]').value;
                            
                            if (checkbox) {
                                //如果有元素存在，就會執行這裡
                                console.log(checkbox.checked); // 確保在訪問 checked 之前，checkbox 是存在的
                                if(checkbox.checked){
                                    //PUT RESTful 規則為，全欄位更新
                                    updates.push(
                                        {
                                        'machNo':machNo ,
                                        'machModel':machModel,
                                        'machModeNo':machModeNo,
                                        'machDate1':machDate1,
                                        'machDate2':machDate2,
                                        'machYears':machYears,
                                        'machReMark':machReMark
                                        }
                                    );
                                }
                            } else {
                                //如果沒有 checkbox 元素，null 會執行這裡
                                console.log('該行沒有 checkbox');
                            }
                        }                    
                    );
                    
                    //列出陣列的所有內容
                    console.log(updates);

                    console.log(updates[0]); //沒陣列元素時，值為 undefind

                    if( updates.length > 0){ //防止無資料更新的錯誤
                        
                        //陣列是儲存了  物件 所以可以這樣取值
                        console.log(updates[0]['machNo']);
    
                        //陣列是儲存了  物件 所以也可以這樣取值
                        console.log(updates[0].machNo);
                        
                        console.log('test111');
                        console.log(JSON.stringify(updates));                 
    
                        //模板與JS資料拼接方式，有參數 會無法通過 laravel 檢查 一定要輸入直
                        //Missing required parameter for [Route: machine.PutUpdate] [URI: machine/put/{MachNo}] [Missing parameter: MachNo].
                        //{{--  Blade 模板註解
                        //console.log( `{{ route("machine.PutUpdate",'') }}/${updates[0]['machNo']} `);
                        //因為上面那行會有上上行的錯誤訊息，所以先不用命名路由來處理
                        //  Blade 模板註解 --}}
                        
    
                        updates.forEach( update => {
                            //更新所有項目
    
                            // 發送 AJAX 請求更新資料
                            fetch( `/machine/put/${update['machNo']}`, {
                                method: 'PUT',  //PUT 用在更新資料，但我都用失敗了   POST 用在新增資料的儲存，還行
                                headers: {
                                    'Content-Type': 'application/json',
                                    'X-CSRF-TOKEN': '{{ csrf_token() }}' // Laravel CSRF 保護
                                },
                                // 將所有更新的資料發送到後端  update 這裡是一筆更新資料  每次只送出一筆資料的更新
                                body: JSON.stringify(update) 
                            })
                            .then(response => response.json())
                            .then(data => {
                                //data 是 JSON 處理後的結果
                                //data 中要有 success 欄位名稱，才能算是資料更新成功
                                //所以在伺服端更新成功後，要用這個欄位設定值
                                if (data.success) {
                                    console.log('資料更新成功');
                                    console.log(data);
                                    showMessage(data.success);
                                    // 這裡可以加入一些提示用戶的訊息，例如顯示成功通知
                                } else {
                                    console.error('資料更新失敗');
                                }
                            })
                            .catch(error => console.error('錯誤:', error));
                        }  )
                    }
                }
            );
            //==============================================================
            //==============================================================
            //===== PATCH ====================================================
            //批次，更新一筆資料，發出多個要求
            //什麼事件，按鈕按下事件
            document.getElementById('PATCH-update-button').addEventListener('click',
                function(){
                    //什麼元素
                    //所有表格中的 tbody 元素中的 tr 元素
                    const rows = document.querySelectorAll('tbody tr');

                    //暫時儲存區
                    const updates = [] ;

                    //已經知道 rows 是可迭代物件
                    rows.forEach( row =>
                        {
                            // console.log(row); //列出每一列
                            // querySelector 選擇符合條件的第一個元素的方法
                            const checkbox = row.querySelector('input[type="checkbox"]');
                            // console.log( checkbox );
                            // const 只能設定一次 的變數 querySelector( 'CSS 選擇運算子' )
                            const machNo        = row.querySelector('input[name="Mach_No"]').value;
                            const machModel     = row.querySelector('input[name="Mach_Model"]').value;
                            const machModeNo    = row.querySelector('input[name="Mach_ModeNo"]').value;
                            const machDate1     = row.querySelector('input[name="Mach_Date1"]').value;
                            const machDate2     = row.querySelector('input[name="Mach_Date2"]').value;
                            const machYears     = row.querySelector('input[name="Mach_Years"]').value;
                            const machReMark    = row.querySelector('input[name="Mach_ReMark"]').value;
                            
                            //HTML 自訂屬性要是用 data-開頭，後面都要小寫，因為大寫在客戶端也會變成小寫，如果真的要大寫，要再要大寫的字目前加上 - 符號
                            const origin_machNo        = row.querySelector('input[name="Mach_No"]').dataset.originValue; 
                            const origin_machModel     = row.querySelector('input[name="Mach_Model"]').dataset.originValue;
                            const origin_machModeNo    = row.querySelector('input[name="Mach_ModeNo"]').dataset.originValue;
                            const origin_machDate1     = row.querySelector('input[name="Mach_Date1"]').dataset.originValue;
                            const origin_machDate2     = row.querySelector('input[name="Mach_Date2"]').dataset.originValue;
                            const origin_machYears     = row.querySelector('input[name="Mach_Years"]').dataset.originValue;
                            const origin_machReMark    = row.querySelector('input[name="Mach_ReMark"]').dataset.originValue;  
                            
                            // console.log( machNo );
                            // console.log( origin_machNo );

                            if (checkbox) {
                                // 如果有元素存在，就會執行這裡
                                // console.log(checkbox.checked); // 確保在訪問 checked 之前，checkbox 是存在的
                                if(checkbox.checked){
                                    //PUT RESTful 規則為，全欄位更新
                                    updates.push(
                                        {
                                        'machNo':machNo ,
                                        'machModel':machModel  ,
                                        'machModeNo':machModeNo,
                                        'machDate1':machDate1,
                                        'machDate2':machDate2,
                                        'machYears':machYears,
                                        'machReMark':machReMark
                                        }
                                    );
                                    // console.log( updates.length ) ;  //陣列長度
                                    // 相同的資料，就不用傳送過去
                                    if( origin_machModel == machModel ) {delete updates[updates.length-1].machModel }
                                    if( origin_machModeNo == machModeNo ) {delete updates[updates.length-1].machModeNo }
                                    if( origin_machDate1 == machDate1 ) {delete updates[updates.length-1].machDate1 }
                                    if( origin_machDate2 == machDate2 ) {delete updates[updates.length-1].machDate2 }
                                    if( origin_machYears == machYears ) {delete updates[updates.length-1].machYears }
                                    if( origin_machReMark == machReMark ) {delete updates[updates.length-1].machReMark }
                                    console.log(updates[updates.length-1]); //列出要更新的資料
                                }
                            } else {
                                //如果沒有 checkbox 元素，null 會執行這裡
                                console.log('該行沒有 checkbox');
                            }
                        }                    
                    );
                    
                    //列出陣列的所有內容
                    // console.log(updates);

                    // console.log(updates[0]); //沒陣列元素時，值為 undefind

                    if( updates.length > 0){ //防止無資料更新的錯誤
                        
                        //陣列是儲存了  物件 所以可以這樣取值
                        // console.log(updates[0]['machNo']);
    
                        //陣列是儲存了  物件 所以也可以這樣取值
                        // console.log(updates[0].machNo);
                        
                        // console.log('test111');
                        // console.log(JSON.stringify(updates));                 
    
                        //模板與JS資料拼接方式，有參數 會無法通過 laravel 檢查 一定要輸入值
                        //Missing required parameter for [Route: machine.PutUpdate] [URI: machine/put/{MachNo}] [Missing parameter: MachNo].
                        //{{--  Blade 模板註解
                        //console.log( `{{ route("machine.PutUpdate",'') }}/${updates[0]['machNo']} `);
                        //因為上面那行會有上上行的錯誤訊息，所以先不用命名路由來處理
                        //  Blade 模板註解 --}}
                        
                        
                        //這樣會根據要跟新的項目，每次向伺服器要求更新一次
                        //多筆資料要更新，就會要求多次
                        updates.forEach( update => {
                            //更新所有項目
    
                            // 發送 AJAX 請求更新資料
                            fetch( `{{ route('machine.PatchUpdateRouteName') }}/${update['machNo']}`, {
                                method: 'PATCH',
                                headers: {
                                    'Content-Type': 'application/json',
                                    'X-CSRF-TOKEN': '{{ csrf_token() }}' // Laravel CSRF 保護
                                },
                                body: JSON.stringify(update) // 將所有更新的資料發送到後端  update 這裡是一筆更新資料  每次只送出一筆資料的更新
                            })
                            .then(response => response.json())
                            .then(data => {
                                //data 是 JSON 處理後的結果
                                //data 中要有 success 欄位名稱，才能算是資料更新成功
                                //所以在伺服端更新成功後，要用這個欄位設定值
                                if (data.success) {
                                    console.log('資料更新成功');
                                    console.log(data);
                                    // console.log(data.success);

                                    // 將 JSON 字串轉換為 JavaScript 物件
                                    const responseObject = JSON.parse(data.success);

                                    // 讀取每個欄位的內容  OK
                                    // console.log('Mach_No:', responseObject.Mach_No);
                                    // console.log('Mach_Model:', responseObject.Mach_Model);
                                    // console.log('Mach_ModeNo:', responseObject.Mach_ModeNo);
                                    // console.log('Mach_Date1:', responseObject.Mach_Date1);
                                    // console.log('Mach_Date2:', responseObject.Mach_Date2);
                                    // console.log('Mach_ReMark:', responseObject.Mach_ReMark);
                                    // console.log('Mach_Years:', responseObject.Mach_Years);
                                    // console.log('created_at:', responseObject.created_at);
                                    // console.log('updated_at:', responseObject.updated_at);


                                    // 在畫面上，顯示更新成功訊息
                                    showMessage(data.success);


                                    // 假設請求成功後，觸發自定義事件 ajaxResponseReceived 是自訂的事件名稱
                                    const event = new CustomEvent('ajaxResponseReceived', { 
                                        detail: { Mach_No: responseObject.Mach_No } // 傳遞 detail.Mach_No 屬性
                                    });

                                    //找尋更新完成的項目，是在目前頁面的哪一個項目
                                    // let updateITEM ;
                                    let updateCheckBoxITEM ;
                                    document.querySelectorAll('input[name="Mach_No"]').forEach(
                                        item =>{
                                            if( responseObject.Mach_No == item.value  ){
                                                console.log(item.value); //列出標籤元素的 value 屬性
                                                // updateITEM = item ; //將這次更新成功的標籤元素挑出來

                                                //找到被更新的資料列，並將 checked 屬性狀態列出在終端機上
                                                // console.log( item.closest('tr').querySelector('input[type="checkbox"]').checked ) ;
                                                updateCheckBoxITEM = item.closest('tr').querySelector('input[type="checkbox"]') ;
                                                updateCheckBoxITEM.dispatchEvent(event); //觸發外部自訂程序，自訂事件觸發練習
                                            }
                                        }
                                    );
                                    
                                    //取消勾選
                                    updateCheckBoxITEM.checked = false ;

                                    //派發事件  與監聽事件要是同樣的元素，不然無法觸發
                                    // document.dispatchEvent(event);
                                } else {
                                    console.error('資料更新失敗');
                                }
                            })
                            .catch(error => console.error('錯誤:', error));
                        }  )
                    }
                }
            );
            //更新成功後，應該要把原本標記更新的記號取消
            function cancelAllCheckbox(){
                //選擇所有的 checkbox 並取消所有的 checked 標記
                document.querySelectorAll("input[type='checkbox']")
                .forEach(
                    checkbox => {
                        console.log(checkbox);
                        checkbox.checked = false;
                    }
                ) ;
            }
            //在網頁最下方顯示，成功更新的訊息
            function showMessage( stringMessage ){
                let message = document.getElementById('message') ;
                message.innerHTML = message.innerHTML + '<br>' + stringMessage ;                
            }
        </script>
    @endisset
@endsection