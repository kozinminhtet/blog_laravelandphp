<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Article;
use App\Models\Category;
use Illuminate\Auth\Events\Validated;
use Illuminate\Support\Facades\Gate;

class ArticleController extends Controller
{
    public function __construct()
    {
        $this->middleware("auth")->except(['index', 'detail']);
    }
    
    public function index()
    {
        //get data from db => all(); instead of sql query 
        // $data = Article::all();
        $data = Article::latest()->paginate(5);
        
        return view('articles.index', [
            'articles' => $data
        ]);
    }

    public function detail($id)
    {
        $article = Article::find($id);

        return view('articles.detail', [
            'article' => $article
        ]);
    }

    //to show form 
    public function add(){
        $categories = Category::all();

        return view("articles.add", [
            "categories" => $categories
        ]);
    }

    //to receive form-data
    public function create(Request $request) {
        $validator = validator($request->all(), [
            'title' => 'required',
            'body' => 'required',
            'category_id' => 'required',
        ]);

        //redirect()
        if($validator->fails()) {
            return back()->withErrors($validator);
        }


        $article = new Article;

        $article->title = $request->title; //val$request()
        $article->body = $request->body; //$_POST['body']
        $article->category_id = $request->category_id;
        $article->user_id = auth()->id();

        $article->save();

        return redirect("/articles");
    }

    public function delete($id)
    {
        $article = Article::find($id);

        if(Gate::allows('delete-article', $article)){
            $article->delete();
            return redirect("/articles")->with("info", "Deleted an article");
        }

        return back()->with('info', "Unauthorize");

    }

    public function edit($id)
    {
        $article = Article::find($id);
        $categories = Category::all();

        return view('articles.edit', [
            'article' => $article,
            'categories' => $categories
        ]);
    }

    public function update(Request $request, $id) {
        $validator = validator($request->all(), [
            'title' => 'required',
            'body' => 'required',
            "category_id" => 'required',
        ]);

        //redirect()
        if($validator->fails()) {
            return back()->withErrors($validator);
        }


        $article = Article::find($id);

        $article->title = $request->title; //val$request()
        $article->body = $request->body; //$_POST['body']
        $article->category_id = $request->category_id;

        $article->save();

        return redirect("/articles")->with('success', "Updated Article");
    }
}
