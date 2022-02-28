@extends('layouts.app')

@section('content')
    <main>
        @if (!$posts)
            <h1></h1>
        @else
            <section>
                <div>
                    <p>CSS</p>
                    <h1>Automatizing Links</h1>
                </div>
            </section>
        @endif

        <section class="table-home">
            <div class="table-home__card">
                <header>
                    <p class="CSS">CSS</p>
                    <p>August, 18 by Matheus Luiz</p>
                </header>

                <h3>Animating Link Underlines</h3>
            </div>
        </section>
    </main>
@endsection
