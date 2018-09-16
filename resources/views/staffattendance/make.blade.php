@extends('layout.app')


@section('content')
<div id="app">
<staff-attendance-create :authenticateduser="{{ Auth::user() }}" ></staff-attendance-create>
</div>


@endsection