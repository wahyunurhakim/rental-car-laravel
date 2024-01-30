@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <h1>Daftar Mobil</h1>
            @if (Auth::user()->role_id == 1)
                <div class="mb-3"><a class="btn btn-primary" href="{{ route('mobil.create') }}">Tambah Mobil</a></div>
            @endif
            <form action="{{ route('mobil.index') }}" method="GET">
                <div class="input-group mb-3">
                    <input type="text" name="search" class="form-control" placeholder="Cari berdasarkan merek, model, atau ketersediaan" value="{{ request()->input('search') ?? '' }}">
                    <div class="input-group-append">
                        <button class="btn btn-outline-secondary" type="submit">Cari</button>
                    </div>
                </div>
            </form>

            <table class="tabel table-bordered">
                <thead>
                    <th class="text text-center">#</th>
                    <th class="text text-center">Merek</th>
                    <th class="text text-center">Model</th>
                    <th class="text text-center">Nomor Plat</th>
                    <th class="text text-center">Tarif Sewa / Hari</th>
                    <th class="text text-center">Status</th>
                    <th class="text text-center">Aksi</th>
                </thead>
                <tbody>
                    @forelse ($cars as $car)
                        <tr>
                            <th scope="row">{{ $loop->iteration }}</th>
                            <td>{{ $car->merek }}</td>
                            <td>{{ $car->model }}</td>
                            <td class="text text-center">{{ $car->no_plat }}</td>
                            <td class="text text-center">{{ $car->tarif_perhari }}</td>
                            <td class="text text-center"><span class="badge rounded-pill {{ $car->status == "Tersedia" ? 'text-bg-success' : 'text-bg-danger' }}">{{ $car->status }}</span></td>
                            <td class="text text-center">
                                @if (Auth::user()->role_id == 1)
                                    <a class="btn btn-xs btn-warning"
                                        href="{{ route('mobil.edit', $car->id) }}">
                                        Edit
                                    </a>
                                    <form action="{{ route('mobil.destroy', $car->id) }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
                                        <input type="hidden" name="_method" value="DELETE">
                                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                        <input type="submit" class="btn btn-xs btn-danger" value="Hapus">
                                    </form>
                                    @if ($car->status == "Kembali")
                                        <form action="{{ route('mobil.sewa.confirm', $car->id) }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
                                            <input type="hidden" name="_method" value="PUT">
                                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                            <input type="submit" class="btn btn-xs btn-info" value="Confirmasi">
                                        </form>
                                    @endif
                                @else
                                    @if ($car->status == "Tersedia")
                                        <a class="btn btn-xs btn-info" href="{{ route('mobil.sewa.create', $car->id) }}">Sewa</a>
                                    @else
                                        <a class="btn btn-xs btn-danger" href="#">Tidak Dapat Disewa!</a>
                                    @endif
                                @endif
                            </td>
                        </tr>
                    @empty
                    <tr>
                        <td colspan="7" class="text text-center">
                            <p class="font-weight-bold">Data Mobil Kosong.</p>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
@endsection
