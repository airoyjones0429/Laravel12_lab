<?php

namespace App\Http\Controllers;

use App\Models\contract;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class ContractController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        dd('index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        dd('create');
    }

    /**
     * Store a newly created resource in storage.
     * 被使用於 : machineContract.blade.php
     * 功能：儲存新合約資料
     */
    public function store(Request $request)
    {
        Log::info( 'Contract store in ContractController');

        //檢查輸入欄位是否符合條件
        $validatedData = $request->validate([
            //nullable 代表該欄位可以為 null，如果有值，就要檢查是否正確
            //sometimes  代表檢查矩陣中，可能沒有該欄位，如果沒有欄位，就不用檢查
            //required  代表檢查矩陣中，必須要有該欄位
            'mach_no' => 'required|string|max:30'   ,
            'mach_rentctmno' => 'sometimes|string|max:30'   ,
            'mach_rentctmname' => 'sometimes|string|max:50'   ,
            'mach_rentctmuno' => 'sometimes|string|max:30'   ,
            'mach_rentdate1' => 'sometimes|date'   ,
            'mach_rentdate2' => 'sometimes|date'   ,
            'mach_rentdays' => 'sometimes|numeric|min:0'   ,
            'mach_rentno' => 'sometimes|string|max:30'   ,
            'mach_rentamt' => 'sometimes|integer|min:0|max:8388607'   ,
            'mach_rentfee' => 'sometimes|integer|min:0|max:8388607'   ,
            'mach_rentfdate' => 'sometimes|date'    ,
            'mach_contract_no' => 'sometimes|string|max:30'   ,
            'mach_rentremark' => 'sometimes|string|max:255'   ,
        ],
        [
            //出現驗證錯誤時，下面可以指定傳回的訊息
            'mach_no.required' => '自訂編號 必須輸入',
            'mach_rentctmno.max' => '客戶編號，不能超過 30 字',
            'mach_rentctmname.max' => '客戶名稱，不能超過 50 字',
            'mach_rentctmuno.max' => '客戶統一編號，不能超過 30 字',
            'mach_rentdate1.date' => 'mach_rentdate1 必須是日期',
            'mach_rentdate2.date' => 'mach_rentdate2 必須是日期',
            'mach_rentdays.numeric' => '租賃天數，必須要有數字',
            'mach_rentdays.min' => '租賃天數，不能為負值',
            'mach_rentno.string' => '租賃編號，必須要輸入數字',
            'mach_rentno.max' => '租賃編號，不能超過 30 字',
            'mach_rentamt.integer' => '租賃總金額，不能為負',
            'mach_rentamt.min' => '租賃總金額，必須要輸入數字',
            'mach_rentamt.max' => '租賃總金額，不能超過 8388607',
            'mach_rentfee.integer' => '租賃總金額，不能為負',
            'mach_rentfee.min' => '租賃運費，不能為負',            
            'mach_rentfee.max' => '租賃運費，不能超過 8388607',
            'mach_contract_no.string' => '合約編號，必須輸入數字',
            'mach_contract_no.max' => '合約編號，不能超過 30 字',
            'mach_rentremark.string' => '備註，必須是字串',
            'mach_rentremark.max' => '備註，不能超過 255 字',
            'mach_rentfdate.date' => 'mach_rentdate2 必須是日期',
        ]);
        //用批量賦值方式，產生一筆資料
        contract::create( $validatedData );

        // $validatedData 會是 Array 要轉字串 才能儲存到 Log 中
        Log::info( $validatedData['mach_no'] . ' Contract store in ContractController'  );

        // dd('Contract store');
        //  response()-> 不支援 with() , response()->with() 是錯的用法
        //  back()->  與 redirect()-> 都會提出一個 GET 方法，前往指定路由
        //  ，如果路由不能接受 GET 就會錯誤
        // return  back()->with( 'data' , json_encode( $validatedData )) //OK 但回到原頁面，要處理 old() 的值，會很累
        //         ->with('succees', 'OK');
        
        return redirect()
        ->route('showRentMachineManager.return' , [  'machno' => $validatedData['mach_no'] ] )
        //在主模板有放置 顯示 session() 的位置
        ->with('succees','儲存合約成功');
    }

    /**
     * Display the specified resource.
     */
    public function show(contract $contract)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(contract $contract)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, contract $contract)
    {
        Log::info('update ' . $contract->mach_no );

        //檢查輸入欄位是否符合條件
        $validatedData = $request->validate([
            //nullable 代表該欄位可以為 null，如果有值，就要檢查是否正確
            //sometimes  代表檢查矩陣中，可能沒有該欄位，如果沒有欄位，就不用檢查
            //required  代表檢查矩陣中，必須要有該欄位
            'mach_no' => 'sometimes|string|max:30'   ,
            'mach_rentctmno' => 'sometimes|string|max:30'   ,
            'mach_rentctmname' => 'sometimes|string|max:50'   ,
            'mach_rentctmuno' => 'sometimes|string|max:30'   ,
            'mach_rentdate1' => 'sometimes|date'   ,
            'mach_rentdate2' => 'sometimes|date'   ,
            'mach_rentdays' => 'sometimes|numeric|min:0'   ,
            'mach_rentno' => 'sometimes|string|max:30'   ,
            'mach_rentamt' => 'sometimes|integer|min:0|max:8388607'   ,
            'mach_rentfee' => 'sometimes|integer|min:0|max:8388607'   ,
            'mach_rentfdate' => 'sometimes|date'    ,
            'mach_contract_no' => 'sometimes|string|max:30'   ,
            'mach_rentremark' => 'sometimes|string|max:255'   ,
        ],
        [
            //出現驗證錯誤時，下面可以指定傳回的訊息
            // 'mach_no.required' => '自訂編號 必須輸入',
            'mach_rentctmno.max' => '客戶編號，不能超過 30 字',
            'mach_rentctmname.max' => '客戶名稱，不能超過 50 字',
            'mach_rentctmuno.max' => '客戶統一編號，不能超過 30 字',
            'mach_rentdate1.date' => 'mach_rentdate1 必須是日期',
            'mach_rentdate2.date' => 'mach_rentdate2 必須是日期',
            'mach_rentdays.numeric' => '租賃天數，必須要有數字',
            'mach_rentdays.min' => '租賃天數，不能為負值',
            'mach_rentno.string' => '租賃編號，必須要輸入數字',
            'mach_rentno.max' => '租賃編號，不能超過 30 字',
            'mach_rentamt.integer' => '租賃總金額，不能為負',
            'mach_rentamt.min' => '租賃總金額，必須要輸入數字',
            'mach_rentamt.max' => '租賃總金額，不能超過 8388607',
            'mach_rentfee.integer' => '租賃總金額，不能為負',
            'mach_rentfee.min' => '租賃運費，不能為負',            
            'mach_rentfee.max' => '租賃運費，不能超過 8388607',
            'mach_contract_no.string' => '合約編號，必須輸入數字',
            'mach_contract_no.max' => '合約編號，不能超過 30 字',
            'mach_rentremark.string' => '備註，必須是字串',
            'mach_rentremark.max' => '備註，不能超過 255 字',
            'mach_rentfdate.date' => 'mach_rentdate2 必須是日期',
        ]);
        //批量更新資料
        $updateOK = $contract->update( $validatedData );

        //將更新的資料記錄在 storage/laravel.log
        Log::info('update ' . json_encode( $validatedData ));

        //設定更新成功訊息
        // if( $updateOK ) {
            session(['succees' => '修改合約，儲存成功!!']);
        // }

        Log::info( 'session() = ' . session( 'succees' ) );
        return response()->json(['succees' => $contract , 'data' => $validatedData  ],200) ;
    }

    /**
     * Remove the specified resource from storage.
     * Request $request 是我自己加入的，可以顯示表單傳送過來的欄位
     * 包含 CSRF 令牌與 _method 屬性值，還有我自己設定的輸入標籤內容
     */
    public function destroy( contract $contract , Request $request )
    {
        //
        Log::info( 'delete' . $contract );
        Log::info( $request );

        //取回所有非隱藏欄位的資料
        $Message = $request->all();

        $contract->delete();

        // return redirect()->back()->with('succees', '合約資料已成功刪除！') ; //ok 等於 back()
        // return back();
        
        // 返回反饋訊息
        return back()->with('succees', $Message['deleteMessage']);

    }
}
