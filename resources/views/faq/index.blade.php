@extends('layouts.layout')

@section('title', 'Frequently Asked Questions')

@section('content')

<!-- user faq index page -->
<link rel="stylesheet" href="/css/faq.css">
<link href="//netdna.bootstrapcdn.com/twitter-bootstrap/4.1.0/css/bootstrap-combined.no-icons.min.css" rel="stylesheet">
<link href="//netdna.bootstrapcdn.com/font-awesome/3.2.1/css/font-awesome.css" rel="stylesheet">

<div class="container">
	<h1 name="h1centre">Frequently Asked Questions</h1><br>
    <div id="accordion">
  		@foreach ($faq as $faq)
	  		@if ($faq->status == 'Published')
	  			<div class="card">
	    			<div class="card-header">
	    				<div class="card-title">
		      				<a class="card-link" data-toggle="collapse" href= "#faq{{ $faq->faqID }}" aria-expanded="false">
			        			<span>
			        				<i class="icon-collapse" data-toggle="expand"></i>
			        				<i class="icon-expand" data-toggle="collapse"></i>
			        				{{ $faq->question }}
			        			</span>
		      				</a>
	  					</div>
	    			</div>
	    			<div id="faq{{$faq->faqID }}" class="collapse">
	      				<div class="card-body">
	        				<p>{{ $faq->answer }}</p>
	      				</div>
	    			</div>
	  			</div>
				<div class="spacer"></div>
			@endif
  		@endforeach
  	</div>
</div>
@endsection
