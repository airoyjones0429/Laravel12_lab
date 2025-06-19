@extends('layouts.layout')

@section('content')

    <!--資源型路由 PUT / PATCH 表單標籤的 method 只能是 POST -->
    <form action="{{ route('customer.update' , $customer->ctm_no ) }}" method="POST">
    @csrf
    @method( 'PUT' )
        <table>
            <tbody>
                <tr>
                    <td>客戶編號</td>
                    <td>{{ $customer->ctm_no }} </td>
                    <td></td>
                </tr>
                <tr>
                    <td>客戶名稱</td>
                    <td>{{ $customer->ctm_name }} </td>
                    <td>
                        <input  type="text" required
                                class="update-field"
                                id="ctm_name"
                                name="ctm_name"
                                value="{{  $customer->ctm_name  }}"
                        >
                    </td>
                </tr>
                <tr>
                    <td>統一編號</td>
                    <td>{{ $customer->ctm_uno }} </td>
                    <td>
                        <input  type="text" required
                                class="update-field"
                                id="ctm_uno"
                                name="ctm_uno"
                                value="{{  $customer->ctm_uno  }}"
                        >
                    </td>
                </tr>
                <tr>
                    <td>電話</td>
                    <td>{{ $customer->ctm_tel }} </td>
                    <td>
                        <input  type="text" required
                                class="update-field"
                                id="ctm_tel"
                                name="ctm_tel"
                                value="{{  $customer->ctm_tel  }}"
                        >
                    </td>
                </tr>
                <tr>
                    <td>傳真</td>
                    <td>{{ $customer->ctm_fax }} </td>
                    <td>
                        <input  type="text" required
                                class="update-field"
                                id="ctm_fax"
                                name="ctm_fax"
                                value="{{  $customer->ctm_fax  }}"
                        >
                    </td>
                </tr>
                <tr>
                    <td>公司地址</td>
                    <td>{{ $customer->ctm_adrs1 }} </td>
                    <td>
                        <input  type="text" required
                                class="update-field"
                                id="ctm_adrs1"
                                name="ctm_adrs1"
                                value="{{  $customer->ctm_adrs1  }}"
                        >
                    </td>
                </tr>
                <tr>
                    <td>發票地址</td>
                    <td>{{ $customer->ctm_adrs2 }} </td>
                    <td>
                        <input  type="text" required
                                class="update-field"
                                id="ctm_adrs2"
                                name="ctm_adrs2"
                                value="{{  $customer->ctm_adrs2  }}"
                        >
                    </td>
                </tr>
                <tr>
                    <td>負責人</td>
                    <td>{{ $customer->ctm_rp }} </td>
                    <td>
                        <input  type="text" required
                                class="update-field"
                                id="ctm_rp"
                                name="ctm_rp"
                                value="{{  $customer->ctm_rp  }}"
                        >
                    </td>
                </tr>
                <tr>
                    <td>負責人電話</td>
                    <td>{{ $customer->ctm_rptel }} </td>
                    <td>
                        <input  type="text" required
                                class="update-field"
                                id="ctm_rptel"
                                name="ctm_rptel"
                                value="{{  $customer->ctm_rptel  }}"
                        >
                    </td>
                </tr>
                <tr>
                    <td>備註</td>
                    <td>{{ $customer->ctm_remark }} </td>
                    <td>
                        <input  type="text" required
                                class="update-field"
                                id="ctm_remark"
                                name="ctm_remark"
                                value="{{  $customer->ctm_remark  }}"
                        >
                    </td>
                </tr>
            </tbody>
            <tfoot>
                <tr>
                    <td colspan="3">
                        <input type="submit" id="updateButton" value="更新" class="button" disabled>
                    </td>
                </tr>
            </tfoot>

        </table>
    </form>

    <script>
        // 當有修改的時候，更新按鈕才能被按下
        document.querySelectorAll(".update-field").forEach( 
            field => {
                //change 要更換焦點，才會觸發
                //input 只要有輸入，就會觸發
                field.addEventListener('input',
                    event => {
                        console.log( event );
                        let updateButton = document.getElementById("updateButton");
                        //列出失能狀態
                        console.log( updateButton.disabled ) ;

                        updateButton.disabled = false;

                    }
                );
            }
        ) ;
    </script>
@endsection

