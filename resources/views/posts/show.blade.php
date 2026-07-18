@extends('master')
@section('title', $post->title)
@section('body')
 
<div class="col-md-8 offset-md-2">
    @if($post->image)
        <img src="{{ asset('storage/'.$post->image) }}" class="w-100 rounded mb-3" style="max-height:400px; object-fit:cover;">
    @endif
 
    <h1 class="fw-bold" style="font-family:'Merriweather',serif;">{{ $post->title }}</h1>
    <p class="text-secondary mb-4">
        {{ $post->publisher ?? 'Redaksi' }} &middot;
        {{ optional($post->event_date)->format('d M Y') ?? $post->created_at->format('d M Y') }}
    </p>
    <div class="fs-5" style="line-height:1.8;">{!! nl2br(e($post->content)) !!}</div>
 
    @auth
        <div class="mt-4 d-flex gap-2">
            <a href="{{ url('/posts/'.$post->id.'/edit') }}" class="btn btn-outline-secondary btn-sm">Edit</a>
            <form method="POST" action="{{ url('/posts/'.$post->id) }}" onsubmit="return confirm('Yakin hapus berita ini?')">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-outline-danger btn-sm">Hapus</button>
            </form>
        </div>
    @endauth
 
    <a href="{{ url('/') }}" class="d-inline-block mt-4">&larr; Kembali ke Beranda</a>
</div>
@stop
