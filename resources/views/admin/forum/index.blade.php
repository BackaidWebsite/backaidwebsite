@extends('layouts.layout')

@section('title',"Community Feed")

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
<!-- main forum index page for admins -->
<h1 name="h1centre">Community Feed</h1>
<button class="btn btn-primary" style="float:right;" onclick="window.location.href='/admin/forum/create'">Add Thread</button>
<select class="btn border dropdown-toggle" style="margin-bottom: 5px" id="category" onchange="this.options[this.selectedIndex].value && (window.location.href = this.options[this.selectedIndex].value);">
    <option class="dropdown-item" value="{{ route('forum.index') }}" > All </option>
    @foreach ($categories as $category)
        <option class="dropdown-item" value="{{ route('adminforums.category', $category->slug) }}">{{ $category->category }}</option>
    @endforeach
</select>
<div style="overflow-x:auto;">
    <table class="table" text-align="center">
        @if($all == 2)
            <thead align="center">
                <th class="text-left" width="400px">Thread Topic</th>
                <th class="text-left">Category</th>
                <th class="text-left">Author</th>
                <th class="text-left">Created</th>
                <th>Replies</th>
                <th>View</th>
                <th>Edit</th>
                <th>Delete</th>
            </thead>
            <tbody align="center">
                @foreach ($thread as $thread)
                    <tr>
                        <td class="text-left">{{ str_limit($thread->threadTopic, 48) }}</td>
                        <td class="text-left">{{ $thread->category->category }}</td>
                        <td class="text-left">{{ $thread->user->name }}</td>
                        <td class="text-left">{{ date('M j, Y', strtotime($thread->created_at)) }}</td>
                        <td>{{ $thread->replies()->count() - 1 }}</td>
                        <td><a href="{{ route('forums.show', $thread->slug) }}"><i style="color:#2AD715;" class="fas fa-search"></i></a></td>
                        <td><a href='/admin/forum/{{ $thread->threadID }}/edit'><i class="fas fa-edit"></i></a></td>
                        <td><a href="javascript:;" data-toggle="modal" data-url="{{ route('forum.destroy', $thread->threadID) }}"
                        	data-target="#DeleteModal" class="remove-record"><i style="color:#FF0000;" class="fa fa-trash-alt"></a></td>
                    </tr>
                @endforeach
        	</tbody>
        @elseif($all == 1)
            <thead align="center">
                <th class="text-left" width="550px">Thread Topic</th>
                <th class="text-left">Author</th>
                <th class="text-left">Created</th>
                <th>Replies</th>
                <th>View</th>
                <th>Edit</th>
                <th>Delete</th>
            </thead>
            <tbody align="center">
                @foreach ($thread as $thread)
                    <tr>
                        <td class="text-left">{{ str_limit($thread->threadTopic, 68) }}</td>
                        <td class="text-left">{{ $thread->user->name }}</td>
                        <td class="text-left">{{ date('M j, Y', strtotime($thread->created_at)) }}</td>
                        <td>{{ $thread->replies()->count() - 1 }}</td>
                        <td><a href="{{ route('forums.show', $thread->slug) }}"><i style="color:#2AD715;" class="fas fa-search"></i></a></td>
                        <td><a href='/admin/forum/{{ $thread->threadID }}/edit'><i class="fas fa-edit"></i></a></td>
                        <td><a href="javascript:;" data-toggle="modal" data-url="{{ route('forum.destroy', $thread->threadID) }}"
                        	data-target="#DeleteModal" class="remove-record"><i style="color:#FF0000;" class="fa fa-trash-alt"></a></td>
                    </tr>
                @endforeach
        	</tbody>
        @endif
    </table>
</div>
@endsection
