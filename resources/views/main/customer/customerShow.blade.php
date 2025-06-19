@extends('layouts.layout')

@section('content')

    <table>
        <tbody>
            <tr>
                <td>客戶編號</td>
                <td>{{ $customer->ctm_no }} </td>
            </tr>
            <tr>
                <td>客戶名稱</td>
                <td>{{ $customer->ctm_name }} </td>
            </tr>
            <tr>
                <td>統一編號</td>
                <td>{{ $customer->ctm_uno }} </td>
            </tr>
            <tr>
                <td>電話</td>
                <td>{{ $customer->ctm_tel }} </td>
            </tr>
            <tr>
                <td>傳真</td>
                <td>{{ $customer->ctm_fax }} </td>
            </tr>
            <tr>
                <td>公司地址</td>
                <td>{{ $customer->ctm_adrs1 }} </td>
            </tr>
            <tr>
                <td>發票地址</td>
                <td>{{ $customer->ctm_adrs2 }} </td>
            </tr>
            <tr>
                <td>負責人</td>
                <td>{{ $customer->ctm_rp }} </td>
            </tr>
            <tr>
                <td>負責人電話</td>
                <td>{{ $customer->ctm_rptel }} </td>
            </tr>
            <tr>
                <td>備註</td>
                <td>{{ $customer->ctm_remark }} </td>
            </tr>
        </tbody>

    </table>

@endsection

