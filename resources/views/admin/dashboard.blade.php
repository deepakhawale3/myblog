@extends('admin.layouts.app')

@section('content')
<div class="container">
    

    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card text-center">
                <div class="card-header">Total Number of Blogs</div>
                <div class="card-body">
                    <h3>{{ $totalBlogsCount }}</h3>
                    <a class="btn btn-primary mt-3" href="{{ route('allblog.index') }}">View</a>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card text-center">
                <div class="card-header">Total Number of Bloggers</div>
                <div class="card-body">
                    <h3>{{ $totalBloggers }}</h3>
                    <a class="btn btn-primary mt-3" href="{{ route('allblogger.index') }}">View</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
