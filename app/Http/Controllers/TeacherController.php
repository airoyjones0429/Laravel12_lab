<?php

namespace App\Http\Controllers;

use App\Models\Teacher;
use Illuminate\Http\Request;

use function Laravel\Prompts\pause;

class TeacherController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    // 列出所有教師
    public function index()
    {
        $teachers = Teacher::all();
        return view('teachers.index', compact('teachers'));
    }

    /**
     * Show the form for creating a new resource.
     */
    // 顯示創建教師的表單
    public function create()
    {
        return view('teachers.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    // 儲存新教師  批量更新的寫法
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'birthday' => 'required|date',
        ]);

        Teacher::create($request->all());
        return redirect()->route('teachers.index')->with('success', '教師新增成功！');
    }

    /**
     * Display the specified resource.
     */
    // 顯示單一教師的詳細資料
    public function show(Teacher $teacher)
    {
        return view('teachers.show', compact('teacher'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    // 顯示編輯教師的表單
    public function edit(Teacher $teacher)
    {
        return view('teachers.edit', compact('teacher'));
    }


    /**
     * Update the specified resource in storage.
     */
    // 更新指定的教師  批次更新  要設定 _token  
    // public function update(Request $request, Teacher $teacher)
    // {
    //     $request->validate([
    //         'name' => 'required|string|max:255',
    //         'birthday' => 'required|date',
    //     ]);

    //     $teacher->update($request->all());
    //     return redirect()->route('teachers.index')->with('success', '教師資料更新成功！');
    // }

    /**
     * Update the specified resource in storage.
     */
    // 更新指定的教師  非批量更新  是逐一欄位更新
    public function update(Request $request, Teacher $teacher)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'birthday' => 'required|date',
        ]);
    
        //除錯方法 1
        dump('更新通過驗證1'); //這行會在網頁中列出，不是在終端機
        
        // pause('test'); //這樣用是錯的

        //除錯方法 2
        // dd('更新通過驗證2');//下面指令都不會執行

        // 逐一更新欄位
        if ($request->has('name')) {
            $teacher->name = $request->input('name');
        }
        
        if ($request->has('birthday')) {
            $teacher->birthday = $request->input('birthday');
        }
    
        // 保存更新
        $teacher->save();
    
        return redirect()->route('teachers.index')->with('success', '教師資料更新成功！');
    }




    /**
     * Remove the specified resource from storage.
     */
    // 刪除指定的教師
    public function destroy(Teacher $teacher)
    {
        $teacher->delete();
        return redirect()->route('teachers.index')->with('success', '教師資料刪除成功！');
    }
}
