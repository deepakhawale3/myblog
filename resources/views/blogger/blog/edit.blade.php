@extends('blogger.layouts.app')

@section('content')
<div class="container">
    <div class="card">
        <div class="card-body">
        <div class="card-header">
            <h1 class="text-center">Edit Blog</h1>
        </div>
            <form method="POST" action="{{ route('blogs.update', $blog->id) }}" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="form-group">
                    <label for="title">Title</label>
                    <input type="text" class="form-control" id="title" name="title" value="{{ $blog->title }}" required>
                </div>
                <div class="form-group">
                    <label for="category">Category</label>
                    <select class="form-control" id="category" name="category">
                        <option value="" disabled>Select Category</option>
                        @foreach($categories as $category)
                            @if($category->name === $blog->category)
                                <option value="{{ $category->name }}" selected>{{ $category->name }}</option>
                            @else
                                <option value="{{ $category->name }}">{{ $category->name }}</option>
                            @endif
                        @endforeach
                    </select>
                </div>

                <div class="form-group">
                    <label for="introduction">Introduction</label>
                    <textarea class="form-control" id="introduction" name="introduction" rows="4" required>{{ $blog->introduction }}</textarea>
                </div>
                <div class="form-group">
                    <label for="description">Description</label>
                    <textarea class="form-control" id="description" name="description" rows="8" required>{{ $blog->description }}</textarea>
                </div><br>
                <div class="form-group">
                    <label for="img">Image</label>
                    <input type="file" class="form-control-file" id="img" name="img">
                </div><br>
                <div class="form-group">
                    <label for="meta_title">Meta Title</label>
                    <input type="text" class="form-control" id="meta_title" name="meta_title" value="{{ $blog->meta_title }}">
                </div>
                <div class="form-group">
                    <label for="meta_description">Meta Description</label>
                    <input type="text" class="form-control" id="meta_description" name="meta_description" value="{{ $blog->meta_description }}">
                </div>
                <div class="form-group">
                    <label for="meta_keyword">Meta Keywords</label>
                    <input type="text" class="form-control" id="meta_keyword" name="meta_keyword" value="{{ $blog->meta_keyword }}">
                </div>
                <div class="form-group">
                    <label for="status">Status</label>
                    <select class="form-control" id="status" name="status">
                        <option value="0" {{ $blog->status == 0 ? 'selected' : '' }}>Draft</option>
                        <option value="1" {{ $blog->status == 1 ? 'selected' : '' }}>Published</option>
                    </select>
                </div><br>
                <div class="text-center">
                    <button type="submit" class="btn btn-primary">Update Blog</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script src="https://cdn.tiny.cloud/1/mfa3p0xj7qq76t0wwtdkv67psubpzi73cmx02mt1pmly6nrl/tinymce/6/tinymce.min.js" referrerpolicy="origin"></script>
<script>
    tinymce.init({
        selector: 'textarea#description',
        plugins: 'anchor autolink charmap codesample emoticons image link lists media searchreplace table visualblocks wordcount',
        toolbar: 'undo redo | blocks fontfamily fontsize | bold italic underline strikethrough | link image media table | align lineheight | numlist bullist indent outdent | emoticons charmap | removeformat',
    });
</script>
@endsection
