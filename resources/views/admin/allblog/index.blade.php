@extends('admin.layouts.app')

@section('content')
    <div class="container">
        <div class="card">
            <div class="card-body">
                <table class="table">
                    <thead>
                        <tr>
                            <th>Sr No</th>
                            <th>Title</th>
                            <th>Author</th>
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
                            <td>{{ $blog->blogger->name }}</td> 
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
        function confirmPropertyDelete(propertyId) {
            Swal.fire({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Yes, delete it!',
                cancelButtonText: 'No, cancel!',
                reverseButtons: true
            }).then((result) => {
                if (result.isConfirmed) {
                    document.getElementById('delete-form-' + propertyId).submit();
                }
            });
        }

        @if(session('success'))
            Swal.fire({
                title: 'Deleted!',
                text: '{{ session('success') }}',
                icon: 'success',
                confirmButtonText: 'OK'
            });
        @endif
    </script>
@endsection
