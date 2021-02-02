@extends('layouts.app')

@section('title', 'profile')

@section('content')
    <div class="container">  
        <div class="profile">
            <div class="profile-head">
                <div class="profile-head-img">
                    <img src="{{ asset('images/'. $user->profile->avarta) }}">
                </div>
                <div class="profile-head-info">
                    <div class="head-info-name">
                        <h1>{{ $user->name }}</h1>
                        @can('update-profile', $user->profile)
                        <a href="{{ route('profile.edit', $user->slug) }}">Edit Profile</a>
                        @endcan
                        
                    </div>
                    <div class="profile-head-statistic">
                        <span>{{ count($user->posts) }} bài viết</span>
                        <span>200 bình luận</span>
                        <span>4000 lượt xem</span>
                    </div>
                    <div class="profile-head-social">
                        <a href="#" id="fb">
                            Facebook
                        </a>
                        <a href="#" id="linked">
                            Linkedin
                        </a>
                    </div>
                </div>
            </div>

            <div class="profile-posts">
                <div class="row">
                    <div class="col-md-2"></div> 
                    <div class="col-md-8">
                    <div class="blogs">
                            <ul class="nav nav-tabs" id="myTab" role="tablist">
                                <li class="nav-item" role="presentation">
                                    <a class="nav-link " id="published-tab" data-bs-toggle="tab" href="#published" role="tab" aria-controls="home" aria-selected="true">Bài viết đã đăng ({{ count($postsPublished) }})</a>
                                </li>
                                @if(Auth::id() === $user->id  )
                                <li class="nav-item" role="presentation">
                                    <a class="nav-link active" id="unpublish-tab" data-bs-toggle="tab" href="#unpublish" role="tab" aria-controls="profile" aria-selected="false">Bài viết chưa đăng ({{ count($postsUnpublish) }})</a>
                                </li>
                                @endif
                            </ul>
                            <div class="tab-content" id="myTabContent">
                                <div class="tab-pane fade show " id="published" role="tabpanel" aria-labelledby="published-tab">
                                    @foreach ($postsPublished as $post)
                                    <div class="blog">
                                        <a href="{{ route('profile.index', $post->user->slug) }}" class="blog-img"><img src="{{ asset('images/'. $post->user->profile->avarta) }}" alt=""></a>
                                        <div class="blog-body">
                                            <a href="{{ route('post.show',$post->slug) }}" class="blog-title">{{ $post->title }}</a>
                                            <div class="blog-categories">
                                                @foreach($post->category as $category)
                                                <a href="{{ route('category.show', $category->slug) }}" id="blog-category">{{ $category->name }}</a>
                                                @endforeach
                                            </div>
                                            <div class="author-delete-edit">
                                                @can('update', $post)
                                                <a href="{{ route('post.edit', $post->slug) }}">Chỉnh sửa bài viết</a>
                                                <a href="{{ route('post.destroy', $post->id) }}">Xóa bài viết</a>
                                                @endcan
                                                <a href="{{ route('post.unpublish', $post->id) }}" class="publishbtn">Unpuslish</a>
                                                
                                            </div>
                                            <!-- <div>{!! substr($post->content,0, 150) !!} ...</div> -->
                                            <div class="blog-other">
                                                <a href="{{ route('profile.index', $post->user->slug) }}">{{ $post->user->name }}</a>
                                                <p id="timePost" alt="0">   created at <span>{{ $post->created_at }}</span></p>
                                            </div>
                                        </div>
                                        <div class="blog-count-comment">
                                            {{ count($post->comment) }}
                                            <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-chat-left-dots" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                            <path fill-rule="evenodd" d="M14 1H2a1 1 0 0 0-1 1v11.586l2-2A2 2 0 0 1 4.414 11H14a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1zM2 0a2 2 0 0 0-2 2v12.793a.5.5 0 0 0 .854.353l2.853-2.853A1 1 0 0 1 4.414 12H14a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2H2z"/>
                                            <path d="M5 6a1 1 0 1 1-2 0 1 1 0 0 1 2 0zm4 0a1 1 0 1 1-2 0 1 1 0 0 1 2 0zm4 0a1 1 0 1 1-2 0 1 1 0 0 1 2 0z"/>
                                            </svg>
                                        </div>
                                    </div>
                                    @endforeach
                                </div>

                                @if(Auth::id() === $user->id  )
                                <div class="tab-pane fade show active" id="unpublish" role="tabpanel" aria-labelledby="unpublish-tab">
                                    @foreach ($postsUnpublish as $post)
                                    <div class="blog">
                                        <a href="{{ route('profile.index', $post->user->slug) }}" class="blog-img"><img src="{{ asset('images/'. $post->user->profile->avarta) }}" alt=""></a>
                                        <div class="blog-body">
                                            <a href="{{ route('post.show',$post->slug) }}" class="blog-title">{{ $post->title }}</a>
                                            <div class="blog-categories">
                                                @foreach($post->category as $category)
                                                <a href="{{ route('category.show', $category->slug) }}" id="blog-category">{{ $category->name }}</a>
                                                @endforeach
                                            </div>
                                            <div class="author-delete-edit">
                                                @can('update', $post)
                                                <a href="{{ route('post.edit', $post->slug) }}">Chỉnh sửa bài viết</a>
                                                <a href="{{ route('post.destroy', $post->id) }}">Xóa bài viết</a>
                                                @endcan
                                                <button type="button" data-post="{{ $post->id }}" class="btn btn-primary publishnow" data-bs-toggle="modal" data-bs-target="#exampleModal">
                                                    Publish
                                                </button>
                                            </div>
                                            <!-- <div>{!! substr($post->content,0, 150) !!} ...</div> -->
                                            <div class="blog-other">
                                                <a href="{{ route('profile.index', $post->user->slug) }}">{{ $post->user->name }}</a>
                                                <p id="timePost" alt="0">   created at <span>{{ $post->created_at }}</span></p>
                                            </div>
                                        </div>
                                        <div class="blog-count-comment">
                                            {{ count($post->comment) }}
                                            <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-chat-left-dots" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                            <path fill-rule="evenodd" d="M14 1H2a1 1 0 0 0-1 1v11.586l2-2A2 2 0 0 1 4.414 11H14a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1zM2 0a2 2 0 0 0-2 2v12.793a.5.5 0 0 0 .854.353l2.853-2.853A1 1 0 0 1 4.414 12H14a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2H2z"/>
                                            <path d="M5 6a1 1 0 1 1-2 0 1 1 0 0 1 2 0zm4 0a1 1 0 1 1-2 0 1 1 0 0 1 2 0zm4 0a1 1 0 1 1-2 0 1 1 0 0 1 2 0z"/>
                                            </svg>
                                        </div>
                                    </div>
                                    
                                    @endforeach
                                </div>

                                <div class="modal fade" id="exampleModal" tabindex="-1" data-bs-backdrop="static" data-bs-keyboard="false" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            
                                            <a href="{{ route('post.publish', $post->id) }}" id="parameterPost">Publish now</a>
                                            <div class="setPublish">
                                                <label>Publish theo thời gian</label>
                                                <input type="datetime-local">
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                        <button type="button" class="btn btn-primary">Save changes</button>
                                        </div>
                                    </div>
                                    </div>
                                </div>
                                @endif
                                
                                
                            </div>
                        </div>
                    </div>
                    <div class="col-md-2"></div>  
                </div>
            </div>
        </div>
        <script>
            $(document).ready(function(){
                $(".publishnow").click(function(){
                    let id = $(this).attr('data-post');
                    let route = "{{ route('post.publish',3) }}";
                    let url = route.replace('3',id);
                    $('#parameterPost').attr('href',url);
                })
            })
        </script>
    </div>
@endsection