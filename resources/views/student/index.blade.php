@extends('layout.app')


@section('content')

<div id="app">
	<student-index :authenticateduser="{{ Auth::user() }}" :authrole="{{ Auth::user()->GetRole() }}"></student-index>
</div>

@endsection


 