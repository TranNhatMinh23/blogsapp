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
                <div class="categoriesform">
                @foreach($category as $category )
                <input type="checkbox" id="{{ $category->id }}" name="categorySelect[]" value="{{ $category->id }}">
                <label for="{{ $category->id }}"> {{ $category->name }}</label><br>
                @endforeach
                </div>
                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
                    Thêm chủ đề
                </button>

            </div>
            <div class="form-group">
                <label for="exampleFormControlTextarea1">Nội dung</label>
                <textarea name="content" class="form-control my-editor" ></textarea>
            </div>
            <button type="submit" class="btn btn-primary">Đăng bài viết</button>
        </form>
        
        
        <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{ route('category.store') }}" class="form-category"  method="POST">
                    <div class="form-group">
                        @csrf
                        <label for="">Thêm chủ đề</label>
                        <input name="name" type="text" class="form-control" id="name-category">
                        <input name="slug" type="text" value="" id="slug-category">

                        <input type="submit" id="add-category" value="Thêm chủ đề">
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary">Save changes</button>
            </div>
            </div>
        </div>
        </div>

       <script>
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
        $(document).ready(function() {            
            TitleToSLug();
            CategoryToSlug();

            
            

            $(".form-category").submit(function(e){
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
                        <input type="checkbox" id="" name="categorySelect[]" value="">
                        <label for="">`+  data.name +`</label><br>
                        `;
                        $(".categoriesform").append(str);
                    }
                })

                
            })
        })
       </script>
    </div>
@endsection

