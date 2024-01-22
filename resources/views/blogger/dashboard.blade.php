@extends('blogger.layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Number of Blogs Created By you </h5>
                    <p class="card-text">{{ $BlogCount }}</p> 
                    <a href="{{ route('blogs.index') }}" class="btn btn-primary">Add More Blogs</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
