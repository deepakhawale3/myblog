@extends('blogger.layouts.app')

@section('content')
<div class="container">
    <h1>Blog List</h1>
    <a href="{{ route('blogs.create') }}" class="btn btn-primary mb-3">Create Blog</a>

    <div class="card">
        <div class="card-body">
            <table class="table">
                <thead>
                    <tr>
                        <th>Sr No</th>
                        <th>Title</th>
                        <th>Image</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @php
                        $counter = 1;
                    @endphp
                    @foreach($blogs as $blog)
                    <tr>
                        <td>{{ $counter++ }}</td>
                        <td>{{ $blog->title }}</td>
                        <td>
                            @if($blog->img)
                            <img src="{{ asset("public/images/$blog->img") }}" alt="Blog Image" width="100">
                            @else
                                No Image
                            @endif
                        </td>
                        <td>{{ $blog->status ? 'Published' : 'Draft' }}</td>
                        <td>
                            <div class="btn-group" role="group">
                                <a href="{{ route('blogs.comments', $blog->id) }}" class="btn btn-success">Comments</a> &nbsp;
                                <a href="{{ route('blogs.edit', $blog->slug) }}" class="btn btn-primary">Edit</a> &nbsp;
                                <form id="deleteForm{{ $blog->id }}" action="{{ route('blogs.destroy', $blog->id) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="button" class="btn btn-danger deleteBtn" data-blogid="{{ $blog->id }}">Delete</button>
                                </form>
                                
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            {{ $blogs->links() }} 
        </div>
    </div>
</div>

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
<!-- Script to handle delete confirmation -->
<script>
    // Add a click event listener to all elements with class "deleteBtn"
    document.querySelectorAll('.deleteBtn').forEach(btn => {
        btn.addEventListener('click', function () {
            // Use SweetAlert2 to confirm the deletion
            Swal.fire({
                title: 'Are you sure?',
                text: 'You won\'t be able to revert this!',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#3085d6',
                confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
                // If user confirms, submit the form
                if (result.isConfirmed) {
                    const formId = 'deleteForm' + btn.getAttribute('data-blogid');
                    document.getElementById(formId).submit();
                }
            });
        });
    });
</script>
@endsection
