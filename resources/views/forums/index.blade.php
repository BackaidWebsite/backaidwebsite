
@extends('layouts.layout')

@section('title',"Community Feed")

@section('content')
@php
    use Illuminate\Support\Str;
    use Illuminate\Support\Facades\Input;
@endphp

<!-- function for keeping selected dropdown option -->
<script type="text/javascript">

    onunload = function()
    {
    	var category = document.getElementById('category');
    	self.name = 'categoryidx' + category.selectedIndex;
    }

    onload = function()
    {
    	var idx, category = document.getElementById('category');
    	category.selectedIndex = (idx = self.name.split('categoryidx')) ?	idx[1] : 0;
    }
    $(document).ready(function() {
        $(".clickable-row").click(function() {
        window.location = $(this).data("href");
    });
        });
</script>

<!-- main user forum index page -->
<h1 name="h1centre"> Community Feed</h1>

<link rel="stylesheet" href="/css/comments.css">
<button class="btn btn-primary" style="float:right;" onclick="window.location.href='/forums/create'">Add Thread</button>

<select class="btn border dropdown-toggle" id="category" style="margin-bottom: 5px" onchange="this.options[this.selectedIndex].value && (window.location.href = this.options[this.selectedIndex].value);">
    <option class="dropdown-item" value="{{ route('forums.index') }}" > All </option>
    @foreach ($category as $categorys)
        <option class="dropdown-item" value="{{ route('forums.category', $categorys->slug) }}">{{ $categorys->category }}</option>
    @endforeach
</select>
<div style="overflow-x:auto;">
    <table class="table" text-align="center">
    <!-- displays all threads -->
        @if ($all == 2)
            <thead align="center">
                <th class="text-left" width="555px">Topic</th>
                <th class="text-left" >Category</th>
                <th class="text-left" >Author</th>
                <th >Replies</th>
                <th>Views</th>
            </thead>
            <tbody align="center">
                @foreach ($thread as $thread)
                    <tr class='clickable-row' data-href="{{ route('forums.show', $thread->slug) }}" name="thread">
                        <td class="text-left" >{{ str_limit($thread->threadTopic, 68) }}</td>
                        <td class="text-left" >{{ $thread->category->category }}</td>
                        <td class="text-left">{{ $thread->user->name }}</td>
                        <td>{{ $thread->replies()->count() - 1}}</td>
                        <td>{{ $thread->view_count }}</td>
                    </tr>
                @endforeach
            </tbody>
        <!-- displays threads by selected category -->
        @elseif ($all == 1)
        <thead align="center">
            <th class="text-left" width="750px">Topic</th>
            <th class="text-left" style="position: relative;" width="100px">Author</th>
            <th>Replies</th>
            <th>Views</th>
        </thead>
        <tbody align="center">
            @foreach ($thread as $thread)
                <tr class='clickable-row' data-href="{{ route('forums.show', $thread->slug) }}" name="thread">
                    <td class="text-left">{{ str_limit($thread->threadTopic, 87) }}</td>
                    <td class="text-left">{{ $thread->user->name }}</td>
                    <td>{{ $thread->replies()->count() - 1}}</td>
                    <td>{{ $thread->view_count }}</td>
                </tr>
            @endforeach
        </tbody>
        @endif
    </table>
</div>
<style>
    tr:hover[name="thread"] {
        background-color: #33cc33;
    }
</style>
@endsection
