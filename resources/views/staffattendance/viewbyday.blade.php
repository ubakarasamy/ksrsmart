@extends('layout.app')


@section('content')
<div id="app">
<staff-attendance-viewbyday :authenticateduser="{{ Auth::user() }}" :authrole="{{ Auth::user()->GetRole() }}"></staff-attendance-viewbyday>
</div>


@endsection