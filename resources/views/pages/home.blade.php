@extends('layouts.master')

@section('title', 'Home')

@section('content-master')
<div class="blogs">
    @foreach ($posts as $post)
    <div class="blog">
        <a href="{{ route('profile.index', $post->user->slug) }}" class="blog-img">
        <img src="{{ asset('images/'. $post->user->profile->avarta) }}" alt="">
        </a>
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
                <a href="{{ route('post.unpublish', $post->id) }}" class="publishbtn">Unpuslish</a>
                @endcan
            </div>
            <!-- <div>{!! trim(substr($post->content, 0 , 150)) !!} ...</div> -->
            <div class="blog-other">
                <a href="{{ route('profile.index', $post->user->slug )}}">{{ $post->user->name }}</a>
                <p id="timePost" alt="0">   đăng <span class="timeAgo{{$post->id}}">{{ $post->created_at }}</span></p>
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
@endsection