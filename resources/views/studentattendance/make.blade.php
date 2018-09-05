@extends('layout.app')


@section('content')
<div id="app">
<student-attendance-create :authenticateduser="{{ Auth::user() }}" ></student-attendance-create>
</div>


@endsection