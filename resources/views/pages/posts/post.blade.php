@extends('layouts.master')

@section('title', 'Bài viết')

@section('content-master')
    <div class="container">
        <div class="detailPost"> 
            <div class="content">
                <h1>{{ $post->title }}</h1>

                @can('update', $post)
                    <a href="{{ route('post.edit', $post->slug) }}">Chỉnh sửa bài viết</a> || 
                    <a href="{{ route('post.destroy', $post->id) }}">Xóa bài viết</a>
                @endcan
            
                <div class="detail-categories">
                @foreach($post->category as $category)
                <a href="{{ route('category.show', $category->slug) }}">{{ $category->name }}</a>
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
            Phải đăng nhập mới bình luận
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
                    <img src="https://kenh14cdn.com/thumb_w/620/2020/10/19/photo-1-16030711718361859040497.jpg">
                    </div>
                    <form id="formComment" action="{{ route('comment.store') }}" method="POST">
                        @csrf
                        <input type="text" value="" placeholder="comment.." name="content" id="content">
                        <!-- <input type="submit" value="Bình luận"> -->
                    </form>
                </div>
                
                <div class="listComment">
                    <div class="countComment">{{ count($comments)}} bình luận</div>
                    @foreach($comments as $comment)
                    <div class="comment">
                        <input type="hidden" value="{{ $comment->id}}"id="idComment">
                        <a href="#" class="commentimg">
                        <img src="https://kenh14cdn.com/thumb_w/620/2020/10/19/photo-1-16030711718361859040497.jpg" alt="">
                        </a>
                        <div class="commentbody">
                            <div id="commentname">
                            <a href="#" id="name">{{ $comment->users->name }}</a>
                            @can('update', $comment)
                            <a href="#" id="commentdel">Xóa comment</a>
                            @endcan
                            </div>
                            <p id="commentcontent">{{ $comment->content }}</p>
                        </div>
                        
                        <div id="commenttime">30 phút trước</div>
                        
                    </div>
                    @endforeach
                </div>
            </div>
            @endguest
    
        </div>
    </div>
    <script>
        $(document).ready(function(){

            $("#formComment").submit(function(e){
                e.preventDefault();

                let comment = $("#content").val();
                let user = '{{ Auth::id() }}';
                let post = '{{ $post->id }}';
                let _token = $("input[name=_token]").val();

                $.ajax({
                    url: "{{ route('comment.store') }}",
                    type: "POST",
                    data: {
                        content: comment,
                        post_id: post,
                        user_id: user,
                        _token : _token
                    },
                    success: function(response)
                    {
                        if(response) {
                            location.reload();
                        }
                    },
                })
                
            }),

            $("#btnDel").click(function(){
                let url = $(this).attr('data-url');
                let _token = $("input[name=_token]").val();
                $.ajax({
                    url: url,
                    type: "POST",
                    data: {
                        _token : _token
                    },
                    success: function(response)
                    {
                        
                        location.reload();
                    },
                    
                })
            })
        });
        
    </script>
@endsection