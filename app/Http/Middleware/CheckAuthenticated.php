<?php

namespace App\Http\Middleware;

use Closure;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

use Illuminate\Support\Facades\Log;

class CheckAuthenticated
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {        
        $user = Auth::user();

        //每次使用者提出要求都會經過這裡，因為在路由有設定 ->middleware() 
        // dump( $user );

        if ( $user ){
            //正常登入
            Log::info( date('Y-m-d H:m:s => (').$request->method().')'.$user->emp_code.$request->path() );
            return $next($request);
        }else{
            //不正常使用，返回登入介面
            Log::info( date('Y-m-d H:m:s => (').$request->method().')'.'陌生的闖入嘗試'.$request->path() );
            return redirect()->route('login');
        }

        session()->forget('succees');
        session()->forget('updateMessage');

        // 改使用 Auth 類別，控制登入動作時，下面改註解
        // if ( session('user_id') ) {
        //     dump( session('user_id'  ) );
        //     dump( session('user_name') );
        //     dump( session('user_lv'  ) );
        //     dump( session('user_tel' ) );
        //     dump( date('Y-M-D') ); 
        //     dump( date('Y-m-d') ); 
        //     Log::info( date('Y-m-d H:m:s => (').session('user_id').session('user_name').$request->method().')'.$request->path() );
        //     // dump( $request->method() );
        //     // dump( $request->path() );
        //     // dd( $request );
        //     return $next($request);
        // } else {
        //     // return back();
        //     //只要沒有設定  session()
        //     return redirect()->route('login');
        // }
    }
}
