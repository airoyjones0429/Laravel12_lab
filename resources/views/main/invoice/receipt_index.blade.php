@extends('main.invoice.receipt')

@section('receipt_sub')

    <table>
        <thead>
            <td>租賃單號</td>
            <td>客戶編號</td>
            <td>客戶名稱</td>
            <td>收款金額</td>
        </thead>

        <tbody>
            <!-- {{ $index = 0 }} -->
            @foreach ( $rent_ms as $rent_m )
            <tr>
                <td>{{ $rent_m->RENT_NO }}</td>
                <!-- {{-- 
                <td>{{ $rent_m->RENT_PDATE }}</td>
                <td>{{ $rent_m->RENT_UNO }}</td>
                <td>{{ $rent_m->RENT_UNO_DAT }}</td>  
                --}} -->
                <td>{{ $rent_m->RENT_CNO }}</td>
                <td>{{ $rent_m->RENT_CNAME }}</td>
                <!-- {{-- 
                <td>{{ $rent_m->RENT_CTMUNO }}</td>
                <td>{{ $rent_m->RENT_CTMADRS }}</td>
                <td>{{ $rent_m->RENT_ADRS }}</td>
                <td>{{ $rent_m->RENT_REMARK }}</td>
                --}} -->
                <td>{{ $rent_m->RENT_TOTAL1 }}</td>
                <td><input type="button" id="detail-row{{ ++$index }}" name="show" value="詳細資料" data-rentno="{{ $rent_m->RENT_NO }}"></td>
                <td><input type="button" id="update-row{{ $index }}" name="update" value="修改" data-rentno="{{ $rent_m->RENT_NO }}"></td>
                <td><input type="button" id="delete-row{{ $index }}" name="delete" value="刪除" data-rentno="{{ $rent_m->RENT_NO }}"></td>
            </tr>
            @endforeach
        </tbody>

        <tfoot></tfoot>

    </table>
    <form id="showForm">
        @csrf
    </form>

    <script>
        // CSS 選擇所有 input 標籤，且屬性 name = show 的元素
        document.querySelectorAll('input[name="show"]').forEach(
            input => {
                // console.log( input.value );
                // 為選擇到的元素設定監聽事件
                input.addEventListener(
                    'click' ,
                    event => {
                        //列出目標事件的元素
                            // console.log( event.target );

                        //列印出要使用的 URL
                            //不能直接使用 route('rentm.show') 因為在模板設定階段 Laravel 就會出現錯誤
                            console.log(`{{ route('rentm.index') }}/${event.target.dataset.rentno}`);

                        //設定 form 表單的動態 URL 位置，表單的提交，可以使用 Laravel dd() 來偵錯
                            //取回 showForm 元素
                            const showForm = document.querySelector('#showForm');
                            showForm.method = "GET" ; //對應 HTTP 路由使用的方法
                            showForm.action = `{{ route('rentm.index') }}/${event.target.dataset.rentno}`;
                            showForm.submit(); //使用指令提交表單

                    }
                );

            }
        );

    </script>

@endsection