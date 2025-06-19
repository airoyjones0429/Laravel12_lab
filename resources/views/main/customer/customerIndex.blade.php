@extends('layouts.layout')

@section('content')

    <table>
        <!-- 新增按鈕 及 標題顯示 -->
        <thead>
            <tr>
                <th colspan="6">
                    <form action="{{ route('customer.create') }}">
                        @csrf
                        <input type="submit" value="新增客戶" class="button">
                    </form>
                </th>
            </tr>
            <tr>
                <th>客戶編號</th>
                <th>客戶姓名</th>
                <th>客戶電話</th>
                <th colspan="3">功能按鈕</th>
            </tr>
        </thead>

        <tbody>
            <!-- 列出每一筆簡略資料，並增加按鈕【詳細資料】【修改】【刪除】 -->
            @foreach ( $customers as $customer )
                <tr>
                    <td>{{ $customer->ctm_no }}</td>
                    <td>{{ $customer->ctm_name }}</td>
                    <td>{{ $customer->ctm_tel }}</td>
                    <td>
                        <!-- show 顯示詳細資料，傳入PK，Laravel 自動會處理成為該筆資料的 ORM 模型 -->
                        <form action="{{ route('customer.show' , $customer->ctm_no ) }}" method="GET">
                            @csrf
                            @method('GET')
                            <input type="submit" value="詳細資料" class="button">
                        </form>
                    </td>
                    <td>
                        <!-- edit 顯示更新介面 -->
                        <form action="{{ route('customer.edit' ,  $customer->ctm_no ) }}" method="GET">
                            @csrf
                            @method('GET')
                            <input type="submit" value="修改" class="button">
                        </form>
                    </td>
                    <td>
                        <!-- destroy 執行刪除動作 -->
                        <form action="{{ route('customer.destroy' ,  $customer->ctm_no ) }}" method="POST">
                            @csrf
                            @method('delete')
                            <input type="submit" value="刪除" class="button">
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>


@endsection

