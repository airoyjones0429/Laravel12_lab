<?php

namespace App\Http\Controllers;

use App\Models\contract;
use App\Models\employee;
use App\Models\machine;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Symfony\Component\Console\Output\NullOutput;

class MainController extends Controller
{
    //顯示按鈕表單
    public function showMainWindows()  {
        return  view('main.main');
    }

    //顯示機具基本資料管理介面
    public function showMachineManager(Request $request){
        dump($request);
        dump($request->attributes); //取出表單中 name = var1 的 value 屬性值
        dump($request->server); //取出表單中 name = var1 的 value 屬性值
        dump($request->var1); //取出表單中 name = var1 的 value 屬性值
        // $MachineManager = machine::all();
        // return 'showMachineManager';
        // return $MachineManager ;

        // 下面因為 get('main') 路由 沒有接收 MachineManager 參數，所以下面傳送過去的參數，會被忽略
        // return redirect()->route( 'main' , [ 'MachineManager' => $MachineManager] ) ;

        // 所以對於模板中  非一定會出現的內容  直接傳回該模板的視圖  與 對應參數就號
        // return view('main.machine.machine' , ['MachineManager' => $MachineManager]);

        //跳轉到 MachineController 資源控制器的預設名稱路由，會呼叫 index() 方法
        return redirect()->route('machine.index');
    }

    //顯示員工基本資料管理介面
    public function showEmployeeManager(Request $request){
        // dump($request);
        // $employees = employee::select('emp_code', 'emp_name', 'emp_lv','emp_imgPath' )->get();
        // return view('main.employee.employeeIndex' , ['employees' => $employees]);

        //將輸出轉向到這個路由
        return  redirect()->route('employee.index');
    }

    //顯示客戶基本資料管理介面
    public function showCustomerManager(Request $request){
        // dump($request);
        // return 'showCustomerManager';

        //轉向到客戶瀏覽頁面
        return redirect()->route('customer.index');
    }

    //顯示高空作業車出租設定管理介面
    public function showRentMachineManager(Request $request , $machno ){
        // dump($request);
        // return 'showCustomerManager';

        //找到 machine 資料中的第一筆資料
        // $machine = machine::all()->first();

        $machine = machine::find( $machno );
        // dd( $machine );
        // $machine = new machine() ; //test1
        // dump($machine); // 這裡沒有 ORM 欄位的名稱 test1
        // $machine->Mach_No = '' ;//test1
        // $machine->Mach_Model = null ;//test1
        // $machine->Mach_ModeNo = null ;//test1
        // $machine->Mach_Date1 = null ;//test1
        // $machine->Mach_Date2 = null ;//test1
        // $machine->Mach_ReMark = null ;//test1
        // $machine->Mach_Years = null ;//test1
        // dump( $machine );//test1

        if( is_null( $machine ) ){
            // dump('machine is null');
            //如果資料庫沒有資料，產生空的模型給模板
            $machine = new machine() ;
            $machine->Mach_No = null ;
            $machine->Mach_Model = null ;
            $machine->Mach_ModeNo = null ;
            $machine->Mach_Date1 = null ;
            $machine->Mach_Date2 = null ;
            $machine->Mach_ReMark = null ;
            $machine->Mach_Years = null ;
            $contract = null ;
            // dump( $machine ); //經過上面的設定，這裡有欄位名稱
        }else{
            // dump('machine is not null');
            //主鍵要設定，才能使用 find() 方法
            $contract = contract::find( $machine->Mach_No );
        }

        if( is_null( $contract ) ){
            // dump('contract is null');
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

        // dd($contract);

        // 要傳送到視圖的 session() 設定方式
        // 不能用 view()->with();
        // session(['succees' => 'test']);


        // 獲取當前路由名稱
        $routeName = $request->route()->getName();
        // dd($routeName);
        Log::info( 'MainController 127 ' . $routeName );

        // 獲取當前路由參數
        $routeParams = $request->route()->parameters();
        // dd($routeParams);
        
        Log::info( 'MainController 132 ' . $routeParams['machno'] );

        Log::info( 'MainController 135 session("succees") = ' . session( 'succees' ));
        

        // 把先前成功存檔的訊息刪除
        if( $routeName === 'showRentMachineManager' ){
            // dd( $routeName === 'showRentMachineManager');
            session()->forget('data');
            session()->forget('succees');
        }


        //顯示資料在頁面上
        return view( 'main.invoice.machineContract' , 
                      compact('machine' , 'contract') );
                

    }

    //顯示請款單管理介面
    public function showSaleNo(Request $request){
        // dump($request);
        // return 'showSaleNo';
        return view('main.invoice.receipt');
    }
}





