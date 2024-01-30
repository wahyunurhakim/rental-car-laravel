@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Edit Mobil</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('mobil.update', $mobil->id) }}">
                        @csrf
                        @method('PUT')

                        <div class="form-group">
                            <label for="merek">Merek</label>
                            <input id="merek" type="text" class="form-control @error('merek') is-invalid @enderror" name="merek" value="{{ old('merek', $mobil->merek) }}" required autocomplete="merek" autofocus>
                            @error('merek')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="model">Model</label>
                            <input id="model" type="text" class="form-control @error('model') is-invalid @enderror" name="model" value="{{ old('model', $mobil->model) }}" required autocomplete="model">
                            @error('model')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="no_plat">Nomor Plat</label>
                            <input id="no_plat" type="text" class="form-control @error('no_plat') is-invalid @enderror" name="no_plat" value="{{ old('no_plat', $mobil->no_plat) }}" required autocomplete="no_plat">
                            @error('no_plat')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="tarif_perhari">Tarif Per Hari</label>
                            <input id="tarif_perhari" type="number" class="form-control @error('tarif_perhari') is-invalid @enderror" name="tarif_perhari" value="{{ old('tarif_perhari', $mobil->tarif_perhari) }}" required autocomplete="tarif_perhari">
                            @error('tarif_perhari')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="form-group mb-2">
                            <label for="status">Status</label>
                            <select id="status" class="form-control form-select @error('status') is-invalid @enderror" name="status" required>
                                <option value="Tersedia" {{ old('status', $mobil->status) == 'Tersedia' ? 'selected' : '' }}>Tersedia</option>
                                <option value="Tersewa" {{ old('status', $mobil->status) == 'Tersewa' ? 'selected' : '' }}>Tersewa</option>
                            </select>
                            @error('status')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
