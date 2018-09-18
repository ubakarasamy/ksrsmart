@extends('layout.app')


@section('content')

<div id="app">
	<schedule-index :authenticateduser="{{ Auth::user() }}" :authrole="{{ Auth::user()->GetRole() }}"></schedule-index>
</div>

@endsection
