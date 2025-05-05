<?php

namespace App\Http\Controllers;

use App\Models\Student;
use Illuminate\Http\Request;
use Laravel\Pail\ValueObjects\Origin\Console;

use function Laravel\Prompts\error;
use function Psy\debug;

class StudentController extends Controller
{
    //取回所有學生資料
    public function getAll(){
        return Student::all();
    }

    //新增一筆學生資料
    public function addOneStudent( $studentName  ){
        $student = new Student();
        $student->name = $studentName ;
        $student->save();
        return '更新成功';
    }

    //搜尋學生姓名
    public function findStudent( $studentName )  {
        $student = Student::where( 'name' ,'=', $studentName )->first();
        return  [ $student->name ,
                  $student->id ,
                  $student->created_at,
                  $student->updated_at,
                ] ;
    }

    //更新學生資料
    public function updateNameData($oldName, $newName) {
        // 找出 name = $oldName
        $student = Student::where('name', trim($oldName))->first();
    
        if (!empty($student)) {
            $student->name = $newName;
            // if ($student->save()) {
                return "   {$student->save()} = $oldName 更新為 $newName  更新成功";
            // } else {
            //     return '更新失敗，請檢查資料';
            // }
        } else {
            return '找不到名稱為 ' . $oldName . ' 的學生，更新失敗';
        }
    }

    //刪除指定姓名資料
    public function deleteStudentByName($name) {
        // 找出 name = $name 的學生
        $student = Student::where('name', trim($name))->first();
    
        if (!empty($student)) {
            $student->delete(); // 刪除學生資料
            return "$name 的學生資料已成功刪除。";
        } else {
            return '找不到名稱為 ' . $name . ' 的學生，刪除失敗。';
        }
    }

    
    public function firstStudent( $studentName ){
        $student = null;
        //Student::where() 傳回查詢建構器，需要再使用 get() 或 first() 方法取得資料
        // $student = Student::where( 'name' ,'!=', $studentName )->first();  
              
        $student = Student::where( 'name' ,'=', $studentName )->first();  //有加與不加，相同效果
        return   [ $student->name ,  $student->id ,  $student->created_at ]  ;
    }

    public function getStudent( $studentName ){
        $studentCollection = null;
        //Student::where() 傳回查詢建構器，需要再使用 get() 或 first() 方法取得資料
        $studentCollection = Student::where( 'name', 'like' , "%$studentName%" )->get()->all();    
        
        // return   [ $student->name ,  $student->id ,  $student->created_at ]  ;
        // return $studentCollection[0]; //傳回第一筆資料
        // 用 [  ] 會變成陣列
        // return [$studentCollection[0]->id , $studentCollection[0]->name ] ; //傳回第一筆資料
        // 用 "{$var}"  內部不要有空白
        // return " {$studentCollection[0]->id}   , {$studentCollection[0]->name}  " ; //傳回第一筆資料

        return $studentCollection ;
    }

}
