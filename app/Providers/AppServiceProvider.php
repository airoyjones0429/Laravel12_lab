<?php

namespace App\Providers;

use App\Models\employee;
use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;


class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }
    
    protected $policies = [
        // 將模型與策略關聯
    ];


    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        $this->registerPolicies();
        //定義一個管控權限的條件，要傳入的參數，依照自己決定數量與類型
        // Gate::define('addNewEmployee',
        //     function(employee $employee1 ){
        //         // dump( $employee1 );
        //         if( $employee1->emp_lv == 10) {
        //             Log::info( date('Y-m-d H:m:s => ').$employee1->emp_code.' 使用 addNewEmployee 功能' );
        //             return true ;
        //         }else{
        //             Log::info( date('Y-m-d H:m:s => ').$employee1->emp_code.' 禁止使用 addNewEmployee 功能' );
        //             return false ;
        //         }
        //     }
        // );

        //這裡發生很奇怪的現象... 傳遞參數時，只傳遞第一個參數 !!? 
        // Gate::define('addNewEmployee', function( ?employee $employee1 =null ,  ?employee $employee2 = null ) {
        
        //以下為   我先這樣子想
        //當閘門使用相同的參數模型 ORM 時，在使用上，只需輸入一個參數，該參數會被指定到，第二個參數位置，第一個參數會自動被設定為登入的物件紀錄
        //我這裡用   比較不好的方式   所以我又設定了一個  $sw 變數，該變數  可以不用輸入  預設值  是  null
        Gate::define('addNewEmployee', function( employee $employee1 ,  employee $employee2 , ?int $sw =null) {
            // 如果沒有第二個參數，則檢查第一個參數
            // Log::info(date('Y-m-d H:i:s => ') . $employee1->emp_code .'  XXX  '.$employee2->emp_code.' OOO '.$sw);
            if ( is_null( $sw ) ) {
                if ($employee1->emp_lv == 10) {
                    Log::info(date('Y-m-d H:i:s => ') . $employee1->emp_code . ' 使用 addNewEmployee 功能');
                    return true;
                } else {
                    Log::info(date('Y-m-d H:i:s => ') . $employee1->emp_code . ' 禁止使用 addNewEmployee 功能');
                    return false;
                }
            } else {
                // 如果有第三個參數，代表是在模板中使用，這是我故意設計的
                // Log::info(date('Y-m-d H:i:s => ') . $employee1->emp_code . '===' . $sw );
                if ($employee1->emp_lv >= $employee2->emp_lv) { // 登入權限大的人，可以修改登入權限小的人
                    Log::info(date('Y-m-d H:i:s => ( ') .$sw .' )'. $employee1->emp_code .' '. $employee1->emp_lv . ' >= ' .$employee2->emp_code .' '. $employee2->emp_lv );
                    return true;
                } else {
                    Log::info(date('Y-m-d H:i:s => ( ') .$sw .' )'. $employee1->emp_code .' '. $employee1->emp_lv . ' < ' .$employee2->emp_code .' '. $employee2->emp_lv );
                    return false;
                }
            }
        });

        //既然是閘門  GATE  自然是要簡單  上面的示範  只是第一次學習的測試
        Gate::define('updateName', 
            //第一個不會管你是設定甚麼類型，他列出來的依然是，登入的使用者
            function( employee $User  , string $empCode ){
                Log::info( '======' );
                Log::info( $User );
                Log::info( $empCode );
                Log::info( '======' );

                if ($User->emp_code == $empCode ){
                    Log::info('true');
                    return true ;
                }else{
                    Log::info('false');
                    return false ;
                }
                Log::info( 'xxxxxxx' );
            }
        );


        //當權限等於 127 才能放行
        Gate::define(
                'del-permission'  ,
                function(employee $User){
                    if ($User->emp_lv == 127){
                        return true;
                    }
                    return false;
                }
        );

        //當權限小於 127 才能放行
        Gate::define(
                'update-permission'  ,
                function(employee $User){
                    if ($User->emp_lv < 127){
                        return true;
                    }
                    return false;
                }
        );
    }
}

