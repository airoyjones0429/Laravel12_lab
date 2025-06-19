@extends('main.invoice.receipt')

@section('receipt_sub')

    @if($rentM && $rentds)
    <div class="normal-form-button">
        <input id="queryButton" type="button" value="查詢" class="button">
        <input type="button" value="　　" class="button" disabled>
        <input type="button" value="　　" class="button" disabled>
        <input id="addNewButton" type="button" value="新增" class="button">
        <input id="addNewSaveButton" type="button" value="新增儲存" class="button">
        <input type="button" value="　　" class="button" disabled>
        <input id="updateButton" type="button" value="修改" class="button">
        <input id="updateSaveButton" type="button" value="修改儲存" class="button">
        <input id="cancelButton" type="button" value="取消" class="button">
        <input type="button" value="　　" class="button" disabled>
        <input id="printButton" type="button" value="列印" class="button" onclick="printElement('myCanvas')">
        <input type="button" value="　　" class="button" disabled>
        <input type="button" value="　　" class="button" disabled>
        <input type="button" value="　　" class="button" disabled>
        <input id="deleteButton" type="button" value="刪除" class="button">
    </div>
    <br>
        <table id="ContractTable">
            <tbody>
                <tr>
                    <td>
                        <label for="RENT_NO" name="RENT_NO">租賃編號</label>
                        <input  type="text" readonly
                        name="RENT_NO" class="mainfile"
                        id="RENT_NO"
                        value="{{ $rentM->RENT_NO }}">
                    </td>
                    <td>
                        <label for="RENT_UNO" name="RENT_UNO">租賃發票編號</label>
                        <input  type="text" readonly
                                name="RENT_UNO" class="mainfile"
                                id="RENT_UNO"
                                value="{{ $rentM->RENT_UNO }}">
                    </td>
                    <td>
                        <label for="RENT_UNO_DAT" name="RENT_UNO_DAT">租賃發票日期</label>
                        <input  type="date" readonly
                        name="RENT_UNO_DAT" class="mainfile"
                        id="RENT_UNO_DAT"
                        value="{{ $rentM->RENT_UNO_DAT }}">
                    </td>
                    <td>
                        <label for="RENT_PDATE" name="RENT_PDATE">列印日期</label>
                        <input  type="date" readonly
                                name="RENT_PDATE" class="mainfile"
                                id="RENT_PDATE"
                                value="{{ $rentM->RENT_PDATE }}">
                    </td>
                </tr>
                <tr>
                    <td>
                        <label for="RENT_CNO" name="RENT_CNO">客戶編號</label>
                        <input  type="text" readonly
                        name="RENT_CNO" class="mainfile"
                        id="RENT_CNO"
                        value="{{ $rentM->RENT_CNO }}">
                    </td>
                    <td colspan="2" >
                        <label for="RENT_CNAME" name="RENT_CNAME">客戶名稱</label>
                        <input  type="text" readonly
                        name="RENT_CNAME" style="width: 80%;"
                        id="RENT_CNAME" class="mainfile"
                        value="{{ $rentM->RENT_CNAME }}">
                    </td>
                    <td>
                        <label for="RENT_CTMUNO" name="RENT_CTMUNO">客戶統一編號</label>
                        <input  type="text" readonly
                        name="RENT_CTMUNO"
                        id="RENT_CTMUNO" class="mainfile"
                        value="{{ $rentM->RENT_CTMUNO }}">
                    </td>
                </tr>
                <tr>
                    <td colspan="4" class="left">
                        <label for="RENT_CTMADRS" name="RENT_CTMADRS">客戶發票地址</label>
                        <input  type="text" readonly
                        name="RENT_CTMADRS" style="width: 80%;"
                        id="RENT_CTMADRS" class="mainfile"
                        value="{{ $rentM->RENT_CTMADRS }}"> 
                    </td>
                </tr>
                <tr>
                    <td colspan="4" class="left">
                        <label for="RENT_ADRS" name="RENT_ADRS">客戶工地地址</label>
                        <input  type="text" readonly
                        name="RENT_ADRS" style="width: 80%;"
                        id="RENT_ADRS" class="mainfile"
                        value="{{ $rentM->RENT_ADRS }}">                    
                    </td>
                </tr>
                
                <tr>
                    <td colspan="4">
                        <table>
                            <thead >
                                <tr>
                                    
                                    <!-- <td>租賃編號</td> 改成 no改成 no -->
                                    <td> no. </td>
                                    <td>機具型式</td>
                                    <td>合約日期</td>
                                    <td>機具編號</td>
                                    <td>起　日期</td>
                                    <td>迄　日期</td>
                                    <td>租賃天數</td>
                                    <td>請款金額</td>
                                    <td>退租日期</td>
                                    <td>運　　費</td>
                                    <td>合約編號</td>
                                    <td hidden>租賃單號</td>
                                </tr>
                            </thead>
                            <tbody>{{-- 顯示租賃明細資料 --}}
                                <!-- {{ $rentdindex = 0 }} -->
                                @foreach ( $rentds as $rentd )
                                <!-- {{ ++$rentdindex }} -->

                                <tr id="row{{ $rentdindex }}">

                                    <td>
                                        <input  type="text"  style="width: 20px;"
                                                name="RENT_DNO" class="text_center"
                                                value="{{ $rentd->RENT_DNO }}"
                                                disabled >
                                    </td>
                                    <td>
                                        <!-- JS 的 唯獨屬性 readOnly 與直接設定 HTML 標籤 readonly 大小寫不同 !! -->
                                        <input  type="text"  style="width: 75px;" readonly
                                                name="RENT_DMODEL" class="editable"
                                                value="{{ $rentd->RENT_DMODEL }}">
                                    </td>
                                    <td>
                                        <input  type="date" style="width: 100px;" readonly
                                                name="RENT_DDATE" class="editable"
                                                value="{{ $rentd->RENT_DDATE }}">
                                    </td>
                                    <td>
                                        <input  type="text" style="width: 100px;" readonly
                                                name="RENT_DMSN" class="editable"
                                                value="{{ $rentd->RENT_DMSN }}">
                                    </td>
                                    <td>
                                        <input  type="date" style="width: 100px;" readonly
                                                name="RENT_DDATE1" class="editable"
                                                value="{{ $rentd->RENT_DDATE1 }}">
                                    </td>
                                    <td>
                                        <input  type="date" style="width: 100px;" readonly
                                                name="RENT_DDATE2" class="editable"
                                                value="{{ $rentd->RENT_DDATE2 }}">
                                    </td>
                                    <td>
                                        <input  type="number" style="width: 100px;" readonly
                                                name="RENT_DAY" class="editable text_right"
                                                value="{{ $rentd->RENT_DAY }}">
                                    </td>
                                    <td>
                                        <input  type="number" style="width: 100px;" readonly
                                                name="RENT_AMT" class="editable text_right"
                                                value="{{ $rentd->RENT_AMT }}">
                                    </td>
                                    <td>
                                        <input  type="date" style="width: 100px;" readonly
                                                name="RENT_FDATE" class="editable"
                                                value="{{ $rentd->RENT_FDATE }}">
                                    </td>
                                    <td>
                                        <input  type="number"  style="width: 100px;" readonly
                                                name="RENT_FEE" class="editable text_right"
                                                value="{{ $rentd->RENT_FEE }}">
                                    </td>
                                    <td>
                                        <!-- 合約編號 -->
                                        <input  type="text" style="width: 100px;" readonly
                                                name="RENT_Contract_No" class="editable"
                                                value="{{ $rentd->RENT_Contract_No }}">
                                    </td>
                                    <td hidden >
                                        <!-- 租賃單號 -->
                                        <input  type="text" style="width: 100px;" readonly
                                                name="RENT_NO" 
                                                value="{{ $rentd->RENT_NO }}">
                                    </td>
                                    <td hidden>
                                        <input  type="button"
                                                id="update{{ $rentdindex }}"
                                                class="update-detail"
                                    >
                                    </td>
                                    <td hidden>
                                        <!-- 更新用表單位置 -->
                                        <form id="detail{{ $rentdindex }}">
                                            @csrf
                                            @method('POST')
                                        </form>
                                    </td>
                                </tr>
                                
                                @endforeach
                            </tbody>
                        </table>
                        
                    </td>
                </tr>                

                <tr style="position: relative;">
                    <td colspan="4" class="left">
                        <label for="RENT_REMARK" name="RENT_REMARK" class="left"
                        >客戶備註</label>
                        <textarea name="RENT_REMARK" id="RENT_REMARK" 
                        style="width: 80%;" class="mainfile"
                        >{{ $rentM->RENT_REMARK }}</textarea>
                    </td>
                </tr>
            </tbody>
        </table>

        <!-- JS 測試用按鈕 -->
        <input id="readOnlyToggle" type="button" value="切換表格唯讀狀態" >
        <input id="readOnlyTrue" type="button" value="表格唯讀 True" >
        <input id="readOnlyFalse" type="button" value="表格唯讀 False" >
        <input id="removeInputEvent" type="button" value="移除可輸入欄位的 輸入事件" >
        <input id="showUpdating" type="button" value="列出目前待更新的資料" >
        <input id="updateMailFile" type="button" value="更新主檔資料" >
        <input id="printSaveDataOnClient" type="button" value="列出儲存在客戶端的資料" onclick="saveServeDetailData();printDetail();" >

        <input id="printDataOnCanvas" type="button" value="在畫布中，列印資料" onclick="printText2Canvas( dataArray );" >


        <!-- xxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx -->
        <!-- xxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx -->
        <!-- xxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx -->
        <!-- 列印區塊設定 -->
        <!-- 畫布大小必須要在這裡設定 -->
        <!-- <canvas id="myCanvas" width="1275" height="825" class="printScreen"></canvas> -->
        <canvas id="myCanvas" width="1075" height="723" class="printScreen"></canvas>
        <div style="display: flex;">
            <div id="print-RENT_NO">
                <input type="text" placeholder="租賃單號" name="print-value" value="{{ $rentM->RENT_NO }}">
                <input type="number" name="x" placeholder="x 軸座標">
                <input type="number" name="y" placeholder="y 軸座標">
                <!-- this 代表觸發事件的 這個元素 -->
                <input type="button" value="列印文字" onclick="clickSetXYButton( this )" >
            </div>
            <div id="print-RENT_UNO" >
                <input type="text" placeholder="發票編號" name="print-value" value="{{ $rentM->RENT_UNO }}">
                <input type="number" name="x" placeholder="x 軸座標">
                <input type="number" name="y" placeholder="y 軸座標">                
                <input type="button" value="列印文字" onclick="clickSetXYButton( this )" >
            </div>
            <div id="print-RENT_UNO_DAT">
                <input type="text" placeholder="發票日期" name="print-value" value="{{ $rentM->RENT_UNO_DAT }}">
                <input type="number" name="x" placeholder="x 軸座標">
                <input type="number" name="y" placeholder="y 軸座標">
                <input type="button" value="列印文字" onclick="clickSetXYButton( this )" >
            </div>
            <div id="print-RENT_PDATE">
                <input type="text" placeholder="列印日期" name="print-value" value="{{ $rentM->RENT_PDATE }}">
                <input type="number" name="x" placeholder="x 軸座標">
                <input type="number" name="y" placeholder="y 軸座標">
                <input type="button" value="列印文字" onclick="clickSetXYButton( this )" >
            </div>
            <div id="print-RENT_CNO">
                <input type="text" placeholder="客戶編號" name="print-value" value="{{ $rentM->RENT_CNO }}">
                <input type="number" name="x" placeholder="x 軸座標">
                <input type="number" name="y" placeholder="y 軸座標">
                <input type="button" value="列印文字" onclick="clickSetXYButton( this )" >
            </div>
            <div id="print-RENT_CNAME">
                <input type="text" placeholder="客戶名稱" name="print-value" value="{{ $rentM->RENT_CNAME }}">
                <input type="number" name="x" placeholder="x 軸座標">
                <input type="number" name="y" placeholder="y 軸座標">
                <input type="button" value="列印文字" onclick="clickSetXYButton( this )" >
            </div>
            <div id="print-RENT_CTMUNO">
                <input type="text" placeholder="客戶統編" name="print-value" value="{{ $rentM->RENT_CTMUNO }}">
                <input type="number" name="x" placeholder="x 軸座標">
                <input type="number" name="y" placeholder="y 軸座標">
                <input type="button" value="列印文字" onclick="clickSetXYButton( this )" >
            </div>
            <div id="print-RENT_CTMADRS">
                <input type="text" placeholder="客戶地址" name="print-value" value="{{ $rentM->RENT_CTMADRS }}">
                <input type="number" name="x" placeholder="x 軸座標">
                <input type="number" name="y" placeholder="y 軸座標">
                <input type="button" value="列印文字" onclick="clickSetXYButton( this )" >
            </div>
            <div id="print-RENT_ADRS">
                <input type="text" placeholder="工地地址" name="print-value" value="{{ $rentM->RENT_ADRS }}">
                <input type="number" name="x" placeholder="x 軸座標">
                <input type="number" name="y" placeholder="y 軸座標">                
                <input type="button" value="列印文字" onclick="clickSetXYButton( this )" >
            </div>
            <div id="print-RENT_REMARK">
                <input type="text" placeholder="備註" name="print-value" value="{{ $rentM->RENT_REMARK }}">
                <input type="number" name="x" placeholder="x 軸座標">
                <input type="number" name="y" placeholder="y 軸座標">
                <input type="button" value="列印文字" onclick="clickSetXYButton( this )" >
            </div>                                                                                                                                    
        </div>

        <!-- 使用圖片當作列印格式時，要先在瀏覽器列上測試，是否可以讀取 -->
        <div>
            <img id="bill" src="{{ url('storage/photos/bill.png') }}" alt="">
            <input type="button" onclick="drawImage( this )">
        </div>
        <!-- xxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx -->
        <!-- xxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx -->
        <!-- xxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx -->


        <script>
            //設定可編輯欄位 EditableClass 唯獨屬性
                // input 唯獨屬性  是 readOnly 大小寫錯了就錯了  只會出現 undefind 不會出現錯誤!!
                // 原本的設定 XOR true => 重複呼叫 => 切換功能
                function setInputClassReadOnlyToggle( className = 'editable' ){
                    document.querySelectorAll(`.${className}`).forEach(
                        editableInput => {
                            editableInput.readOnly = editableInput.readOnly ^ true ;
                        }
                    );
                }

                function setInputClassReadOnly( readOnly = true , className = 'editable' ){
                    document.querySelectorAll(`.${className}`).forEach(
                        editableInput => {
                            editableInput.readOnly = readOnly ;
                        }
                    );
                }

            //
            //
            //明細表格 獲得焦點與失去焦點的處理
                //可編輯欄位 editable 失去焦點事件
                function editableBlurEvent(event){
                    // console.log(
                    //     ` ${event.target.nodeName}  ${event.target.id}  blur => ${event.target.value}`
                    // );
                    // active 是已經設定好的 CSS 類別 .active
                    event.target.classList.toggle('active');
                }

                ////可編輯欄位 editable 獲得焦點事件
                function editableFocusEvent(event){
                    // console.log(
                    // ` ${event.target.nodeName}  ${event.target.id}  focus => ${event.target.value} `
                    // );

                    // active 是已經設定好的 CSS 類別 .active
                    event.target.classList.toggle('active');
                }

            
            //
            //
            //
            //按下修改儲存，明細要做的事
                //儲存明細表格修改資料
                //將更新明細的表單，填入目前的明細主鍵，並且送出更新要求
                function updateDetailData(){
                    
                    //選出所有明細資料的表單
                    const forms = document.querySelectorAll('td form'); 

                    //每列資料的表單，按照順序判斷是否要更新，如果要更新就增加主鍵
                    forms.forEach(
                        form => {
                            // console.log( form.id ); //OK
                            // console.log( form.childElementCount ) ;//OK 列出表單中的元素數量
                            const elementCount = form.childElementCount ;
                            
                            //如果元素數量超過 2 ，就代表有異動的資料，需要在每個表單上增加 PK
                            //明細資料的 PK 有 2 個，一個是項目索引，一個是租賃單號
                            if( elementCount > 2){
                                // console.log( form.id );//OK
                                //可以只篩選 元素中，屬性值
                                // console.log( form.closest('tr').querySelector('[name="RENT_DNO"]') ) ;//OK

                                //找出明細的主鍵，共有二個欄位
                                //從目前的表單往上找最接近的 tr 標籤，再從 tr 標籤往下找 屬性名稱 name = RENT_NO 或 RENT_DNO
                                const RENT_DNO = form.closest('tr').querySelector('[name="RENT_DNO"]') ;
                                const RENT_NO =  form.closest('tr').querySelector('[name="RENT_NO"]') ;

                                // console.log( ` RENT_NO = ${RENT_NO.value} , RENT_DNO = ${RENT_DNO.value} ` );
                                
                                //複製 有更新資料的 PK 到待更新表單中，直接複製一個元素，貼到表單上
                                const newDNO = RENT_DNO.cloneNode(false);
                                const newNO = RENT_NO.cloneNode(false);

                                newDNO.disabled = false ; //如果 disabled = true 這個欄位，資料不會被傳出去

                                //設定 DOM 類別屬性是 className 或 classList.add()  .remove()
                                newDNO.className = 'updating'; //設定為 更新中 類別
                                newNO.className = 'updating';//設定為 更新中 類別

                                //增加的 PK 資料在這裡
                                form.appendChild(newNO);
                                form.appendChild(newDNO);

                                // console.log( form ); //OK 列出元素的 HTML 內容

                                //設定表單方法及路由，因為會連續送出 form.submit()
                                //而 最後一個 form.submit() 會蓋掉之前的 form.submit()
                                //所以改用 AJAX 方式更新資料
                                form.method = "POST";
                                // form.action = "{{ route('rentd.updatebatch') }}";
                                // form.submit();//這是同步的方法，最後一個 form.submin() 會蓋掉前面的 submit()

                                //FormData() 方法，前面要加 new 才能讀出表單的 關聯式陣列內容
                                //FormData() 不是當作函數使用
                                

                                const formData = new FormData(form); // 獲取表單數據
                                // console.log( formData ); //列出來的結構，在終端機沒辦法直接看到內容
                                
                                // console.log('VVVVVVV');
                                //這樣只能讀出，欄位內容，但不知道欄位名稱
                                // formData.forEach(
                                //      value  =>  {
                                //         console.log( ` ${value} ` );
                                //     }
                                //  );
                                // console.log('======');

                                // 準備要 fetch 送出的數據物件
                                // 所有更新的資料，都整合在這裡
                                let fetchOutDataArray = {} ;
                                // 輸出表單數據
                                for (const [key, value] of formData.entries()) {
                                    // console.log(`${key}: ${value}`); //OK 輸出每個鍵值對
                                    fetchOutDataArray[key]=value ; //這才是 JS 的物件屬性設定方式
                                }
                                // console.log(JSON.stringify( fetchOutDataArray ));


                                // 送出資料給 AJAX 更新
                                fetch(
                                    // 路由位置，這裡是使用 Laravel 的路由，目的是批次呼叫 更新資料
                                    "{{ route('rentd.updatebatch') }}", 
                                    // 傳送的 request 封包內容
                                    {
                                        method: "POST", // 使用 POST 方法
                                        headers: {
                                            'Content-Type': 'application/json', // 設定請求內容類型為 JSON
                                            'X-CSRF-TOKEN': '{{ csrf_token() }}' // Laravel 的 CSRF 令牌
                                        },
                                        body: JSON.stringify(fetchOutDataArray) // 將發送的數據轉換為 JSON 格式
                                    }
                                )
                                .then(response => {
                                    //將資料轉換成 JSON ，通常都會這樣做
                                        if (response.ok) {
                                            return response.json(); // 或者 response.text() 根據你的需求
                                        }
                                        throw new Error('Network response was not ok.');
                                })
                                .then(data => {
                                    // 在這裡處理返回的數據，例如更新 DOM
                                        // console.log( `message => ${data.message}` );
                                        if(data.ok){
                                            // console.log(`${data.ok}`);
                                            //移除更新表單中的元素
                                                //搜尋表單中，所有類別是 updating 的元素
                                                const removeElements = form.querySelectorAll('.updating');
                                                // console.log( form );//OK
                                                // console.log( removeElements );//OK
                                                
                                                //然後從表單中，移除這些元素
                                                removeElements.forEach(
                                                    removeElement =>{
                                                        form.removeChild(removeElement);
                                                    }
                                                ) ;
                                            //移除該列的 CSS 更新中的類別
                                                    let updateTR = form.closest('tr');
                                                    let inputs = updateTR.querySelectorAll('.wait-for-update');
                                                    inputs.forEach(
                                                        input => {
                                                            //移除這個類別
                                                            input.classList.remove('wait-for-update');
                                                        }
                                                    );                                                
                                        }
                                })
                                .catch(error => {
                                    console.error('There was a problem with your fetch operation:', error);
                                });                                    
                            }
                        }
                    );
                }
            //
            //
            //按下修改儲存，主檔案要做的事
            function updateMailFile(){
                //選取所有更新過的 主檔案 欄位
                const mainfileInputs = document.querySelectorAll('.wait-for-update');
                //設定原始租賃編號
                const primaryKey = document.querySelector('#RENT_NO').dataset.origin ;
                const update =  {} ; //設定更新物件

                // console.log( ` null == null  ${null == null}` );//true
                // console.log( ` null != null  ${null != null}` );//false

                //將要更新的資料，儲存在物件中
                mainfileInputs.forEach(
                    input => {
                        //設定物件更新屬性
                            if(input.value){
                                // console.log( ` ${input.name} => ${input.value}`);
                                // 有修改過的資料，才要更新
                                if( input.value != input.dataset.origin ){
                                    update[`${input.name}`] = input.value ;
                                }
                            }else{
                                // console.log( ` ${input.name} => ${input.innerHTML}`);
                                update[`${input.name}`] = input.innerHTML ;
                            }
                        //
                    }
                );

                //檢視 JSON 格式資料
                // console.log( JSON.stringify( update ) );
                //傳送更新資料到伺服器上
                fetch(`{{ route('rentm.updateMainFileRouteName') }}/${primaryKey}`,
                    {
                        method:"POST"   ,
                        headers:
                            {'Content-Type':'application/json',
                            'X-CSRF-TOKEN': '{{ csrf_token() }}'} ,
                        body: JSON.stringify( update )
                    }
                ).then( 
                    response => {
                        if (response.ok){
                            return response.json();
                        }
                    }
                ).then(
                    data =>{
                        console.log( data );
                        //移除待更新的 CSS 樣式                        
                        mainfileInputs.forEach(
                            input => {
                                // console.log( ` ${input.id} = ${input.classList}`) ;
                                //移除只要打類別名稱就好  不用加  .
                                input.classList.remove('wait-for-update');
                                // console.log( ` ${input.id} = ${input.classList}`) ;
                            }
                        );
                    }
                ).catch(err => {
                    console.log( err );
                });
            }
            //

            // JS 測試用按鈕
                document.querySelector('#readOnlyToggle').addEventListener(
                    'click' ,
                    event => {
                        console.log('readOnlyToggle click');
                        setInputClassReadOnlyToggle();
                    }
                );
                document.querySelector('#readOnlyTrue').addEventListener(
                    'click' ,
                    event => {
                        console.log('readOnlyTrue click');
                        setInputClassReadOnly();
                    }
                );
                document.querySelector('#readOnlyFalse').addEventListener(
                    'click' ,
                    event => {
                        console.log('readOnlyFalse click');
                        setInputClassReadOnly( false );
                        setInputClassReadOnly( false  , 'mainfile');
                    }
                );
                document.querySelector('#removeInputEvent').addEventListener(
                    'click' ,
                    event => {
                        console.log('click');
                        // removeEditableInputEvent();
                        removeInputEvent( editableInputDetailEvent ) ;
                    }
                );
                //增加有更新資料表單的 主鍵，明細資料為 雙主鍵
                document.querySelector('#showUpdating').addEventListener(
                    'click' ,
                    event => {
                        console.log('showUpdating click');

                        //更新資料
                        updateDetailData();
                    }
                );
                //儲存主檔 測試按鈕 
                document.querySelector('#updateMailFile').addEventListener(
                    'click' ,
                    event => {
                        console.log('updateMailFile click');

                        //更新資料
                        updateMailFile();
                    }
                );                
                
            //
            //

            //設定列印的位置
                //測試滑鼠點擊畫布的反應
                document.querySelector('#myCanvas').addEventListener(
                    'click' ,
                    event => {
                        const rect = event.target.getBoundingClientRect();
                        // rect.left  rect.top  是物件在文件中的左上角座標
                        const x = event.clientX - rect.left; // 計算滑鼠相對於畫布的 X 座標
                        const y = event.clientY - rect.top ; // 計算滑鼠相對於畫布的 Y 座標
                        console.log( rect ); //傳回 矩形物件
                        console.log( event.clientX ); //傳回 滑鼠 x 位置，從文件最左邊開始計算
                        console.log( event.clientY ); //傳回 滑鼠 y 位置，從文件最上面開始計算
                        console.log( x );
                        console.log( y );                        
                        //將所有屬性 name 為 x 的元素的 value 設定成 x
                        document.querySelectorAll('[name="x"]').forEach(
                            inputX => {
                                inputX.value = x ;
                            }
                        );                        
                        //將所有屬性 name 為 y 的元素的 value 設定成 y
                        document.querySelectorAll('[name="y"]').forEach(
                            inputY => {
                                inputY.value = y ;
                            }
                        );                        
                    }
                );

                //按下按鈕，將指定的內容，列印在畫布上
                function clickSetXYButton( event ){
                    const canvas = document.getElementById('myCanvas');
                    const ctx = canvas.getContext('2d');
                    console.log( event ) ;
                    console.log( event.closest('div').id );
                    console.log( event.closest('div').querySelector('[name="print-value"]').value );
                    const text = event.closest('div').querySelector('[name="print-value"]').value ; // 獲取文字內容
                    const x = parseInt(event.closest('div').querySelector('[name="x"]').value); // 獲取 X 座標
                    const y = parseInt(event.closest('div').querySelector('[name="y"]').value); // 獲取 Y 座標                    
                    console.log( text );
                    // 在畫布上繪製文字
                    // ctx.clearRect(0, 0, canvas.width, canvas.height); // 清空畫布
                    ctx.font = "30px Arial";
                    // ctx.font = "30px"; //這樣子 沒有效果
                    ctx.fillText(text, x, y); // 在指定位置繪製文字
                }

                //將圖片畫在畫布中 canvas
                function drawImage( event ){
                    console.log( event );
                    //獲得畫布元素
                    const canvas = document.getElementById('myCanvas');
                    //獲得畫布繪圖物件
                    const ctx = canvas.getContext('2d');

                    const img = document.getElementById("bill");
                    const img1 = event.closest('div').querySelector('img');

                    // 0,0 代表從左上方 原點 開始畫  
                    ctx.drawImage(img,0,0);
                }

                //將明細資料，儲存在客戶端的 JS 變數中
                const dataArray = [] ;
                function saveServeDetailData(){
                    console.log( 'saveServeDetailData' );
                    // let dataArray = [] ; //改成全域儲存
                    let data = {} ;

                    //  {{ $saveServeDetailData = 0 }} 
                    // 將伺服器資料寫在客戶端頁面上
                    // @foreach ( $rentds as $rentd )
                    // @if ( $saveServeDetailData != 0 )
                    //
                    data = {} ; //清空物件，重新使用同一個變數
                    //
                    // @endif                    
                    // {{ $saveServeDetailData++ }}
                    //

                    data['RENT_01DNO'] = `{{ $rentd->RENT_DNO }}`;
                    data['RENT_02DMODEL'] = `{{ $rentd->RENT_DMODEL }}`;
                    data['RENT_03DDATE'] = `{{ $rentd->RENT_DDATE }}`;
                    data['RENT_04DMSN'] = `{{ $rentd->RENT_DMSN }}`;
                    data['RENT_05DDATE1'] = `{{ $rentd->RENT_DDATE1 }}`;
                    data['RENT_06DDATE2'] = `{{ $rentd->RENT_DDATE2 }}`;
                    data['RENT_07DAY'] = `{{ $rentd->RENT_DAY }}`;
                    data['RENT_08AMT'] = `{{ $rentd->RENT_AMT }}`;
                    data['RENT_09FDATE'] = `{{ $rentd->RENT_FDATE }}`;
                    data['RENT_10FEE'] = `{{ $rentd->RENT_FEE }}`;
                    data['RENT_11Contract_No'] = `{{ $rentd->RENT_Contract_No }}`;
                    
                    // 同一筆資料列印時，不需要下面的內容                    
                    // data['RENT_NO'] = `{{ $rentd->RENT_NO }}`;
                    // data['RENT_DDATE1'] = `{{ $rentd->RENT_DDATE1 }}`;
                    dataArray.push( data );
                    // @endforeach
                    //
                    
                    // 模板語法，藏在 JS 的註解中，避免JS檢測錯誤
                    // 但請在模板語法與 JS 語法中間 隔一行
                    // 才不會發生  客戶端上  有指令備註解的問題
                    console.log(dataArray);
                }
                
                //將文字列印在畫布上
                function printText2Canvas( textArray = [{}] , xx = 0 , yy = 0 , canvasID = 'myCanvas' ){
                    const canvas = document.querySelector(`#${canvasID}`);
                    const ctx = canvas.getContext('2d');                    
                    r = 20 ; //字形大小設定 Consolas ,  Courier New ,Lucida Console 這個是等寬字體
                    ctx.font = `${r}px Lucida Console`;
                    let text = "";
                    //畫布的最左上角座標為 x = 0 , y = 0
                    yy += 344 ; //指定報表上的 y 位置，似向下偏移數值
                    xx += 15 ;  //指定報表上的 x 位置，似向右偏移數值
                    //每一筆資料儲存在陣列中
                    let subText ;
                    textArray.forEach(
                        //將每筆資料的文字內容，連接成為一個字串
                        textObject => {
                            console.log( textObject );
                            for (let x in textObject) {
                                subText =  processText ( textObject[x] ) ;
                                // text += textObject[x] + " ";
                                text += (subText?subText:' ') + " ";
                            };
                            console.log( text );
                            //列印文字會從指定的座標上方列印出來，也就是說指定 x , 0 的位置，是沒辦法看到列印出來的文字的
                            ctx.fillText( text , xx , yy); //24 是我設定的字型大小 24 pixel
                            text = '' ;
                            yy += parseInt( r * 1.3 ); //每列的間距，如果與字形大小相同，會感覺很緊密
                        }
                    );
                }

                //列印明細資料
                function printDetail(){
                    console.log('printDetail')
                    dataArray.forEach(
                        data => {
                            console.log( data );
                        }
                    );
                }

                //將文字填滿位置
                function processText(inputText , maxLength = 10) {
                    // 確保輸入為字串
                    if (typeof inputText !== 'string') {
                        console.error('請提供有效的字串');
                        return;
                    }
                    let text1 = '_____' + inputText.slice(0, inputText.length / 2);
                    let text2 = inputText.slice(inputText.length / 2, inputText.length) + '_____';
                    // document.getElementById("demo1").innerHTML = text1;
                    // document.getElementById("demo2").innerHTML = text1.slice(text1.length - 5, text1.length);
                    // document.getElementById("demo3").innerHTML = text2.slice(0, 5);
                    // .slice( 開始位址 , 結束位址 )    .length  字串長度
                    // .replace( 搜尋的字串 或 正則表達式 ,  替換的字串 )
                    //   /.../正則表達式指令 ... 是代表要找的任何字元， /g  代表要找全部的字串
                    return (text1.slice(text1.length - 5, text1.length) + text2.slice(0, 5)).replace(/_/g, ' ');
                }                

            //

            //列印功能
                function printElement(elementId) {
                    const canvas = document.getElementById('myCanvas');
                    const dataURL = canvas.toDataURL(); // 將畫布轉換為圖像數據 URL                    

                    const printContent = document.getElementById(elementId).outerHTML; // 獲取要列印的內容
                    const newWindow = window.open('', '', 'height=825,width=1275'); // 打開新窗口
                    newWindow.document.write('<html><head><title>列印</title></head><body>');
                    // newWindow.document.write(printContent); // 將內容寫入新窗口，如果是用 HTML 元素，輸入這裡就可以了，但是畫布就沒有效果
                    newWindow.document.write('<img src="' + dataURL + '" style="width:100%; height:auto;">'); // 將畫布圖像寫入新窗口
                    newWindow.document.write('</body></html>');
                    newWindow.document.close(); // 關閉文檔

                    // 使用 requestAnimationFrame 確保畫布內容已渲染
                    requestAnimationFrame(() => {
                        newWindow.print(); // 觸發列印對話框
                        newWindow.close(); // 列印後關閉窗口
                    });
                }


            //
            //

            //
            // 沒使用的 JS
            // 選擇 input[class="update-detail"] 與 選擇  .update-detail  相似
            // 如果類別增加了其他樣式，前者，就選不到該元素了，必須依照要求選用，撰寫方式
            document.querySelectorAll('.update-detail').forEach(
                updateButton => {
                    updateButton.addEventListener(
                        'click' ,
                        event => {
                            // console.log( event.target.id ); //會列出按鈕按下的按鈕 id
                            // console.log( event.target.closest('tr').id );//會列出最接近的 tr 元素
                            
                            //先找到按下按鈕的那列，從那列找到該列的表單
                            // console.log( event.target.closest('tr').querySelector('form').id );

                            // const detailForm = event.target.closest('form');
                            // // detailForm.method = "POST"
                            // // detailForm.action = "{{ route('rentd.updatebatch') }}"
                            // // detailForm.submit();
                        }
                    );
                }
            );
            //
            //

            //刪除 某表單 的 某個名稱元素
            function removeInputByNameFromForm( editForm , nameField ){
                //先移除目前在表單相同 name ，然後再增加這次的異動元素
                const removingElement = editForm.querySelector( `[name="${nameField}"]` );
                if (removingElement) {
                    //如果有就要刪除
                    editForm.removeChild( removingElement );
                }
            }

            //主檔欄位的輸入事件 ( HTML 類別為 mainfile  )
            function editMainFileInputEvent( event ){
                const input = event.target ;

                if( input.value ){
                    // input 標籤，在這處理
                    if( input.value == input.dataset.origin ) {
                        input.classList.remove('wait-for-update');
                    }else{
                        // console.log( input.classList ); //不知道會不會重複增加類別 測試，答案，並不會增加重複類別
                        input.classList.add('wait-for-update');
                    }

                }else{
                    // textarea 標籤，在這裡處理，textarea.value 為 undefined
                    if( input.innerHTML == input.dataset.origin ) {
                        input.classList.remove('wait-for-update');
                    }else{
                        console.log( input.classList ); //不知道會不會重複增加類別 測試
                        input.classList.add('wait-for-update');
                    }
                }

            }

            //可編輯欄位的輸入事件 ( 明細資料結構為 tr -> form)
            function editableInputDetailEvent( event ){
                //目前輸入中的元素
                const input = event.target ; 

                //目前輸入列的待更新 表單 元素
                const editForm = input.closest('tr').querySelector('form') ;

                // console.log( event.target.value );
                // console.log( input.value); //同上

                // 如果相等，就是沒有改變
                noChange = input.value == input.dataset.origin ;

                //修改明細資料時，如果有改變就設定 顯示樣式的不同 與 在待更新表單中紀錄更新欄位內容
                if( noChange ){
                    //移除等待更新顯示樣式
                    input.classList.remove('wait-for-update')
                    //移除表單此元素的設定值，避免更新
                    removeInputByNameFromForm(editForm,input.name); //取代下面註解
                }else{
                    //加入等待更新顯示樣式
                    input.classList.add('wait-for-update')
                    //在表單中，增加欄位的內容，以便於更新資料
                        //  .id 不能讀出元素的 id ，但是用 closest('某元素').id 可以讀出數據
                        // console.log( ` name = ${input.name}  ` );
                        // const editForm = input.closest('tr').querySelector('form') ; //改到上面去宣告
                        // console.log( ` form.id = ${input.closest('tr').querySelector('form').id}  ` ); //OK
                        // console.log( ` form.id = ${editForm.id}  ` );//OK 都能讀出 id
                        // console.log( editForm );
                        //用表單協助更新
                            //在表單中增加目前輸入的欄位內容的副本
                            const newInput = document.createElement('input');
                            newInput.type = input.type ;
                            newInput.name = input.name ;
                            newInput.value = input.value ;
                            newInput.className = 'updating' ; //設定為 更新中類別 非檢視用
                            //先移除目前在表單相同 name 的元素，然後再增加這次的異動元素
                            removeInputByNameFromForm(editForm,input.name); //取代下面註解
                                // const removingElement = editForm.querySelector( `input[name="${input.name}"]` );
                                // if (removingElement) {
                                //     //如果有就要刪除
                                //     editForm.removeChild( removingElement );
                                // }                            
                            //添加異動的元素到待更新表單中
                            editForm.appendChild( newInput );
                }
                // console.log( input.classList); //列出目前類別清單
            }

            //原本使用這個函式，專門處理 editable 類別，移除 editableInputDetailEvent 事件
            //改成用 removeInputEvent 專門移除 input 事件，預設移除 editable 類別
            //移除 輸入 input 監聽事件
            function removeEditableInputEvent(){
                const inputs = document.querySelectorAll('.editable');
                inputs.forEach(
                    input => {
                        input.removeEventListener('input' , editableInputDetailEvent );
                    }
                );
            }

            //移除 輸入 input 監聽事件
            function removeInputEvent( functionName  ,className ='editable'){
                const inputs = document.querySelectorAll(`.${className}`);
                // console.log( functionName ) ; //OK
                console.log( className );
                inputs.forEach(
                    input => {
                        // input.removeEventListener('input' , editableInputDetailEvent );
                        console.log( input.value ) ;
                        input.removeEventListener('input' , functionName );
                    }
                );
            }            

            //更新按鈕按下的 click 事件
            function updateButtonClick( event ){
                // console.log( event.target.value );

                //主檔案資料的處理
                    //保留原始資料
                    //並對每個輸入欄位監聽 input 事件
                    //將主檔欄位變更成為可編輯欄位，保留欄位內容到 data- 欄位中
                    document.querySelectorAll('.mainfile').forEach(
                        input => {
                            input.readOnly = false ;
                            if (input.value){
                                //input 原始值，保留方式
                                input.dataset.origin = input.value ;
                            }
                            else{
                                //textarea 原始值，保留方式
                                input.dataset.origin = input.innerHTML ;                                
                            }

                            //增加 mainfile 可輸入欄位的 input 事件
                            input.addEventListener(
                                'input' ,
                                editMainFileInputEvent
                            );
                        }
                    );
                    
                    //設定  mainfile 可編輯欄位 為可以編輯狀態
                    setInputClassReadOnly( false , 'mainfile' );

                //明細資料的處理
                    //設定可修改欄位的 原始值 欄位內容
                    const editableInputs = document.querySelectorAll('.editable');
                    editableInputs.forEach(
                        input => {
                            // console.log( input.value );
                            //將目前欄位內容儲存到 data- 自定欄位中
                            input.dataset.origin = input.value ; //自訂 data-origin 欄位
                            //在終端機列出 data-origin 屬性值的另一個方法
                            // console.log( input.getAttribute('data-origin') );
                        }
                    );

                    //設定  editable 可編輯欄位 為可以編輯狀態
                    setInputClassReadOnly(false);

                    //為每個可修改欄位，增加 input 監聽事件
                    editableInputs.forEach(
                        input => {
                            input.addEventListener(
                                'input'     ,
                                //要傳送事件過去，並且要能移除這個監聽方法，必須只寫函數名稱
                                editableInputDetailEvent
                            );
                        }
                    );
            }

            //按下修改後，將資料備份在，data-original 中
            document.querySelector('#updateButton').addEventListener(
                'click' ,
                //設定回呼的位址是這個函數名稱的位置
                updateButtonClick
            );

            //選擇所有 CSS 選擇子為 .editable ，監聽其獲得焦點事件
            document.querySelectorAll('.editable').forEach(
                editableField => {
                    editableField.addEventListener(
                        'focus' ,
                        editableFocusEvent
                    );
                }
            );

            //選擇所有 CSS 選擇子為 .editable ，監聽其離開焦點事件
            document.querySelectorAll('.editable').forEach(
                editableField => {
                    editableField.addEventListener(
                        'blur' ,
                        editableBlurEvent
                    );
                }
            );

            //按下修改儲存按鈕 click 事件
            document.querySelector('#updateSaveButton').addEventListener(
                'click' ,
                event => {
                    //因為主檔的 PK 可以修改，所以明細要先更新
                    //然後在一起修改 主索引的內容
                    //更新明細資料
                    updateDetailData();

                    //更新主檔案資料
                    updateMailFile();

                    //移除監聽事件
                    // removeEditableInputEvent();
                    removeInputEvent( editableInputDetailEvent ) ;
                    removeInputEvent( editMainFileInputEvent , 'mainfile' ) ;

                    //儲存主檔 明細檔案後，欄位變更為 readonly 狀態
                    setInputClassReadOnly( true , 'mainfile' );
                    setInputClassReadOnly( true , 'editable' );                    
                }
            );
        </script>
    @endif
@endsection

{{-- 下面的 yield  session 會跑到最頂端，要解決這個問題，要把 yield  session 集中放在第一個模板中 --}}
@if (session('updateMessage'))
            {{ session('updateMessage') }}
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