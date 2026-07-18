@extends('master')
@section('title', 'Dashboard')
@section('body')
 
<div class="col-12">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h2 class="fw-bold mb-1">Dashboard Berita</h2>
            <p class="text-muted mb-0">Selamat datang, {{ Auth::user()->name }} ({{ Auth::user()->email }})</p>
        </div>
        <a href="{{ url('/posts/create') }}" class="btn btn-danger">+ Tulis Berita</a>
    </div>
 
    <hr>
 
    @if($posts->count())
        <div class="table-responsive bg-white rounded shadow-sm">
            <table class="table table-hover align-middle mb-0">
                <thead>
                    <tr>
                        <th>Gambar</th>
                        <th>Judul</th>
                        <th>Publisher</th>
                        <th>Tanggal</th>
                        <th>Status</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($posts as $post)
                        <tr>
                            <td style="width:80px;">
                                <img src="{{ $post->image ? asset('storage/'.$post->image) : 'https://placehold.co/80x60?text=No+Img' }}"
                                     style="width:70px; height:50px; object-fit:cover;" class="rounded">
                            </td>
                            <td>{{ $post->title }}</td>
                            <td>{{ $post->publisher ?? '-' }}</td>
                            <td>{{ optional($post->event_date)->format('d M Y') ?? $post->created_at->format('d M Y') }}</td>
                            <td>
                                @if($post->published == 'yes')
                                    <span class="badge bg-success">Publish</span>
                                @else
                                    <span class="badge bg-secondary">Draft</span>
                                @endif
                            </td>
                            <td>
                                <a href="{{ url('/posts/'.$post->id) }}" class="btn btn-sm btn-outline-primary">Lihat</a>
                                <a href="{{ url('/posts/'.$post->id.'/edit') }}" class="btn btn-sm btn-outline-secondary">Edit</a>
                                <form method="POST" action="{{ url('/posts/'.$post->id) }}" class="d-inline"
                                      onsubmit="return confirm('Yakin hapus berita ini?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-outline-danger">Hapus</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @else
        <p class="text-muted">Belum ada berita. <a href="{{ url('/posts/create') }}">Tulis yang pertama</a>.</p>
    @endif
</div>
@stop