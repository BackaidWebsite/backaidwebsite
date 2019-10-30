@extends('layouts.layout')

@section('title',"Edit Category")

@section('content')
<!-- edit thread category -->
<h4>Edit Category</h4>
<hr>

<div class="form-group">
    {!! Form::model($category, ['route' => ['threadcategories.update', $category->categoryID], 'method' => 'PUT']) !!}
    <div class="form-group">
        <label class="form-spacing-top">Category:</label>
        <input class="form-control input-lg" value="{{ $category->category }}" name="category">
        {{ csrf_field() }}
    </div>
        <button class="btn btn-success" type="submit">Update Category</button>
        <button value="back" name="status" class="btn btn-danger ">Cancel</button>
    {!! Form::close() !!}
</div>


@endsection
