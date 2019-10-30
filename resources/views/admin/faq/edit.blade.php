@extends('layouts.layout')

@section('title',"Edit FAQ")

@section('content')

  <h4>Edit FAQ</h4>
<hr>
{!! Form::model($faq, ['route' => ['faq.update', $faq->faqID], 'method' => 'PUT']) !!}
    <div class="form-group">
        <label class="">Question:</label>
        <textarea class="form-control" name="question">{{ $faq->question }}</textarea>
    </div>
    <div class="form-group">
        <label class="form-spacing-top">Answer:</label>
        <textarea name="answer" class="form-control" rows="5">{{ $faq->answer }}</textarea>
    </div>
    {{ csrf_field() }}
    @if($faq->status == 'Draft')
    <div class="form-group">
        <input type="submit" class="btn btn-success" value="Save Draft" name="status">
        <input type="submit" class="btn btn-primary " value="Publish" name="status">
        <button value="back" name="status" class="btn btn-danger ">Cancel</button>
    </div>
    @else
    <div class="form-group">
        <input type="submit" class="btn btn-primary" value="Save Changes" name="status"></input>
        <button value="back" name="status" class="btn btn-danger ">Cancel</button>
        </div>
    @endif
{!! Form::close() !!}

@endsection
