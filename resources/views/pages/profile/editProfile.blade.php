@extends('layouts.app')

@section('title', 'update profile')

@section('content')
    <div class="container profile-edit">
    <ul class="nav edit-nav nav-pills nav-stacked" id="myTab" role="tablist">
        <li class="nav-item" role="presentation">
            <a class="nav-link active" id="user-tab" data-bs-toggle="tab" href="#userTab" aria-selected="true">
            <span>
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-person-fill" viewBox="0 0 16 16">
            <path d="M3 14s-1 0-1-1 1-4 6-4 6 3 6 4-1 1-1 1H3zm5-6a3 3 0 1 0 0-6 3 3 0 0 0 0 6z"/>
            </svg>
            </span>
            Tài khoản
            </a>
        </li>
        <li class="nav-item" role="presentation">
            <a class="nav-link " id="unpublish-tab" data-bs-toggle="tab" href="#passwordTab" aria-selected="false">
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-shield-lock-fill" viewBox="0 0 16 16">
            <path fill-rule="evenodd" d="M8 0c-.69 0-1.843.265-2.928.56-1.11.3-2.229.655-2.887.87a1.54 1.54 0 0 0-1.044 1.262c-.596 4.477.787 7.795 2.465 9.99a11.777 11.777 0 0 0 2.517 2.453c.386.273.744.482 1.048.625.28.132.581.24.829.24s.548-.108.829-.24a7.159 7.159 0 0 0 1.048-.625 11.775 11.775 0 0 0 2.517-2.453c1.678-2.195 3.061-5.513 2.465-9.99a1.541 1.541 0 0 0-1.044-1.263 62.467 62.467 0 0 0-2.887-.87C9.843.266 8.69 0 8 0zm0 5a1.5 1.5 0 0 1 .5 2.915l.385 1.99a.5.5 0 0 1-.491.595h-.788a.5.5 0 0 1-.49-.595l.384-1.99A1.5 1.5 0 0 1 8 5z"/>
            </svg>
            Mật khẩu
            </a>
        </li>
    </ul>
    <div class="tab-content" id="myTabContent">
        <div class="tab-pane fade show active" id="userTab" >
            <form method="POST" action="{{ route('profile.update', Auth::id()) }}" enctype="multipart/form-data">
                @csrf
                <section>
                    <label for="">Ảnh đại diện</label>
                    <input type="file" onchange="readURL(this)" accept="image/png, image/jpeg" class="file-upload-input"  name="avarta" id="avarta-edit">
                    <div class="img-edit">
                        <img class="file-upload-image" src="{{ asset('images/'. $profile->avarta) }}" alt="">
                        <div id="inputFile">
                            <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="currentColor" class="bi bi-camera-fill" viewBox="0 0 16 16">
                                <path d="M10.5 8.5a2.5 2.5 0 1 1-5 0 2.5 2.5 0 0 1 5 0z"/>
                                <path d="M2 4a2 2 0 0 0-2 2v6a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V6a2 2 0 0 0-2-2h-1.172a2 2 0 0 1-1.414-.586l-.828-.828A2 2 0 0 0 9.172 2H6.828a2 2 0 0 0-1.414.586l-.828.828A2 2 0 0 1 3.172 4H2zm.5 2a.5.5 0 1 1 0-1 .5.5 0 0 1 0 1zm9 2.5a3.5 3.5 0 1 1-7 0 3.5 3.5 0 0 1 7 0z"/>
                            </svg>
                        </div>
                        
                    </div>
                </section>
                <br>
                <div class="row">
                    <div class="col-md-6">
                    <section>
                        <label for="">Tên</label>
                        <div class="group-input">
                            <span id="social-icon">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-person-fill" viewBox="0 0 16 16">
                            <path d="M3 14s-1 0-1-1 1-4 6-4 6 3 6 4-1 1-1 1H3zm5-6a3 3 0 1 0 0-6 3 3 0 0 0 0 6z"/>
                            </svg>
                            </span>
                            <input type="text" name="name" id="name-edit" value="{{ Auth::user()->name }}">
                        </div>
                    </section>
                    </div>
                    <div class="col-md-6">
                    <section>
                        <label for="">Short name</label>
                        <div class="group-input">
                            <span id="social-icon">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-person-fill" viewBox="0 0 16 16">
                            <path d="M3 14s-1 0-1-1 1-4 6-4 6 3 6 4-1 1-1 1H3zm5-6a3 3 0 1 0 0-6 3 3 0 0 0 0 6z"/>
                            </svg>
                            </span>
                            <input type="text" disabled name="slug" id="slug-edit" value="{{ Auth::user()->slug }}">
                        </div>
                    </section>
                    </div>
                    <!-- crop image https://www.jqueryscript.net/other/Image-Resize-Crop-imageResizer.html -->
                </div>

                <br>
                <div class="row">
                    <div class="col-md-6">
                    <section>
                        <label for="">Số điện thoại</label>
                        <div class="group-input">
                            <span id="social-icon">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-telephone-fill" viewBox="0 0 16 16">
                            <path fill-rule="evenodd" d="M1.885.511a1.745 1.745 0 0 1 2.61.163L6.29 2.98c.329.423.445.974.315 1.494l-.547 2.19a.678.678 0 0 0 .178.643l2.457 2.457a.678.678 0 0 0 .644.178l2.189-.547a1.745 1.745 0 0 1 1.494.315l2.306 1.794c.829.645.905 1.87.163 2.611l-1.034 1.034c-.74.74-1.846 1.065-2.877.702a18.634 18.634 0 0 1-7.01-4.42 18.634 18.634 0 0 1-4.42-7.009c-.362-1.03-.037-2.137.703-2.877L1.885.511z"/>
                            </svg>
                            </span>
                            <input type="tel" placeholder="Số điện thoại" name="phoneNumber" id="phoneNumber-edit" value="{{ $profile->phoneNumber }}">
                        </div>
                    </section>
                    </div>
                    <div class="col-md-6">
                        <section>
                            <label for="">Ngày sinh</label>
                            <div class="group-input">
                                <!-- <span id="social-icon">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-person-fill" viewBox="0 0 16 16">
                                <path d="M3 14s-1 0-1-1 1-4 6-4 6 3 6 4-1 1-1 1H3zm5-6a3 3 0 1 0 0-6 3 3 0 0 0 0 6z"/>
                                </svg> -->
                                </span>
                                <input type="date" name="birthday" id="birthday-edit" value="{{ $profile->birthday }}">
                            </div>
                        </section>
                    </div>
                </div>
                
                <br>

                
                <section>
                    <label for="">Social</label>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="group-input">
                                <span id="social-icon" class="social-fb">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-facebook" viewBox="0 0 16 16">
                                        <path d="M16 8.049c0-4.446-3.582-8.05-8-8.05C3.58 0-.002 3.603-.002 8.05c0 4.017 2.926 7.347 6.75 7.951v-5.625h-2.03V8.05H6.75V6.275c0-2.017 1.195-3.131 3.022-3.131.876 0 1.791.157 1.791.157v1.98h-1.009c-.993 0-1.303.621-1.303 1.258v1.51h2.218l-.354 2.326H9.25V16c3.824-.604 6.75-3.934 6.75-7.951z"/>
                                    </svg>
                                </span>
                                <input type="text" name="fbsocial" id="fbsocial-edit"  value="{{ $profile->fbsocial }}" placeholder="URL Facebook">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="group-input">
                                <span id="social-icon" class="social-linkedin">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-linkedin" viewBox="0 0 16 16">
                                    <path d="M0 1.146C0 .513.526 0 1.175 0h13.65C15.474 0 16 .513 16 1.146v13.708c0 .633-.526 1.146-1.175 1.146H1.175C.526 16 0 15.487 0 14.854V1.146zm4.943 12.248V6.169H2.542v7.225h2.401zm-1.2-8.212c.837 0 1.358-.554 1.358-1.248-.015-.709-.52-1.248-1.342-1.248-.822 0-1.359.54-1.359 1.248 0 .694.521 1.248 1.327 1.248h.016zm4.908 8.212V9.359c0-.216.016-.432.08-.586.173-.431.568-.878 1.232-.878.869 0 1.216.662 1.216 1.634v3.865h2.401V9.25c0-2.22-1.184-3.252-2.764-3.252-1.274 0-1.845.7-2.165 1.193v.025h-.016a5.54 5.54 0 0 1 .016-.025V6.169h-2.4c.03.678 0 7.225 0 7.225h2.4z"/>
                                </svg>
                                </span>
                                <input type="text" name="linkedInsocial" id="linkedInSocial-edit" value="{{ $profile->linkedInSocial }}" placeholder="URL LinkedIn">
                            </div>
                        </div>

                    </div>

                </section>
                <br>
                <button id="save-edit-profile">Lưu</button>
            </form>
        </div>
        <div class="tab-pane fade show " id="passwordTab">
            {{ $profile }}
        </div>
    </div>
        <script>
            $(document).ready(function() {
                
                // $("#save-edit-profile").click(function(){
                //     let avarta = $("#avarta-edit").prop('files');
                //     let name = $("#name-edit").val();
                //     let shortname = $("#slug-edit").val();
                //     let phoneNumber = $("#phoneNumber-edit").val();
                //     let birthday = $("#birthday-edit").val();
                //     let fbsocial = $("#fbsocial-edit").val();
                //     let linkedInSocial = $("#linkedInSocial-edit").val();

                //     $.ajax({
                //         type: "POST",
                //         url: "{{ route('profile.update', Auth::id()) }}",
                //         data: {
                //             avarta: avarta,
                //             name: name,
                //             slug: shortname,
                //             phoneNumber: phoneNumber,
                //             birthday: birthday,
                //             fbsocial: fbsocial,
                //             linkedInSocial: linkedInSocial
                //         },
                //         success: function(data)
                //         {
                //             console.log(data);
                //         }
                //     })

                // })
                
            })
            
        </script>
        <script>
            $(document).on('click', '#inputFile', function(){
                $('.file-upload-input').trigger('click'); 
            })
            function readURL(input) {
                if (input.files && input.files[0]) {
                    var reader = new FileReader();
                    reader.onload = function(e) {
                    $('.file-upload-image').attr('src', e.target.result);
                    };
                    reader.readAsDataURL(input.files[0]);
                }
            }
        </script>
    </div>
@endsection