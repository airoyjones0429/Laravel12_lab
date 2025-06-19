<?php

use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ContractController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\MachineController;
use App\Http\Controllers\MainController;
use App\Http\Controllers\RentDController;
use App\Http\Controllers\RentMController;

use App\Http\Controllers\MyTestController;

use Illuminate\Support\Facades\Route;

//當在  bootstrap\app.php  設定中介層  命名名稱  後，就不用使用這個中介層類別
use App\Http\Middleware\CheckAuthenticated;
use App\Models\rent_d;

Route::get('/', function () {
    return 'root';
});

//測試直接傳入 模型的主鍵 就可以得到該主鍵的 ORM ，測試成功
Route::get('/mytest/{employee}/{machine}' , [MyTestController::class,  'allModuleTest'] );

Route::post('', function () {
    return 'root';
});
        
//登入路由
Route::get('/login',[AuthController::class, 'showLoginForm'])->name('login.form');
//執行登入動作路由
Route::post('/login',[AuthController::class, 'login'] )->name('login');

//執行登出動作路由
Route::post('/logout',[AuthController::class, 'logout'])->name('logout');



//單一設定 中介層 的寫法，在 bootstrap\app.php  設定中介層
Route::resource('employee',EmployeeController::class)->middleware('user_login');

// session() 保存期限設定，與關閉瀏覽器是否保留的設定，都在 config\session.php 這裡設定

// 預設的 auth 中介層，會自動回到 /login 路由 ，在內部的  
// 全都會回到 login 路由，我還不會修正，所以只要先自己用 session() 處理
// 以下設定多個路由 中介層 的寫法
// Route::group(['middleware' => 'auth' ],function(){
Route::group(['middleware' => 'user_login' ],function(){

        //執行顯示主控台路由
        Route::get('/main' ,[MainController::class, 'showMainWindows'] )->name('main') ;        
        
        //宣告為資源型控制器後，會自動設定有下列的名稱路由
        //machine.index     檢視所有資料的頁面 GET
        //machine.create    檢視新增資料的頁面 GET
        //machine.store     執行儲存新增資料的動作 POST
        //machine.show      檢視特定資料的明細 GET
        //machine.edit      檢視資料編輯的頁面 GET
        //machine.update    執行資料編輯更新的動作 PUT/PATCH
        //   PUT   欄位需還原預設值後，全部欄位一起更新
        //   PATCH 可以更新部分欄位，其他欄位內容不會改變
        //machine.destory   執行資料刪除動作 DELETE
        Route::resource('machine',MachineController::class);
        
        //AJAX 需要傳回資料使用
        Route::get('/findMachineAJAX')->name('findMachineAJAXNameRoute'); //用來傳回名稱
        Route::post('/findMachineAJAX/{mach_no}' ,[ MachineController::class , 'findMachineAJAX' ] )->name('findMachineAJAX');

        //AJAX 傳送不需要回應使用
        Route::get('/findMachine')->name('findMachineNameRoute');//用來傳回名稱
        //查詢合約機器使用的 AJAX 路由，會刪除 儲存成功的訊息
        Route::post('/findMachine/{mach_no}' ,[ MachineController::class , 'findMachine' ] )->name('findMachine');



        // Route::resource('contract',ContractController::class);
        Route::get('contract',[ContractController::class,'index'])->name('contract.index');
        Route::post('contract',[ContractController::class,'store'])->name('contract.store');
        
        // 用 AJAX 一定要用 response()->json([ ... , ... ] , 200) ; 回應，不然客戶端一定錯誤
        // 下面 { contract } ，這裡一定要這樣寫，這樣子，控制器的方法中，的物件模型才會有所選擇的物件
        Route::get('patch/contract/')->name('contract.UpdateRouteName');//用來給客戶端取路由名稱的路由
        Route::patch('patch/contract/{contract}' , [ContractController::class, 'update' ])->name('contract.update');
        Route::get('patch/message' , function(){ return back(); } )->name('contract.updateMessage');

        // 這裡的路由如果設定成 contract/{mach_no}，路由名稱如果太相似，會造成判斷錯誤，增加自己的困擾
        // 修改成目前這個樣子，就不會出現，路由不能支援 DELETE 方法的錯誤
        Route::get('delete/contract/')->name('contract.destroyRouteName');
        // 下面的 {contract}  contract 一定要是模型的名稱，如果是其他名稱，destroy 就無法接收到 contract ORM物件
        // 會導致控制器的方法的 $contract 是空的 []
        Route::delete('delete/contract/{contract}',[ContractController::class,'destroy'])->name('contract.destroy');

        Route::resource('customer',CustomerController::class);
        
        //請款單檢視介面路由
        // Route::resource('rentm',RentMController::class);
        Route::get('rentm',[RentMController::class, 'index'])->name('rentm.index');
        Route::get('rentm/{rent_m}',[RentMController::class, 'show'])->name('rentm.show');
        //請款單明細更新路由，多次呼叫更新明細資料
        Route::post('rentd/update' , [RentMController::class , 'updateDetail'])->name('rentd.updatebatch');
        
        //請款單主檔案，修改用路由
        Route::get('rentm/update/',function(){ return 'rentm/update 路由名稱';})->name('rentm.updateMainFileRouteName');
        Route::post('rentm/update/{rent_m}' , [RentMController::class , 'updateMainFile'])->name('rentm.updateMainFile');


        // 機具 續租 結案 使用路由
        // Route::resource('rentd',RentDController::class);
        Route::put('rentd/store' , [RentDController::class, 'store'])->name('rentd.store');
        
        
        
        // 上傳員工圖片的路由，專案內部目錄
        Route::post('/upload/photo/{employee}', [EmployeeController::class,  'uploadPhoto'])->name('upload.photo');

        // 上傳圖片到指定外部目錄 C:PIC 目錄下
        Route::post('/upload/image/', [EmployeeController::class,  'upload'])->name('upload.image');

        // 取得上傳圖片路由 C:PIC
        Route::get('/images/{filename}', [EmployeeController::class, 'showCPIC'])->name('images.showCPIC');

        // 取得外部圖片目錄
        Route::get('/files', [EmployeeController::class, 'showFiles'])->name('files.index');        

        

        
        // 批次 機具更新用 POST 路由，符合 RESTful 規範，儲存新增資料也是使用 POST 方法
        Route::post('/machine/update' , [MachineController::class , 'updatePostMachine'])->name('machine.PostUpdate');
        
        //機具更新 put 方法  針對一筆資料  最全欄位數值的更新  沒提供資料的欄位  會被初始化
        Route::put('/machine/put/{MachNo}' , [MachineController::class , 'updatePutMachine'])->name('machine.PutUpdate');
        
        //用 GET 路由儲存 patch 路由不包含 {MachNo} 的名稱，避免模板要求輸入參數的錯誤
        Route::get('/machine/patch/', function() { return '/machine/patch/'; } )->name('machine.PatchUpdateRouteName');
        Route::patch('/machine/patch/{MachNo}' , [MachineController::class , 'updatePatchMachine'])->name('machine.PatchUpdate');
        
        
        // DELETE 多設定一個路由 用來取刪除路由前半段的名稱
        Route::get('/machine/delete/', function() { return '/machine/delete/'; } )->name('machine.DeleteRouteName');
        Route::delete('/machine/delete/{MachNo}' ,[MachineController::class,'destroy'] );
        
        
        //顯示機具管理介面的路由，不使用GET
        //強迫使用者要經過驗證後才能登入使用
        Route::post('/main/showMachineManager' 
                ,[MainController::class, 'showMachineManager'] 
            )->name('showMachineManager') ;
        
        //顯示員工管理介面的路由
        Route::post('/main/showEmployeeManager' ,
                [MainController::class, 'showEmployeeManager'] )
                ->name('showEmployeeManager') ;
        
        //顯示客戶管理介面的路由
        Route::post('/main/showCustomerManager' ,
                [MainController::class, 'showCustomerManager'] )
                ->name('showCustomerManager') ;
        
        //顯示出租機具管理介面的路由，因為內部控制器，
        //有使用 back()-> 到這個路由，所以要改成用 GET 方法
        //有使用 redirect()-> 到這個路由，所以要改成用 GET 方法
        Route::get('/main/showRentMachineManager')->name('showRMMString');
        Route::get('/main/showRentMachineManager/{machno}' ,
                [MainController::class, 'showRentMachineManager'] )
                ->name('showRentMachineManager') ;

        Route::get('/main/showRentMachineManager/return/{machno}' ,
                [MainController::class, 'showRentMachineManager'] )
                ->name('showRentMachineManager.return') ;
        
        //顯示出請款單管理介面的路由
        Route::get('/main/showSaleNo' ,
                [MainController::class, 'showSaleNo'] )
                ->name('showSaleNo') ;
});





// Route::get('/main', 'MainController@index')->name('main')->middleware('auth');