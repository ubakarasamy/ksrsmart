@extends('layout.app')


@section('content')

<div id="app">
    <academic-page :authenticateduser="{{ Auth::user() }}"></academic-page>
</div>

@endsection