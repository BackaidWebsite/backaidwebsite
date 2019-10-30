@extends('layouts.layout')

@section('title',"Add FAQ")

@section('content')

<h4>Add FAQ</h4>

<hr>

<!-- create faq-->
{!! Form::open(array('route' => 'faq.store', 'files' => true)) !!}
    <div class="form-group">
        <label class="">Question:</label>
        <textarea class="form-control" name="question" >{!! old('question') !!}</textarea>
    </div>
    <div class="form-group">
        <label class="form-spacing-top">Answer:</label>
        <textarea name="answer" class="form-control"  rows="5">{!! old('answer') !!}</textarea>
    </div>
    {{ csrf_field() }}
    <div class="form-group">
        <input type="submit" class="btn btn-success" value="Save as Draft" name="status">
        <input type="submit" class="btn btn-primary" value="Publish" name="status">
        <button value="back" name="status" class="btn btn-danger ">Cancel</button>
    </div>
{!! Form::close() !!}


@endsection
