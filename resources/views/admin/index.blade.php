@extends('layouts.layout')

@section('title', "Home")
@section('title',"Home")

@section('content')
@php
    use Illuminate\Support\Str;
@endphp
<!-- home page admins -->
<div class="container">
    <div class="row justify-content-center" style="margin-top:15px">
        <div class="card h-100 text-white bg-success" style="width: 250px; margin-right: 5px">
          <div class="card-body">
            <h2 class="card-title">{{ $articleCount }}<a href="{{ route('articles.index') }}">
                <i style="float:right;color:#FFFFFF;" class="fas fa-newspaper fa-2x"></i></a></h2>
            <a href="{{ route('articles.index') }}" style="color:#FFFFFF;"class="card-text">Articles</a>
          </div>
        </div>
        <div class="card h-100 text-white bg-primary" style="width: 250px; margin-right: 5px">
          <div class="card-body">
            <h2 class="card-title">{{ $threadCount }}<a href="{{ route('forum.index') }}">
                <i style="float:right;color:#FFFFFF;" class="fas fa-comments fa-2x"></i></a></h2>
            <a href="{{ route('forum.index') }}" style="color:#FFFFFF;" class="card-text">Threads</a>
          </div>
        </div>
        <div class="card h-100 text-white bg-warning" style="width: 250px; margin-right: 5px">
          <div class="card-body">
            <h2 class="card-title">{{ $faqCount }}<a href="{{ route('faq.index') }}">
                <i style="float:right;color:#FFFFFF;" class="fa fa-question-circle fa-2x" ></i></a></h2>
            <a href="{{ route('faq.index') }}" style="color:#FFFFFF;" class="card-text">FAQ</a>
          </div>
        </div>
        <div class="card h-100 text-white bg-dark" style="width: 250px;">
          <div class="card-body">
            <h2 class="card-title">{{ $userCount - 1 }}<a href="{{ route('users.index') }}">
                <i style="float:right;color:#FFFFFF;" class="fas fa-users fa-2x"></i></a></h2>
            <a href="{{ route('users.index') }}" style="color:#FFFFFF;" class="card-text">Registered Users</a>
          </div>
        </div>
    </div>
</div>

@endsection
