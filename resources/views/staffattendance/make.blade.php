@extends('layout.app')


@section('content')
<div id="app">
<staff-attendance-create :authenticateduser="{{ Auth::user() }}" :authrole="{{ Auth::user()->GetRole() }}"></staff-attendance-create>
</div>


@endsection