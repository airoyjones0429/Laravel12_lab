@extends('mainboard.main1')

@section('subtop')
   <div style="background-color: green;color:lightgoldenrodyellow"> 
    ( 這是從控制器，呼叫的子模板 )  
    @if( !empty( $subString )  )
      {{ $subString }}
    @endif
   </div> 
@endsection

