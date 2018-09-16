@extends('layout.app')


@section('content')
<div id="app">
<staff-attendance-edit :authenticateduser="{{ Auth::user() }}" ></staff-attendance-edit>
</div>


@endsection