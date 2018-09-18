@extends('layout.app')


@section('content')
<div id="app">
<student-attendance-edit :authenticateduser="{{ Auth::user() }}" :authrole="{{ Auth::user()->GetRole() }}"></student-attendance-edit>
</div>


@endsection