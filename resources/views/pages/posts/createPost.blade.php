@extends('layouts.app')

@section('title', 'Viết bài')

@section('content')
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
        
        
        <form id="form-add-post" method="POST" action="{{ route('post.store') }}">
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
                <div class="categoriesform">
                @foreach($category as $category )
                <input type="checkbox" class="select-category"  id="{{ $category->id }}" name="categorySelect[]" value="{{ $category->id }}">
                <label for="{{ $category->id }}"> {{ $category->name }}</label><br>
                @endforeach
                </div>
                <!-- <button type="button" class="add-category" data-toggle="modal" data-target="#exampleModal">
                    Thêm chủ đề
                </button> -->

            </div>
            <div class="form-group">
                <label for="exampleFormControlTextarea1">Nội dung</label>
                <textarea name="content" class="form-control my-editor" ></textarea>
            </div>
            <button type="submit" class="btn btn-primary" id="savePost">Lưu bài viết</button>
            <button type="submit" class="btn btn-primary" id="publishPost">Đăng bài viết</button>
        </form>
        
        
        <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <form action="{{ route('category.store') }}" class="form-category"  method="POST">
                <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title " id="exampleModalLabel">Thêm chủ đề</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        @csrf
                        <input name="name" type="text" class="form-control" id="name-category">
                        <input name="slug" type="hidden" value="" id="slug-category">
                        
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <input type="submit" id="add-category" class="btn btn-primary" value="Submit">
                </div>
                </div>
            </form>
        </div>
        </div>

       <script type='text/javascript'>
        function TitleToSLug() {
            let title = $("#title-post");
            let slug = $("#slug-post");
            title.keyup(function(){
                let textSlug = slugfnc(title.val());
                slug.val(textSlug);
            });
        }

        function CategoryToSlug() {
            let name = $("#name-category");
            let slug = $("#slug-category");
            name.keyup(function(){
                let textSlug = slugfnc(name.val());
                slug.val(textSlug);
            })
        }

        function ajaxPost($isPost) {
            
            let arrCategory = [];
            tinyMCE.triggerSave();
            $('input[type=checkbox]:checked').map(function(_, el) {
                arrCategory.push($(el).val());
            }).get();
            let _token = $("input[name=_token]").val();
            let title = $("#title-post").val();
            let slug = $("#slug-post").val();
            let content = $(".my-editor").val();
            $.ajax({
                type : "POST",
                url: "{{ route('post.store') }}",
                data: {
                    _token : _token,
                    title: title,
                    slug: slug,
                    published: $isPost,
                    content: content,
                    user_id: '{{ Auth::id() }}',
                    categorySelect: arrCategory,
                },
                success: function(data) {
                }
            })
        }

        $(document).on('click', '#savePost', function (e){
            e.preventDefault();
            $isPost = 0;
            console.log(ajaxPost($isPost));
            if(ajaxPost($isPost)) {
                alert("Đã lưu bài viết");
            };
        })
        $(document).on('click', '#publishPost', function (e){
            e.preventDefault();
            $isPost = 1;
            if(ajaxPost($isPost)) {
                alert("Đã đăng bài viết");
            };
        })
        $(document).on('submit', '.form-category', function(e){
            e.preventDefault();
            let _token = $("input[name=_token]").val();
            
            $.ajax({
                type : "POST",
                cache: false,
                url: "{{ route('category.store') }}",
                data: {
                    _token : _token,
                    name: $("#name-category").val(),
                    slug: $("#slug-category").val()
                },
                success: function(data) {
                    let obj = data;
                    let str = `
                    <input type="checkbox" id="`+ data.id +`" name="categorySelect[]" value="`+ data.id +`">
                    <label for="`+ data.id +`">`+  data.name +`</label><br>
                    `;
                    $(".categoriesform").append(str);
                }
            })

        })
        $(document).ready(function() {            
            TitleToSLug();
            CategoryToSlug();
        })
       </script>
    </div>
@endsection

