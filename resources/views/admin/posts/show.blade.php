@extends('layouts.app')

@section('content')
    <div class="text-center">
        <img src="{{ asset("storage/$singolo_post->cover") }}" alt="">

        <h1>{{ $singolo_post->title }}</h1>
        <p>{{ $singolo_post->body }}</p>

        @if ($singolo_post->category)
            Categoria: {{ $singolo_post->category['name'] }}
        @else
            Categoria: null
        @endif

    </div>
@endsection
