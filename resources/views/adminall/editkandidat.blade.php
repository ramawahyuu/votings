@extends('index') <!-- Merujuk ke template utama -->

@section('content') <!-- Menyediakan isi yield konten -->
<div class="container">

    @if(Auth::user()->role == 'superadm' || Auth::user()->role == 'admin')
                
    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif
    <form method="POST" action="{{ route('adminall.updatekandidat', ['id' => $kandidat->id]) }}">
        @method('PUT')
        @csrf
        <div class="form-group">
            <label for="nama_kandidat">Nama Kandidat</label>
            <input type="text" name="nama_kandidat" value="{{ $kandidat->nama_kandidat }}" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="foto">Foto Kandidat</label>
            <input type="file" name="foto" class="form-control-file" accept="image/*">
            
            @if ($kandidat->foto)
                <img src="{{ $kandidat->foto }}" alt="Foto Kandidat" class="img-thumbnail mt-2" style="max-width: 200px;">
            @endif
        
            <input type="hidden" name="current_foto" value="{{ $kandidat->foto }}">
        </div>
        <div class="form-group">
            <label for="posisi">Posisi</label>
            <input type="text" name="posisi" value="{{ $kandidat->posisi}}" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="id"></label>
            <input hidden type="text" name="id" value="{{ $kandidat->id }}" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="id_event"></label>
            <input hidden type="text" name="id_event" value="{{ $kandidat->id_event }}" class="form-control" required>
        </div>
        <button type="submit" class="btn btn-primary">Simpan</button>
    </form>
                        @endif
                      </div>
                      @endsection