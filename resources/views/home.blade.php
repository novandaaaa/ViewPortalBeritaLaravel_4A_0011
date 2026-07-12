@extends('master')
@section('title', 'Home')
@section('body')


<div class="col-md-8 offset-md-2 mt-5">


    <h2>
        Selamat datang, {{ Auth::user()->name }}!
    </h2>

    <p>
        Email: {{ Auth::user()->email }}
    </p>
    <hr>
    <h3 class="mb-4">
        Berita Terkini
    </h3>

    @if($posts->count())


        @foreach($posts as $post)
        <div class="card mb-4 shadow-sm">
            @if($post->image)

            <img src="{{ asset('storage/'.$post->image) }}"
                 class="card-img-top"
                 style="height:250px; object-fit:cover;">

            @endif
            <div class="card-body">
                <h4 class="fw-bold">
                    {{ $post->title }}
                </h4>

                <p class="text-muted">
                    {{ Str::limit($post->content, 150) }}
                </p>

                <small class="text-secondary">
                    {{ $post->publisher }}
                    |
                    {{ $post->event_date }}
                </small>
                <br>
            </div>
        </div>
        @endforeach

    @else
        <div class="alert alert-info">
            Belum ada berita tersedia.
        </div>

    @endif
</div>
@endsection