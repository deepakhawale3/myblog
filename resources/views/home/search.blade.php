@extends('layouts.app')
@section('content')

<!-- Breadcrumb Start -->
<div class="container-fluid">
    <div class="container">
        <nav class="breadcrumb bg-transparent m-0 p-0">
            <a class="breadcrumb-item" href="#">Home</a>
            <span class="breadcrumb-item active">Search</span>
        </nav>
    </div>
</div>
<!-- Breadcrumb End -->


<!-- Blogs With Sidebar Start -->
<div class="container-fluid py-3">
    <div class="container">
        <div class="row">
            <div class="col-lg-8">
                <div class="row">
                    <div class="col-12">
                        <div class="d-flex align-items-center justify-content-between bg-light py-2 px-4 mb-3">
                            <h3 class="m-0">Search Results: {{$keyword}}</h3>
                            
                        </div>
                    </div>
                    @foreach($blogs as $blog)
                    <div class="col-lg-6">
                            <div class="position-relative mb-3">
                                <img class="img-fluid w-100" src="{{ asset("public/images/{$blog->img}") }}" alt="Blog Image" style="object-fit: cover; width: 200px; height: 200px;">
                                <div class="overlay position-relative bg-light">
                                    <div class="mb-2" style="font-size: 14px;">
                                        <a href="">{{ $blog->category }}</a>
                                        <span class="px-1">/</span>
                                        <span>{{ $blog->created_at->format('F d, Y') }}</span>
                                    </div>
                                    <a class="h4" href="{{ route('blog.show', ['blogSlug' => $blog->slug]) }}">{{ $blog->title }}</a>
                                    <p class="m-0">{{ Str::limit(strip_tags($blog->description), 150) }}</p>
                                </div>
                            </div>  
                    </div>
                    @endforeach
                    
                </div>

                
            </div>

            <div class="col-lg-4 pt-3 pt-lg-0">
                <!-- Social Follow Start -->
                <div class="pb-3">
                    <div class="bg-light py-2 px-4 mb-3">
                        <h3 class="m-0">Follow Us</h3>
                    </div>
                    <div class="d-flex mb-3">
                        <a href="" class="d-block w-50 py-2 px-3 text-white text-decoration-none mr-2" style="background: #39569E;">
                            <small class="fab fa-facebook-f mr-2"></small><small>12,345 Fans</small>
                        </a>
                        <a href="" class="d-block w-50 py-2 px-3 text-white text-decoration-none ml-2" style="background: #52AAF4;">
                            <small class="fab fa-twitter mr-2"></small><small>12,345 Followers</small>
                        </a>
                    </div>
                    <div class="d-flex mb-3">
                        <a href="" class="d-block w-50 py-2 px-3 text-white text-decoration-none mr-2" style="background: #0185AE;">
                            <small class="fab fa-linkedin-in mr-2"></small><small>12,345 Connects</small>
                        </a>
                        <a href="" class="d-block w-50 py-2 px-3 text-white text-decoration-none ml-2" style="background: #C8359D;">
                            <small class="fab fa-instagram mr-2"></small><small>12,345 Followers</small>
                        </a>
                    </div>
                    <div class="d-flex mb-3">
                        <a href="" class="d-block w-50 py-2 px-3 text-white text-decoration-none mr-2" style="background: #DC472E;">
                            <small class="fab fa-youtube mr-2"></small><small>12,345 Subscribers</small>
                        </a>
                        <a href="" class="d-block w-50 py-2 px-3 text-white text-decoration-none ml-2" style="background: #1AB7EA;">
                            <small class="fab fa-vimeo-v mr-2"></small><small>12,345 Followers</small>
                        </a>
                    </div>
                </div>
                <!-- Social Follow End -->

                <!-- Newsletter Start -->
                <div class="pb-3">
                    <div class="bg-light py-2 px-4 mb-3">
                        <h3 class="m-0">Newsletter</h3>
                    </div>
                    <div class="bg-light text-center p-4 mb-3">
                        <p>Please Enter Your Email for Subscribe Newsletter</p>
                        <form action="{{ route('subscribe.newsletter') }}" method="post" class="input-group" style="width: 100%;">
                            @csrf
                            <input type="text" name="email" class="form-control form-control-lg" placeholder="Your Email">
                            <div class="input-group-append">
                                <button type="submit" class="btn btn-primary">Send</button>
                            </div>
                        </form>
                    </div>
                </div>
                <!-- Newsletter End -->

                

                <!-- Popular Blogs Start -->
                <div class="pb-3">
                    <div class="bg-light py-2 px-4 mb-3">
                        <h3 class="m-0">Tranding</h3>
                    </div>
                    @foreach($randomBlogs as $randomBlog)
                        <div class="d-flex mb-3">
                            <img src="{{ asset("public/images/{$randomBlog->img}") }}" style="width: 100px; height: 100px; object-fit: cover;">
                            <div class="w-100 d-flex flex-column justify-content-center bg-light px-3" style="height: 100px;">
                                <div class="mb-1" style="font-size: 13px;">
                                    <a href="{{ route('category.show', $randomBlog->category) }}">{{ $randomBlog->category }}</a>
                                    <span class="px-1">/</span>
                                    <span>{{ $randomBlog->created_at->format('F d, Y') }}</span>
                                </div>
                                <a class="h6 m-0" href="{{ route('blog.show', ['blogSlug' => $randomBlog->slug]) }}">{{ \Str::limit($randomBlog->title, 30) }}</a>
                            </div>
                        </div>
                    @endforeach


                    
                    
                    
                    
                </div>
                <!-- Popular Blogs End -->

                
            </div>
        </div>
    </div>
</div>
</div>
<!-- News With Sidebar End -->
<!-- Include SweetAlert2 script -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
    @if(session('success'))
    Swal.fire({
        title: 'Success!',
        text: '{{ session('success') }}',
        icon: 'success',
        confirmButtonText: 'OK'
    });
@endif
</script>
@endsection