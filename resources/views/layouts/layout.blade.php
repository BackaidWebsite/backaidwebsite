@php
    use Illuminate\Support\Str;
@endphp
<!DOCTYPE html>
<html>

<head>

    <title>@yield('title')</title>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
</head>
    <body>
<!-- navbar that will go on every page besides login-->
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.0/jquery.js"></script>
        <script src="//cdn.tinymce.com/4/tinymce.min.js"></script>
        <script src="{{ asset('js/app.js') }}"></script>
        <link rel="stylesheet" href="/css/pages.css">
<link rel="stylesheet" href="/css/fontcss/css/all.css">
        @if(Auth::user()->isSuperAdmin())
        <nav class="navbar navbar-expand-md navbar-dark bg-dark">
            <h2 style="color:white;">Back Aid</h2>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav mr-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="/admin">Home</a>
                    </li>
                    <li class="nav-item dropdown" >
                        <a class="nav-link dropdown-toggle" href="" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            Articles
                        </a>
                        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <a class="dropdown-item @if(Request::routeIs('articles.index')) active @endif" href="{{ route('articles.index') }}"><i class="fa fa-th fa-fw" aria-hidden="true"></i> All Articles</a>
                            <a class="dropdown-item @if(Request::routeIs('articles.create')) active @endif" href="{{ route('articles.create') }}"><i class="fa fa-plus fa-fw" aria-hidden="true"></i> Add Article</a>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item @if(Request::routeIs('articlecategories.index')) active @endif" href="{{ route('articlecategories.index') }}">
                                <i class="fa fa-object-group fa-fw" aria-hidden="true"></i> All Categories</a>
                            <a class="dropdown-item @if(Request::routeIs('articlecategories.create')) active @endif" href="{{ route('articlecategories.create') }}">
                                <i class="fa fa-plus fa-fw" aria-hidden="true"></i> Add Category</a>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item @if(Request::routeIs('userarticles.index')) active @endif" href="{{ route('userarticles.index') }}"><i class="fa fa-th fa-fw" aria-hidden="true"></i> User View</a>

                        </div>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            Community Feed
                        </a>
                        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <a class="dropdown-item @if(Request::routeIs('forum.index')) active @endif" href="{{ route('forum.index') }}"><i class="fa fa-th fa-fw" aria-hidden="true"></i> All Threads</a>
                            <a class="dropdown-item @if(Request::routeIs('forum.create')) active @endif" href="{{ route('forum.create') }}"><i class="fa fa-plus fa-fw" aria-hidden="true"></i> Add Thread</a>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item @if(Request::routeIs('threadcategories.index')) active @endif" href="{{ route('threadcategories.index') }}">
                                <i class="fa fa-object-group fa-fw" aria-hidden="true"></i> All Categories</a>
                            <a class="dropdown-item @if(Request::routeIs('threadcategories.create')) active @endif" href="{{ route('threadcategories.create') }}">
                                <i class="fa fa-plus fa-fw" aria-hidden="true"></i> Add Category</a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item @if(Request::routeIs('forumsindex')) active @endif" href="{{ route('forums.index') }}"><i class="fa fa-th fa-fw" aria-hidden="true"></i> User View</a>
                        </div>
                    </li>
                    <li class="nav-item dropdown" >
                        <a class="nav-link dropdown-toggle" href="" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            FAQ
                        </a>
                        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <a class="dropdown-item @if(Request::routeIs('faq.index')) active @endif" href="{{ route('faq.index') }}"><i class="fa fa-th fa-fw" aria-hidden="true"></i> All FAQs</a>
                            <a class="dropdown-item @if(Request::routeIs('faq.create')) active @endif" href="{{ route('faq.create') }}"><i class="fa fa-plus fa-fw" aria-hidden="true"></i> Add FAQ</a>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item @if(Request::routeIs('userfaq.index')) active @endif" href="{{ route('userfaq.index') }}"><i class="fa fa-th fa-fw" aria-hidden="true"></i> User View</a>
                        </div>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            Users
                        </a>
                        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <a class="dropdown-item @if(Request::routeIs('users.index')) active @endif" href="{{ route('users.index') }}"><i class="fa fa-th fa-fw" aria-hidden="true"></i> All Users</a>
                            <a class="dropdown-item @if(Request::routeIs('users.create')) active @endif" href="{{ route('users.create') }}"><i class="fa fa-plus fa-fw" aria-hidden="true"></i> Add User</a>
                        </div>
                    </li>

                </ul>
                <div class="nav-item dropdown" style="margin-right: 55px;">
                    <a class="nav-link dropdown-toggle" href="#" id="dropdown01" style="color:#808080;" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">{{Auth::user()->name}}</a>
                    <div class="dropdown-menu" aria-labelledby="dropdown01">
                        <a class="dropdown-item" href="/profile">Account Profile</a>
                        <a class="dropdown-item" href="{{ route('logout') }}">Logout</a>
                    </div>
                </div>
            </div>
        </nav>

        @else
        <nav class="navbar navbar-expand-md navbar-dark bg-dark">
            <h2 style="color:white;">Back Aid</h2>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav mr-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="/articles">Articles</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/forums">Community Feed</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/faq">FAQ</a>
                    </li>
                </ul>
                <div class="nav-item dropdown" style="margin-right: 55px;">
                    <a class="nav-link dropdown-toggle" href="#" id="dropdown01" style="color:#808080;" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">{{Auth::user()->name}}</a>
                    <div class="dropdown-menu" aria-labelledby="dropdown01">
                        <a class="dropdown-item" href="/profile">Account Profile</a>
                        <a class="dropdown-item" href="{{ route('logout') }}">Logout</a>
                    </div>
                </div>
            </div>
        </nav>

        @endif
         @include('layouts.messages')
         @include('layouts.delete_prompt')
         @include('layouts.edituser_prompt')
         <div class="container">
            <div class="row justify-content-center">
                <div class="col-sm-12 col-md-offset-2">
                    @yield('content')
                </div>
            </div>
        </div>



    <script type="text/javascript">

        $(document).ready(function()
        {
	           $('.remove-record').click(function()
               {
                   var url = $(this).attr('data-url');
                   $("#deleteForm").attr('action', url);
               });

               $('.edit').click(function()
               {
                   var url = $(this).attr('data-url');
                   $("#update").attr('action', url);

                   var name = $(this).attr('data-name');
                   document.getElementById('name').value = name;

                   var email = $(this).attr('data-email');
                   document.getElementById("email").value = email;

                   var content = $(this).attr('data-content');
                   document.getElementById("content_comment").value = content;

               });
               $('.editreply').click(function()
               {
                   var url = $(this).attr('data-url');
                   $("#update_reply").attr('action', url);

                   var name = $(this).attr('data-name');
                   document.getElementById('name_reply').value = name;

                   var email = $(this).attr('data-email');
                   document.getElementById("email_reply").value = email;

                   var content = $(this).attr('data-content');
                   document.getElementById("content_reply").value = content;

               });
               $('.edituser').click(function()
               {
                   var url = $(this).attr('data-url');
                   $("#update_user").attr('action', url);

                   var name = $(this).attr('data-name');
                   document.getElementById('name_user').value = name;

                   var email = $(this).attr('data-email');
                   document.getElementById("email_user").value = email;
               });
        });
        function formSubmit()
        {
            $("#deleteForm").submit();
        }
        function formSubmit_comment()
        {
            $("#update").submit();
        }
        function formSubmit_reply()
        {
            $("#update_reply").submit();
        }
        function formSubmit_user()
        {
            $("#update_user").submit();
        }

    </script>


    </body>
</html>
