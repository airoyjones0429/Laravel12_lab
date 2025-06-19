<?php
namespace App\Http\Controllers;
use App\Models\employee;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

///學習登入介面的第一個控制器
class AuthController extends Controller
{
    //==============================================================================
    //顯示登入介面的方法
    //內部有表單，會 POST 資料到，AuthController  的 login() 方法
    public function showLoginForm()
    {
        return view('login.login'); // 返回登入介面
    }
    //==============================================================================
    //post 資料  會有參數  $request
    //如果沒有也可以  只是  不能利用  送到伺服器的資料
    //返回 登入介面 因輸入錯誤，請使用者重新輸入
    //進入 主要介面 因輸入正確
    public function login(Request $request)
    {
        $request->validate([
            'emp_code' => 'required|string',
            'emp_pwd' => 'required|string',
        ]);

        //將從客戶端送過來的資料，轉換成陣列並指定給 $credentials
        //只轉換 emp_code 與 emp_pwd
        //如果沒有該欄位，內容為 null
        // $credentials = $request->only('emp_code', 'emp_pwd');
        
        $credentials = [
            'emp_code' => $request->input('emp_code'), // 使用者代碼
            'password' => $request->input('emp_pwd') // 密碼  因為 Laravel 預設只能用這個 password 名稱
        ];
        
        // dump($credentials);
        
        // //如果密碼沒有 HASH 加密  Laravel 也會出現錯誤訊息
        // dump($credentials);
        // dump(session());
        // dump('===========');
        // dump(  Auth::attempt( $credentials )  ? '驗證成功' : '驗證失敗' ) ;
        // dump('===========');
        // dump(session()->getId());
        // dump( Auth::user() );
        // $user = Auth::user();
        // dump( $user->emp_code );
        // dump( $user->emp_name );
        // dump( $user->emp_pwd );
        // dump( $user->emp_lv );
        // dump( $user->emp_tel );
        // dump( $user->created_at );
        // dump( $user->updated_at );
        // dump( $user->emp_imgPath );
        // dump(session()); //我還看不出來 哪裡被儲存了使用者的資訊
        // dd();

        if( Auth::attempt( $credentials ) ){
            //驗證通過
            //之後直接使用 Auth::user() 取回使用者資訊
            // dd('成功');
            session()->forget('error');//刪除錯誤資訊欄位
            session()->forget('error_time');//刪除錯誤次數欄位            
            return redirect()->route('main');
        }else{
            //驗證失敗
            //如果 session() 沒有 error_time 欄位，就取回預設值 0
            $et = session('error_time',0) ; 
            session(['error_time' => ++$et]); //計數錯誤次數

            // dd('不成功');
            //回到原本路由，並在session()中儲存 error 欄位，顯示錯誤訊息
            return back()->with('error', '員工編號或密碼錯誤') ;
        }


        // ///因為已經會使用 Auth 類別，所以下面改為註解
        // if( ($credentials['emp_code']==null) || ( $credentials['emp_pwd'] == null )) {goto ERROR_PWD ;}

        // //獲取 employee 模型的資料，查詢該員工的資料
        // $employee=employee::where('emp_code' , $request->emp_code )->first();
        
        // // is_null( ) 才是 PHP 的函數
        // if( is_null($employee) ) {
        //     // dd('GOTO ERR'); //會強制停在這裡
        //     goto ERROR_PWD ;
        // }

        // dump(" $request ");
        // // dump( var_dump( $request ) ); //這樣會一直有資料回傳的感覺
        // dump(" $request->_token ");
        // dump(" $request->emp_code ");
        // dump(" $request->emp_pwd ");
        // dump(" {$request->ip()} "); //送出要求使用者的 ip 位置
        // dump(" {$request->userAgent()} "); //送出要求使用者的 代理   
        // dump ( $request->cookie('laravel_session')); //$sessionId = 
        // dump ( $request->cookie('XSRF-TOKEN')); //$sessionId = 
        
        // if( $employee != null ){
        //     //用了二種  字串連接方式  物件的屬性用 ->  
        //     //這裡的 employee 算是物件 可以用 $employee->emp_code
        //     dump( "employee['emp_code'] => {$employee['emp_code']}  " ) ;
        //     dump( "employee['emp_pwd'] => {$employee['emp_pwd']}  " ) ;
        //     dump( '檢查員工編號是否相同 => '. ( $employee['emp_code'] == $request->emp_code ? 'true': 'false') ) ;
        //     dump( '檢查員工密碼是否相同 => '. ( $employee['emp_pwd'] == $request->emp_pwd ? 'true' : 'false')  ) ;
        // }
        
        // // true 代表值 1
        // // false 代表值  在這裡可能為 null
        // // dd(" STOP Here "); //程序到這會執行到這裡停止
        

        // if ( $credentials['emp_pwd'] == $employee['emp_pwd']  ){
        //     //密碼正確
        //     dump('密碼正確');
        //     dump( session('user_id') != null  ?  session('user_id') : '還沒儲存 session 所以沒有資料'  );
        //     session(['user_id'      => $employee->emp_code] );  //設定 session([ '欄位名稱' =>  屬性值  ]);
        //     session(['user_name'    => $employee->emp_name] );
        //     session(['user_lv'      => $employee->emp_lv]   );
        //     session(['user_tel'      => $employee->emp_tel] );
        //     // $temp = session( 'user_id') ;  //取回 session( '欄位名稱' ) 內容
        //     // dump( $temp ) ;
        //     dump( session('user_id') != null  ?  session('user_id') : '儲存 session 後，就有資料'  );
            
        //     // 刪除 Session 資料：            
        //     // 如果你需要刪除某個 session 屬性，可以使用 forget() 方法：
        //     // session()->forget('error');
        //     // session()->forget('error_time');
        //     // dump( session( 'error_time' ));

        //     // dump( '在 session 讀取不存在的屬性值，用 is_null() 判斷是否存在' . 
        //     //         (is_null( session('other_p1') ) ? 'true':'false' ) 
        //     //     ); //讀取不存在的屬性
        //     // dump( $employee );
        //     // dump( session('user_id') );
        //     // dd('密碼正確時');

            

        //     return redirect()->route('main');

        //     dd('密碼正確時');
        // } else{
        //     ERROR_PWD:
        //     //密碼錯誤
        //     dump('密碼錯誤');

        //     $et = session('error_time',0) ;
        //     session(['error_time' => ++$et]); 

        //     // session( ['error' => '密碼不正確']  );
        //     // return redirect()->route('login'); //密碼錯誤，再返回一次登入介面

        //     // 上面二行指令可以改成
        //     return back()->with('error', '員工編號或密碼錯誤') ;
        //     //back()  會退回到上一個路由
        //     // ->with( '自己隨便定義的名稱欄位' ,  '儲存在這個欄位的內容' )   
        //     //會把資料儲存在  session 資料表(用資料庫管理的話) 中，
        //     // 之後可以在  模板語法 直接用 session('自己隨便定義的欄位名稱') 取出資料表的內容
        // }
        // dd(" STOP Here "); //程序到這會執行到這裡停止，如果上面沒有 return
    }

    //==============================================================================
    public function logout()
    {
        // dump( 'error_time => ' . session('error_time') );
        // dump( session() ); //自訂屬性在 driver  attributes 陣列中可以看到
        session()->flush(); //清除 attributes 陣列
        // dump( '============== session()->flush() ==============' );
        // dump( session() );
        // dump( 'error_time => ' . session('error_time') );
        // dd(" STOP Here "); //程序到這會執行到這裡停止，如果上面沒有 return
        return redirect()->route('login.form');
    }
}