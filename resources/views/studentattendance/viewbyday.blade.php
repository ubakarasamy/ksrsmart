@extends('layout.app')


@section('content')
<div id="app">
<student-attendance-viewbyday :authenticateduser="{{ Auth::user() }}" :authrole="{{ Auth::user()->GetRole() }}"></student-attendance-viewbyday>
</div>


@endsection