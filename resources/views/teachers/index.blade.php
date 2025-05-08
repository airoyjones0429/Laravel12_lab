<!-- resources/views/teachers/index.blade.php -->
@extends('layouts.app')
@section('content')
<div class="container">
<h1>教師列表</h1>
<a href="{{ route('teachers.create') }}" class="btn btn-primary">新增教師</a>
    <table class="table">
        <thead><tr><th>ID</th><th>姓名</th><th>生日</th><th>操作</th></tr></thead>
    <tbody>
    @foreach ($teachers as $teacher)
    <tr>
    <td>{{ $teacher->id }}</td>
    <td>{{ $teacher->name }}</td>
    <td>{{ $teacher->birthday }}</td>
    <td>
        <a href="{{ route('teachers.edit', $teacher->id) }}" class="btn btn-warning">編輯</a>
        <form action="{{ route('teachers.destroy', $teacher->id) }}" method="POST" style="display:inline;">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn btn-danger">刪除</button>
        </form>
    </td>
    </tr>
    @endforeach
    </tbody>
    </table>
</div>
@endsection