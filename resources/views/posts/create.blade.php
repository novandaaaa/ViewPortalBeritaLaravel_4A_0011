@extends('master')
@section('title', 'Tulis Berita Baru')
@section('body')

<div class="col-md-8 offset-md-2">
    <h2 class="fw-bold mb-4">Tulis Berita Baru</h2>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form method="POST" action="{{ url('/posts') }}" enctype="multipart/form-data">
        @csrf
        <div class="mb-3">
            <label>Judul</label>
            <input type="text" name="title" class="form-control" value="{{ old('title') }}">
        </div>
        <div class="mb-3">
            <label>Isi Berita</label>
            <textarea name="content" rows="6" class="form-control">{{ old('content') }}</textarea>
        </div>
        <div class="row">
            <div class="col-md-6 mb-3">
                <label>Publisher</label>
                <input type="text" name="publisher" class="form-control" value="{{ old('publisher') }}">
            </div>
            <div class="col-md-6 mb-3">
                <label>Tanggal Kejadian</label>
                <input type="date" name="event_date" class="form-control" value="{{ old('event_date') }}">
            </div>
        </div>
        <div class="mb-3">
            <label>Status</label>
            <select name="published" class="form-select">
                <option value="yes">Publish</option>
                <option value="no">Draft</option>
            </select>
        </div>
                <div class="mb-3">
            <label>Gambar</label>
            <input type="file" name="image" class="form-control">
        </div>
        <button type="submit" class="btn btn-danger">
            Simpan Berita
        </button>
    </form>
</div>
@endsection