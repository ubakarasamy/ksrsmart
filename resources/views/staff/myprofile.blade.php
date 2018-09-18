@extends('layout.app')


@section('content')
<div id="app">
<staff-myprofile :authenticateduser="{{ Auth::user() }}" :authrole="{{ Auth::user()->GetRole() }}"></staff-myprofile>
</div>


@endsection