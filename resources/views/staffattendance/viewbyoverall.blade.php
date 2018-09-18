@extends('layout.app')


@section('content')

<div id="app">
    <staff-attendance-viewbyoverall :authenticateduser="{{ Auth::user() }}" :authrole="{{ Auth::user()->GetRole() }}"></staff-attendance-viewbyoverall>
</div>

@endsection