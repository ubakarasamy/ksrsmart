@extends('layout.app')


@section('content')

<div id="app">
    <home-page :authenticateduser="{{ Auth::user() }}"></home-page>
</div>

@endsection