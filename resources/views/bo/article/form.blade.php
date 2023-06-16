@extends('layouts.app')
@section('style')
    <style>
        .ck-editor__editable[role='textbox'] {
            min-height: 400px;
        }
    </style>
@endsection
@section('content')
<div class="container">
    <div class="pagetitle">
        <h1>
            @if(isset($article))
                Edit article
            @else
                New article
            @endif
        </h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="index.html">Articles</a></li>
                <li class="breadcrumb-item active">New</li>
            </ol>
        </nav>
    </div>
    <div class="card">
        <div class="card-body mt-3">
            <form method="post" enctype="multipart/form-data" action="{{ isset($article) ? route('articles.update', $article->id) : route('articles.store') }}">
                @csrf
                @if(isset($article))
                    @method('PUT')
                @endif
                <div class="d-flex justify-content-end">
                    <button class="btn btn-success mb-2 " >
                        Save  <span><i class="fas fa-save"></i></span>
                    </button>
                </div>
                <div class="form-group">
                    <label for="title">Title</label>
                    <input type="text" name="title" id="title" value="{{ isset($article) ? $article->title : old('title') }}" class="form-control @error('title') is-invalid @enderror" >
                    @error('title')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="image" class="col-sm-2 col-form-label">Thumbnail</label>
                    <div class="col-sm-10">
                        <input class="form-control" name="img" type="file" id="image">
                    </div>
                </div>
                <div class="form-group">
                    <label for="resume">Resume</label>
                    <textarea name="resume" rows="7" id="resume" class="form-control @error('resume') is-invalid @enderror" >
                        {{ isset($article) ? $article->resume : old('resume') }}
                    </textarea>
                    @error('resume')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="content">Content</label>
                    <textarea name="content" id="content" rows="10"  @error('content') is-invalid @enderror" >
                        {{ isset($article) ? $article->content : old('content') }}
                    </textarea>
                    @error('content')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@section('js')
    <script src="https://cdn.ckeditor.com/ckeditor5/37.0.1/classic/ckeditor.js"></script><
    <script>
        ClassicEditor
            .create(document.querySelector("#content"),{
                placeholder: "Your content",
                heading: {
                    options: [
                        { model: 'paragraph', title: 'Paragraph', class: 'ck-heading_paragraph' },
                        { model: 'heading2', view: 'h2', title: 'Heading 2', class: 'ck-heading_heading2' },
                        { model: 'heading3', view: 'h3', title: 'Heading 3', class: 'ck-heading_heading3' },
                        { model: 'heading4', view: 'h4', title: 'Heading 4', class: 'ck-heading_heading4' },
                        { model: 'heading5', view: 'h5', title: 'Heading 5', class: 'ck-heading_heading5' },
                        { model: 'heading6', view: 'h6', title: 'Heading 6', class: 'ck-heading_heading6' }
                    ]
                },
            })
            .catch( error => {
                console.log(error)
            });
    </script>
@endsection
