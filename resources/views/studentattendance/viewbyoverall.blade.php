@extends('layout.app')


@section('content')

<div id="app">
    <student-attendance-viewbyoverall :authenticateduser="{{ Auth::user() }}" :authrole="{{ Auth::user()->GetRole() }}"></student-attendance-viewbyoverall>
</div>

@endsection