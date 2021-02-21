@extends('layouts.app')

@section('title', 'Edit bài viết')

@section('content')
    <div class="container">
        <form method="POST" action="{{ route('post.update', $post->id) }}">
        @csrf
            <div class="form-group">
                <label for="exampleFormControlInput1">Tiêu đề bài viết</label>
                <input name="title" value="{{ $post->title }}" type="text" class="form-control" id="title-post" placeholder="Title content">
                <input type="hidden" value="{{ $post->slug }}" name="slug" id="slug-post">
            </div>
            <input name="user_id" value="{{ Auth::id() }}" type="hidden" class="form-control" id="exampleFormControlInput1" placeholder="Title content" value="">
            <div class="form-group">
                <label for="">Chủ đề</label>
                <br>
                @foreach($categories as $category )
                <input type="checkbox" id="{{ $category->id }}" name="categorySelect[]" value="{{ $category->id }}">
                <label for="{{ $category->id }}"> {{ $category->name }}</label><br>
                @endforeach
            </div>

            <div class="form-group">
                <label for="exampleFormControlTextarea1">Nội dung</label>
                <textarea name="content" class="form-control my-editor" >{{ $post->content }}</textarea>
            </div>
            <button type="submit" class="btn btn-primary">Cập nhật</button>
        </form>

        <script>
            $(document).ready(function() {            
                let title = $("#title-post");
                let slug = $("#slug-post")
                title.keyup(function(){
                    var textSlug = slugfnc(title.val());
                    slug.val(textSlug);
                });
            })
        </script>
    </div>
@endsection