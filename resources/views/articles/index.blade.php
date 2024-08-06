{{-- <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Articles</title>
</head>
<body>
    <h1>Article List</h1>
    <ul>
        @foreach($articles as $article)
            <li>{{ $article['title']}}</li>
        @endforeach
    </ul>
</body>
</html> --}}

@extends("layouts.app")

@section("content")
    <div class="container" style="max-width: 600px">

        @if(session("info"))
            <div class="alert alert-info">
                {{session("info")}}
            </div>
        @endif
        @if(session("success"))
            <div class="alert alert-success">
                {{session("success")}}
            </div>
        @endif

        
        {{$articles->links()}}

        @foreach ($articles as $article)
            <div class="card mb-2">
                <div class="card-body">
                    <h4>{{ $article->title}}</h4>

                    <div class="small text-muted mb-2">
                        {{-- category=> magic method --}}
                        <b>
                            {{$article->user->name}},
                        </b>

                        <b>Category: </b>{{ $article->category->name ?? 'Unknown'}}, 
                        <b>Comments </b>{{count($article->comments)}}
                    </div>
                    <div>
                        {{ $article->body }}
                        <a href="{{url("/articles/detail/$article->id")}}" class="">
                            more detail &raquo;
                        </a>
                    </div>

                    <div class="small text-success mt-2">{{ $article->created_at->diffForHumans()}}</div>
                </div>
            </div>
        @endforeach

        
    </div>

@endsection