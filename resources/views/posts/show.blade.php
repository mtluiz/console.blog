@extends ('layout.app')

@section('content')
    <a href="/posts" class="button"> Retornar </a>

    <h1>{{ $post->title }}</h1>
    <small>Escrito em {{ $post->created_at }} por {{$post->user->name}}</small>

    <div>
        {!! $post->body !!}
    </div>

    @if (!Auth::guest() && Auth::user()->id == $post->user_id)
    <a href="/posts/{{ $post->id }}/edit" class="btn btn-default">Edit</a>
    {!! Form::open(['action' => ['PostsController@destroy', $post->id], 'method' => 'DELETE']) !!}
    {{ Form::submit('Delete', ['class' => 'btn btn-danger']) }}
    {!! Form::close() !!}
    @endif
@endsection
