@extends('master')
@section('title', 'Kabar Burung - Berita Terkini')
@section('body')

@if($posts->count())

    @php $headline = $posts->first(); @endphp
    <div class="card mb-4 border-0 shadow-sm overflow-hidden">

        <div class="row g-0">
            <div class="col-md-6">
                <img src="{{ $headline->image ? asset('storage/'.$headline->image) : 'https://placehold.co/600x400?text=Kabar+Burung' }}"
                     class="w-100 h-100"
                     style="object-fit:cover; min-height:320px;">
            </div>
            <div class="col-md-6 p-4 d-flex flex-column justify-content-center">
                <span class="badge bg-danger align-self-start mb-2">
                    Headline
                </span>
                <h1 class="fw-bold" style="font-family:'Merriweather',serif; font-size:1.9rem;">
                    <a href="{{ url('/posts/'.$headline->id) }}"
                       class="text-decoration-none text-dark">
                        {{ $headline->title }}
                    </a>
                </h1>
                <p class="text-muted">
                    {{ \Illuminate\Support\Str::limit(strip_tags($headline->content), 160) }}
                </p>
                <small class="text-secondary">
                    {{ $headline->publisher ?? 'Redaksi' }} &middot;
                    {{ optional($headline->event_date)->format('d M Y') ?? $headline->created_at->format('d M Y') }}
                </small>

                {{-- Tombol Edit Delete Headline --}}
                @auth
                <div class="mt-3">
                    <a href="{{ url('/posts/'.$headline->id.'/edit') }}"
                       class="btn btn-warning btn-sm">
                        Edit
                    </a>

                    <form action="{{ url('/posts/'.$headline->id) }}"
                          method="POST"
                          class="d-inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit"
                                class="btn btn-danger btn-sm"
                                onclick="return confirm('Yakin ingin menghapus berita ini?')">
                            Delete
                        </button>
                    </form>
                </div>
                @endauth


            </div>
        </div>
    </div>

    {{-- Grid berita lainnya --}}
    <div class="row g-4">

        @foreach($posts->skip(1) as $post)

        <div class="col-md-4">

            <div class="card h-100 border-0 shadow-sm">

                <img src="{{ $post->image ? asset('storage/'.$post->image) : 'https://placehold.co/400x250?text=Kabar+Burung' }}"
                     class="card-img-top"
                     style="height:180px; object-fit:cover;">
                <div class="card-body">
                    <h5 class="card-title fw-bold"
                        style="font-family:'Merriweather',serif;">
                        <a href="{{ url('/posts/'.$post->id) }}"
                           class="text-decoration-none text-dark">
                            {{ \Illuminate\Support\Str::limit($post->title, 60) }}
                        </a>
                    </h5>
                    <p class="card-text text-muted small">
                        {{ \Illuminate\Support\Str::limit(strip_tags($post->content), 90) }}
                    </p>
                    {{-- Tombol Edit Delete --}}
                    @auth
                    <div class="mt-3">
                        <a href="{{ url('/posts/'.$post->id.'/edit') }}"
                           class="btn btn-warning btn-sm">
                            Edit
                        </a>
                        <form action="{{ url('/posts/'.$post->id) }}"
                              method="POST"
                              class="d-inline">
                            @csrf
                            @method('DELETE')

                            <button type="submit"
                                    class="btn btn-danger btn-sm"
                                    onclick="return confirm('Yakin ingin menghapus berita ini?')">
                                Delete
                            </button>
                        </form>
                    </div>
                    @endauth
                </div>

                <div class="card-footer bg-white border-0 small text-secondary">
                    {{ $post->publisher ?? 'Redaksi' }} &middot;

                    {{ optional($post->event_date)->format('d M Y') ?? $post->created_at->format('d M Y') }}
                </div>
            </div>
        </div>
        @endforeach
    </div>
@else
<div class="text-center py-5">

    <h4 class="text-muted">
        Belum ada berita yang dipublikasikan.
    </h4>

    @auth
    <a href="{{ url('/posts/create') }}"
       class="btn btn-danger mt-3">
        Tulis Berita Pertama
    </a>
    @endauth
</div>
@endif
@endsection