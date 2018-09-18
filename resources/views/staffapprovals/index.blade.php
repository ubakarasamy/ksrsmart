@extends('layout.app')


@section('content')
<div id="app">
<staff-approvals-index :authenticateduser="{{ Auth::user() }}" :authrole="{{ Auth::user()->GetRole() }}"></staff-approvals-index>
</div>


@endsection