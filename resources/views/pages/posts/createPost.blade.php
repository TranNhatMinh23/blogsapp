@extends('layouts.app')

@section('title', 'Viết bài')

@section('content')    
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
            <div class="row">
                <div class="col-md-9">
                    <!--  alert notification -->
                    

                    <div class="form-group">
                        <input name="title" autocomplete="off" type="text" class="form-control" id="title-post" placeholder="Tiêu đề bài viết">
                    </div>
                    <input name="slug" type="hidden" value="" id="slug-post">
                    <input name="user_id" value="{{ Auth::id() }}" type="hidden" class="form-control">
                    <div class="form-group">
                        <textarea name="content" class="form-control my-editor" >content</textarea>
                    </div>
                    
                </div>
                <div class="col-md-3">
                    
                    <div class="form-group">
                        <label for="">Chủ đề</label>
                        <br>
                        <div class="categoriesform">
                        @foreach($category as $category )
                        <input type="checkbox" checked class="select-category"  id="{{ $category->id }}" name="categorySelect[]" value="{{ $category->id }}">
                        <label for="{{ $category->id }}"> {{ $category->name }}</label><br>
                        @endforeach
                        </div>

                        <!-- <div class="form-category">
                            <input name="name" autocomplete="off" type="text" class="" id="name-category" placeholder="Chủ đề..">
                            <input name="slug" type="hidden" value="" id="slug-category">
                            <button id="add-category">+</button>
                        </div> -->

                    </div>
                    
                    <div class="form-group">
                        <label for="">Trạng thái</label>
                        <br>
                        <input type="radio" name="publish" value="1" id="yesPublish">
                        <label for="yesPublish">Đăng bài viết</label>
                        <br>
                        <input type="radio" name="publish" value="0" id="noPublish">
                        <label for="noPublish">Lưu bản nháp</label>

                    </div>
                    
                    <button type="submit" class="btn btn-primary button-blog" id="savePost">Tạo bài viết</button>
                </div>
            </div>
        </form>
        


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

        function validateNew(title, content, category, publish) {
            if(title=='' || content=='' || category=='' || publish=='') {
                return false;
            }
            return true;
        }
        $(document).on('click', '#savePost', function (e){
            e.preventDefault();
            
            let arrCategory = [];
            $('input[type=checkbox]:checked').map(function(_, el) {
                arrCategory.push($(el).val());
            }).get();

            tinyMCE.triggerSave();
            let _token = $("input[name=_token]").val();
            
            let title = $("#title-post").val();
            let slug = $("#slug-post").val();
            let content = $(".my-editor").val();
            let published;
            let user_id = "{{ Auth::id() }}";

            let yes = $("#yesPublish");
            let no = $("#noPublish");
            yes.is(':checked') ? published=yes.val() : published=no.val();


            if(validateNew(title, content, arrCategory, published)) {
                $.ajax({
                    type: "POST",
                    url: "{{ route('post.store') }}",
                    data: {
                        _token: _token,
                        title: title,
                        slug: slug,
                        content: content,
                        published: published,
                        user_id: user_id,
                        categorySelect: arrCategory
                    },
                    success: function(data) {
                        console.log(data);
                        $('.toast').toast('show');
                        if(published == 0) {
                            $(".toast-body").html("Đã lưu bài viết");
                        }
                        else {
                            $(".toast-body").html("Đã đăng vào bản nháp");
                        }
                        
                    },
                    error: function(data) {
                        $('.toast').toast('show');
                        $(".toast-body").html("Xảy ra lỗi");
                    }
                })
            }

        })


        // add category
        $(document).on('click', '#add-category', function(e){
            e.preventDefault();

            $.ajax({
                type : "GET",
                url: "{{ route('category.store') }}",
                data: {
                    name: $("#name-category").val(),
                    slug: $("#slug-category").val()
                },
                success: function(data) {
                    console.log(data);
                    // let obj = data;
                    // let str = `
                    // <input type="checkbox" id="`+ data.id +`" name="categorySelect[]" value="`+ data.id +`">
                    // <label for="`+ data.id +`">`+  data.name +`</label><br>
                    // `;
                    // $(".categoriesform").append(str);
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

