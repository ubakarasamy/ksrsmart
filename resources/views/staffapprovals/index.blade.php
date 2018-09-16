@extends('layout.app')


@section('content')
<div id="app">
<staff-approvals-index :authenticateduser="{{ Auth::user() }}" ></staff-approvals-index>
</div>


@endsection