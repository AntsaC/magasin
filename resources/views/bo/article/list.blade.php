@extends('layouts.app')

@section('content')
<div class="container">
    <div class="pagetitle">
        <h1>All articles</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                <li class="breadcrumb-item active">Articles</li>
            </ol>
        </nav>
    </div>
    <div class="row row-cols-3">
        @foreach( $articles as $article )
            <div class="col px-4">
                <div class="card">
                    <img class="card-img-top" height="250px" src="{{ isset($article->image) ? asset("storage/".$article->image) : asset("img/1.PNG") }}" alt="Article">
                    <div class="card-body">
                        <a href="{{ route('articles.edit', $article->id) }}">
                            <h4 style="height: 100px" class="mt-3 fw-bold">{{ $article->title }}</h4>
                        </a>
                        <span class="mt-2 text-muted">{{ $article->created_at }}</span>
                        <div class="d-flex justify-content-end mt-1">
                            <div class="btn-group btn-group-sm" role="group" aria-label="Basic example">
                                <a href="{{ route("articles.edit", $article->id) }}"  class="btn btn-success">
                                  <span><i class="fas fa-edit"></i></span>
                                </a>
                                <form method="POST" class="btn btn-sm btn-danger" action="{{ route("articles.destroy", $article->id) }}">
                                    @csrf
                                    @method("DELETE")
                                    <button class="btn btn-sm btn-danger">
                                        <span><i class="fas fa-trash"></i></span>
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
    {{ $articles->links() }}
    <div class="btn-floating">
        <a href="{{ route('articles.create') }}" title="New article" class="btn btn-primary btn-lg rounded-pill ">
            <i class="fas fa-plus"></i>
        </a>
    </div>
</div>
@endsection


