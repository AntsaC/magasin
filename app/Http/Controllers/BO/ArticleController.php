<?php

namespace App\Http\Controllers\BO;

use App\Http\Controllers\Controller;
use App\Models\Article;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;

class ArticleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index(): View
    {
        return view("bo.article.list",[
            "articles" => Article::paginate(3)
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create(): View
    {
        return \view('bo.article.form');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return Response
     */
    public function store(Request $request)
    {
        $article = new Article();
        $article->fill($request->all());
        $article->image = $request->file('img')->store('articles','public');
        $article->save();
        return Redirect::route('articles.index');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Article  $article
     * @return Application|Factory|\Illuminate\Contracts\View\View
     */
    public function edit(Article $article): \Illuminate\Contracts\View\View|Factory|Application
    {
        return \view('bo.article.form', compact('article'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Article  $article
     * @return Response
     */
    public function update(Request $request, Article $article)
    {
        $request->validate(Article::RULE);
        $article->fill($request->all())->save();
        return Redirect::route('articles.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Article  $article
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Article $article)
    {
        $article->delete();
        return Redirect::route("articles.index");
    }
}
