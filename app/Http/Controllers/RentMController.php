<?php

namespace App\Http\Controllers;

use App\Models\rent_d;
use App\Models\rent_m;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class RentMController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //傳回這幾個欄位的所有資料
        $rent_m = rent_m::select('RENT_NO','RENT_CNO','RENT_CNAME','RENT_TOTAL1')->get();
        
        return view('main.invoice.receipt_index',[ 'rent_ms' => $rent_m ]);
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
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     * 
     * 如果控制器宣告為資源路由，rent_m 模型 沒辦法透過傳遞主KEY 就直接產生
     * 但是可以 在後面增加一個變數，路由變數會儲存在哪裡
     * 或者是  不要使用資源型路由，路由變數名稱使用 {模型名稱}
     * 這樣就可以直接使用 primary key 查詢到路由模型
     */
    public function show(rent_m $rent_m)
    {
        //
        // dd( $rent_m );
        // 找出明細資料
        // dump( $rent_m['RENT_NO']); //ok
        // dump( $rent_m );//ok

        //ok1 可是找不到可以用的資料，最多知道是雙主鍵
            // $rentds = rent_d::where('RENT_NO' , $rent_m['RENT_NO']);
            // dump($rentds);

        //ok2
            //取得 ORM 選擇器結果集合，在 items
            // $rentds = rent_d::where('RENT_NO' , $rent_m['RENT_NO'])->get();
            // dump($rentds);
            // dump( count( $rentds )); //取得查詢結果資料筆數

        //ok3
            $rentds = rent_d::where('RENT_NO' , $rent_m['RENT_NO'])->get();
            // $rentds_array = array( $rentds ); //這樣會多包一層 陣列在外面，更麻煩
            // dump($rentds); //列出 ORM 物件集合
            // dump($rentds->all()); //列出 ORM 物件欄位的陣列
            $rentds_array = $rentds->all(); //取回陣列型態的集合物件
            // dump( count( $rentds_array )); //取得查詢結果資料筆數

            // dd( $rentds_array );
        // dd();

        return view('main.invoice.receipt_show',['rentM' => $rent_m  , 'rentds' => $rentds_array ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(rent_m $rent_m)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, rent_m $rent_m)
    {
        //
    }

    //POST updateDetail 多次呼叫路由 更新方法
    //雙主鍵  用 FORM 更新會要切換畫面 所以改用 AJAX 
    //ORM 不支援 路由傳遞  雙主鍵 所以 update() 現在方法沒辦法用 因為我用都錯誤
    //所以改使用  DB::  Query Constructor 查詢建構器
    //重點  
    //如果可以從路由  獲取模型  就可以直接使用  update()  delete()
    //如果不能從路由  獲得資料  就要使用 查詢建構器  DB::table()  的方式處理資料
    public function updateDetail(Request $request){
        //用 HTML 表單標籤 POST 方法，可以觸發 dd() 動作，AJAX 不行
        //相同 name 的欄位 會被最後一筆資料取代

        //又改回用 AJAX ，因為用表單，需要增加程序(因為每個 form.submit() 都會跳轉畫面 ?!)，所以繼續練習用 AJAX
        // dd( $request ); 
        Log::info( $request );

        //驗證浮點數 float 要用 numeric
        $rentd = $request->validate([
            'RENT_NO'       => 'required|string|max:30' ,
            'RENT_DNO'      => 'required|string|max:30'  ,
            'RENT_DMODEL'   => 'sometimes|string|max:30|nullable'  ,
            'RENT_DDATE'    => 'sometimes|date|nullable',
            'RENT_DMSN'     => 'sometimes|string|max:80|nullable'  ,
            'RENT_DDATE1'   => 'sometimes|date|nullable',
            'RENT_DDATE2'   => 'sometimes|date|nullable',
            'RENT_DAY'      => 'sometimes|numeric|nullable',
            'RENT_AMT'      => 'sometimes|numeric|nullable',
            'RENT_FDATE'    => 'sometimes|date|nullable',
            'RENT_FEE'      => 'sometimes|int|min:0|max:32767|nullable',
            'RENT_Contract_No'  => 'sometimes|string|max:255|nullable' ,
            ]
        );
        Log::info( 'RentMController 129' );        
        //用 DB 查詢建構器 更新資料
        $rentdw = 
            DB::table('rent_ds')->
            where('RENT_NO' , $rentd['RENT_NO'])->
            where('RENT_DNO' , $rentd['RENT_DNO'])->
            update($rentd) ;
        Log::info( 'RentMController 136' );
        //列出 要求更新欄位的資料
            // foreach( $rentd as $key => $value ){
            //     Log::info( '更新前' . $key . '=>' . $value );

            //     $rentdw["$key"] = $value ;
            // }
            // $rentdw->save();

            // Log::info( '更新前d' . json_encode($rentd ) );
            // Log::info( '更新前dw' . $rentdw );
            // $rentdw->update( $rentd ) ; // 有這行就出錯!!?
            // $rentdw->RENT_DAY = 10 ;
            // Log::info( '更新前' . $rentdw->RENT_DAY );
            // $rentdw->update(
            //     [
            //         'RENT_DAY' => 123
            //     ]            
            // );

            
            

                
            
            // 下面也錯 !!
            // $rentdww = rent_d::             
            //     where('RENT_NO' , $rentd['RENT_NO'])->
            //     where('RENT_DNO' , $rentd['RENT_DNO'])->first()->update( $rentd );

            // Log::info( '更新資料筆數' . $recordNum );
            // Log::info( '執行更新後' . $rentdw );
            // $rentdw->refresh(); //這個也錯

            // // $message = session('updateMessage','') . json_encode( $request->all() ) ;
            // // session(['updateMessage'=> $message ]);

        // AJAX　的回應方式
        // return response()->json([ 'updateData' => json_encode( $rentdw ) ] , 200);
        return response()->json(['message' => '更新完成' , 'ok' => true ],200);
    }


    //更新主檔 rent_ms 的方法
    //路由 rentm/update/
    public function updateMainFile( Request $request , rent_m $rent_m){
        $validatedData = $request->validate(
            [
                'RENT_NO' => 'sometimes|string|max:30'  ,
                'RENT_PDATE' => 'sometimes|date|nullable'  ,
                'RENT_UNO' => 'sometimes|string|max:20|nullable'  ,
                'RENT_UNO_DAT' => 'sometimes|date|nullable'  ,
                'RENT_CNO' => 'sometimes|string|max:30|nullable'  ,
                'RENT_CNAME' => 'sometimes|string|max:50|nullable'  ,
                'RENT_CTMUNO' => 'sometimes|string|max:20|nullable'  ,
                'RENT_CTMADRS' => 'sometimes|string|max:255|nullable'  ,
                'RENT_ADRS' => 'sometimes|string|max:255|nullable'  ,
                'RENT_REMARK' => 'sometimes|string|max:255|nullable'  ,
                'RENT_TOTAL1' => 'sometimes|int|min:0'  ,
            ]
        );
        //更新明細資料的 
        //如果要修改 租賃單號 要將目前的明細 編號也要一起修改
        Log::info( 'RentMController 208 ') ;
        if( $request->only(['RENT_NO']) ){
            $validateDate2 = $request->only(['RENT_NO']);
            Log::info( 'RentMController 212 ' . $validateDate2['RENT_NO'] ) ;
            $rent_ds=DB::table('rent_ds')->where('RENT_NO' , $rent_m['RENT_NO']  );
            //這裡的 rent_ds 是資料表 rent_ds 的查詢建構器
            //查詢的內容已經在上面設定
            //這個時候，就可以像 ORM 物件一樣，直接用 update() 方法更新選中的內容
            $rent_ds->update( $validateDate2 );
        }
        //更新主檔資料
        //注意  這裡並沒有用 get() 取回集合，
        $rent_m->update( $validatedData );
        //這樣子  [ '' => '' ] 在客戶端，會當成 JSON 解讀
        // 與 response()->json([ '' => '' ,... ] , 200);  相同意思
        return response([ 'ok' => $request->all() , 'data1' => $rent_m  ,
                 'data2' => $rent_ds ? $rent_ds: '沒有更新明細資料'] , 200);
    }

    
    /**
     * Remove the specified resource from storage.
     */
    public function destroy(rent_m $rent_m)
    {
        //
    }
}
