@extends('layouts.master')

@section('title', 'Bài viết')

@section('content-master')
    <div class="background-post">
        <div class="detailPost"> 
            <div class="fix-left sticky-score">
                <a href="#"><img src="{{ asset('images/' . $post->user->profile->avarta) }}"></a>
                <button id="fix-left-up">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-caret-up-fill" viewBox="0 0 16 16">
                    <path d="M7.247 4.86l-4.796 5.481c-.566.647-.106 1.659.753 1.659h9.592a1 1 0 0 0 .753-1.659l-4.796-5.48a1 1 0 0 0-1.506 0z"/>
                    </svg>
                </button>
                <span data-id="{{ $post->id }}">{{ $post->point }}</span>
                <button id="fix-left-down">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-caret-down-fill" viewBox="0 0 16 16">
                    <path d="M7.247 11.14L2.451 5.658C1.885 5.013 2.345 4 3.204 4h9.592a1 1 0 0 1 .753 1.659l-4.796 5.48a1 1 0 0 1-1.506 0z"/>
                    </svg>
                </button>
            </div>
            <div class="content">
                <h1>{{ $post->title }}</h1>

                @can('update', $post)
                    <a href="{{ route('post.edit', $post->slug) }}">Chỉnh sửa bài viết</a> || 
                    <a href="{{ route('post.destroy', $post->id) }}">Xóa bài viết</a>
                @endcan
            
                <div class="detail-categories">
                @foreach($post->category as $category)
                <a href="{{ route('category.show', $category->slug) }}" class="categories-item">{{ $category->name }}</a>
                @endforeach
                    
                </div>

                <div class="creator">
                    <a href="{{ route('profile.index', $post->user->slug) }}" class="creator-img">
                        <img src="{{ asset('images/' . $post->user->profile->avarta) }}">
                    </a>
                    <div class="creator-name">
                        <a href="{{ route('profile.index', $post->user->slug) }}">{{ $post->user->name }}</a>
                        đăng 3 giờ trước
                    </div>
                </div>
                
                <div id="contentString">{!!  $post->content !!}</div>
            </div>
            
            @guest
            Phải đăng nhập mới được bình luận
            @else
            <div class="comments">
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                
                <div class="articleComment">
                    <div class="img-formComment">
                    <img src="{{ asset('/images/' . Auth::user()->profile->avarta ) }}">
                    </div>
                    <form id="formComment" action="{{ route('comment.store') }}" method="POST">
                        @csrf
                        <input type="text" value="" placeholder="comment.." name="content" class="inputComment" id="content">
                        <input type="hidden" value="" id="auth-info" auth-name="{{ Auth::user()->name }}" auth-avarta = "{{ Auth::user()->profile->avarta }}" >
                        <!-- <input type="submit" value="Bình luận"> -->
                    </form>
                </div>
                <div class="countComment"><span id="count">{{ count($comments)}}</span> bình luận</div>
                <div class="listComment">
                    @foreach($comments as $comment)
                    <div class="comment" id="comment-{{ $comment->id }}">
                        <input type="hidden" value="{{ $comment->id}}"id="idComment">
                        <a href="{{ route('profile.index', $comment->users->slug) }}" class="commentimg">
                        <img src="{{ asset('/images/' . $comment->users->profile->avarta ) }}" alt="">
                        </a>
                        <div class="comment-right">
                            <div class="commentbody commentbody-{{ $comment->id }}">  
                                <div id="commentname">
                                <a href="{{ route('profile.index', $comment->users->slug) }}" id="name">{{ $comment->users->name }}</a>
                                <div class="dropdown dropdown-action">
                                    <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                                        ...
                                    </button>
                                    <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                                        <li>
                                            @can('update', $comment)
                                            <a href="{{route('comment.destroy',$comment->id)}}" id="commentdel" data-id="{{ $comment->id }}">Xóa comment</a>
                                            @endcan
                                        </li>
                                        <li>
                                            @can('update', $comment)
                                            <a href="" id="commentedit" data-id="{{ $comment->id }}">Chỉnh sửa comment</a>
                                            @endcan
                                        </li>
                                    </ul>
                                </div>
                                </div>
                                <p id="commentcontent">{{ $comment->content }}</p>
                                <div id="commenttime">30 phút trước</div>
                            </div>
                            <form class="form-edit-comment form-edit-{{ $comment->id }}">
                                <input type="text" class="input-edit-{{ $comment->id }}"  name="" id="">
                                <!-- <input type="submit" value="Cập nhật"> -->
                                <span class="cancel-update" data-id="{{ $comment->id }}" >Cancel</span>
                            </form>
                        </div>
                        
                        
                    </div>
                    @endforeach
                </div>
            </div>
            @endguest
    
        </div>
    </div>

    <script>
        function ajaxPoint($type) {
            let point = $(".fix-left span");
            let getId = point.attr('data-id');
            let urlUp = "{{ route('post.up.point',156723) }}";
            let urlDown = "{{ route('post.down.point',1222153) }}";
            let urlCurrentUp = urlUp.replace('156723', getId);
            let urlCurrentDown = urlDown.replace('1222153', getId);
            let urlCurrent = null;
            
            switch($type) {
                case 'up':
                    urlCurrent = urlCurrentUp;
                    break;
                case 'down':
                    urlCurrent = urlCurrentDown;
                    break;
                default:
                    break;
            }
            $.ajax({
                url: urlCurrent,
                type: "GET",
                success: function(data)
                {
                    // alert("Cảm ơn bạn đã đánh giá.")
                },
            })
        }
        function up_down($parameter, $flag) {
            let point = $(".fix-left span");
            let up = $("#fix-left-up");
            let down = $("#fix-left-down");
            if($flag) {
                up.attr('disabled', true);
                down.removeAttr('disabled', true);
                console.log('up');
            }
            else {
                down.attr('disabled', true);
                up.removeAttr('disabled', true);
                console.log('down');
            }
            console.log($flag);
            let calculate; 
            switch ($parameter) {
                case 1:
                    calculate = parseInt(point.text()) + 1;
                    break;
                case 2:
                    calculate = parseInt(point.text()) - 1;
                    break;
                default:
                    break;
            }
            point.text(calculate);           
        }
        function checkLogin() {
            let check = '{{Auth::id()}}';
            if(check > 0) {
                return true;
            }
            else {
                let url = '{{ route("login") }}';
                $(location).attr('href',url);
                return false;
            }
        }
        var flag = true;
        $(document).on('click', '#fix-left-up', function() {
            var up = 1;
            flag = true;
            if(checkLogin()) {
                up_down(up, flag);
                ajaxPoint('up');
            }
        })
        $(document).on('click', '#fix-left-down', function() {
            flag = false;
            var down = 2;
            if(checkLogin()) {
                up_down(down, flag);
                ajaxPoint('down');
            }  
        })
    </script>
    <script>
        $(document).on('submit', '#formComment', function(e) {
            e.preventDefault();
            let image = $("#auth-info").attr('auth-avarta');
            let url_avarta = '{{ asset("/images/") }}'+ '/' + image;
            let name = $("#auth-info").attr('auth-name');
            let comment = $("#content").val();
            let user = '{{ Auth::id() }}';
            let post = '{{ $post->id }}';
            let _token = $("input[name=_token]").val();
            let countComment = $("#count").html();
            
            $.ajax({
                url: "{{ route('comment.store') }}",
                type: "POST",
                data: {
                    content: comment,
                    post_id: post,
                    user_id: user,
                    _token : _token
                },
                success: function(data)
                {
                    let str = `
                    @guest
                    @else
                    <div class="comment" id="comment-`+ data.id +`">
                        <input type="hidden" value="`+ data.id +`"id="idComment">
                        <a href="profile/{{Auth::user()->slug}}" class="commentimg">
                        <img src="`+ url_avarta +`" alt="">
                        </a>
                        <div class="commentbody">
                            <div id="commentname">
                            <a href="profile/{{Auth::user()->slug}}" id="name">`+ name +`</a>
                            <a href="comment/`+ data.id +`" id="commentdel" data-id="`+ data.id +`">Xóa comment</a>
                            </div>
                            <p id="commentcontent">`+ data.content + `</p>
                        </div>
                        
                        <div id="commenttime">5 phút trước</div>
                    </div>
                    @endguest
                    `;
                    $(".listComment").prepend(str);
                    $(".inputComment").val('');
                    $("#count").html(parseInt(countComment)+1);
                },
            })

        })
        $(document).on('click', '#commentdel', function(e) {
            e.preventDefault();
            let id = $(this).attr('data-id');
            let url = "{{ route('comment.destroy', 33333) }}";
            let urlDel = url.replace('33333', id);

            $.ajax({
                url: urlDel,
                type: "GET",
                success: function(data) {
                    $("#comment-"+id).remove();
                }

            })
        })

        // comment edit
        $(document).on('click', '#commentedit', function(e) {
            e.preventDefault();
            let id = $(this).attr('data-id');
            $(".form-edit-comment").hide();
            $(".commentbody").show();
            $(".form-edit-"+id).show();
            $(".commentbody-"+id).hide();

            let contentEdit = $(".commentbody-"+id).children("#commentcontent").html();
            $(".input-edit-"+id).val(contentEdit);
            $(".input-edit-"+id).focus();
        })

        // comment cancel
        $(document).on('click', '.cancel-update', function(e) {
            let id = $(this).attr('data-id');
            $(".form-edit-"+id).hide();
            $(".commentbody-"+id).show();
        })
    </script>

    <script>
    $(document).ready(function(){
        var width = $(".background").width();
        var screen = $("#app").width();
        var cal = ((screen - width) / 2) - 45;
        console.log('background: '+ width + " screen: " + screen)
        $(".fix-left").css("left", cal);
    })
    window.onscroll = function() {myFunction()};
    
    function myFunction() {
        var Offset = $(".header").offset().top -3;
        if(window.pageYOffset > Offset)
        {
            $(".sticky-score img").css("opacity", "1");
        }
        else {
            $(".sticky-score img").css("opacity", "0");
        }
    }
    </script>
@endsection