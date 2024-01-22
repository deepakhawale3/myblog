@extends('layouts.app')
@section('content')


<!-- Breadcrumb Start -->
<div class="container-fluid">
    <div class="container">
        <nav class="breadcrumb bg-transparent m-0 p-0">
            <a class="breadcrumb-item" href="#">Home</a>
            <a class="breadcrumb-item" href="">Category</a>
            <a class="breadcrumb-item" href="{{ route('category.show', ['categorySlug' => $blog->category]) }}">{{ $blog->category }}</a>
            <span class="breadcrumb-item active">{{ $blog->title }}</span>
        </nav>
    </div>
</div>
<!-- Breadcrumb End -->


<!-- Blogs With Sidebar Start -->
<div class="container-fluid py-3">
    <div class="container">
        <div class="row">
            <div class="col-lg-8">
                <!-- Blogs Detail Start -->
                <div class="position-relative mb-3">
                    <h3 class="mb-3">{{ $blog->title }}</h3>
                    <p >{{ $blog->introduction }}</p>
                    <img class="img-fluid w-100" src="{{ asset("public/images/{$blog->img}") }}" style="object-fit: cover;">
                    <div class="overlay position-relative bg-light">
                        <div class="mb-3">
                            <a href="{{ route('category.show', ['categorySlug' => $blog->category]) }}">{{ $blog->category }}</a>
                            <span class="px-1">/</span>
                            <span>{{ $blog->created_at->format('F d, Y') }}</span>
                        </div>
                        <div>
                            
                            <div>{!! $blog->description !!}</div>

                            <!-- Add more details as needed -->
                        </div>
                    </div>
                </div>
                
                <!-- Blogs Detail End -->

                <!-- Comment List Start -->
                <div class="bg-light mb-3" style="padding: 30px;">
                    <h3 class="mb-4">{{ $comments->count() }} Comments</h3>

                    @foreach($comments as $comment)
                        <div class="media mb-4">
                            <!-- Assuming you have a user avatar field in your Comment model -->
                            <img src="{{ asset("public/img/user.jpg") }}" alt="Image" class="img-fluid mr-3 mt-1" style="width: 45px;">
                            <div class="media-body">
                                <h6><a href="">{{ $comment->name ?? 'Anonymous' }}</a> <small><i>{{ $comment->created_at->format('d M Y') }}</i></small></h6>
                                <p>{{ $comment->message }}</p>
                            </div>
                        </div>
                    @endforeach
                </div>
                <!-- Comment List End -->


                <!-- Comment Form Start -->
                <div class="bg-light mb-3" style="padding: 30px;">
                    <h3 class="mb-4">Leave a comment</h3>
                    <form action="{{ route('comments.store') }}" method="post">
                        @csrf
                        <input type="hidden" name="blog_id" value="{{ $blog->id }}">
                        <div class="form-group">
                            <label for="name">Name *</label>
                            <input type="text" class="form-control" id="name" name="name" required>
                        </div>
                        <div class="form-group">
                            <label for="email">Email *</label>
                            <input type="email" class="form-control" id="email" name="email" required>
                        </div>
                        <div class="form-group">
                            <label for="message">Message *</label>
                            <textarea id="message" cols="30" rows="5" class="form-control" name="message" required oninput="validateInput(this)"></textarea>
                        </div>
                        <div class="form-group mb-0">
                            <input type="submit" value="Leave a comment" class="btn btn-primary font-weight-semi-bold py-2 px-3">
                        </div>
                    </form>
                    
                </div>
                <!-- Comment Form End -->
            </div>

            <div class="col-lg-4 pt-3 pt-lg-0">

                
                <div class="pb-3">
                    <div class="bg-light py-2 px-4 mb-3">
                        <h4 class="m-0">Author Details</h4>
                        <p>Author name- {{$blog->blogger->name}}</p>
                    </div>
                    
                </div>
                
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
                                    <a class="h6 m-0" href="">{{ \Str::limit($randomBlog->title, 30) }}</a>
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
<!-- Blogs With Sidebar End -->

<script>
    function validateInput(textarea) {
        var inputValue = textarea.value;
        var filteredValue = inputValue.replace(/[^a-zA-Z0-9 ]/g, ''); // Allow only alphabets and numbers

        textarea.value = filteredValue;
    }
</script>

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