@extends('layout.app')


@section('content')
<div id="app">
<staff-create :authenticateduser="{{ Auth::user() }}" :authrole="{{ Auth::user()->GetRole() }}"></staff-create>
</div>


@endsection