@extends('layouts.layout')

@section('title',"Article Categories")

@section('content')
<!-- Article category index -->
<h1 name="h1centre">Articles Categories</h1>


<button class="btn btn-primary" style="float:right;" onclick="window.location.href='/admin/articlecategories/create'">Add Category</button></br></br>

<div style="overflow-x:auto;">
    <table class="table" text-align="center" >
        <thead align="center">
            <th >No.</th>
            <th class="text-left">Category</th>
            <th class="text-left">Slug</th>
            <th >Edit</th>
            <th>Delete</th>
        </thead>
        <tbody align="center">
            @foreach ($articlecategories as $category)
                <tr>
                    <td>{{ $loop->index + 1 }}</td>
                    <td class="text-left">{{ $category->category }}</td>
                    <td class="text-left">{{ $category->slug }}</td>
                    <td><a href="{{ route('articlecategories.edit', $category->categoryID) }}"><i class="fas fa-edit"></i></a></td>
                    <td><a href="javascript:;" data-toggle="modal" data-url="{{ route('articlecategories.destroy', $category->categoryID) }}"
                        data-target="#DeleteModal" class="remove-record"><i style="color:#FF0000;" class="fa fa-trash-alt"></a></td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
