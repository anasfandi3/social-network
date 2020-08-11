@extends('layouts.master')

@section('content')
    @include('includes.message-block')
    <section class="row new-post">
        <div class="col-md-6 offset-md-3">
            <header><h3>Share your thoughts</h3></header>
        <form action="{{route('create.post')}}" method="POST">
                <div class="form-group">
                    <textarea name="body" id="new-post" rows="5" class="form-control" placeholder="Your post..."></textarea>
                </div>
                <button type="submit" class="btn btn-primary">Post</button>
            <input type="hidden" name="_token" value="{{Session::token()}}">
            </form>
        </div>
    </section>
    <section class="row posts">
        <div class="col-md-6 offset-3">
            <header><h3>Other posts</h3></header>
            @foreach ($posts as $post)
                <article class="post" data-postid="{{ $post->id }}">
                    <p>{{ $post->body }}</p>
                    <div class="info"> posted by {{$post->user->first_name}} on {{$post->created_at}} </div>
                    <div class="interaction">
                        <a class="like" href="#">{{App\Like::where('post_id', $post->id)->where('like', 1)->count()}} likes</a> |
                        <a class="like" href="#">{{App\Like::where('post_id', $post->id)->where('like', 0)->count()}} dislikes</a> 
                        @if (Auth::user() == $post->user)
                            |
                            <a class="edit" href="#">edit</a> |
                            <a href="{{route('delete.post',['post_id' => $post->id])}}">delete</a>                            
                        @endif
                    </div>
                </article> 
            @endforeach
        </div>
    </section>
    <div class="modal" tabindex="-1" role="dialog" id="edit-modal">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Edit Post</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form>
                        <div class="form-group">
                            <label for="post-body">Edit the post</label>
                            <textarea class="form-control" name="post-body" id="post-body" rows="5"></textarea>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary" id="modal-save">Save changes</button>
                </div>
            </div>
        </div>
    </div>

    <script>
        var token = '{{ Session::token() }}';
        var urlEdit = '{{ route('edit') }}';
        var urlLike = '{{ route('like') }}';
    </script>
@endsection
