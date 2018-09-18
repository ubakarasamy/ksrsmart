@extends('layout.app')


@section('content')
<div id="app">
<student-create :authenticateduser="{{ Auth::user() }}" :authrole="{{ Auth::user()->GetRole() }}"></student-create>
</div>


@endsection