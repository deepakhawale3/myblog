@extends('layouts.app')
@section('content')


    <!-- Top Blogs Slider Start -->
    <div class="container-fluid py-3">
        <div class="container">
            <div class="owl-carousel owl-carousel-2 carousel-item-3 position-relative">
                @foreach($allBlogs as $blog)
                    <div class="d-flex">
                        <img src="{{ asset("public/images/$blog->img") }}" style="width: 80px; height: 80px; object-fit: cover;">
                        <div class="d-flex align-items-center bg-light px-3" style="height: 80px;">
                            <a class="text-secondary font-weight-semi-bold" href="{{ route('blog.show', ['blogSlug' => $blog->slug]) }}"> {{ strlen($blog->title) > 50 ? substr($blog->title, 0, 50) . '...' : $blog->title }}</a>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>

    <!-- Top Blogs Slider End -->


    <!-- Main Blogs Slider Start -->
    <div class="container-fluid py-3">
        <div class="container">
            <div class="row">
                <div class="col-lg-8">
                    <div class="owl-carousel owl-carousel-2 carousel-item-1 position-relative mb-3 mb-lg-0">
                        @foreach($allBlogs as $blog)
                            <div class="position-relative overflow-hidden" style="height: 435px;">
                                <img class="img-fluid h-100" src="{{ asset("public/images/$blog->img") }}" style="object-fit: cover;">
                                <div class="overlay">
                                    <div class="mb-1">
                                        <a class="text-white" href="{{ route('category.show', ['categorySlug' => $blog->category]) }}">{{ $blog->category }}</a>
                                        <span class="px-2 text-white">/</span>
                                        <a class="text-white" href="">{{ date('F j, Y', strtotime($blog->created_at)) }}</a>
                                    </div>
                                    <a class="h2 m-0 text-white font-weight-bold" href="{{ route('blog.show', ['blogSlug' => $blog->slug]) }}">
                                        {{ strlen($blog->title) > 50 ? substr($blog->title, 0, 70) . '...' : $blog->title }}
                                    </a>
                                    
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
                
                <div class="col-lg-4">
                    <div class="d-flex align-items-center justify-content-between bg-light py-2 px-4 mb-3">
                        <h3 class="m-0">Categories</h3>
                        
                    </div>
                    <div class="position-relative overflow-hidden mb-3" style="height: 80px;">
                        <img class="img-fluid w-100 h-100" src="{{ asset("public/images/background.jpg") }}" style="object-fit: cover;">
                        <a href="{{ route('category.show', ['categorySlug' => 'Business']) }}" class="overlay align-items-center justify-content-center h4 m-0 text-white text-decoration-none">
                            Business
                        </a>
                    </div>
                    <div class="position-relative overflow-hidden mb-3" style="height: 80px;">
                        <img class="img-fluid w-100 h-100" src="{{ asset("public/images/background.jpg") }}" style="object-fit: cover;">
                        <a href="{{ route('category.show', ['categorySlug' => 'Educational']) }}" class="overlay align-items-center justify-content-center h4 m-0 text-white text-decoration-none">
                            Educational
                        </a>
                    </div>
                    <div class="position-relative overflow-hidden mb-3" style="height: 80px;">
                        <img class="img-fluid w-100 h-100" src="{{ asset("public/images/background.jpg") }}" style="object-fit: cover;">
                        <a href="{{ route('category.show', ['categorySlug' => 'Entertainment']) }}" class="overlay align-items-center justify-content-center h4 m-0 text-white text-decoration-none">
                            Entertainment
                        </a>
                    </div>
                    <div class="position-relative overflow-hidden" style="height: 80px;">
                        <img class="img-fluid w-100 h-100" src="{{ asset("public/images/background.jpg") }}" style="object-fit: cover;">
                        <a href="{{ route('category.show', ['categorySlug' => 'Sports']) }}" class="overlay align-items-center justify-content-center h4 m-0 text-white text-decoration-none">
                            Sports
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Main Blogs Slider End -->


    <!-- Featured Blogs Slider Start -->
    <div class="container-fluid py-3">
        <div class="container">
            <div class="d-flex align-items-center justify-content-between bg-light py-2 px-4 mb-3">
                <h3 class="m-0">Featured</h3>
                <a class="text-secondary font-weight-medium text-decoration-none" href="">View All</a>
            </div>
            <div class="owl-carousel owl-carousel-2 carousel-item-4 position-relative">
                @foreach ($randomBlogs as $blog)
                    <div class="position-relative overflow-hidden" style="height: 300px;">
                        <img class="img-fluid w-100 h-100" src="{{ asset("public/images/{$blog->img}") }}" alt="Blog Image" style="object-fit: cover;">
                        <div class="overlay">
                            <div class="mb-1" style="font-size: 13px;">
                                <a class="text-white" href="{{ route('category.show', ['categorySlug' => $blog->category]) }}">{{ $blog->category }}</a>
                                <span class="px-1 text-white">/</span>
                                <a class="text-white" href="">{{ $blog->created_at->format('F d, Y') }}</a>
                            </div>
                            <a class="h4 m-0 text-white" href="{{ route('blog.show', ['blogSlug' => $blog->slug]) }}">{{ \Str::limit($blog->title, 50) }}</a>
                        </div>
                    </div>
                @endforeach
            </div>
            
        </div>
    </div>
    </div>
    <!-- Featured Blogs Slider End -->


    <!-- Category Blogs Slider Start -->
    <div class="container-fluid">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 py-3">
                    <div class="bg-light py-2 px-4 mb-3">
                        <h3 class="m-0">Healthcare</h3>
                    </div>
                    <div class="owl-carousel owl-carousel-3 carousel-item-2 position-relative">
                        @foreach ($healthcareBlogs as $blog)
                            <div class="position-relative">
                                <img class="img-fluid w-100" src="{{ asset("public/images/{$blog->img}") }}" alt="Blog Image" style="object-fit: cover; width: 160px; height: 130px;">

                                <div class="overlay position-relative bg-light">
                                    <div class="mb-2" style="font-size: 12px;">
                                        <a href="{{ route('category.show', ['categorySlug' => $blog->category]) }}">{{ $blog->category }}</a>
                                        <span class="px-1">/</span>
                                        <span>{{ $blog->created_at->format('F d, Y') }}</span>
                                    </div>
                                    <a class="h5 m-0" href="{{ route('blog.show', ['blogSlug' => $blog->slug]) }}">{{ \Str::limit($blog->title, 30) }}</a>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
                <div class="col-lg-6 py-3">
                    <div class="bg-light py-2 px-4 mb-3">
                        <h3 class="m-0">Entertainment</h3>
                    </div>
                    <div class="owl-carousel owl-carousel-3 carousel-item-2 position-relative">
                        @foreach ($entertainmentBlogs as $blog)
                            <div class="position-relative">
                                <img class="img-fluid w-100" src="{{ asset("public/images/{$blog->img}") }}" alt="Blog Image" style="object-fit: cover; width: 160px; height: 130px;">

                                <div class="overlay position-relative bg-light">
                                    <div class="mb-2" style="font-size: 12px;">
                                        <a href="{{ route('category.show', ['categorySlug' => $blog->category]) }}">{{ $blog->category }}</a>
                                        <span class="px-1">/</span>
                                        <span>{{ $blog->created_at->format('F d, Y') }}</span>
                                    </div>
                                    <a class="h5 m-0" href="{{ route('blog.show', ['blogSlug' => $blog->slug]) }}">{{ \Str::limit($blog->title, 30) }}</a>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
                <div class="col-lg-6 py-3">
                    <div class="bg-light py-2 px-4 mb-3">
                        <h3 class="m-0">Educational</h3>
                    </div>
                    <div class="owl-carousel owl-carousel-3 carousel-item-2 position-relative">
                        @foreach ($educationalBlogs as $blog)
                            <div class="position-relative">
                                <img class="img-fluid w-100" src="{{ asset("public/images/{$blog->img}") }}" alt="Blog Image" style="object-fit: cover; width: 160px; height: 130px;">

                                <div class="overlay position-relative bg-light">
                                    <div class="mb-2" style="font-size: 12px;">
                                        <a href="{{ route('category.show', ['categorySlug' => $blog->category]) }}">{{ $blog->category }}</a>
                                        <span class="px-1">/</span>
                                        <span>{{ $blog->created_at->format('F d, Y') }}</span>
                                    </div>
                                    <a class="h5 m-0" href="{{ route('blog.show', ['blogSlug' => $blog->slug]) }}">{{ \Str::limit($blog->title, 30) }}</a>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>

                <div class="col-lg-6 py-3">
                    <div class="bg-light py-2 px-4 mb-3">
                        <h3 class="m-0">Business</h3>
                    </div>
                    <div class="owl-carousel owl-carousel-3 carousel-item-2 position-relative">
                        @foreach ($businessBlogs as $blog)
                            <div class="position-relative">
                                <img class="img-fluid w-100" src="{{ asset("public/images/{$blog->img}") }}" alt="Blog Image" style="object-fit: cover; width: 160px; height: 130px;">

                                <div class="overlay position-relative bg-light">
                                    <div class="mb-2" style="font-size: 12px;">
                                        <a href="{{ route('category.show', ['categorySlug' => $blog->category]) }}">{{ $blog->category }}</a>
                                        <span class="px-1">/</span>
                                        <span>{{ $blog->created_at->format('F d, Y') }}</span>
                                    </div>
                                    <a class="h5 m-0" href="{{ route('blog.show', ['blogSlug' => $blog->slug]) }}">{{ \Str::limit($blog->title, 30) }}</a>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>

                <div class="col-lg-6 py-3">
                    <div class="bg-light py-2 px-4 mb-3">
                        <h3 class="m-0">Economical</h3>
                    </div>
                    <div class="owl-carousel owl-carousel-3 carousel-item-2 position-relative">
                        @foreach ($economicalBlogs as $blog)
                            <div class="position-relative">
                                <img class="img-fluid w-100" src="{{ asset("public/images/{$blog->img}") }}" alt="Blog Image" style="object-fit: cover; width: 160px; height: 130px;">

                                <div class="overlay position-relative bg-light">
                                    <div class="mb-2" style="font-size: 12px;">
                                        <a href="{{ route('category.show', ['categorySlug' => $blog->category]) }}">{{ $blog->category }}</a>
                                        <span class="px-1">/</span>
                                        <span>{{ $blog->created_at->format('F d, Y') }}</span>
                                    </div>
                                    <a class="h5 m-0" href="{{ route('blog.show', ['blogSlug' => $blog->slug]) }}">{{ \Str::limit($blog->title, 30) }}</a>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>

                <div class="col-lg-6 py-3">
                    <div class="bg-light py-2 px-4 mb-3">
                        <h3 class="m-0">Sports</h3>
                    </div>
                    <div class="owl-carousel owl-carousel-3 carousel-item-2 position-relative">
                        @foreach ($sportsBlogs as $blog)
                            <div class="position-relative">
                                <img class="img-fluid w-100" src="{{ asset("public/images/{$blog->img}") }}" alt="Blog Image" style="object-fit: cover; width: 160px; height: 130px;">

                                <div class="overlay position-relative bg-light">
                                    <div class="mb-2" style="font-size: 12px;">
                                        <a href="{{ route('category.show', ['categorySlug' => $blog->category]) }}">{{ $blog->category }}</a>
                                        <span class="px-1">/</span>
                                        <span>{{ $blog->created_at->format('F d, Y') }}</span>
                                    </div>
                                    <a class="h5 m-0" href="{{ route('blog.show', ['blogSlug' => $blog->slug]) }}">{{ \Str::limit($blog->title, 30) }}</a>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
                
            </div>
        </div>
    </div>
    </div>
    <!-- Category Blogs Slider End -->


   


    <!-- Blogs With Sidebar Start -->
    <div class="container-fluid py-3">
        <div class="container">
            <div class="row">
                
                
                <div class="col-lg-6 pt-3 pt-lg-0">
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
                </div>

                <div class="col-lg-6 pt-3 pt-lg-0">
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

                    
                </div>
                    

                    
                </div>
            </div>
        </div>
    </div>
    </div>
    <!-- Blogs With Sidebar End -->
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