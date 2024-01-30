@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <h1 class="text text-center">Detail Sewa</h1>
                </div>
                @php
                    $pinjam = DB::table('pinjam_mobils')->where('mobil_id', $mobil->id ?? null)->select('pinjam_mobils.*', 'id', 'mobil_id', 'tanggal_pinjam', 'user_id')->first();
                    $kembali = DB::table('kembali_mobils')->where('mobil_id', $mobil->id ?? null)->select('kembali_mobils.*', 'id', 'mobil_id', 'tanggal_kembali')->first();
                @endphp
                @php
                    $penyewa = DB::table('users')->where('id', $pinjam->user_id ?? null)->select('users.*', 'id', 'name', 'alamat', 'email', 'sim', 'no_telp', 'role_id')->first();
                    $sebagai = DB::table('roles')->where('id', $penyewa->role_id ?? null)->select('roles.*', 'id', 'role')->first();
                @endphp
                <div class="card-body">
                    <div class="row justify-content-center">
                        <h1 class="text text-center">Identitas Penyewa</h1>
                        <div class="col-md-4">
                            <p>
                                Nama : {{ $penyewa->name }}
                            </p>
                            <p>
                                Alamat : {{ $penyewa->alamat }}
                            </p>
                            <p>
                                Email : {{ $penyewa->email }}
                            </p>
                        </div>
                        <div class="col-md-4">
                            <p>
                                Sebagai : {{ $sebagai->role }}
                            </p>
                            <p>
                                Nomor SIM : {{ $penyewa->sim }}
                            </p>
                            <p>
                                Nomor Telepon : {{ $penyewa->no_telp }}
                            </p>
                        </div>
                    </div>
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
                </div>

                <div class="card-footer">
                    <div class="row justify-content-center">
                        <div class="col-md-4 text text-left">
                            <p>Tanggal Sewa : {{ $pinjam->tanggal_pinjam }}</p>
                        </div>
                        <div class="col-md-4 text text-right">
                            <p>Tanggal Kembali : {{ $kembali->tanggal_kembali }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
