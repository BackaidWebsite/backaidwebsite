@extends('layouts.layout')
<?php $titleTag = htmlspecialchars($article->articleTitle); ?>
@section('title', "$titleTag")

@section('content')

@include('layouts.editcomment_prompt')
@include('layouts.editreply_prompt')
<script>
    $(document).ready(function() {

        $(".show_hide_reply").click(function()
        {
            var $toggle = $(this);
            var id = "#reply" + $toggle.data('id');
            $( id ).toggle();
        });

        $(".toggle").hide();

        $(".reply").click(function()
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
<!-- individual article page -->
<link rel="stylesheet" href="/css/comments.css">
@if($article->status == "Draft")
    <div class="container">
        <div class="row justify-content-center">
            <div style="margin-top: 10px; width: 50rem" >
                <!-- only admins can edit articles -->
                @if(Auth::user()->isSuperAdmin())
                <button onclick="window.location.href='{{ URL::route('articles.edit', $article->articleID) }}'" style="float:right;">Edit Article</button>
                @endif
        	    <h2 name="h1centre" style="margin-top:25px">{{ $article->articleTitle }}</h2>
        		<p>{!! $article->articleContent !!}</p>
        		<hr>
        		<p>Posted In: {{ $article->category->category }}</p>
                <hr>
                <h6 style="color:#FF0000; text-align:center">This Article must be published for comments to be enabled.</h6>
                <hr>
            </div>
        </div>
    </div>
@else
    <div class="container">
        <div class="row justify-content-center">
            <div style="margin-top: 10px; width: 50rem;">
                @if(Auth::user()->isSuperAdmin())
                    <button onclick="window.location.href='{{ URL::route('articles.edit', $article->articleID) }}'" style="float:right;">Edit Article</button>
                @endif
            	<h2 name="h1centre" style="margin-top:25px">{{ $article->articleTitle }}</h2>
            	<p>{!! $article->articleContent !!}</p>
            	<hr>
            	<p>Posted In: {{ $article->category->category }}</p>
                <h4 class="comments-title"><i class="fas fa-comment"></i>  {{ $article->comment()->count() }} {{ Str::plural('Comment', $article->comment()->count()) }}</h4>
                <hr>

                @foreach($article->comment as $comment)
                    <div class="card" style="border-color:#FFFFFF;">
			            <div class="comment">
                            <div class="author-name">
                                <h4>{{ $comment->user->name }}</h4>
					            <p class="author-time">{{ date('F dS, Y - g:iA' ,strtotime($comment->created_at)) }}</p>
				            </div>
				            <div class="comment-content" >
					            {!! $comment->comment !!}
				            </div>
                            <div class="comment-reply" >
                                <a href="javascript:void(0)" style="float:right; margin-left: 5px;" class="reply" name="{{ $comment->user->name }}" data-id="#reply"
                                    data-url="{{ route('commentsreply.store', $comment->commentID) }}"><i style="margin-right: 5px"  class="fas fa-reply-all"></i>Reply</a>
                                @can('access', $comment)
                                    <a  href="javascript:void(0)" style="float:right; margin-left: 5px; cursor: pointer;" data-toggle="modal"
                                        data-url="{{ route('usercomments.destroy', $comment->commentID) }}"data-target="#DeleteModal" class="remove-record"><i style="color:#FF0000;" class="fa fa-trash-alt"></i></a>
                                    <a href="javascript:void(0)" class="edit" data-name="{{$comment->user->name}}" style="float:right;" data-email="{{ $comment->user->email }}"
                                        data-url="{{ route('usercomments.update',$comment->commentID) }}" data-content="{!! $comment->comment !!}" data-toggle="modal" data-target="#edit"><i class="fas fa-edit"></i></a>
                                @endcan
                                @if($comment->replies()->count() == 1)
                                    <a href="javascript:void(0)" class="show_hide_reply" style="cursor: pointer;"
                                        data-id="{{ $comment->commentID }}">{{ $comment->replies()->count() }}  Reply ↓</a>
                                @elseif($comment->replies()->count() == 0)
                                    <br>
                                @elseif($comment->replies()->count() > 1)
                                    <a href="javascript:void(0)" class="show_hide_reply" style="cursor: pointer;"
                                        data-id="{{ $comment->commentID }}">{{ $comment->replies()->count() }}  Replies ↓</a>
                                @endif
                                <div id="reply{{ $comment->commentID }}" style="display: none;">
                                    @foreach($comment->replies as $reply)
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
                                                    <a href="javascript:void(0)"  style="float:right; margin-right: 10px; cursor: pointer;" data-toggle="modal"
                                                        data-url="{{ route('commentsreply.destroy', $reply->id) }}"data-target="#DeleteModal" class="remove-record"><i style="color:#FF0000;" class="fa fa-trash-alt"></i></a>
                                                    <a href="javascript:void(0)" class="editreply" data-name="{{$reply->user->name}}" data-email="{{ $reply->user->email }}" data-url="{{ route('commentsreply.update', $reply->id) }}"
                                                        data-content="{!! $reply->reply !!}" style="float:right; margin-right: 5px; cursor: pointer;" data-toggle="modal" data-target="#replies"><i class="fas fa-edit"></i></a>
                                                @endcan
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
            				</div>
                        </div>
            		</div>
                    <hr>
            	@endforeach
                <div class=" col-md-offset-2" style="margin-bottom: 10px;">
                    <button class="btn btn-block btn-primary reply" data-id="#comment" style="margin-bottom: 5px;" >Write a response</button>
                    <div class="toggle" id="comment">
                        {{ Form::open(['route' => ['usercomments.store', $article->articleID], 'method' => 'POST']) }}
                	       {{ Form::label('comment', "Comment:") }}
                		   <textarea name="comment" id="article_comment" class="form-control" rows="5"></textarea>
                	       {{ Form::submit('Publish', ['class' => 'btn btn-success btn-block', 'style' => 'margin-top:15px;']) }}
                	    {{ Form::close() }}
                    </div>
                    <div id="reply" class="toggle">
                        <form action="" class="form"  method="post" >
                            <label id="names"></label>
                            <textarea name="reply" id="comment_reply" class="form-control" rows="5"></textarea>
                            {{ csrf_field() }}
                            <button type="submit" class="btn btn-block btn-success" value="Publish" style="margin-top: 15px;">Publish</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endif
<script>
  tinymce.init
  ({
    path_absolute : "/",
    menubar: false,
    selector: '#article_comment',
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
     selector: '#comment_reply',
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
