@extends('layouts.app')

@section('content')
    <div class="text-center">
        <h1>Modifica IL Post: {{ $post->title }}</h1>

    </div>

    <form action="{{ route('admin.posts.update', $post->id) }}" method="POST">

        @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="" class="form-label">Titolo</label>
            <input value="{{ $post->title }}" type="text" class="form-control" name="title">
            @error('title')
                <div class="alert alert-danger">
                    {{ $message }}
                </div>
            @enderror
        </div>
        <div class="mb-3">
            <label for="" class="form-label">Body</label>
            <textarea class="form-control" name="body">
                {{ $post->body }}
            </textarea>
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
                    <option value="{{ $elem->id }}"
                        {{ $elem->id == old('category_id', $post->category_id) ? 'selected' : '' }}>
                        {{ $elem->name }}
                    </option>
                @endforeach
            </select>

        </div>

        <div class="mb-3">
            <label for="" class="form-label">Tag</label>
            @foreach ( $tags as $tag )
            <input type="checkbox" name="tags[]" value="{{ $tag->id }}" {{ $post->tags->contains($tag) ? 'checked' : ''}}>
            {{$tag->name}}
            @endforeach
        </div>

        <button type="submit" class="btn btn-primary">Crea</button>
    </form>
@endsection
