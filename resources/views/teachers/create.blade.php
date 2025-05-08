<!-- resources/views/teachers/create.blade.php -->
@extends('layouts.app')

@section('content')
<div class="container">
    <h1>新增教師</h1>
    <form action="{{ route('teachers.store') }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="name">姓名</label>
            <input type="text" name="name" class="form-control" id="name" required>
        </div>
        <div class="form-group">
            <label for="birthday">生日</label>
            <input type="date" name="birthday" class="form-control" id="birthday" required>
        </div>
        <button type="submit" class="btn btn-success">儲存</button>
        <a href="{{ route('teachers.index') }}" class="btn btn-secondary">返回</a>
    </form>
</div>
@endsection
