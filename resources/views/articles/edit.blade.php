@extends("layouts.app")
@section("content")

    <div class="container" style="max-width: 600px">
        <h2>Edit Article</h2>
        
        @if ($errors->any())
            <div class="alert alert-warning">
                @foreach ($errors->all() as $error)
                    {{ $error }}
                @endforeach
            </div>  
        @endif

        <form action="" method="POST">
            @csrf
            <input type="text" name="title" value="{{$article->title}}" class="form-control mb-2">
            <textarea name="body" class="form-control mb-2">{{$article->body}}</textarea>
 
            <select name="category_id" class="form-select mb-2">
                @foreach ($categories as $category)
                    <option value="{{ $category->id }}" @selected($article->category_id == $category->id)>
                        {{ $category->name }}
                    </option>
                @endforeach
            </select>

            <button class="btn btn-primary">Update Article</button>
        </form>
    </div>
@endsection