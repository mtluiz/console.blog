@extends('layouts.app')

@section('content')
    <main>
        @if (!count($posts) > 0)
            <h1 class="title"> Desculpa, nenhum post foi encontrado :(</h1>
        @else
        <section class="table-home">
            @foreach ($posts as $post)
            <div class="table-home__card">
                <header>
                    <p class="{{ $post->tag }}">{{ $post->tag }}</p>
                    <p>{{ $post->created_at->format('d/m/Y') }} by {{ $post->user->name }}</p>
                </header>

                <h3>{{ $post->title }}</h3>
            </div>
            @endforeach
        </section>
        @endif
    </main>
@endsection
