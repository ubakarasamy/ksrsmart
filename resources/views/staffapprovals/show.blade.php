@extends('layout.app')


@section('content')
<div id="app">
<staff-approvals-show :authenticateduser="{{ Auth::user() }}" :authrole="{{ Auth::user()->GetRole() }}"></staff-approvals-show>
</div>


@endsection