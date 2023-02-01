@extends('layouts.app')

@section('content')
    <div class="text-center">
        <h1>Crea un Post</h1>

    </div>

    <form action="{{ route('admin.posts.store') }}" method="POST" enctype="multipart/form-data">

        @csrf

        <div class="mb-3">
            <label for="" class="form-label">Titolo</label>
            <input type="text" class="form-control" name="title">
            @error('title')
                <div class="alert alert-danger">
                    {{ $message }}
                </div>
            @enderror
        </div>
        <div class="mb-3">
            <label for="" class="form-label">Body</label>
            <textarea class="form-control" name="body"></textarea>
            @error('body')
                <div class="alert alert-danger">
                    {{ $message }}
                </div>
            @enderror
        </div>
        <div class="mb-3">
            <label for="" class="form-label">Categories</label>
            <select name="category_id" id="">
                <option value="">Seleziona la categoria</option>

                @foreach ($categories as $elem)
                    <option value="{{ $elem->id }}">
                        {{ $elem->name }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label for="" class="form-label">Tag</label>
            @foreach ( $tags as $tag )
            <input type="checkbox" name="tags[]" value="{{ $tag->id }}">
            {{$tag->name}}
            @endforeach
        </div>

        <div class="mb-3" >
            <label for="" class="form-label">Inserisci Immagine </label>
            <input type="file" name="image" class="form-control-file">
        </div>

        <button type="submit" class="btn btn-primary">Crea</button>
    </form>
@endsection
