@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Sewa Mobil</div>

                    <div class="card-body">
                        <div class="row justify-content-center">
                            <h1 class="text text-center">Identitas Mobil</h1>
                            <div class="col-md-4">
                                <p>Merek : {{ $mobil->merek }}</p>
                                <p>Model : {{ $mobil->model }}</p>
                                <p>Nomor Plat : {{ $mobil->no_plat }}</p>
                            </div>
                            <div class="col-md-4">
                                <p>Tarif Sewa / Hari : {{ $mobil->tarif_perhari }}</p>
                                <p>Status : {{ $mobil->status }}</p>
                            </div>
                        </div>
                        <form method="POST" action="{{ route('mobil.sewa.store', $mobil->id) }}">
                            @csrf

                            <div class="form-group">
                                <label for="tanggal_pinjam">Tanggal Mulai Sewa</label>
                                <input id="tanggal_pinjam" type="datetime-local" class="form-control @error('tanggal_pinjam') is-invalid @enderror" name="tanggal_pinjam" required>
                                @error('tanggal_pinjam')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="tanggal_kembali">Tanggal Selesai Sewa</label>
                                <input id="tanggal_kembali" type="datetime-local" class="form-control @error('tanggal_kembali') is-invalid @enderror" name="tanggal_kembali" required>
                                @error('tanggal_kembali')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <button type="submit" class="btn btn-primary">Sewa Mobil</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
