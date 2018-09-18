@extends('layout.app')


@section('content')
<div id="app">
<staff-attendance-edit :authenticateduser="{{ Auth::user() }}" :authrole="{{ Auth::user()->GetRole() }}"></staff-attendance-edit>
</div>


@endsection