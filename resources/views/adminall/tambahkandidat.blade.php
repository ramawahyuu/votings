@extends('index') <!-- Merujuk ke template utama -->

@section('content') <!-- Menyediakan isi yield konten -->
<div class="container">

    @if(Auth::user()->role == 'superadm' || Auth::user()->role == 'admin')

        @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif
            
                <h3>Tambah Kandidat</h3>
            
            <div class="card-body">
                <form method="POST" action="{{ route('adminall.storekandidat') }}" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <label for="nama_kandidat">Nama Kandidat</label>
                        <input type="text" name="nama_kandidat" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="foto">Foto Kandidat</label>
                        <input type="file" name="foto" class="form-control-file" accept="image/*" required>
                    </div>
                    <div class="form-group">
                        <label for="posisi">Posisi</label>
                        <input type="text" name="posisi" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="id_event">ID Event</label>
                        <input type="text" name="id_event" value="{{ $id_event }}" class="form-control" required>
                    </div>
            
                        <button type="submit" class="btn btn-custom-color btn-sm">
                             Submit
                        </button>
                </form>
            </div>
    @endif

</div>
@endsection
