@extends('layouts.master')

@section('title', $category->name)

@section('content-master')
<div class="blogs">
    @if(count($posts) === 0)
    <?php echo 'Không có bài viết nào.' ?>    
    @else
    <h1 id="blog-category">{{ $category->name }}</h1>
    @foreach ($posts as $post)
    <div class="blog">
        <a href="{{ route('profile.index', $post->user->slug ) }}" class="blog-img">
        <img src="{{ asset('images/'. $post->user->profile->avarta) }}" alt="">
        </a>
        <div class="blog-body">
            <a href="{{ route('post.show',$post->slug) }}" class="blog-title">{{ $post->title }}</a>
            <div class="blog-categories">
                @foreach($post->category as $category)
                <a href="{{ route('category.show', $category->slug) }}" class="categories-item">#{{ $category->name }}</a>
                @endforeach
            </div>
            <div class="author-delete-edit">
                @can('update', $post)
                <a href="{{ route('post.edit', $post->slug) }}">Chỉnh sửa bài viết</a>
                <a href="{{ route('post.destroy', $post->id) }}">Xóa bài viết</a>
                @endcan
            </div>
            <!-- <div>{!! substr($post->content,0, 150) !!} ...</div> -->
            <div class="blog-other">
                <a href="{{ route('profile.index', $post->user->slug ) }}">{{ $post->user->name }}</a>
                <p id="timePost" alt="0">   đăng <span class="timeAgo">{{ $post->created_at }}</span></p>
            </div>
        </div>
        <div class="blog__view-count-edit">
            <div class="count-comment">
                {{ count($post->comment) }}
                <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-chat-left-dots" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                <path fill-rule="evenodd" d="M14 1H2a1 1 0 0 0-1 1v11.586l2-2A2 2 0 0 1 4.414 11H14a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1zM2 0a2 2 0 0 0-2 2v12.793a.5.5 0 0 0 .854.353l2.853-2.853A1 1 0 0 1 4.414 12H14a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2H2z"/>
                <path d="M5 6a1 1 0 1 1-2 0 1 1 0 0 1 2 0zm4 0a1 1 0 1 1-2 0 1 1 0 0 1 2 0zm4 0a1 1 0 1 1-2 0 1 1 0 0 1 2 0z"/>
                </svg>
            </div>
            <div class="count-view">
                {{ $post->view }}
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-eye" viewBox="0 0 16 16">
                <path d="M16 8s-3-5.5-8-5.5S0 8 0 8s3 5.5 8 5.5S16 8 16 8zM1.173 8a13.133 13.133 0 0 1 1.66-2.043C4.12 4.668 5.88 3.5 8 3.5c2.12 0 3.879 1.168 5.168 2.457A13.133 13.133 0 0 1 14.828 8c-.058.087-.122.183-.195.288-.335.48-.83 1.12-1.465 1.755C11.879 11.332 10.119 12.5 8 12.5c-2.12 0-3.879-1.168-5.168-2.457A13.134 13.134 0 0 1 1.172 8z"/>
                <path d="M8 5.5a2.5 2.5 0 1 0 0 5 2.5 2.5 0 0 0 0-5zM4.5 8a3.5 3.5 0 1 1 7 0 3.5 3.5 0 0 1-7 0z"/>
                </svg>
            </div>
        </div>
    </div>
    @endforeach
    @endif
    
</div>
@endsection