@extends('layout.app')


@section('content')

<div id="app">
	<staff-index :authenticateduser="{{ Auth::user() }}" :authrole="{{ Auth::user()->GetRole() }}"></staff-index>
</div>

@endsection


 