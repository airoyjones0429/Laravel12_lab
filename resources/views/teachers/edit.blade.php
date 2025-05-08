<!-- resources/views/teachers/edit.blade.php -->
@extends('layouts.app')

@section('content')
<div class="container">
    <h1>編輯教師</h1>
    <form action="{{ route('teachers.update', $teacher->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label for="name">姓名</label>
            <input type="text" name="name" class="form-control" id="name" value="{{ $teacher->name }}" required>
        </div>
        <div class="form-group">
            <label for="birthday">生日</label>
            <input type="date" name="birthday" class="form-control" id="birthday" value="{{ $teacher->birthday }}" required>
        </div>
        <button type="submit" class="btn btn-success">更新</button>
        <a href="{{ route('teachers.index') }}" class="btn btn-secondary">返回</a>
    </form>
</div>
@endsection