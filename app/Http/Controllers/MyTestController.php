<?php

namespace App\Http\Controllers;

use App\Models\employee;
use App\Models\machine;
use Illuminate\Http\Request;

class MyTestController extends Controller
{
    //測試可不可以自訂路由，並透過模型的 PK 直接查詢出，ORM 模型中的資料

    public function allModuleTest(employee $employee , machine $machine ){

        dump( $employee );

        dd( $machine );

    }

}
