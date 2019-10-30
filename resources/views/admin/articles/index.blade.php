@extends('layouts.layout')

@section('title',"Articles")

@section('content')
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

<h1 name="h1centre">Back Aid Articles</h1>
<!-- cretae new article cateogry buttons-->
<button style="float:right" class="btn btn-primary" onclick="window.location.href='{{ URL::route('articles.create') }}'">Add Article</button>
<select class="btn border dropdown-toggle" style="margin-bottom: 5px" id="category" onchange="this.options[this.selectedIndex].value && (window.location.href = this.options[this.selectedIndex].value);">
    <option class="dropdown-item" value="{{ route('articles.index') }}">All</option>
    @foreach ($categories as $category)
        <option class="dropdown-item" value="{{ route('articles.category', $category->slug) }}">{{ $category->category }}</option>
    @endforeach
</select>
<!-- article index for admins-->

<div style="overflow-x:auto;">
    <table class="table" text-align="center">
        @if ($all == 2)
            <thead align="center">
                <th class="text-left" width="400px">Title</th>
                <th class="text-left">Status</th>
                <th class="text-left">Category</th>
                <th class="text-left">Author</th>
                <th class="text-left">Created</th>
                <th>View</th>
                <th>Edit</th>
                <th>Delete</th>
            </thead>
            <tbody align="center">
                @foreach ($article as $article)
                    <tr>
                        <td class="text-left">{{ str_limit($article->articleTitle, 47) }}</td>
                        <td class="text-left">{{ $article->status }}</td>
                        <td class="text-left">{{ $article->category->category }}</td>
                        <td class="text-left">{{ $article->user->name }}</td>
                        <td class="text-left">{{ date('M j, Y', strtotime($article->created_at)) }}</td>
                        <td><a href="{{ route('userarticles.show', $article->slug) }}"><i style="color:#2AD715;" class="fas fa-search"></i></a></td>
                        <td><a href='/admin/articles/{{ $article->articleID }}/edit'><i class="fas fa-edit"></i></a></td>
                        <td><a href="javascript:;" data-toggle="modal" data-url="{{ route('articles.destroy', $article->articleID) }}"
                            data-target="#DeleteModal" class="remove-record"><i style="color:#FF0000;" class="fa fa-trash-alt"></a></td>
                    </tr>
                @endforeach
            </tbody>
        @elseif($all == 1)
            <thead align="center">
                <th class="text-left" width="500px">Title</th>
                <th class="text-left">Status</th>
                <th class="text-left">Author</th>
                <th class="text-left">Created</th>
                <th>View</th>
                <th>Edit</th>
                <th>Delete</th>
            </thead>
            <tbody align="center">
                @foreach ($article as $article)
                    <tr>
                        <td class="text-left">{{ str_limit($article->articleTitle, 60) }}</td>
                        <td class="text-left">{{ $article->status }}</td>
                        <td class="text-left">{{ $article->user->name }}</td>
                        <td class="text-left">{{ date('M j, Y', strtotime($article->created_at)) }}</td>
                        <td><a href="{{ route('userarticles.show', $article->slug) }}"><i style="color:#2AD715;" class="fas fa-search"></i></a></td>
                        <td><a href='/admin/articles/{{ $article->articleID }}/edit'><i class="fas fa-edit"></i></a></td>
                        <td><a href="javascript:;" data-toggle="modal" data-url="{{ route('articles.destroy', $article->articleID) }}"
                            data-target="#DeleteModal" class="remove-record"><i style="color:#FF0000;" class="fa fa-trash-alt"></a></td>
                    </tr>
                @endforeach
            </tbody>
        @endif
    </table>
</div>
@endsection
