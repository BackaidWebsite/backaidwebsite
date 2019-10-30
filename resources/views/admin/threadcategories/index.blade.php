@extends('layouts.layout')

@section('title',"thread Categories")

@section('content')
<!-- main thrady category index -->
<h1 name="h1centre">Thread Categories</h1>

<button class="btn btn-primary" style="float:right;" onclick="window.location.href='/admin/threadcategories/create'">Add Category</button></br></br>

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
            @foreach ($threadcategories as $category)
                <tr>
                    <td>{{ $loop->index + 1 }}</td>
                    <td class="text-left">{{ $category->category }}</td>
                    <td class="text-left">{{ $category->slug }}</td>
                    <td><a href="{{ route('threadcategories.edit', $category->categoryID) }}"><i class="fas fa-edit"></i></a></td>
                    <td><a href="javascript:;" data-toggle="modal" data-url="{{ route('threadcategories.destroy', $category->categoryID) }}"
                        data-target="#DeleteModal" class="remove-record"><i style="color:#FF0000;" class="fa fa-trash-alt"></a></td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
