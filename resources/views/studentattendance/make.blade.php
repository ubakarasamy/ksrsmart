@extends('layout.app')


@section('content')
<div id="app">
<student-attendance-create :authenticateduser="{{ Auth::user() }}" :authrole="{{ Auth::user()->GetRole() }}"></student-attendance-create>
</div>


@endsection