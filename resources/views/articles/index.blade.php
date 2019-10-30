@extends('layouts.layout')

@section('title', 'Articles')

@section('content')

<!DOCTYPE html>
<!-- main article page for users -->

<!-- display categories -->
<div class="nav-scroller py-1 mb-2">
    <nav class="nav d-flex justify-content-between">
        <a class="p-2 text-muted" href="{{ route('userarticles.index') }}">Home</a>
      @foreach($category as $category)
        <a class="p-2 text-muted" href="{{ route('userarticles.category', $category->slug) }}">{{ $category->category }}</a>
      @endforeach
    </nav>
</div>

<!-- articles -->
<div class="row">
    @foreach ($article as $article)
        @if($article->status == "Published")
            <div class="card" style="width:550px;margin-right:5px; height:238px; margin-top:5px">

                <div class="card-body">
                    <h5 class="card-title" style="min-height: 45px;">{{ $article->articleTitle }}</h5>
                    <div class="card-text" name="content">{!! str_limit($article->articleContent, 135) !!}</div>
                    @if($all == 1)
                        <div class="card-text" style="color:#">{{ $article->user->name }} in {{ $article->category->category}}</div>
                    @else
                        <div class="card-text" style="color:#">{{ $article->user->name }}</div>
                    @endif
                    <div class="card-text" style="color:#">{{ date('M j', strtotime($article->created_at)) }}</div>
                    <a href="{{ route('userarticles.show', $article->slug) }}" class="stretched-link">Continue reading...</a>
                </div>
            </div>
        @endif
    @endforeach
</div>

<style>
div[name="content"] {
    overflow: hidden;
    text-overflow: ellipsis;
    display: -webkit-box;
    max-height: 93px;
    -webkit-box-orient: vertical;
    height: 68px;
}
</style>



@endsection
