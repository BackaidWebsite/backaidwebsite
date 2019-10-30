@extends('layouts.layout')
<?php $titleTag = htmlspecialchars($thread->threadTopic); ?>
@section('title', "$titleTag")

@section('content')

@php
    use Illuminate\Support\Str;
@endphp

@include('layouts.editreply_prompt')

<!-- invidual thread page -->
<script>
    $(document).ready(function() {

        $(".show_hide_reply").click(function()
        {
            var $toggle = $(this);
            var id = "#reply" + $toggle.data('id');
            $( id ).toggle();
        });
        $(".thread").click(function()
        {
            var $toggle = $(this);
            var threadid = "#thread";
            $( threadid ).toggle();
        });

        $(".toggle").hide();

        $(".response").click(function()
        {
            var url = $(this).attr('data-url');
            $(".form").attr('action', url);

            var name = $(this).attr('name');

            document.getElementById("names").innerHTML = "Reply to " + name + ":";

            var id = $(this).attr('data-id');

            $(id).toggle();

            $(".toggle:visible").not(id).hide();
        });
    });
</script>

<link rel="stylesheet" href="/css/comments.css">

<div class="container">
    <div class="row justify-content-center">
            <div style="width: 50rem; margin-top:10px">
            <!-- only admins and users who created the edit the thread -->
            <!-- only admins can delete threads -->
            <!-- admins can edit and delete everyones replies, while users can only edit and delete their own -->
                @if(Auth::user()->isSuperAdmin())
                    <button style="float:right" onclick="window.location.href='{{ URL::route('forum.edit', $thread->threadID) }}'">Edit Thread</button>
                @else
                    @can('access', $thread)
                        <button style="float:right" onclick="window.location.href='{{ URL::route('forums.edit', $thread->threadID) }}'">Edit Thread</button>
                    @endcan
                @endif
			    <h4 style="margin-top: 25px" name="no">{{ $thread->threadTopic}}</h4>
                <h6>{{ $thread->category->category }}</h6>
                {{ date('F dS, Y ' ,strtotime($thread->created_at)) }}

			    <hr>

                <h5>{{ $thread->user->name }} </h5>
                <p>{!! $first->reply !!}</p>
                <div class="comment-reply" >
                    <a href="javascript:void(0)" style="float:right; margin-left: 5px;" class="response" name="{{ $thread->user->name }}" data-id="#reply"
                        data-url="{{ route('threadreply.store', $first->repliesID) }}"><i style="margin-right: 5px"  class="fas fa-reply-all"></i>Reply</a>

                    @if($first->replies()->count() == 1)
                        <a href="javascript:void(0)" class="thread" style="cursor: pointer;" data-id="thread">{{ $first->replies()->count() }}  Reply ↓</a>
                    @elseif($first->replies()->count() == 0)
                        <br>
                    @elseif($first->replies()->count() > 1)
                        <a href="javascript:void(0)" class="thread" style="cursor: pointer;" data-id="thread">{{ $first->replies()->count() }}  Replies ↓</a>
                    @endif
                    <div id="thread" style="display: none;">
                        @foreach($first->replies as $reply)
                            <div class="card bg-dark text-white" style=" margin-top: 5px;">
                                <div style="margin-left: 5px;">
                                    <div class="author-name">
                                        <h4>{{ $reply->user->name }}</h4>
                                        <p class="author-time">{{ date('F dS, Y - g:iA' ,strtotime($reply->created_at)) }}</p>
                                    </div>
                                    <div class="comment-content" >
                                        {!! $reply->reply !!}
                                    </div>
                                </div>
                                <div>
                                    @can('access', $reply)
                                        <a href="javascript:void(0)"  style="float:right; margin-right: 10px; cursor: pointer;" data-toggle="modal" data-url="{{ route('threadreply.destroy', $reply->id) }}"
                                            data-target="#DeleteModal" class="remove-record"><i style="color:#FF0000;" class="fa fa-trash-alt"></i></a>
                                        <a href="javascript:void(0)" class="editreply" data-name="{{$reply->user->name}}" data-email="{{ $reply->user->email }}" data-url="{{ route('threadreply.update',$reply->id) }}"
                                            data-content="{!! $reply->reply !!}" style="float:right; margin-right: 5px; cursor: pointer;" data-toggle="modal" data-target="#replies"><i class="fas fa-edit"></i></a>
                                   @endcan
                               </div>
                           </div>
                        @endforeach
                    </div>
                </div>

                <hr>

                <table>
                    <thead>
                        <th style="color: #aaa;padding-right: 20px;">Created </th>
                        <th style="color: #aaa;padding-right: 20px;">Last Reply </th>
                        <th align="center" style="color: #aaa;padding-right: 20px;">{{ Str::plural('Reply', $thread->replies()->count() - 1) }}</th>
                        <th align="center" style="color: #aaa;">Views</th>
                    </thead>
                    <tbody align="center">
                        @if( $thread->replies()->count() > 1 )
                            <tr>
                                <td style="padding-right: 20px;">{{ $created_date }}{{ $format }}</td>
                                <td style="padding-right: 20px;">{{ $latestreply }}{{ $format_latest }}</td>
                                <td style="padding-right: 20px;">{{ $thread->replies()->count() - 1 }}</td>
                                <td>{{ $thread->view_count }}</td>
                            </tr>
                        @else
                            <tr>
                                <td style="padding-right: 20px;">{{ $created_date }}{{ $format }}</td>
                                <td style="padding-right: 20px;">0 Replies</td>
                                <td style="padding-right: 20px;">0</td>
                                <td>{{ $thread->view_count }}</td>
                            </tr>
                        @endif
                    </tbody>
                <table>

		        <hr>

                @if(($thread->replies()->count() - 1) == 1)
                    <h5>There is {{ $thread->replies()->count() - 1}} reply in this thread</h5>
                @else
                    <h5>There are {{ $thread->replies()->count() - 1}} replies in this thread</h5>
                @endif

                <hr>
            </div>
            @foreach($thread->replies as $replies)
                @if(!$replies->parentID)
                    @if(!$loop->first)
                        <div class="card" style=" border-color:#FFFFFF;">
				            <div class="comment">
					            <div class="author-name">
						            <h5>{{ $replies->user->name }}</h5>
						            <p class="author-time">{{ date('F dS, Y - g:iA' ,strtotime($replies->created_at)) }}</p>
					            </div>
					            <div class="comment-content">
						            {!! $replies->reply !!}
					            </div>
                                <div class="comment-reply" >
                                    <a href="javascript:void(0)" style="float:right; margin-left: 5px;" class="response" name="{{ $replies->user->name }}"
                                        data-id="#reply" data-url="{{ route('threadreply.store', $replies->repliesID) }}"><i style="margin-right: 5px"  class="fas fa-reply-all"></i>Reply</a>
                                    @can('access', $replies)
                                        <a href="javascript:void(0)" style="float:right; margin-left: 5px; cursor: pointer;" data-toggle="modal"
                                            data-url="{{ route('usereply.destroy', $replies->repliesID) }}"data-target="#DeleteModal" class="remove-record"><i style="color:#FF0000;" class="fa fa-trash-alt"></i></a>
                                        <a href="javascript:void(0)" class="editreply" data-name="{{$replies->user->name}}" data-email="{{ $replies->user->email }}" data-url="{{ route('usereply.update',$replies->repliesID) }}"
                                            data-content="{!! $replies->reply !!}" data-toggle="modal" style="float:right;" data-target="#replies"><i class="fas fa-edit"></i></a>
                                    @endcan
                                    @if($replies->replies()->count() == 1)
                                        <a href="javascript:void(0)" class="show_hide_reply" style="cursor: pointer;" data-id="{{ $replies->repliesID }}">{{ $replies->replies()->count() }}  Reply ↓</a>
                                    @elseif($replies->replies()->count() == 0)
                                        <br>
                                    @elseif($replies->replies()->count() > 1)
                                        <a href="javascript:void(0)" class="show_hide_reply" style="cursor: pointer;" data-id="{{ $replies->repliesID }}">{{ $replies->replies()->count() }}  Replies ↓</a>
                                    @endif
                                    <div id="reply{{ $replies->repliesID }}" style="display: none;">
                                        @foreach($replies->replies as $reply)
                                            <div class="card bg-dark text-white" style=" margin-top: 5px;">
                                                <div style="margin-left: 5px;">
                                                    <div class="author-name">
            						                    <h4>{{ $reply->user->name }}</h4>
            						                    <p class="author-time">{{ date('F dS, Y - g:iA' ,strtotime($reply->created_at)) }}</p>
            					                    </div>
            				                        <div class="comment-content">
            						                    {!! $reply->reply !!}
            					                    </div>
                                                </div>
                                                <div>
                                                    @can('access', $reply)
                                                        <a href="javascript:void(0)"  style="float:right; margin-right: 10px; cursor: pointer;" data-toggle="modal" data-url="{{ route('threadreply.destroy', $reply->id) }}"
                                                            data-target="#DeleteModal" class="remove-record"><i style="color:#FF0000;" class="fa fa-trash-alt"></i></a>
                                                        <a href="javascript:void(0)" class="editreply" data-name="{{$reply->user->name}}" data-email="{{ $reply->user->email }}" data-url="{{ route('threadreply.update',$reply->id) }}"
                                                            data-content="{!! $reply->reply !!}" style="float:right; margin-right: 5px; cursor: pointer;" data-toggle="modal" data-target="#replies"><i class="fas fa-edit"></i></a>
                                                    @endcan
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
					            </div>
                                <hr>
                            </div>
			            </div>
                    @endif
                @endif
			@endforeach


        <div style="margin-bottom: 10px;">
            <button class="btn btn-block btn-primary response" data-id="#comment" style="margin-bottom: 5px;" ><i style="margin-right: 5px"  class="fas fa-reply-all"></i>Reply to this thread</button>
            <div class="toggle" id="comment">
                {{ Form::open(['route' => ['usereply.store', $thread->threadID], 'method' => 'POST']) }}
			        {{ Form::label('comment', "Reply:") }}
			        <textarea name="reply" id="thread_reply" class="form-control" rows="5"></textarea>
				    {{ Form::submit('Publish', ['class' => 'btn btn-success btn-block', 'style' => 'margin-top:15px;']) }}
			    {{ Form::close() }}
            </div>
            <div id="reply" class="toggle">
                <form action="" class="form"  method="post" >
                    <label id="names"></label>
                    <textarea name="reply" id="replies_reply" class="form-control" rows="5"></textarea>
                    {{ csrf_field() }}
                    <button type="submit" class="btn btn-block btn-success" value="Publish" style="margin-top: 15px;">Publish</button>
                </form>
            </div>
		</div>
	</div>
</div>

<script>
  tinymce.init
  ({
    path_absolute : "/",
    menubar: false,
    selector: '#replies_reply',
    plugins: [
      "advlist autolink lists link image charmap print preview hr anchor pagebreak",
      "searchreplace wordcount visualblocks visualchars code fullscreen",
      "insertdatetime media nonbreaking save table contextmenu directionality",
      "template paste textcolor colorpicker textpattern autoresize"
    ],
    toolbar: "bold italic | bullist numlist emoticons | link insertdatetime",
    relative_urls: false,
   });
</script>
<script>
   tinymce.init
   ({
     path_absolute : "/",
     menubar: false,
     selector: '#thread_reply',
     plugins: [
       "advlist autolink lists link image charmap print preview hr anchor pagebreak",
       "searchreplace wordcount visualblocks visualchars code fullscreen",
       "insertdatetime media nonbreaking save table contextmenu directionality",
       "template paste textcolor colorpicker textpattern autoresize"
     ],
     toolbar: "bold italic | bullist numlist emoticons | link insertdatetime",
     relative_urls: false,


    });
</script>
@endsection
