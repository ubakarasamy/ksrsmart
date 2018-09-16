@extends('layout.app')


@section('content')
<div id="app">
<staff-myprofile :authenticateduser="{{ Auth::user() }}" ></staff-myprofile>
</div>


@endsection