@extends('layouts.app')

@section('content')

@if(session()->has('success'))
<div class="alert alert-success" role="alert">
    {{ session('success') }}
</div>
@endif

    <a href="{{ route('blog.create')}}" class="btn btn-dark"> <i class="fa fa-plus"></i> Create New Post</a>
    
    <div class="container">
        <br>
        <h2>Blogs</h2>       
        <table class="table">
        <thead>
            <tr>
                <th>No</th>
                <th>Title</th>
                <th>Excerpt</th>
                <th>Action</th>
            </tr>
        </thead>

        <tbody>
            @php
                $no = 1
            @endphp

            @foreach ($blogs as $blog)
            <tr>
                <td>{{ $no++ }}</td>
                <td>{{ $blog->title }}</td>
                <td>{{ $blog->excerpt }}</td>
                <td>
                    <form onsubmit="return confirm('Are you sure?');"
                        action="{{ route('blog.destroy', $blog) }}" method="POST">
                        <a href="{{ route('blog.show', $blog->slug) }}" class="btn"><i class="fa fa-eye"  style="color: rgb(0, 0, 0)"></i></a>
                        <a href="{{ route('blog.edit', $blog) }}" class="btn"><i class="fa fa-edit"  style="color: blue"></i></a>
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn"><i class="fa fa-trash"  style="color: red"></i></button>
                    </form>
                </td>
            </tr>
            @endforeach
            
        </tbody>
        </table>
    </div>

@endsection