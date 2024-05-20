@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-body">
                    <h3>Timeline</h3>
                    <hr>
                    @foreach ($blogs as $blog)
                        <div>
                            <h5><a href="{{ route('blog.show', $blog->slug) }}">{{ $blog->title }}</a></h5>
                            <p>{{ $blog->excerpt }}</p>
                        </div>
                    @endforeach
                </div>
            </div>
        </div> 
    </div> 
</div>
@endsection