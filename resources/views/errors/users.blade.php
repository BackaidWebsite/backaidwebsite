@extends('layouts.layout')

@section('title', 'Page not found - 404')

@section('content')

<h1 name="h1centre" style="font-size:9.5em;line-height:1em;color: #00aeff;">404</h1>
<h2 align="center" style="font-size:4.5em;line-height:1em;">Not Found</h2>
<div class="container" style="text-align: center;">
    @if(Auth::user()->isSuperAdmin())
        <button class="btn btn-primary" style="text-align:center;" type="new" onclick="window.location.href='/admin'">Return Home</button>
    @else
        <button class="btn btn-primary" style="text-align:center;" type="new" onclick="window.location.href='/articles'">Return To Articles</button>
    @endif
</div>
@endsection
