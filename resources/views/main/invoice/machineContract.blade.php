@extends('main.main')

@section('content_sub')

    <!-- 這個表單用來避免，刷新畫面時，欄位被清空 -->
    <form action="" method="POST">
        <table>
            <thead>
                <tr>
                    <!-- 
                    查詢車號
                    如果查不到 mach_no
                    會顯示空白頁面
                    -->
                    <th>
    
                        <input 
                        class="button"
                        type="button"
                        id="queryMachNoAJAX"
                        value="查詢車號AJAX">
                    </th>
                    <th>
                        <input 
                        class="button"
                        type="button"
                        id="queryMachNo"
                        value="查詢車號">
                    </th>
                    <!-- 
                    建立合約
                    當沒有合約資料時
                    可以按下建立合約
                    新增這台機具的合約內容
                    當有合約資料時
                    不能按下建立合約按鈕
                    -->                    
                    <th>
    
                        <input
                        class="button"
                        type="button"
                        id="createContract"
                        value="建立合約">
                    </th>
                    <!-- 
                    續簽合約
                    會依照租賃單號
                    產生一筆租賃主檔(如果尚未建立租賃主檔)
                    產生一筆租賃明細資料
                    合約檔並不會刪除
                    -->    
                    <th>
                        <input
                        class="button"
                        type="button" 
                        id="remainContract"
                        value="續簽合約">
                    </th>
                    <!-- 
                    結案合約
                    會依照租賃單號
                    產生一筆租賃主檔(如果尚未建立租賃主檔)
                    產生一筆租賃明細資料
                    將合約檔案刪除
                    -->
                    <th>
                        <input
                        class="button"
                        type="button"
                        id="closeContract"
                        value="結案合約">
                    </th>
                    <!-- 
                    刪除合約 按鈕
                    刪除目前車號的合約
                    -->
                    <th>
                        <input
                        class="button" 
                        type="button"
                        id="deleteContract"
                        value="刪除合約">
                    </th>
                    <!-- 
                    修改合約 按鈕
                    修改目前車號的合約
                    -->
                    <th>
                        <input
                        class="button"
                        type="button"
                        id="updateContract"
                        value="修改合約">
                    </th>
                    <!-- 
                    儲存合約 按鈕
                    儲存修改後的合約
                    -->
                    <th>
                        <input
                        class="button"
                        type="button"
                        id="saveContract"
                        value="儲存合約">
                    </th>                
                </tr>
                <!-- 機具資料顯示 第一列 -->
                <tr>
                    <th>自訂編號</th>
                    <td>
                        <input 
                        type="text" readonly
                        id="machine_MachNo"
                        name="machine_MachNo"
                        value="{{$machine->Mach_No }}"
                        >
                    </td>
    
                    <th>機具型式</th>
                    <td>
                        <input 
                        type="text" readonly
                        id="machine_MachModel"
                        name="machine_MachModel"
                        value="{{ $machine->Mach_Model }}"
                        >
                    </td>
    
                    <th>機具編號</th>
                    <td>
                        <input 
                        type="text" readonly
                        id="machine_MachModeNo"
                        name="machine_MachModeNo"
                        value="{{ $machine->Mach_ModeNo }}"
                        >
                    </td>
    
                    <th>進貨日期</th>
                    <td>
                        <input
                        type="text" readonly
                        id="machine_MachDate1"
                        name="machine_MachDate1"
                        value="{{ $machine->Mach_Date1 }}">
                    </td>
                </tr>
                <!-- 機具資料顯示 第二列 -->
                <tr>
                    <th>機具年分</th>
                    <td>
                        <input
                        type="text" readonly
                        id="machine_MachYears"
                        name="machine_MachYears"
                        value="{{ $machine->Mach_Years }}">
                    </td>    
                    <th>備註</th>
                    <td colspan="3">
                        <input
                        style="width:100%;height:100%;"
                        type="text" readonly
                        id="machine_MachReMark"
                        name="machine_MachReMark"
                        value="{{ $machine->Mach_ReMark }}">
                    </td>    
                    <th>除役日期</th>
                    <td>
                        <input 
                        type="text" readonly
                        id="machine_MachDate2"
                        name="machine_MachDate2"
                        value="{{ $machine->Mach_Date2 }}">
                    </td>
                </tr>
            </thead>
        </table>
    </form>
    <hr><hr><hr>

    <form id="formContract" method="POST" >
        @csrf <!-- Laravel 的 CSRF 保護 一定要有 不然會錯誤 -->
        <table>
            <tbody>
                <tr>
                    <th>自訂編號</th>
                    <td>
                        <!-- disabled -->
                        <input
                        readonly
                        type="text"
                        id="mach_no"
                        name="mach_no"
                        class="primary_key"
                        {{-- 如果沒有舊值，就設定資料庫的內容 --}}
                        @if( is_null( old('mach_no') ) )
                            value="{{ $contract->mach_no }}"
                        @else
                            value="{{ old('mach_no') }}"
                        @endif
                        >
                    </td>
    
                    <th>目前合約客戶編號</th>
                    <td>
                        <input  
                        type="text"
                        id="mach_rentctmno"
                        name="mach_rentctmno"
                        class="editable"
                        {{-- 如果沒有舊值，就設定資料庫的內容 --}}
                        @if( is_null( old('mach_rentctmno') ) )
                            value="{{ $contract->mach_rentctmno }}"
                        @else
                            value="{{ old('mach_rentctmno') }}"
                        @endif
                        >
                    </td>
    
                    <th>目前合約客戶名稱</th>
                    <td colspan="3">
                        <input  
                        style="width: 100%;"
                        type="text"
                        id="mach_rentctmname"
                        name="mach_rentctmname"
                        class="editable"
                        {{-- 如果沒有舊值，就設定資料庫的內容 --}}
                        @if( is_null( old('mach_rentctmname') ) )
                            value="{{ $contract->mach_rentctmname }}"
                        @else
                            value="{{ old('mach_rentctmname') }}"
                        @endif
                        >
                    <td>
    
                    <th>目前合約客戶統一編號</th>
                    <td>
                        <input  
                        type="text"
                        id="mach_rentctmuno"
                        name="mach_rentctmuno"
                        class="editable"
                        {{-- 如果沒有舊值，就設定資料庫的內容 --}}
                        @if( is_null( old('mach_rentctmuno') ) )
                            value="{{ $contract->mach_rentctmuno }}"
                        @else
                            value="{{ old('mach_rentctmuno') }}"
                        @endif
                        >
                    </td>
                </tr>
                <tr>
                    <th>目前合約開始日期</th>
                    <td>
                        <input  
                        type="date"
                        id="mach_rentdate1"
                        name="mach_rentdate1"
                        class="editable"
                        {{-- 如果沒有舊值，就設定資料庫的內容 --}}
                        @if( is_null( old('mach_rentdate1') ) )
                            value="{{ $contract->mach_rentdate1 }}"
                        @else
                            value="{{ old('mach_rentdate1') }}"
                        @endif
                        >                    
                    </td>
    
                    <th>目前合約結束日期</th>
                    <td>
                        <input  
                        type="date"
                        id="mach_rentdate2"
                        name="mach_rentdate2"
                        class="editable"
                        {{-- 如果沒有舊值，就設定資料庫的內容 --}}
                        @if( is_null( old('mach_rentdate2') ) )
                            value="{{ $contract->mach_rentdate2 }}"
                        @else
                            value="{{ old('mach_rentdate2') }}"
                        @endif
                        >
                    </td>
    
                    <th>目前合約租賃天數</th>
                    <td>
                        <input  
                        type="number"
                        id="mach_rentdays"
                        name="mach_rentdays"
                        class="editable"
                        {{-- 如果沒有舊值，就設定資料庫的內容 --}}
                        @if( is_null( old('mach_rentdays') ) )
                            value="{{ $contract->mach_rentdays }}"
                        @else
                            value="{{ old('mach_rentdays') }}"
                        @endif
                        >                    
                    </td>
    
                    <th>目前合約請款單號(租賃單號)</th>
                    <td>
                        <input
                        type="text"
                        id="mach_rentno"
                        name="mach_rentno"
                        class="editable"
                        {{-- 如果沒有舊值，就設定資料庫的內容 --}}
                        @if( is_null( old('mach_rentno') ) )
                            value="{{ $contract->mach_rentno }}"
                        @else
                            value="{{ old('mach_rentno') }}"
                        @endif
                        >
                    </td>
                </tr>
                <tr>
                    <th>目前合約機具請款金額</th>
                    <td>
                        <input
                        type="number"
                        id="mach_rentamt"
                        name="mach_rentamt"
                        class="editable"
                        {{-- 如果沒有舊值，就設定資料庫的內容 --}}
                        @if( is_null( old('mach_rentamt') ) )
                            value="{{ $contract->mach_rentamt }}"
                        @else
                            value="{{ old('mach_rentamt') }}"
                        @endif
                        >
                    </td>
                    <th>目前合約機具運費</th>
                    <td>
                        <input  
                        type="number"
                        id="mach_rentfee"
                        name="mach_rentfee"
                        class="editable"
                        {{-- 如果沒有舊值，就設定資料庫的內容 --}}
                        @if( is_null( old('mach_rentfee') ) )
                            value="{{ $contract->mach_rentfee }}"
                        @else
                            value="{{ old('mach_rentfee') }}"
                        @endif
                        >
                    </td>
                    <th>目前合約退租日期</th>
                    <td>
                        <input  
                        type="date"
                        id="mach_rentfdate"
                        name="mach_rentfdate"
                        class="editable"
                        {{-- 如果沒有舊值，就設定資料庫的內容 --}}
                        @if( is_null( old('mach_rentfdate') ) )
                            value="{{ $contract->mach_rentfdate }}"
                        @else
                            value="{{ old('mach_rentfdate') }}"
                        @endif
                        >
                    </td>
                    <th>目前合約租賃編號</th>
                    <td>
                        <input  
                        type="text"
                        id="mach_contract_no"
                        name="mach_contract_no"
                        class="editable"
                        {{-- 如果沒有舊值，就設定資料庫的內容 --}}
                        @if( is_null( old('mach_contract_no') ) )
                            value="{{ $contract->mach_contract_no }}"
                        @else
                            value="{{ old('mach_contract_no') }}"
                        @endif
                        >
                    </td>
                </tr>
                <tr>
                    <th>目前合約備註</th>
                    <td colspan="7">
                        <!--  textarea 標籤直接編輯時，預設值要在角括號範圍中設定， -->
                        <textarea
                        style="width:100%;height:100%"
                        name="mach_rentremark"
                        class="editable"
                        id="mach_rentremark">{{ $contract->mach_rentremark }}</textarea>
                        {{-- 已改用 GET 轉向到 查詢車號路由 視圖 
                        故這裡改只用資料庫的值 不然會因為縮排  跑出很多空格
                        其他位置 保留不改  用來增加記憶
                        @if( is_null( old('mach_rentremark') ) )
                            {{ $contract->mach_rentremark }}
                        @else
                            {{ old('mach_rentremark') }}
                        @endif --}}                        
                    </td>
                    <th>
                        <input 
                        type="button"
                        value="新建儲存"
                        id="newContractSave" hidden>
                    </th>
                    <th >
                        <input type="button" value="續租儲存" id="remainContractSave" hidden>
                    </th>
                    <th >
                        <input type="button" value="取消" id="cancelSave" hidden>
                    </th>                                
                </tr>
            </tbody>
        </table>
    </form>
    
    <!-- 除錯用區塊 -->
        <!-- 練習用 JS 產生 form 的提交 submit()  其實可以不用一個實體標籤，用到時，在宣告就可以了  但是很麻煩  不如直接寫好標籤-->
        <form  id="hideForm" method="GET" action="">
            @csrf
            <input type="button" value="查詢 1 號車" onclick="showRefreshContract('1')">
        </form>

        <!--
        用 form 標籤包住按鈕，提交時，會影響到與此按鈕動作相關的其他表單內容，及沒被表單標籤包住的內容，都會被初始化
        如果其他表單，並不受此按鈕動作所影響，則該表單內容，不會初始化
        表單設為隱藏  可以用指令觸發按鈕
        -->
        <form  id="deleteForm" method="POST" action="" hidden>
            @csrf
            @method('DELETE')
            <input type="text" id="deleteMessage" name="deleteMessage" value="">
            <!-- <input type="button" value="刪除合約" onclick="deleteContract()"> -->
        </form>

        <!-- PATCH 更新資料 -->
        <form id="patchForm" method="POST">
            @csrf
            @method('PATCH')
            <input type="button" value="更新資料" onclick="">
        </form>
    

        <!-- 測試 JS 的按鈕 START -->
        <!-- <button onclick="setOriginalForEdit()" class="button">setOriginalForEdit</button>
        <button onclick="clearEditableFields()" class="button">clearEditableFields</button>
        <button onclick="setClassReadOnly()" class="button">setClassReadOnly</button>
        <button onclick="deleteContract()" class="button">deleteContract</button> -->
        <!-- <button onclick="addListenerForInputElement()" class="button">addListenerForInputElement</button>
        <button onclick="addListenerForInputElement('editable','')" class="button">addListenerForInputElement</button>
        <button onclick="addListenerForInputElement('editable','input')" class="button">addListenerForInputElement</button> -->
        <!-- <button onclick="removeListenerForInputElement('editable','input')" 
        class="button">removeListenerForInputElement</button> -->

        <!-- <button onclick="saveUpadteContract()" class="button">saveUpadteContract</button> -->
        <button onclick="createRentData()" class="button">建立租賃明細資料</button>
        
        
        <label for="testInput">請輸入元素的ID</label>
        <input type="text" id="testInput" placeholder="請輸入元素的ID">
        <button onclick="setIdFocus()"  on class="button">setIdFocus</button>
    <!-- END -->

    <script>
        
        //產生儲存合約的路由 URL
        const newContractSaveUrl = "{{ route('contract.store') }}";

        // {{-- 取回 showRentMachineManager 的路由前半段名稱 --}}
        const showRentMachineManagerUrl = "{{ route( 'showRMMString') }}";

        // {{-- 取回 route( contract.update ) 的路由前半段名稱 --}}
        const updateContractUrl = "{{ route('contract.UpdateRouteName') }}";
        
        //用 JS 方法執行 Form 表單標籤的送出 查詢自訂編號 1 號車
        function showRefreshContract( machno = null  ){
            if( machno ) {
                const form = document.querySelector('#hideForm');
                // const form = document.createElement('form');  //用這個方法  要自己建立很多欄位的連結
                form.method = "GET" ;
                form.action = `${showRentMachineManagerUrl}/${machno}` ; // 設定表單的 action 屬性為對應的路由
                console.log( `${showRentMachineManagerUrl}/${machno}` )
                form.submit(); // 提交表單
            }else{
                console.log( 'showRefreshContract' );
            }
        }

        //建立一筆租賃明細資料
        //續租合約  結案合約  都會用到
        function createRentData(){


            //將目前合約內容讀出 租賃 資料
            const newRentMD = {
                'MRENT_NO' : document.querySelector('#mach_rentno').value ,
                'MRENT_PDATE' : null ,
                'MRENT_UNO' : document.querySelector('#mach_rentno').value ,
                'MRENT_UNO_DAT' : null ,
                'MRENT_CNO' : document.querySelector('#mach_rentctmno').value ,
                'MRENT_CNAME' : document.querySelector('#mach_rentctmname').value ,
                'MRENT_CTMUNO' : document.querySelector('#mach_rentctmuno').value ,
                'MRENT_CTMADRS' : null ,
                'MRENT_ADRS' : null,
                'MRENT_REMARK' : document.querySelector('#mach_rentremark').innerHTML ,
                'MRENT_TOTAL1' : null ,

                'DRENT_NO' : document.querySelector('#mach_rentno').value ,
                'DRENT_DNO' : '1' ,
                'DRENT_DMODEL' : document.querySelector('#machine_MachModel').value ,
                'DRENT_DDATE' : document.querySelector('#mach_rentdate1').value ,
                'DRENT_DMSN' : `${document.querySelector('#machine_MachNo').value} - ${document.querySelector('#machine_MachModeNo').value}`  ,
                'DRENT_DDATE1' : document.querySelector('#mach_rentdate1').value ,
                'DRENT_DDATE2' : document.querySelector('#mach_rentdate2').value ,
                'DRENT_DAY' : document.querySelector('#mach_rentdays').value ,
                'DRENT_AMT' : document.querySelector('#mach_rentamt').value ,
                'DRENT_FDATE' : document.querySelector('#mach_rentfdate').value ,
                'DRENT_FEE' : document.querySelector('#mach_rentfee').value ,
                'DRENT_Contract_No' : document.querySelector('#mach_contract_no').value ,
            };



            fetch(  `{{ route('rentd.store') }}` ,
                {
                    method: 'PUT',
                    headers: 
                    {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}' // Laravel CSRF 保護                            
                    },
                    body: JSON.stringify(newRentMD)
                }
            )
            .then(response => {
                console.log( ` ok => ${response.ok}` );
                if( response.ok ){
                    //傳回正常資料
                    return response.json();
                }
            })
            .then(
                data => {
                    console.log( data ) ;
                }
            ).catch(err => {
                console.log( err );
                return false ;
            });

            return true ;
        }

        //刪除合約資訊 message 傳給伺服器，讓伺服器知道要回應甚麼訊息
        function deleteContract(  message , machno = '') {
            // const form = document.createElement('form'); // 動態產生 form 標籤
            const form = document.querySelector('#deleteForm');
            const deleteMessage = document.querySelector('#deleteMessage');
            const mach_no = document.querySelector('#mach_no'); // 取回合約自訂編號元素

            // 設定 action 和 method
            // form.method = "POST"; // 使用 POST 方法
            console.log(`{{ route('contract.destroyRouteName') }}/${machno ? machno : mach_no.value}`);
            form.action = `{{ route('contract.destroyRouteName') }}/${machno ? machno : mach_no.value}`;

            //設定刪除後，完成的訊息
            deleteMessage.value = message ;

            // // 添加 CSRF 令牌
            // let csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
            // let csrfInput = document.createElement('input');
            // csrfInput.type = 'hidden';
            // csrfInput.name = '_token';
            // csrfInput.value = csrfToken;
            // form.appendChild(csrfInput);

            // // 添加 _method 欄位以模擬 DELETE 方法
            // let methodInput = document.createElement('input');
            // methodInput.type = 'hidden';
            // methodInput.name = '_method';
            // methodInput.value = 'DELETE';
            // form.appendChild(methodInput);

            // 將表單添加到 DOM
            // document.body.appendChild(form);
            
            // 提交表單
            form.submit();
        }
        


        // 更新合約內容
        function saveUpadteContract(){
            //要當 URL 一部分的元素內容，要用 encodeURIComponent() 才不會出現編碼的問題，看起來相同，但電腦覺得不相同
            const mach_no = encodeURIComponent( document.querySelector('#mach_no').value ) ;
            let patch = {} ; //宣告空物件，用來放更新的資料
            if(mach_no){
                const updates = document.querySelectorAll('.wait-for-update');

                // 主鍵不用丟到更新陣列中，因為沒有要修改
                // patch['mach_no'] = mach_no ; //增加物件屬性
                
                // 雖然主鍵不用更新，不用傳送到伺服端，但伺服端有檢查的話
                // 會造成 405 (Method Not Allowed) 路由不支援這個方法的錯誤

                console.log(updates.length);
                updates.forEach(
                    update => {
                        console.log( ` ${update.name}  :  ${update.value}` );
                        if( update.value ){
                            patch[update.name] = update.value ; //增加物件屬性
                        }else{
                            //Textarea 標籤用
                            patch[update.name] = update.innerHTML ; //增加物件屬性
                        }
                        

                    }
                );
                console.log( patch ); //OK
                
                //fetch API 傳送更新資料到伺服器
                fetch(  `${updateContractUrl}/${ mach_no }` ,
                        {
                            method: 'PATCH',
                            headers: 
                            {
                                'Content-Type': 'application/json',
                                'X-CSRF-TOKEN': '{{ csrf_token() }}' // Laravel CSRF 保護                            
                            },
                            body: JSON.stringify(patch)
                        }
                    )
                    .then(response => {
                        console.log( ` ok => ${response.ok}` );
                        if( response.ok ){
                            //傳回正常資料

                            //移除等待更新 CSS 類別
                            const updateds = document.querySelectorAll('.wait-for-update');
                            updateds.forEach(
                                updated => {
                                    updated.classList.remove('wait-for-update');
                                }
                            );
                            //傳回JSON格式回應
                            return response.json();
                        }
                    })
                    .then(
                        data => {
                            console.log( data ) ;
                            // alert('儲存修改資料 => 成功'); //在這裡顯示訊息會錯誤 ?!

                        }
                    ).catch(err => {
                        console.log( err );
                    });

            }else{
                alert('沒有合約資訊，無法修改');
            }
        }

        // 要使用新增與移除事件，必須把處理函式，寫在外部，
        // 不然移除的時候，找不到新增時的函數位址
        // 修改合約內容時，將修改過的欄位，設定增加一個 wait-for-update 的 CSS 樣式
        // 這樣就可以直接看到，那些內容被修改過
        function handleInputEvent(event) {            
            hasSame = event.target.value == event.target.dataset.original ;
            if(hasSame){
                event.target.classList.remove('wait-for-update');
            }else{
                event.target.classList.add('wait-for-update');
            }
            // 列出自定義欄位內容
            // console.log(event.target.dataset);            
            // // 列出目標套用的 CSS 類別
            // console.log(event.target.classList);            
        }

        //為特定類別輸入標籤，增加事件
        function addListenerForInputElement( className = null , eventName = null ){
            // console.log(`addListenerForInputElement ${className}  ${eventName} `);
            // console.log(className & eventName); // 結果都是 0
            if( className && eventName ){ //用 & 與 && 效果會不同歐!!， & 是邏輯運算， && 是關係運算
                // console.log(`addListenerForInputElement ${className}  ${eventName} `);
                // 都有輸入，才增加事件監聽
                const inputs = document.querySelectorAll(`.${className}`); //選擇類別所有元素
                inputs.forEach(
                    input => {
                        input.addEventListener( eventName , handleInputEvent );
                    }
                );
            }
        }

        //為特定類別輸入標籤，移除事件
        function removeListenerForInputElement( className = null , eventName = null ){            
            if( className && eventName ){ //用 & 與 && 效果會不同歐!!， & 是邏輯運算， && 是關係運算
                // console.log(`addListenerForInputElement ${className}  ${eventName} `);
                // 都有輸入，才增加事件監聽
                const inputs = document.querySelectorAll(`.${className}`); //選擇類別所有元素
                inputs.forEach(
                    input => {
                        input.removeEventListener( eventName , handleInputEvent );
                    }
                );
            }
        }



        //設定 input textarea 標籤的 readonly 屬性
        function setClassReadOnly( className = 'editable' , readOnly = true ){
            // CSS 選擇所有 類別. 是 editable 的 HTML 元素
            const inputs = document.querySelectorAll(`.${className}`);
            inputs.forEach(
                input => {
                    // console.log( `${input.name} readOnly is ${input.readOnly}` ); //OK
                    // input.readOnly = !input.readOnly ; //OK
                    input.readOnly = readOnly ;
                }
            );
        }
        
        //指定 id 設定 input 標籤的值 value
        function setInputValue( inputID , value){
            const input = document.querySelector(`#${inputID}`);
            input.value = value ;
        }

        //取回 id 設定 input 標籤的值 value
        function getInputValue( inputID ){
            const input = document.querySelector(`#${inputID}`);
            return input.value ;
        }        


        //HTML 載入完成時，設定 建立合約 續簽合約 結案合約的 disabled 屬性
        window.addEventListener(
            //'load'  ,     //載入中的事件
            'DOMContentLoaded', //載入完成的事件
            event => {
                console.log( 'DOMContentLoaded' );
                console.log( newContractSaveUrl );
                //設定 input 類別為 ? 的 readonly 屬性為 true
                setClassReadOnly(); //預設為 editable
                hasMachine =  getInputValue('machine_MachNo') ? true : false ;                 
                hasContract =  getInputValue('mach_no') ? true : false ; 
                console.log( `hasContract = ${hasContract}`);
                //設定 新增合約 按鈕不可使用
                setCommandButtonDisable('createContract' , hasContract || !hasMachine ) ;
                //設定 續租合約 按鈕不可使用
                setCommandButtonDisable('remainContract' , !hasContract );
                //設定 結束合約 按鈕不可使用
                setCommandButtonDisable('closeContract' , !hasContract );
                //設定 刪除合約 按鈕不可使用
                setCommandButtonDisable('deleteContract' , !hasContract );
                //設定 修改合約 按鈕不可使用
                setCommandButtonDisable('updateContract' , !hasContract );
                //設定 儲存合約 按鈕不可使用
                setCommandButtonDisable('saveContract' );                
                                
            }
        );

        //將目前可編輯欄位的內容，儲存到自訂屬性中，以 " data- " 開頭
        //續簽合約、取消 會用到
        function setOriginalForEdit(){
            //用 CSS 選擇子，挑出類別為 editable 的標籤元素
            const editableElements = document.querySelectorAll('.editable');

            //將編輯前的數據，保存下來，按下取消時，要復原
            editableElements.forEach(
                element => {
                    //設定自訂欄位 data-original 屬性
                    element.dataset.original = element.value ;
                    // console.log(
                    //     element.dataset.original
                    // );
                    // 使用結果，上下相同，都能把值列印出來
                    // console.log(
                    //     element.getAttribute('data-original')
                    // );                    
                }
            );
        }

        //清除所有可編輯欄位的函數，包含 data-original 欄位
        //結案按鈕 會用到
        function clearEditableFields(){
            //用 CSS 選擇子，挑出類別為 editable 的標籤元素
            const editableElements = document.querySelectorAll('.editable');

            editableElements.forEach(
                element => {
                    //清除欄位內容
                    element.value = '' ;
                    console.log( ` clear ${element.value}` );

                    //清除保留欄位內容 .dataset 是使用屬性名稱有 "data-" 開頭的屬性值
                    // 下面代表 data-original 的值，被設定為 ''
                    element.dataset.original = '' ;
                    console.log( ` clear ${element.dataset.original}` );
                }
            );
        }

        //依照 ID 設定輸入標籤獲得焦點
        function setIdFocus( inputID = null ){
            const input = document.querySelector(`#${inputID}`);
            
            if( inputID ){
                // inputID 有輸入值
                //將焦點轉移到該 ID 元素位置
                input.focus();
            }else{
                // 測試按鈕會執行這裡， null 執行這裡
                const testInput = document.querySelector('#testInput');
                const selectInput = document.querySelector(`#${testInput.value}`);
                console.log(
                    // selectInput.value //元素值
                    selectInput.classList.toggle('active')//切換 active 這個類別狀態
                );

                //將焦點轉移到該 ID 元素位置
                selectInput.focus();
            }
        }


        //快速設定按鈕程序
        function setCommandButtonDisable( buttonID , disabled = true , hidden = false){
            const button = document.querySelector(`#${buttonID}`);
            button.disabled = disabled ;
            button.hidden = hidden ;
        }

        //取得 按鈕ID 不可使用 狀態
        function getCommandButtonDisable( buttonID ) {
            const button = document.querySelector(`#${buttonID}`);
            return button.disabled ;
        }


        //設定 AJAX 取回的 機具資料
        function setMachine( machine ){
            const machine_MachNo = document.querySelector('#machine_MachNo');
            const machine_MachModel = document.querySelector('#machine_MachModel');
            const machine_MachModeNo = document.querySelector('#machine_MachModeNo');
            const machine_MachDate1 = document.querySelector('#machine_MachDate1');
            const machine_MachYears = document.querySelector('#machine_MachYears');
            const machine_MachReMark = document.querySelector('#machine_MachReMark');
            const machine_MachDate2 = document.querySelector('#machine_MachDate2');

            // 原本是用 td 標籤，改成用 input 標籤，所以要改成註解
            // machine_MachNo.innerHTML = machine.Mach_No ;
            // machine_MachModel.innerHTML = machine.Mach_Model ;
            // machine_MachModeNo.innerHTML = machine.Mach_ModeNo ;
            // machine_MachDate1.innerHTML = machine.Mach_Date1 ;
            // machine_MachDate2.innerHTML = machine.Mach_Date2 ;
            // machine_MachYears.innerHTML = machine.Mach_Years ;
            // machine_MachReMark.innerHTML = machine.Mach_ReMark ;
            // 以下替代上面指令
            machine_MachNo.value = machine.Mach_No ;
            machine_MachModel.value = machine.Mach_Model ;
            machine_MachModeNo.value = machine.Mach_ModeNo ;
            machine_MachDate1.value = machine.Mach_Date1 ;
            machine_MachDate2.value = machine.Mach_Date2 ;
            machine_MachYears.value = machine.Mach_Years ;
            machine_MachReMark.value = machine.Mach_ReMark ;
            //如果沒有機具型號 Mach_Model 資料，建立合約，不可以按下
            if( machine.Mach_Model ){
                setCommandButtonDisable('createContract' , false );                
            }else{
                // null 執行這裡
                setCommandButtonDisable('createContract');                
            }
        }
        
        //設定 AJAX 取回的 合約資料
        function setContract( contract ) {
            // input 標籤內容用 value 設定
            // 其他標籤用 innerHTML 設定
            const mach_no = document.querySelector('#mach_no');
            const mach_rentctmno = document.querySelector('#mach_rentctmno');
            const mach_rentctmname = document.querySelector('#mach_rentctmname');
            const mach_rentctmuno = document.querySelector('#mach_rentctmuno');
            const mach_rentdate1 = document.querySelector('#mach_rentdate1');
            const mach_rentdate2 = document.querySelector('#mach_rentdate2');
            const mach_rentdays = document.querySelector('#mach_rentdays');
            const mach_rentno = document.querySelector('#mach_rentno');
            const mach_rentamt = document.querySelector('#mach_rentamt');
            const mach_rentfee = document.querySelector('#mach_rentfee');
            const mach_rentfdate = document.querySelector('#mach_rentfdate');
            const mach_contract_no = document.querySelector('#mach_contract_no');
            const mach_rentremark = document.querySelector('#mach_rentremark');

            //input 標籤預設值要在 value 設定
            mach_no.value = contract.mach_no ;
            mach_rentctmno.value = contract.mach_rentctmno ;
            mach_rentctmname.value = contract.mach_rentctmname ;            
            mach_rentctmuno.value = contract.mach_rentctmuno ;
            mach_rentdate1.value = contract.mach_rentdate1 ;
            mach_rentdate2.value = contract.mach_rentdate2 ;
            mach_rentno.value = contract.mach_rentno ; 
            mach_rentamt.value = contract.mach_rentamt ;
            mach_rentfee.value = contract.mach_rentfee ;
            mach_rentfdate.value = contract.mach_rentfdate ;
            mach_contract_no.value = contract.mach_contract_no ;
            mach_rentremark.value = contract.mach_rentremark ; 

            const NoMachine = getCommandButtonDisable( 'createContract' );
            console.log( `NoMachine = ${NoMachine}` );

            //沒資料時，伺服器會傳回 null (我設定的)
            if( contract.mach_rentctmno ){
                //如果有合約資料
                //建立合約按鈕 不可以按下
                //結案合約、續簽合約、修改合約按鈕 可以按下
                    setCommandButtonDisable('createContract');
                    setCommandButtonDisable('remainContract' , false);
                    setCommandButtonDisable('closeContract' , false);
                    setCommandButtonDisable('deleteContract' , false );
                    setCommandButtonDisable('updateContract' , false );
            } else {
                //如果沒有合約資料
                //結案合約、續簽合約、修改合約按鈕 不可以按下
                //建立合約按鈕 可以按下
                    setCommandButtonDisable('createContract' , NoMachine );
                    setCommandButtonDisable('remainContract');
                    setCommandButtonDisable('closeContract' );
                    setCommandButtonDisable('deleteContract');
                    setCommandButtonDisable('updateContract');
            }
        }      

        //查詢車號 AJAX 按鈕
        //使用 MachineController  的 findMachineAJAX()
        document.querySelector('#queryMachNoAJAX').addEventListener(
            'click',
            event => {
                // console.log( event );
                // console.log( event.layerX ); //滑鼠點擊位置不同，會有不同的位置
                // console.log( event.layerY ); //滑鼠點擊位置不同，會有不同的位置
                // console.log( event.screenX ); //
                // console.log( event.screenY ); //
                // console.log( event.x ); //
                // console.log( event.y ); //

                //利用 prompt() 讓使用者輸入車號
                const machNo = prompt('請輸入車號');
                console.log( machNo );

                fetch(
                    `{{ route('findMachineAJAXNameRoute') }}/${machNo}` ,
                    {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': '{{ csrf_token() }}'
                        },
                        body: JSON.stringify({ 'key1' : 'value1' , 'key2' : 'value2'})
                    }
                )
                .then(response => response.json())
                .then(
                    data => {
                        console.log( 'data' );
                        console.log( data );
                        console.log(data.success);
                        console.log(data.machine);
                    }
                );

            }
        );
        
        //查詢車號按鈕
        //使用 MachineController  的 findMachine()
        document.querySelector('#queryMachNo').addEventListener(
            'click',
            event => {
                //利用 prompt() 讓使用者輸入車號
                const machNo = prompt('請輸入車號');
                console.log( machNo );

                fetch(
                    `{{ route('findMachineNameRoute') }}/${machNo}` ,
                    {
                        method: 'POST',
                        headers: {
                            'X-CSRF-TOKEN': '{{ csrf_token() }}'
                        },
                    }
                ).then(
                    (response)=>{
                        console.log(response);
                        if( response.ok ){
                            return response.json();
                        }
                    }
                ).then(
                    data => {
                        // console.log(data.machine); //伺服端關聯式陣列回來
                        // console.log(data.machine.Mach_Date1);
                        // console.log(data.machine.Mach_Date2);
                        // console.log(data.machine.Mach_ModeNo);
                        // console.log(data.machine.Mach_Model);
                        // console.log(data.machine.Mach_No);
                        // console.log(data.machine.Mach_ReMark);
                        // console.log(data.machine.Mach_Years);
                        setMachine( data.machine );
                        setContract( data.contract );
                        // console.log(data.contract); //伺服端關聯式陣列回來
                        // console.log(data.contract.mach_contract_no);
                        // console.log(data.contract.mach_no);
                        // console.log(data.contract.mach_rentamt);
                        // console.log(data.contract.mach_rentctmname);
                        // console.log(data.contract.mach_rentctmno);
                        // console.log(data.contract.mach_rentctmuno);
                        // console.log(data.contract.mach_rentdate1);
                        // console.log(data.contract.mach_rentdate2);
                        // console.log(data.contract.mach_rentdays);
                        // console.log(data.contract.mach_rentfdate);
                        // console.log(data.contract.mach_rentfee);
                        // console.log(data.contract.mach_rentno);
                        // console.log(data.contract.mach_rentremark);

                        // // 延遲 2 秒後自動刷新頁面
                        // setTimeout(function() {
                        //     location.reload(); // 刷新頁面
                        // }, 2000); // 2000 毫秒 = 2 秒

                        console.log('刪除 儲存完成的訊息');
                        const sm = document.querySelector('#succeesMessage');
                        // console.log(sm);
                        // console.log(sm.innerHTML == '');
                        sm.innerHTML='' ;
                    }
                );
            }
        );

        //建立合約 click 事件
        document.querySelector('#createContract').addEventListener(
            'click' ,
            (event)=>{
                console.log('createContract');
                //將機具編號儲存到合約的欄位中
                setInputValue( 'mach_no' , getInputValue('machine_MachNo') );


                //設定 input 標籤可以寫入
                //如果想使用函數的參數預設值，在不改變順序的情況，用 undefined 代表未指定
                //不然就直接改變參數的順序，這樣就不用空著欄位
                setClassReadOnly( undefined  ,  false);

                //將焦點轉移到輸入格
                setIdFocus('mach_rentctmno');

                //顯示新建儲存按鈕
                setCommandButtonDisable('newContractSave' ,false,false );
                setCommandButtonDisable('cancelSave' ,false,false );
            }
        );
        
        //續簽合約 click 事件
        //續簽 = 修改 + 產生租賃資料
        document.querySelector('#remainContract').addEventListener(
            'click' ,
            (event)=>{
                console.log('remainContract');
                //按下 修改合約的按鈕 (click) 事件
                    const uButton = document.querySelector('#updateContract');
                    //軟觸發事件必須自己宣告事件物件，然後自己觸發
                    const uButtonEvent = new Event('click',{bubbles:true,cancelable:true});
                    //什麼按鈕.觸發事件(什麼事件);
                    uButton.dispatchEvent(uButtonEvent);                

                //按鈕狀態控制
                    //顯示新建儲存按鈕
                    setCommandButtonDisable('remainContractSave' ,false,false );
                    setCommandButtonDisable('cancelSave' ,false,false );
                    setCommandButtonDisable('remainContract');
                    setCommandButtonDisable('updateContract');
                    setCommandButtonDisable('saveContract');
                    setCommandButtonDisable('closeContract');
                    setCommandButtonDisable('deleteContract');
                    setCommandButtonDisable('queryMachNo');
                    
            }
        );

        //結案合約 click 事件
        document.querySelector('#closeContract').addEventListener(
            'click' ,
            (event)=>{
                console.log('closeContract');
                //根據目前畫面，產生租賃資料
                created = createRentData();

                if( created ){ 
                    //刪除目前合約資訊
                    deleteContract( '合約結案完成' );
    
                    //清除所有欄位
                    clearEditableFields();
                    
                    alert('結案完成');
                }else{
                    alert('結案失敗!!');
                }
            }
        );

        //刪除合約 click 事件
        //直接在 input 標籤內輸入 onclick 會出現 deleteContract() 不是函數
        //改用 JS 增加監聽事件
        document.querySelector('#deleteContract').addEventListener(
            'click' ,
            event => {
                deleteContract('合約刪除完成');
            }
        );

        //修改合約 click 事件
        document.querySelector('#updateContract').addEventListener(
            'click' ,
            event => {
                console.log('updateContract');
                //按下修改按鈕後，不能再按下修改按鈕，但能按下儲存按鈕
                    setCommandButtonDisable('updateContract');
                    setCommandButtonDisable('saveContract',false);

                //保留欄位原始內容到 data- 內容中
                setOriginalForEdit();

                //設定 editable 類別為可編輯狀態
                //設定欄位可以寫入
                setClassReadOnly( 'editable' , false );

                //轉移焦點到 mach_rentctmno 租賃客戶編號上
                document.querySelector('#mach_rentctmno').focus();

                //列出每個 input 的欄位值
                // document.querySelectorAll('.editable').forEach(
                //     input => {
                //         console.log(input.dataset);
                //     }
                // );

                //為 editable 類別元素 增加 input 事件
                addListenerForInputElement( 'editable' , 'input' );
            }
        );

        //儲存合約 click 事件
        document.querySelector('#saveContract').addEventListener(
            'click' ,
            event => {
                console.log('saveContract');
                //按下儲存合約後，不能在按下儲存合約，但能按下修改合約
                setCommandButtonDisable('updateContract',false);                
                setCommandButtonDisable('saveContract');                

                //執行 PATCH 儲存的路由，儲存完成會將 wait-for-update 記號取消
                saveUpadteContract();

                //保留欄位原始內容到 data- 內容中
                // setOriginalForEdit();

                //設定 editable 類別為 不 可編輯狀態
                setClassReadOnly( 'editable');


                //顯示更新成功訊息
                alert( '修改合約，儲存成功!! ');

                // 下面會刷新網頁成空白
                // const form = document.querySelector('#hideForm');
                // form.method = "GET" ;
                // form.action = `{{ route('contract.updateMessage') }}` ; // 設定表單的 action 屬性為對應的路由
                // console.log( `{{ route('contract.updateMessage') }}` );
                // form.submit(); // 提交表單


            }
        );


        //新建儲存 合約 Contract  click 事件
        document.querySelector('#newContractSave').addEventListener(
            'click' ,
            (event)=>{
                console.log('newContractSave');

                const form = document.querySelector('#formContract');
                form.method = "POST" ;
                form.action = newContractSaveUrl ; // 設定表單的 action 屬性為對應的路由

                console.log( form.method );
                console.log( form.action );
                form.submit(); // 提交表單

                //不顯示 新建儲存 按鈕
                //因為打算用轉向處理，所以這裡就不隱藏儲存按鈕
                // setCommandButtonDisable('newContractSave' ,false,true );
                // setCommandButtonDisable('cancelSave' ,false,true );

            }
        );

        //續租儲存 click 事件
        document.querySelector('#remainContractSave').addEventListener(
            'click' ,
            (event)=>{
                console.log('remainContractSave');
                //根據目前畫面，產生租賃資料
                created = createRentData();
                console.log(created);
                if( created ){
                    //不顯示 續租儲存 按鈕
                    setCommandButtonDisable('remainContractSave' ,false,true );
                    setCommandButtonDisable('cancelSave' ,false,true );
                    setCommandButtonDisable('remainContract',false);
                    setCommandButtonDisable('updateContract',false);
                    setCommandButtonDisable('closeContract',false);
                    setCommandButtonDisable('deleteContract',false);
                    setCommandButtonDisable('queryMachNo',false);
                }
            }
        );

        //取消 click 事件
        document.querySelector('#cancelSave').addEventListener(
            'click' ,
            (event)=>{
                console.log('cancelSave');
            }
        );        

        //選擇所有 CSS 選擇子為 .editable ，獲得焦點事件
        document.querySelectorAll('.editable').forEach(
            editableField => {
                editableField.addEventListener(
                    'focus' ,
                    event => {

                        console.log(
                           ` ${event.target.nodeName}  ${event.target.id}  focus => ${event.target.value} `
                        );

                        // active 是已經設定好的 CSS 類別 .active
                        event.target.classList.toggle('active');
                    }
                );
            }
        );

        //選擇所有 CSS 選擇子為 .editable ，獲得離開焦點事件
        document.querySelectorAll('.editable').forEach(
            editableField => {
                editableField.addEventListener(
                    'blur' ,
                    event => {
                        console.log(
                            ` ${event.target.nodeName}  ${event.target.id}  blur => ${event.target.value}`
                        );
                        // active 是已經設定好的 CSS 類別 .active
                        event.target.classList.toggle('active');
                    }
                );
            }
        );


    </script>
@endsection