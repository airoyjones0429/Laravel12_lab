@extends( 'main.main' )

@section('content_sub')

<input type="button" value="檢視所有請款單" 
onclick="window.location.href=`{{ route('rentm.index') }}`" >

@endsection

