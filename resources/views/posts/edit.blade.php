@extends('master')
@section('title', 'Edit Berita')
@section('body')
 
<div class="col-md-8 offset-md-2">
    <h2 class="fw-bold mb-4">Edit Berita</h2>
 
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
 
    <form method="POST" action="{{ url('/posts/'.$post->id) }}" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="mb-3">
            <label>Judul</label>
            <input type="text" name="title" class="form-control" value="{{ old('title', $post->title) }}">
        </div>
        <div class="mb-3">
            <label>Isi Berita</label>
            <textarea name="content" rows="6" class="form-control">{{ old('content', $post->content) }}</textarea>
        </div>
        <div class="row">
            <div class="col-md-6 mb-3">
                <label>Publisher</label>
                <input type="text" name="publisher" class="form-control" value="{{ old('publisher', $post->publisher) }}">
            </div>
            <div class="col-md-6 mb-3">
                <label>Tanggal Kejadian</label>
                <input type="date" name="event_date" class="form-control"
                       value="{{ old('event_date', optional($post->event_date)->format('Y-m-d')) }}">
            </div>
        </div>
        <div class="mb-3">
            <label>Status</label>
            <select name="published" class="form-select">
                <option value="yes" @selected($post->published == 'yes')>Publish</option>
                <option value="no" @selected($post->published == 'no')>Draft</option>
            </select>
        </div>
        @if($post->image)
            <div class="mb-2">
                <img src="{{ asset('storage/'.$post->image) }}" style="max-height:150px;" class="rounded">
            </div>
        @endif
        <div class="mb-3">
            <label>Ganti Gambar (opsional)</label>
            <input type="file" name="image" class="form-control">
        </div>
        <button type="submit" class="btn btn-danger">Update Berita</button>
    </form>
</div>
@stop