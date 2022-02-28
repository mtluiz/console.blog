@extends ('layouts.app')

@section('content')
    <h1>Posts</h1>

    @if (count($posts) > 0)
        @foreach ($posts as $post)
            <div class="card card-body">
                <a href="/posts/{{ $post->id }}">
                    <h3>{{ $post->title }}</h3>
                </a>
                <small>Escrito em {{ $post->created_at }} por $post->user->name</small>
            </div>
        @endforeach
        {{ $posts->links() }}
    @else
        <h3> Desculpe, nenhum post foi encontrado </h3>
    @endif

@endsection
