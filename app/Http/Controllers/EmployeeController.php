<?php

namespace App\Http\Controllers;

use App\Models\employee;
use Illuminate\Auth\Access\Gate as AccessGate;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Storage as FacadesStorage;

class EmployeeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // dd('已登入過');
        // $employees = employee::all();
        // $employees =  employee::select('emp_code', 'emp_name', 'emp_lv','emp_imgPath')->get();
        // dd( $employees);
        // return  view( 'main.employee.employeeIndex', ['employees' => $employees]);
        
        $employees = employee::select('emp_code', 'emp_name', 'emp_lv','emp_imgPath' )->get();
        return view('main.employee.employeeIndex' , ['employees' => $employees]);        
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //使用 app\Providers\AppServiceProvider.php 權限設定檔案
        //當目前登入使用者 Auth::user() 權限不足時，
        //自動跳到 403 權限不足頁面
        Gate::authorize('addNewEmployee',Auth::user()) ;        

        //顯示新建員工表單
        return view('main.employee.employeeCreate');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //從客戶端要求物件中，篩選出這幾個欄位的資訊給 newEmployeeArray 陣列變數
        $newEmployeeArray = $request->only("emp_code","emp_name","emp_pwd1" ,"emp_pwd2" ,"emp_tel" ,"emp_lv" );

        //在這裡可以印出所有資訊，但是在模板語法是會造成錯誤的!!
        // dump( $newEmployeeArray );
        // dump( $newEmployeeArray['emp_code'] ); //陣列只能這樣取值
        // dump( $newEmployeeArray->emp_code ); //會造成這個錯誤 Attempt to read property "emp_code" on array


        //新增資料庫 ORM 
        $newEmployee = new employee();
        $newEmployee->emp_code = $newEmployeeArray['emp_code'];
        $newEmployee->emp_name = $newEmployeeArray['emp_name'];
        //密碼必須要加密，不然 Laravel 會出現強制性錯誤
        $newEmployee->emp_pwd = Hash::make(   $newEmployeeArray['emp_pwd1'])  ;
        $newEmployee->emp_tel = $newEmployeeArray['emp_tel'];
        $newEmployee->emp_lv = $newEmployeeArray['emp_lv'];
        $newEmployee->save();

        //傳回更新狀態在 session，標準資源控制器 編輯表單 只要傳送 PK 鍵到該路由，自動在編輯表單會帶出資料
        return  redirect()->route('employee.edit' , ['employee' => $newEmployee->emp_code ])->with(['success'=> '新增資料成功!!'.$newEmployee ]);

        //顯示客戶端完整的 request 物件訊息
        // dd( $request );
    }

    /**
     * Display the specified resource.
     */
    public function show(employee $employee)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(employee $employee)
    {
        //顯示編輯介面的控制器方法，模板只要給 employee 模型的主鍵就可以
        //會自動轉換成對應的員工模型
        // dump( $employee );

        Gate::authorize('update-permission');

        //挑選員工可以修改的欄位
        $empRArray = $employee->only('emp_code','emp_name', 'emp_pwd' ,'emp_lv', 'emp_tel','emp_imgPath');
        // dump( $empRArray );

        return view( 'main.employee.employeeEdit' ,['employee' => $empRArray] );
    }




    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, employee $employee)
    {
        //
        // dump($request); //列出要求物件，包含其他屬性
        // dump($request->attributes); //列出特定的屬性，我還不會用
        // dump($request->request); //列出要求的屬性
        // dump($request->query); //列出特定的屬性，我還不會用
        // dump($request->server); //列出特定的屬性，我還不會用
        // dump($request->files); //列出特定的屬性，我還不會用
        // dump($request->cookies); //列出特定的屬性，我還不會用        
        // dump($request->headers); //列出特定的屬性，我還不會用

        // //要更新的資料
        // dump($request->emp_code);
        // dump($request->emp_name);
        // dump($request->emp_pwd1);
        // dump($request->emp_pwd2);
        // dump($request->emp_tel);
        // dump($request->emp_lv);
        
        // //資料庫 ORM 資料
        // dump($employee->emp_code);
        // dump($employee->emp_name);
        // dump($employee->emp_pwd);
        // dump($employee->emp_lv);
        // dump($employee->emp_tel);
        

        $employee->emp_name = $request->emp_name ;

        
        $employee->emp_pwd = ( $request->emp_pwd1 == $request->emp_pwd2 ) ? $request->emp_pwd1 : $employee->emp_pwd  ;

        $employee->emp_lv = $request->emp_lv ;
        $employee->emp_name = $request->emp_name ;
        $employee->emp_tel = $request->emp_tel ;
        $employee->save();

        // dump($employee); //找到該筆員工資料，只要指定 PK 搜尋的動作，Laravel 會自己處理
        // dd('update');

        //返回上個頁面，並且將資料更新成功的訊息儲存在 session 中傳回去客戶端
        // return back()->with('success','資料更新成功');

        // employee 視圖中，變數是陣列，所以要傳陣列過去，如果傳送物件，網頁會全跑掉，不會有錯誤碼!!
        
        // 挑選員工可以修改的欄位，用正確的陣列設定，可以使用這種方式
        $empRArray = $employee->only('emp_code','emp_name', 'emp_pwd' ,'emp_lv', 'emp_tel','emp_imgPath');
        return view('main.employee.employeeEdit' , [   'employee' => $empRArray ]  );
        
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(employee $employee)
    {
        //
        // dump($employee);

        $employee->delete();
        // dd('destroy');

        // 返回反饋訊息
        return back()->with('success', '員工資料已成功刪除！');
    }


    /**
     *  上傳員工圖片的方法
     *  $request  當客戶端要新增修改資料，相關的訊息都會在這裡
     *  $employee  當方法有物件模型要輸入，且路由有提供 主鍵編號， 
     *  不用真的傳送一個物件，這時，$employee 就會是該主鍵的 ORM 資料
     */
    public function uploadPhoto(Request $request , employee $employee)
    {
        // dump( $employee  ); //測試參數內容
        // dd('uploadPhoto'); //測試路由是否正確

        // 驗證上傳的檔案
        $request->validate([
            'photo' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        // 獲取當前登入的使用者
        // $user = employee::where( 'emp_code' ,  session('user_id') )->first() ;                
        // 取得當前使用者的圖片路徑
        // dd( $user->emp_imgPath ); //沒資料會是 null
        
        // 取回員工資料模型的圖片路徑資料
        if(  $employee->emp_imgPath ){
            //已儲存過圖片，要刪除該圖片檔案
            //刪除原先的圖片檔案
            FacadesStorage::disk('public')->delete($employee->emp_imgPath);
        }

        // dump( $request ); //圖片的要求在 files 屬性中
        // dump( $request->files ); //取回 request 物件的 files 屬性        
        // 儲存照片並獲取路徑，重複儲存，檔案名稱不會一樣，所以檔案會一直增加
        // 所以在新增圖片時，必須要先做刪除圖片的動作
        $path = $request->file('photo')->store('photos', 'public');

        // dd($path); //檔案名稱是經過計算的，無法直觀看出來
        // 更新使用者的照片路徑欄位
        $employee->emp_imgPath = $path;
        $employee->save() ;

        // dd( $employee );
        //返回上個頁面，並且將資料更新成功的訊息儲存在 session 中傳回去客戶端
        return back()->with('success', '照片上傳成功！');
    }


    //也可以不用傳送 ORM 模型主鍵 C:PIC
    public function upload(Request $request)
    {
        // 驗證上傳的檔案
        $request->validate([
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        // 儲存圖片到 C:\PIC 目錄
        // $path = $request->file('image')->store('images', 'external'); // 使用 'external' 設定
        // 下面指令會儲存在 storage\app\private\external 目錄下
        // 第一個參數是目錄名稱，
        // 第二個參數是 filesystem 設定的磁碟物件名稱，因為沒特別指定，預設是 local
        // $path = $request->file('image')->store('external'); // 會建立 'external' 目錄

        // 下面指令，會將檔案儲存在名稱為 external 的 disks 設定中
        // disks 是在 config/filessystem.php 中設定
        // $path = $request->file('image')->store('','external'); // 使用 'external' 設定
        // 以下指令同上一行指令 '' == '/' 代表原本目錄
        $path = $request->file('image')->store('/','external_my'); // 使用 'external' 設定

        return back()->with('success', '圖片上傳成功！路徑: ' . $path);
    }


    //顯示 外部目錄的圖片 C:PIC
    public function showCPIC($filename)
    {
        $path = "C:/PIC/$filename"; // 指向檔案的完整路徑
        // 檢查檔案是否存在
        if (!file_exists($path)) {
            abort(404); // 如果檔案不存在，返回 404 錯誤
        }
        // 返回檔案
        return Response::file($path);
    }

    //顯示外部目錄的檔案清單  C:PIC
    public function showFiles()
    {
        $directory = 'C:/PIC'; // 指定目錄
        $files = File::files($directory); // 獲取目錄中的檔案
        
        // dump( compact( 'files' ) ); //傳回一個關聯式陣列，該內部有名為 files 陣列，files 為索引陣列
        // dump( array( $files ) ); //將 $files 轉換成陣列
        // dump( count( $files ) ); //顯示陣列項目數量
        // dd($files);
        // 將檔案傳遞到視圖，視圖的變數名稱與方法的變數名稱相同，就可以直接用 compact() 傳送過去
        // return view('files.index', compact('files')); 
        return view('files.index',  [ 'files' => $files] ); // 將檔案傳遞到視圖
    }

}

