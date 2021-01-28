@extends('layouts.master')

@section('title', 'Viết bài')

@section('content-master')
    <div class="container">

        
        @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif
        
        
        <form method="POST" action="{{ route('post.store') }}">
        @csrf
            <div class="form-group">
                <label for="">Tiêu đề bài viết</label>
                <input name="title" type="text" class="form-control" id="title-post" placeholder="Tiêu đề bài viết">
            </div>
            <input name="slug" type="hidden" value="" id="slug-post">
            <input name="user_id" value="{{ Auth::id() }}" type="hidden" class="form-control">
            <div class="form-group">
                <label for="">Chủ đề</label>
                <br>
                @foreach($category as $category )
                <input type="checkbox" id="{{ $category->id }}" name="categorySelect[]" value="{{ $category->id }}">
                <label for="{{ $category->id }}"> {{ $category->name }}</label><br>
                @endforeach
                
                <div class="addCategory">
                    <label>Chủ đề khác</label>
                    <input type="text" id="valueCategory" placeholder="Nhập thể loại mới...">
                    <button id="addCategory">Thêm</button>
                </div>

            </div>
            <div class="form-group">
                <label for="exampleFormControlTextarea1">Nội dung</label>
                <textarea name="content" class="form-control my-editor" ></textarea>
            </div>
            <button type="submit" class="btn btn-primary">Đăng bài viết</button>
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

