@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">{{ $blog->title }}</div>

                <div class="card-body">
                    <br>
                    <button id="backButton" class="btn"><i class="fa fa-arrow-left"></i> Back</button>
                    @if ($blog->image)
                        <img src="{{ asset('storage/' . $blog->image) }}" class="img-fluid mt-3" alt="{{ $blog->title }}">
                    @endif
                    <br>
                    <p>{!! $blog->body !!}</p>

                    {{-- <p>Slug : {{ $blog->slug }}</p> --}}
                    <p>Created at : {{ $blog->created_date }}, {{ $blog->created_time }}</p>

                    <hr>
                    <div id="comment">
                        <h5>Comments</h5>

                        <form action="{{route('comment.store')}}" method="POST">
                            @csrf
                            <input type="hidden" name="blog_id" value="{{ $blog->id }}">
                            <textarea class="form-control"  name="body" placeholder="Type your comment here" rows="3"></textarea>
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </form>

                        @if($comments->count() > 0)
                            <ul class="list-group mt-3">
                                @foreach($comments as $comment)
                                    <li class="list-group-item"><b>{{ optional($comment->user)->name }}</b> <br> {{ $comment->body }}</li>
                                @endforeach
                            </ul>
                        @else
                            <p>No comments yet.</p>
                        @endif
                    </div>

                    
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function() {
        $('#backButton').click(function() {
            window.history.back();
        });
    });
</script>
