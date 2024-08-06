@extends("layouts.app")

@section("content")
    <div class="container" style="max-width: 600px">

        @if (session('info'))
            <div class="alert alert-info">
                {{ session('info')}}
            </div>
        @endif
        
        <div class="card mb-2">
            <div class="card-body">
                <h4>{{ $article->title}}</h4>

                <div class="small text-success mb-2">
                    <b>{{$article->user->name}}</b>,
                    {{-- category=> magic method --}}
                    <b>Category: </b>{{ $article->category->name ?? 'Unknown'}} 
                </div>

                
                <div class="mb-2">
                    {{ $article->body }}
                </div>

                <div class="text-success small">
                    <i>
                    {{ $article->created_at->diffForHumans() }}
                    </i>
                </div>

                @can("delete-article", $article)
                    <a href="{{url("/articles/delete/$article->id")}}" class="mt-2 btn btn-outline-danger btn-sm">
                        Delete
                    </a>
                    <a href="{{url("/articles/edit/$article->id")}}" class="mt-2 btn btn-outline-success btn-sm">
                        Update
                    </a> 
                @endcan

            </div>
        </div>

        <ul class="list-group mt-4">
            <li class="list-group-item active">
                Comments ({{ count($article->comments)}})
            </li>

            @foreach ($article->comments as $comment)
                <li class="list-group-item">

                    @can("delete-comment", $comment)
                        <a href="{{ url("/comments/delete/$comment->id") }}" class="btn-close small float-end"></a>
                    @endcan

                    <b class="text-success small">{{ $comment->user->name}}</b> -
                    {{ $comment->content }}
                    <b class="small text-success">
                        <i> {{$comment->created_at->diffForHumans()}}</i>
                    </b>
                </li>
            @endforeach
        </ul>

        @auth
            <form action="{{ url("/comments/add") }}" method="post">
                @csrf
                <input type="hidden" name="article_id" value="{{ $article->id }}">
                <textarea name="content" class="form-control mb-2" placeholder="New Comment"></textarea>
                <button class="btn btn-secondary">Add Comment</button>
            </form>
        @endauth
    </div>

@endsection