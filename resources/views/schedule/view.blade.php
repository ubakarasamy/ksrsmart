@extends('layout.app')


@section('content')

<div id="app">
	<schedule-view :authenticateduser="{{ Auth::user() }}" :authrole="{{ Auth::user()->GetRole() }}"></schedule-view>
</div>

@endsection
