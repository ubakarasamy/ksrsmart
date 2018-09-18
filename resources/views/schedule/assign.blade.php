@extends('layout.app')


@section('content')

<div id="app">
	<schedule-assign :authenticateduser="{{ Auth::user() }}" :authrole="{{ Auth::user()->GetRole() }}"></schedule-assign>
</div>

@endsection
