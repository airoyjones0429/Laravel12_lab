<?php

namespace App\Http\Controllers;

use App\Models\contract;
use App\Models\machine;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log ;
use PhpParser\JsonDecoder;

class MachineController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // 傳回所有資料
        // $MachineManager = machine::all();

        // 升冪排序
        $MachineManager = Machine::orderBy('created_at', 'asc')->get(); 

        // 降冪排序
        // $MachineManager = Machine::orderBy('created_at', 'desc')->get(); 

        return view('main.machine.machine' , ['MachineManager' => $MachineManager]);
    }

    /**
     * Show the form for creating a new resource.
     * 顯示新增 資料的  表單方法
     */
    public function create()
    {

    }

    /**
     * Store a newly created resource in storage.
     * 用 RESTful 規範  使用 POST 儲存全新的資料
     */
    public function store(Request $request)
    {
        //更新訊息         //錯誤訊息
        $message =  ''  ; $error = '' ;

        //回應碼，提供客戶端瀏覽器，是否要把訊息當作錯誤處理  捕獲 catch()
        $responseCode = 200 ;
        
        //新增紀錄的暫存區
        $newMachine =  new machine();

        //在 storage\logs\laravel.log 紀錄訊息
        Log::info( $request );

        //接收要求新增的機具資訊陣列 ->all() 傳回要求傳遞的主要資料為關聯式陣列
        $newArray =  $request->all();

        //檢查新增資料是否重複
        $check_duplicate = machine::find( $newArray['machNo'] );
        
        //沒有重複就新增資料
        if ($check_duplicate == null){
            $newMachine->Mach_No        =  $newArray['machNo']              ;
            $newMachine->Mach_Model     =  $newArray['machModel']           ;
            $newMachine->Mach_ModeNo    =  $newArray['machModeNo']          ;
            $newMachine->Mach_Date1     =  $newArray['machDate1']           ;
            $newMachine->Mach_Date2     =  $newArray['machDate2']           ;
            $newMachine->Mach_ReMark    =  $newArray['machReMark']          ;
            $newMachine->Mach_Years     =  $newArray['machYears']           ;

            //使用 Laravel 模型提供的方法 儲存 資料
            $newMachine->save();

            $message = '更新成功';
        }
        else{
            //有重複就傳回訊息，說是重複的資料
            $error = '機具自訂編號，資料重複，新建資料失敗';            
            $responseCode = 409 ; //主鍵重複 Conflict 衝突錯誤代碼
        }

        //統一在一位置設定回應
        return 
        response()->
                json([  'error'     => $error ,
                        'message'   => $message , 
                        'newData'   => $newMachine ,
                        'oldData'   => $check_duplicate],
                        $responseCode );
    }

    /**
     * Display the specified resource.
     */
    public function show(machine $machine)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(machine $machine)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, machine $machine)
    {
   
    }


    //PATCH 更新方法
    //要符合 RESTful 設計  PATCH 路由上  必須要放 主鍵
    //PATCH 用來更新 指定欄位 不會重設其他欄位的值
    public function updatePatchMachine( Request $request ,$MachNo)  {
        // Log::info( 'PUT 更新方法 IF 外' );
        // Log::info( $request );

        if ($request->isMethod('patch') ){
            // Log::info( 'PUT 更新方法 IF 內' );
            $u = $request->all(); //將更新資料轉換成關聯陣列  要注意 客戶端送過來資料的格式   
            $d = machine::findOrFail( $MachNo ); //找到要更新資料的資料庫那筆紀錄，可以直接使用的資料模型物件，要去模型定義檔案更改 PK 是設定
            // Log::info( '這次 PUT 要更新的資料'.$d );

            Log::info( $u );
            // Log::info( '更新的自訂編號'.$u['machNo'] );
            // Log::info( '網址列上的自訂編號'.$MachNo );
            // Log::info( '資料庫搜尋的自訂編號'.$d['Mach_No'] );

            //更新所有欄位資料            
            Log::info( ( isset($u['Mach_Model'] )?'有':'無').' machModel 欄位' );
            Log::info( ( isset($u['machModeNo'] )?'有':'無').' machModeNo 欄位' );
            Log::info( ( isset($u['machDate1'] )?'有':'無').' machDate1 欄位' );
            Log::info( ( isset($u['machDate2'] )?'有':'無').' machDate2 欄位' );
            Log::info( ( isset($u['machReMark'] )?'有':'無').' machReMark 欄位' );
            Log::info( ( isset($u['machYears'] )?'有':'無').' machYears 欄位' );
            if( isset($u['machModel'])) { $d['Mach_Model'] = $u['machModel']; }
            if( isset($u['machModeNo'])) { $d['Mach_ModeNo'] = $u['machModeNo']; }
            if( isset($u['machDate1']) ) { $d['Mach_Date1']  = $u['machDate1']; }
            if( isset($u['machDate2']) ) { $d['Mach_Date2']  = $u['machDate2']; }
            if( isset($u['machReMark'])) { $d['Mach_ReMark'] = $u['machReMark']; }
            if( isset($u['machYears']) ) { $d['Mach_Years']  = $u['machYears']; }
            // $d['Mach_Model']    =$u['machModel']; //PK 已有在資料模型中設定 
            // $d['Mach_ModeNo']   =$u['machModeNo'];
            // $d['Mach_Date1']    =$u['machDate1'];
            // $d['Mach_Date2']    =$u['machDate2'];
            // $d['Mach_ReMark']   =$u['machReMark'];
            // $d['Mach_Years']    =$u['machYears'];
            $d->save();
            Log::info( $d );
            Log::info( '=================end' );
          //success 欄位，在客戶端會檢查是否有這個欄位，如果沒有，就代表傳輸失敗，是自己設定的名稱
            return response()->json(['message' => '更新成功', 'success' => json_encode($d) ], 200);
        }        
    }


    //PUT 更新方法
    //要符合 RESTful 設計  PUT 路由上  必須要放 主鍵
    //PUT 用來更新 所有的欄位  沒有數值的欄位 要被設定成預設值
    public function updatePutMachine( Request $request ,$MachNo)  {
        // Log::info( 'PUT 更新方法 IF 外' );
        // Log::info( $request );

        if ($request->isMethod('put') ){
            // Log::info( 'PUT 更新方法 IF 內' );
            $u = $request->all(); //將更新資料轉換成關聯陣列  要注意 客戶端送過來資料的格式   
            $d = machine::findOrFail( $MachNo ); //找到要更新資料的資料庫那筆紀錄，可以直接使用的資料模型物件
            // Log::info( '這次 PUT 要更新的資料'.$d );

            // Log::info( $u );
            Log::info( '更新的自訂編號'.$u['machNo'] );
            Log::info( '網址列上的自訂編號'.$MachNo );
            Log::info( '資料庫搜尋的自訂編號'.$d['Mach_No'] );

            //更新所有欄位資料
            $d['Mach_Model']    =$u['machModel']; //PK 已有在資料模型中設定
            $d['Mach_ModeNo']   =$u['machModeNo'];
            $d['Mach_Date1']    =$u['machDate1'];
            $d['Mach_Date2']    =$u['machDate2'];
            $d['Mach_ReMark']   =$u['machReMark'];
            $d['Mach_Years']    =$u['machYears'];
            $d->save();

            //success 欄位，在客戶端會檢查是否有這個欄位，如果沒有，就代表傳輸失敗，是自己設定的名稱
            return response()->json(['message' => '更新成功', 'success' => $d ], 200);
            // return redirect()->route('login')->with([ //更新後轉向，目前還是失敗
            //     'message' => '更新成功',
            //     'success' => $d // 這裡可以直接傳遞數據，不需要 json_encode
            // ]);
        }        
    }

    //POST 既有資料更新方法  不是標準 RESTful 做法
    //不是原本的更新流程 所以沒辦法有 $machine 這個參數，只能另外寫一個更新方法
    public function updatePostMachine(Request $request ){

        // dd( $request );  //這行  雖然AI說不會造成 500 錯誤，但的確造成了 500 錯誤

        //以下可以將資訊  放到 //storage/log/laravel.log 中
        // dump()  dd() 不知道什麼原因 在這裡沒辦法正常用 所以改用下面的方式  除錯
        // Log::info($request->all());
        // Log::info(  $request );

        // 確認請求是 POST
        if ($request->isMethod('post')) {
            // 獲取接收到的資料
            $data = $request->all(); // 獲取所有請求資料，轉成   陣列  傳回

            // Log::info(  $data[0]  );
            
            foreach( $data as $da ){
                // Log::info( 'Mach_No = ' .  $da['machNo']  );
                // Log::info( 'Mach_Model = ' .  $da['machModel']  );
                // Log::info( 'Mach_ModeNo = ' .  $da['machModeNo']  );
                // Log::info( 'Mach_Date1 = ' .  $da['machDate1']  );
                // Log::info( 'Mach_Date2 = ' .  $da['machDate2']  );
                // Log::info( 'Mach_ReMark = ' .  $da['machReMark']  );
                // Log::info( 'Mach_Years = ' .  $da['machYears']  );
                // Log::info( $da );
                $v= $da['machNo'];
                Log::info( $v );
                $d = machine::where('Mach_No' , $v )->first() ; //傳回記錄物件

                //POST 下面這個方法  只會更新第一筆資料!?
                // $d = machine::findOrFail( $v )->first() ;  //先前沒有改模型的 PK 鍵，所以才不能用這個方法
                
                Log::info( $d );
                $d->Mach_Model= $da['machModel']  ;
                $d->Mach_ModeNo= $da['machModeNo']  ;
                $d->Mach_Date1= $da['machDate1']  ;
                $d->Mach_Date2= $da['machDate2']  ;
                $d->Mach_ReMark= 'test' ; //$da['machReMark']+' '  ;//欄位屬性不能為NULL  因為沒設定 格式錯誤就會出現 500 錯誤碼
                $d->Mach_Years= $da['machYears']  ;       
                
                $d->save();
            }


            // 檢查是否有收到資料
            if (!empty($data)) {
                // 返回成功回應，並顯示接收到的資料
                return response()->json([
                    'success' => true,
                    'data' => $data // 回傳接收到的資料
                ]);
            } else {
                // 返回失敗回應
                return response()->json(['success' => false, 'message' => '未接收到任何資料'], 400);
            }
        }


        // 返回錯誤回應，因為不是 POST 請求
        return response()->json(['success' => false, 'message' => '請求方法不正確'], 405);
     //


        // dump('MachineController 67');
        // dd('test');
        // foreach ($validatedData as $data) {
        //     $model = machine::find($data['Mach_No']);
        //     if ($model) {
        //         $model->Mach_Model = $data['Mach_Model'];
        //         $model->Mach_Date1 = $data['Mach_Date1'];
        //         $model->Mach_Date2 = $data['Mach_Date2'];
        //         $model->Mach_Years = $data['Mach_Years'];
        //         $model->Mach_ReMark = $data['Mach_ReMark'];
        //         $model->save();
        //     }
        // }

        // return response()->json(['success' => true]);
    }


    /**
     * Remove the specified resource from storage.
     * 
     *  參數名稱 
     */
    public function destroy(machine $machine , $MachNo)
    {
        //除錯用指令，在 log 紀錄下面訊息
        Log::info('Destory'.$MachNo);
        // 查詢機器編號是否存在
        $deletedRecord = machine::find($MachNo);

        // 確認資源存在
        if (!$deletedRecord) {
            return response()->json(['message' => 'Resource not found'], 404);
        }
        // 刪除資源
        $deletedRecord->delete();

        // 返回成功響應
        return response() ->json(['success'=> true , 'message'=> $MachNo],200);
    }


    //1140527
    //不是資源型路由，傳遞主鍵編號似乎不會自動變成ORM物件
    //根據路由上的 mach_no 找到 ORM 資料
    //已可以將資料傳送回去
    public function findMachineAJAX(Request $request ,$MachNo){
        //dd( $machine );  //AJAX dd() 偵錯沒用
        //要用 Log 類別 (use Illuminate\Support\Facades\Log)
        Log::info( 'AJAX findMachine ' . $MachNo );
        
        //列出從模板傳來的 AJAX 要求，會直接印出 JSON.stringify() 的傳輸內容
        // Log::info(  $request );

        $ajax =  $request->toArray() ;
        Log::info( $ajax['key1'] );
        Log::info( $ajax['key2'] );

        $machine = machine::find( $MachNo );

        if($machine){
            $message = '找到資料';
        }else{
            $message = '沒有資料';
        }

        //回應 AJAX 一定要使用 JSON 格式，不然，我不知道如何讀取資料
        return  response()->json(
            [
        // 回傳的屬性名稱 => 回傳的屬性內容(型態不限)
            'success' => $message ,
            'machine' => $machine
        // 一定要回應 200，不然偵錯視窗會出現錯誤
            ] , 200 )  ;
    }


    //machineContract.blade 有用到
    public function findMachine( Request $request , $MachNo){
        Log::info( 'AJAX findMachine' . $MachNo . 'Cant Use redirect() in MachineController ' );

        $machine = machine::find( $MachNo );
        Log::info( $machine );
        if( is_null( $machine ) ){
            Log::info('MachineController 341');
            //如果資料庫沒有資料，產生空的模型給模板
            $machine = new machine() ;
            $machine->Mach_No = '車號不存在';
            $machine->Mach_Model = null ;
            $machine->Mach_ModeNo = null ;
            $machine->Mach_Date1 = null ;
            $machine->Mach_Date2 = null ;
            $machine->Mach_ReMark = null ;
            $machine->Mach_Years = null ;
            $contract = null ;
            // dump( $machine ); //經過上面的設定，這裡有欄位名稱
        }else{
            Log::info('MachineController 354');
            // dump('machine is not null');
            //主鍵要設定，才能使用 find() 方法
            $contract = contract::find( $machine->Mach_No );
        }

        if( is_null( $contract ) ){
            Log::info('MachineController 361');
            //如果機具沒有合約，就產生合約的樣子給模板
            $contract =  new contract() ;
            $contract->mach_no = null ;
            $contract->mach_rentctmno = null ;
            $contract->mach_rentctmname = null ;
            $contract->mach_rentctmuno = null ;
            $contract->mach_rentdate1 = null ;
            $contract->mach_rentdate2 = null ;
            $contract->mach_rentdays = null ;
            $contract->mach_rentno = null ;
            $contract->mach_rentamt = null ;
            $contract->mach_rentfee = null ;
            $contract->mach_rentfdate = null ;
            $contract->mach_contract_no = null ;
            $contract->mach_rentremark = null ;
        }
        Log::info('MachineController 385');

        // redirect()->route() 會產生一個 GET 方法的路由請求，所以路由一定要是 GET，否則要換作法
        // showRentMachineManager 是 POST 方法的路由
        // return redirect()->route('showRentMachineManager', ['machno' => $machine->Mach_No ]);
        
        Log::info( 'MachineController 393' . $contract );
        //顯示資料在頁面上，上面原本要用轉向處理，但 Laravel 不准，改方法
        //看來用 AJAX 要求的路由，不能回傳視圖，下面會沒有反應，客戶端網頁並不會改變
        // return view('main.invoice.machineContract' ,
        //      ['machine' => $machine , 'contract' => $contract]);


        // // 獲取當前路由名稱
        // $routeName = $request->route()->getName();
        // // dd( $routeName );

        // // 獲取當前路由參數
        // $routeParams = $request->route()->parameters();
        // // dd( $routeParams ); //會傳回關聯式陣列 [{路由變數名稱} => 路由變數的值 ,..]
        // Log::info( 'MainController 409 ' . $routeName );

        // // 直接 列出 陣列 會錯誤
        // Log::info( 'MainController 412 ' . count($routeParams) );


        Log::info( 'MachineController 414 session("succees") = ' . session('succees' , '沒有 succees')  );
        // 刪除 session('succees')  的內容
        session()->forget('succees');
        session()->forget('data');
        Log::info( 'MachineController 417 session("succees") = ' . session('succees' , '沒有 succees')  );


        //最後 AJAX 最好是把資料傳回去給客戶端處理
        return response()->json( [ 'machine'=> $machine , 'contract' => $contract ] , 200 );

    }

}
