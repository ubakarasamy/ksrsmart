@extends('layout.app')


@section('content')
<div id="app">
<student-attendance-edit :authenticateduser="{{ Auth::user() }}" ></student-attendance-edit>
</div>


@endsection