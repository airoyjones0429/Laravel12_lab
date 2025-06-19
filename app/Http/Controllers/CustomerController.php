<?php

namespace App\Http\Controllers;

use App\Models\customer;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    /**
     * 以下是宣告控制器為資源型路由的例子
     * 資源名稱為 customer，控制器名稱為 CustomerController
     * Route::resource('customer' , [CustomerController::class]) ;
     * 有預設 index() 方法，用來索引模型所有項目
     * HTTP 通訊方法為 GET，使用方式如下
     * 在瀏覽器輸入 server_ip:port/customer
     */
    public function index()
    {
        // 列出所有資料
        // $ctm_list = customer::all();
        // return $ctm_list ;
        // 挑選索引的欄位，get() 傳回結果集
        $ctm_list = customer::select('ctm_no','ctm_name','ctm_tel')->get();
        // return $ctm_list ; //傳回原始資料格式
        // 以下使用視圖顯示資料
        return view('main.customer.customerIndex' , ['customers' => $ctm_list]) ;
    }

    /**
     * Show the form for creating a new resource.
     * 以下是宣告控制器為資源型路由的例子
     * 資源名稱為 customer，控制器名稱為 CustomerController
     * Route::resource('customer' , [CustomerController::class]) ;
     * 有預設 create() 方法，用來顯示新增資料模型的介面
     * HTTP 通訊方法為 GET，使用方式如下
     * 在瀏覽器輸入 server_ip:port/customer/create
     */
    public function create()
    {
        return view('main.customer.customerCreate');
    }

    /**
     * Store a newly created resource in storage.
     * 以下是宣告控制器為資源型路由的例子
     * 資源名稱為 customer，控制器名稱為 CustomerController
     * Route::resource('customer' , [CustomerController::class]) ;
     * 有預設 store() 方法，用來顯示新增資料模型的介面
     * HTTP 通訊方法為 POST，在模板以下方式設定 form 表單標籤
     * action = "{{ route('customer.store') }}"  method="POST"
     */
    public function store(Request $request)
    {
        // 設定 form 標籤 method ="POST" ，才會執行這裡的 dd()
        // dd( $request ) ;

        //設定驗證欄位與條件
            $validatedData = $request->validate([
                'ctm_no'    => 'required|string|max:30|unique:customers',
                'ctm_name'  => 'required|string|max:50|min:4',
                'ctm_uno'   => 'required|string|max:20',
                'ctm_tel'   => 'required|string|max:20',
                'ctm_fax'   => 'required|string|max:20',
                'ctm_adrs1' => 'required|string|max:255',
                'ctm_adrs2' => 'required|string|max:255',
                'ctm_rp'    => 'required|string|max:20',
                'ctm_rptel' => 'required|string|max:20',
                'ctm_remark'=> 'required|string|max:255',
            ],
            //  在這裡設定
            //  不符合的條件 => 要顯示的文字內容
            [   'ctm_no.required' => '員工代碼是必填的',
                'ctm_no.unique' => '員工代碼重複',
                'ctm_name.min' => '客戶名稱至少要 4 個字', ]);
        //
        
        //用批量賦值方式，產生一筆資料
        customer::create( $validatedData );
        
        // 取回客戶端要求新增的資料欄位 only() 會傳回陣列
            // $newCTM = $request->only(
            //             'ctm_no','ctm_name',
            //             'ctm_uno','ctm_tel',
            //             'ctm_fax','ctm_adrs1',
            //             'ctm_adrs2','ctm_rp',
            //             'ctm_rptel','ctm_remark');
            // 要設定物件關聯模型 ORM 的 $fillable 屬性
            // customer::create($newCTM); //這行可執行

            // 無法直接傳陣列名稱當作陣列內容傳送到視圖
            // 先轉換成 JSON 格式就可以將資料傳送到視圖
            // 返回呼叫此方法的頁面，並將新增的資料傳送回去
        //
        
        return back()->with('data' , json_encode( $validatedData ) )->with('succees', 'OK');
    }

    /**
     * Display the specified resource.
     * 以下是宣告控制器為資源型路由的例子
     * 資源名稱為 customer，控制器名稱為 CustomerController
     * Route::resource('customer' , [CustomerController::class]) ;
     * 有預設 show() 方法，用來顯示詳細資料介面
     * HTTP 通訊方法為 GET，在模板以下方式設定 form 表單標籤
     * action = "{{ route('customer.show' , $customer->ctm_no) }}"  method="GET"
     */
    public function show(customer $customer)
    {
        //傳送物件關聯模型 ORM 資料到視圖
        return view( 'main.customer.customerShow' , [ 'customer' => $customer ]) ;
    }

    /**
     * Show the form for editing the specified resource.
     * 以下是宣告控制器為資源型路由的例子
     * 資源名稱為 customer，控制器名稱為 CustomerController
     * Route::resource('customer' , [CustomerController::class]) ;
     * 有預設 edit() 方法，用來顯示編輯資料介面
     * HTTP 通訊方法為 GET，在模板以下方式設定 form 表單標籤
     * action = "{{ route('customer.edit' , $customer->ctm_no) }}"  method="GET"
     */
    public function edit(customer $customer)
    {
        //傳送物件關聯模型 ORM 資料到視圖
        return view( 'main.customer.customerEdit' ,[ 'customer' => $customer ] ) ;
    }

    /**
     * Update the specified resource in storage.
     * 以下是宣告控制器為資源型路由的例子
     * 資源名稱為 customer，控制器名稱為 CustomerController
     * Route::resource('customer' , [CustomerController::class]) ;
     * 有預設 update() 方法，用來更新舊有資料
     * HTTP 通訊方法為 PUT / PATCH，在模板以下方式設定 form 表單標籤
     * action = "{{ route('customer.update' , $customer->ctm_no) }}"  method="POST"
     * 並且內部除了 @crsf 外，還要增加 @method='PUT' 或 @method='PATCH'
     */
    public function update(Request $request, customer $customer)
    {
        //驗證修改的資料是否符合規則
        $validatedData = $request->validate([
            //更新不能修改主鍵
            //'ctm_no'    => 'required|string|max:30|unique:customers',
            // sometimes 只有在提供欄位時，才會更新
            'ctm_name'  => 'sometimes|string|max:50|min:4',
            'ctm_uno'   => 'sometimes|string|max:20',
            'ctm_tel'   => 'sometimes|string|max:20',
            'ctm_fax'   => 'sometimes|string|max:20',
            'ctm_adrs1' => 'sometimes|string|max:255',
            'ctm_adrs2' => 'sometimes|string|max:255',
            'ctm_rp'    => 'sometimes|string|max:20',
            'ctm_rptel' => 'sometimes|string|max:20',
            'ctm_remark'=> 'sometimes|string|max:255',            
        ],
        //  在這裡設定
        //  不符合的條件 => 要顯示的文字內容
        //  如果要驗證的資料，包含不存在的欄位，驗證必定失敗
        [   //'ctm_no.required' => '員工代碼是必填的', 
            //'ctm_no.unique' => '員工代碼重複',
            'ctm_name.min' => '客戶名稱至少要 4 個字', ]    
        );
        
        // 一次更新所有欄位資料，$customer 必須是路由產生的 ORM
        // 或是為查詢建構器 DB::table() 所產生 ORM 物件，才能使用 update() 方法
        $customer->update( $validatedData );

        //視圖 似乎不能用  ->with() 附帶 session 資料
        // session(['succees' => '成功更新']); //這樣 session 會一直保留這個資訊，要自己手動處理掉
        // 使用下面 快閃顯示 session 方法 ，系統會自己回收訊息
        session()->flash('succees' , '成功更新' ) ;

        // dump(session('succees'));//OK
        // dump( session() );//OK
        
        return view( 'main.customer.customerEdit' ,  compact('customer') ) ;
    }

    /**
     * Remove the specified resource from storage.
     * 以下是宣告控制器為資源型路由的例子
     * 資源名稱為 customer，控制器名稱為 CustomerController
     * Route::resource('customer' , [CustomerController::class]) ;
     * 有預設 destroy() 方法，用來刪除舊資料
     * HTTP 通訊方法為 POST，在模板以下方式設定 form 表單標籤
     * action = "{{ route('customer.destroy' , $customer->ctm_no) }}"  method="POST"
     * 並且內部除了 @crsf 外，還要增加 @method='delete'
     */
    public function destroy(customer $customer)
    {
        //
        // return 'delete' . $customer ;
        
        session(['succees' => '刪除資料'.$customer->ctm_name]);

        $customer->delete();
        
        return redirect()->route('customer.index');
    }
}
