@extends('layout.app')


@section('content')

<div id="app">
<student-attendance-viewsubject :authenticateduser="{{ Auth::user() }}" :authrole="{{ Auth::user()->GetRole() }}"></student-attendance-viewsubject>
</div>

@endsection