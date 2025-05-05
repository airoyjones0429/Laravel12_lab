<?php

use Illuminate\Support\Facades\Route;

Route::get('/',
    function(){
        return view('mainpage',[
            'title'=>'這是標題',
            'bodyh1'=>'這是H1標籤文字',
            'bodyh2'=>'這是H2標籤文字'
        ]);
    }
);

Route::get('/1',
    function(){
        $title =  'Laravel 練習 1' ;
        $bodyh1 = 'Laravel 12 真有趣' ;
        $bodyh2 = 'PHP + MySQL 
        用測試伺服器，就能跑測試範例' ;

        return view('mainpage',[
            'title'=> $title,
            'bodyh1'=> $bodyh1,
            'bodyh2'=> $bodyh2
        ]);
    }
)->name('start1');

Route::get('/{var1}/{var2}/{var3}',
    function($var1,$var2,$var3){
        return view('mainpage',[
            'title'=> $var1,
            'bodyh1'=> $var2,
            'bodyh2'=> $var3
        ]);
    }
);

Route::get('/php/{title}/{bodyh1}/{bodyh2}',
    function($title,$bodyh1,$bodyh2){
        return view('mainpage',
            compact(
             'title',
             'bodyh1',
             'bodyh2'
            )            
        );
    }
);

Route::get('/2',
    function(){
        $title =  'Laravel 練習 1' ;
        $bodyh1 = 'Laravel 12 真有趣' ;
        $bodyh2 = 'PHP + MySQL 
        用測試伺服器，就能跑測試範例' ;

        return view('dir1.dir12.mainpage',[
            'title'=> $title,
            'bodyh1'=> $bodyh1,
            'bodyh2'=> $bodyh2
        ]);
    }
)->name('start2');

Route::get('/3' , 
    function(){
        return view('content1');
    }
);

//@yield() @extends() @section 
//在同一個檔案的路由練習
Route::get('/4' , 
    function(){
        return view('content2');
    }
);

//將相同開頭的路由，群組在一起
Route::prefix('group_name')->group(
    function(){
        //  表示路由 group_name/g1 處理方式
        Route::get('g1',function(){
            return '<h1> 這是群組路由的方法 G1 </h1>' ;
        });

        //  表示路由 group_name/g2 處理方式
        Route::get('g2',function(){
            return '<h1> 這是群組路由的方法 G2 </h1>' ;            
        });

        //  表示路由 group_name/g3 處理方式
        Route::get('g3',function(){
            return '<h1> 這是群組路由的方法 G3 </h1>' ;
        });                
    }
);


//路由要使用控制器時，必須要先引用，引用方式，如下
use App\Http\Controllers\MyController01 ;


//建立二個路由名稱，並且對應到控制器公開共用的方法
Route::get( 'mycontroller1'  , [MyController01::class, 'MyFunction1'] );
Route::get( 'mycontroller2'  , [MyController01::class, 'MyFunction2'] );


//群組控制器類別的寫法
Route::controller(MyController01::class)
    ->group(
    function(){
        Route::get( 'mycontroller3'  ,  'MyFunction1' );
        Route::get( 'mycontroller4'  ,  'MyFunction2' );        
        Route::get( 'mycontroller5'  ,  'MyFunction3' );
    }
);


//建立一個可以連結路由名稱的網頁
Route::get('/btnList1' ,
    function(){
        return view('buttonpage');
    }
);

//404 錯誤時，自定義回應
Route::fallback(
    function(){
        return "<h1>網址輸入錯誤，請確定網址正確性</h1> ";
    }
);


//直接使用模型的方法，取回資料庫資料
use App\Models\Student;
Route::get('students_data',
    function(){
        return Student::all();
    }
);


//直接使用模型專用的控制器，呼叫方法，並由控制器決定回應的內容
use App\Http\Controllers\StudentController;
Route::get('students_data1',
    [StudentController::class,'getAll']
);

//增加一筆資料
Route::get('addOneStudent/{studentName}',
    [StudentController::class,'addOneStudent']
);

//找到一位學生資料，first() 傳回第一筆資料的結果
//，可以直接用欄位名稱取值
Route::get('selectStudent1/{studentName}',
    [StudentController::class,'firstStudent']
);

//找到一位以上學生資料，get() 是傳回集合
Route::get('selectStudent2/{studentName}',
    [StudentController::class,'getStudent']
);


//搜尋學生姓名
Route::get('findStudent/{studentName}',
    [StudentController::class,'findStudent']
);


//更改學生姓名
Route::get('T/updateStudentName/{oldName}/{newName}',
    [StudentController::class,'updateNameData']
);


//依照名稱刪除學生資料
Route::get('deleteStudentByName/{name1}',
    [StudentController::class,'deleteStudentByName']
);


// Route::get('/', function () {
//     return view('welcome');
// });