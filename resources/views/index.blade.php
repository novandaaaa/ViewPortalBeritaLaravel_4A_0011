@extends('master')
@section('title', 'Kabar Burung - Portal Berita Terkini')
@section('body')
 
<div class="col-12">
 
    <div class="d-flex align-items-center py-2 px-3 mb-4 rounded" style="background:#1a1a1a; color:#fff;">
        <span class="badge bg-danger me-3">TERKINI</span>
        <span class="small">
            @if($posts->count())
                {{ $posts->first()->title }}
            @else
                Selamat datang di Kabar Burung — portal berita terpercaya.
            @endif
        </span>
    </div>
 
    @if($posts->count())
        @php $headline = $posts->first(); @endphp
 
        <div class="card mb-5 border-0 shadow-sm overflow-hidden">
            <div class="row g-0">
                <div class="col-md-7">
                    <img src="{{ $headline->image ? asset('storage/'.$headline->image) : 'https://placehold.co/700x450/B3131B/ffffff?text=Kabar+Burung' }}"
                         class="w-100 h-100" style="object-fit:cover; min-height:360px;">
                </div>
                <div class="col-md-5 p-4 d-flex flex-column justify-content-center bg-white">
                    <span class="badge bg-danger align-self-start mb-3" style="letter-spacing:1px;">HEADLINE</span>
                    <h1 class="fw-bold mb-3" style="font-family:'Merriweather',serif; font-size:1.8rem; line-height:1.3;">
                        <a href="{{ url('/posts/'.$headline->id) }}" class="text-decoration-none text-dark">
                            {{ $headline->title }}
                        </a>
                    </h1>
                    <p class="text-muted">{{ \Illuminate\Support\Str::limit(strip_tags($headline->content), 180) }}</p>
                    <small class="text-secondary mt-2">
                        @if($headline->publisher) {{ $headline->publisher }} &middot; @endif
                        {{ optional($headline->event_date)->format('d M Y') ?? $headline->created_at->format('d M Y') }}
                    </small>
                </div>
            </div>
        </div>
 
        <div class="d-flex align-items-center mb-3">
            <h4 class="fw-bold mb-0" style="font-family:'Merriweather',serif; border-left:5px solid #B3131B; padding-left:10px;">
                Berita Lainnya
            </h4>
        </div>
 
        {{-- Grid berita --}}
        <div class="row g-4">
            @foreach($posts->skip(1) as $post)
                <div class="col-md-4">
                    <div class="card h-100 border-0 shadow-sm">
                        <img src="{{ $post->image ? asset('storage/'.$post->image) : 'https://placehold.co/400x250/222222/ffffff?text=Kabar+Burung' }}"
                             class="card-img-top" style="height:190px; object-fit:cover;">
                        <div class="card-body">
                            <h5 class="card-title fw-bold" style="font-family:'Merriweather',serif; font-size:1.05rem;">
                                <a href="{{ url('/posts/'.$post->id) }}" class="text-decoration-none text-dark">
                                    {{ $post->title }}
                                </a>
                            </h5>
                            <p class="card-text text-muted small">
                                {{ \Illuminate\Support\Str::limit(strip_tags($post->content), 100) }}
                            </p>
                        </div>
                        <div class="card-footer bg-white border-0 small text-secondary">
                            @if($post->publisher) {{ $post->publisher }} &middot; @endif
                            {{ optional($post->event_date)->format('d M Y') ?? $post->created_at->format('d M Y') }}
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
 
    @else
        <div class="text-center py-5">
            <h4 class="text-muted">Belum ada berita yang dipublikasikan.</h4>
            @auth
                <a href="{{ url('/posts/create') }}" class="btn btn-danger mt-3">Tulis Berita Pertama</a>
            @endauth
        </div>
    @endif
</div>
 
@stop
 