@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <h1>Daftar Mobil Yang Disewa</h1>
            {{-- @if (Auth::user()->role_id == 1)
                <div class="mb-3"><a class="btn btn-primary" href="{{ route('mobil.create') }}">Tambah Mobil</a></div>
            @endif --}}
            {{-- <form action="{{ route('mobil.index') }}" method="GET">
                <div class="input-group mb-3">
                    <input type="text" name="search" class="form-control" placeholder="Cari berdasarkan merek, model, atau ketersediaan" value="{{ request()->input('search') ?? '' }}">
                    <div class="input-group-append">
                        <button class="btn btn-outline-secondary" type="submit">Cari</button>
                    </div>
                </div>
            </form> --}}

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
                    @forelse ($pinjams as $data)
                    @php
                        $mobil = DB::table('mobils')->where('id', $data->mobil_id ?? null)->select('mobils.*', 'id', 'merek', 'model', 'status', 'no_plat')->first();
                    @endphp
                    @if ($mobil->status != 'Tersedia')

                    <tr>
                        <th scope="row">{{ $loop->iteration }}</th>
                        <td>{{ $mobil->merek }}</td>
                        <td>{{ $mobil->model }}</td>
                        <td class="text text-center">{{ $mobil->no_plat }}</td>
                        <td class="text text-center">{{ $mobil->tarif_perhari }}</td>
                        <td class="text text-center"><span class="badge rounded-pill {{ $mobil->status == "Tersedia" ? 'text-bg-success' : 'text-bg-danger' }}">{{ $mobil->status }}</span></td>
                        <td class="text text-center">
                            @if (Auth::user()->role_id == 1)

                            @else
                                <form action="{{ route('mobil.sewa.kembali', $mobil->id ?? '') }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
                                    <input type="hidden" name="_method" value="PUT">
                                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                    <input type="submit" class="btn btn-xs btn-danger" value="Kembali">
                                </form>
                            @endif
                        </td>
                    </tr>
                    @endif
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
