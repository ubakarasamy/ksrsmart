@extends('layout.app')


@section('content')
<div id="app">
<staff-approvals-show :authenticateduser="{{ Auth::user() }}" ></staff-approvals-show>
</div>


@endsection