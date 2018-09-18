@extends('layout.app')


@section('content')

<div id="app">
    <staff-attendance-viewbymonth :authenticateduser="{{ Auth::user() }}" :authrole="{{ Auth::user()->GetRole() }}"></staff-attendance-viewbymonth>
</div>

@endsection