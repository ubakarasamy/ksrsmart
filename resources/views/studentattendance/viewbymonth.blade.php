@extends('layout.app')


@section('content')

<div id="app">
    <student-attendance-viewbymonth :authenticateduser="{{ Auth::user() }}" :authrole="{{ Auth::user()->GetRole() }}"></student-attendance-viewbymonth>
</div>

@endsection