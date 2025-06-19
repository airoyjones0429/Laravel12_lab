<?php

namespace App\Http\Controllers;

use App\Models\rent_d;
use App\Models\rent_m;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class RentDController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        //
        Log::info( 'RentDController');
        Log::info( $request );
        return  view('main_noUse')->with('succees' , 'RentDController Test') ;
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     * 
     * 使用模板：machineContract.blade.php
     * 儲存要計算金額的合約資料 = 租賃資料 主檔 / 明細檔
     */
    public function store(Request $request)
    {
        //將客戶端傳送過來的所有資料，儲存在 $validatedData 中
        // all() 會傳回陣列型態
        $validatedData = $request->all();

        //將租賃主檔資料，記錄在 laravel.log 檔案中
            // Log::info( $validatedData['MRENT_NO'] );
            // Log::info( $validatedData['MRENT_PDATE'] );
            // Log::info( $validatedData['MRENT_UNO'] );
            // Log::info( $validatedData['MRENT_UNO_DAT'] );
            // Log::info( $validatedData['MRENT_CNO'] );
            // Log::info( $validatedData['MRENT_CNAME'] );
            // Log::info( $validatedData['MRENT_CTMUNO'] );
            // Log::info( $validatedData['MRENT_CTMADRS'] );
            // Log::info( $validatedData['MRENT_ADRS'] );
            // Log::info( $validatedData['MRENT_REMARK'] );
            // Log::info( $validatedData['MRENT_TOTAL1'] );
        //

        // 從 validatedData 中，分離 租賃主檔資料 出來
        $rent_ms['RENT_NO'] = $validatedData['MRENT_NO'];
        $rent_ms['RENT_PDATE'] = $validatedData['MRENT_PDATE'];
        $rent_ms['RENT_UNO'] = $validatedData['MRENT_UNO'];
        $rent_ms['RENT_UNO_DAT'] = $validatedData['MRENT_UNO_DAT'];
        $rent_ms['RENT_CNO'] = $validatedData['MRENT_CNO'];
        $rent_ms['RENT_CNAME'] = $validatedData['MRENT_CNAME'];
        $rent_ms['RENT_CTMUNO'] = $validatedData['MRENT_CTMUNO'];
        $rent_ms['RENT_CTMADRS'] = $validatedData['MRENT_CTMADRS'];
        $rent_ms['RENT_ADRS'] = $validatedData['MRENT_ADRS'];
        $rent_ms['RENT_REMARK'] = $validatedData['MRENT_REMARK'];
        $rent_ms['RENT_TOTAL1'] = $validatedData['MRENT_TOTAL1'];

        $rentM = rent_m::find( $rent_ms['RENT_NO'] );
        if( is_null($rentM)){
            Log::info( '沒找到租賃單號' . $rent_ms['RENT_NO']  );
            rent_m::create( $rent_ms ); //建立主檔資料
        } 

        //將租賃單一明細資料，記錄在 laravel.log 檔案中
            // Log::info( $validatedData['DRENT_NO'] );
            // Log::info( $validatedData['DRENT_DNO'] );
            // Log::info( $validatedData['DRENT_DMODEL'] );
            // Log::info( $validatedData['DRENT_DDATE'] );
            // Log::info( $validatedData['DRENT_DMSN'] );
            // Log::info( $validatedData['DRENT_DDATE1'] );
            // Log::info( $validatedData['DRENT_DDATE2'] );
            // Log::info( $validatedData['DRENT_DAY'] );
            // Log::info( $validatedData['DRENT_AMT'] );
            // Log::info( $validatedData['DRENT_FDATE'] );
            // Log::info( $validatedData['DRENT_FEE'] );
            // Log::info( $validatedData['DRENT_Contract_No'] );
        //

        $rent_ds['RENT_NO'] =  $validatedData['DRENT_NO'];
        $rent_ds['RENT_DNO'] =  $validatedData['DRENT_DNO'];
        $rent_ds['RENT_DMODEL'] =  $validatedData['DRENT_DMODEL'];
        $rent_ds['RENT_DDATE'] =  $validatedData['DRENT_DDATE'];
        $rent_ds['RENT_DMSN'] =  $validatedData['DRENT_DMSN'];
        $rent_ds['RENT_DDATE1'] =  $validatedData['DRENT_DDATE1'];
        $rent_ds['RENT_DDATE2'] =  $validatedData['DRENT_DDATE2'];
        $rent_ds['RENT_DAY'] =  $validatedData['DRENT_DAY'];
        $rent_ds['RENT_AMT'] =  $validatedData['DRENT_AMT'];
        $rent_ds['RENT_FDATE'] =  $validatedData['DRENT_FDATE'];
        $rent_ds['RENT_FEE'] =  $validatedData['DRENT_FEE'];
        $rent_ds['RENT_Contract_No'] =  $validatedData['DRENT_Contract_No'];

        //ORM 不支援雙主鍵搜尋，要自己用條件選擇器處理
        $rentD = rent_d::
            where('RENT_NO'     , $rent_ds['RENT_NO'])->
            where('RENT_DNO'    , $rent_ds['RENT_DNO'])->first();
        
        if(is_null( $rentD )){
            Log::info(  '沒找到'    . $rent_ds['RENT_DNO'] . 
                        '租賃明細'  . $rent_ds['RENT_NO']  );
            rent_d::create( $rent_ds ); //建立明細資料
        }else{
            //找出 租賃明細資料筆數
            $rentD1 = rent_d::
            where('RENT_NO' , $rent_ds['RENT_NO'])->get() ;//取回租賃單號的紀錄集合
            Log::info(  '資料數量' . count($rentD1)  );
            $rent_ds['RENT_DNO'] = count($rentD1) + 1 ; //照目前資料數量加1
            
            //增加這次要儲存的資料
            rent_d::create( $rent_ds ); //建立明細資料
        }

        return response(['succees' => $validatedData , 'rent_m' => $rent_ms ,'rent_d' => $rent_ds ],200);
    }

    /**
     * Display the specified resource.
     */
    public function show(rent_d $rent_d)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(rent_d $rent_d)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, rent_d $rent_d)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(rent_d $rent_d)
    {
        //
    }
}
