<?php

namespace App\Http\Controllers;

use App\Models\KembaliMobil;
use App\Models\Mobil;
use App\Models\PinjamMobil;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class PinjamMobilController extends Controller
{
    public function index()
    {
        // $pinjam = PinjamMobil::where('id', $pinjam->id)->first();
        $penyewa = DB::table('users')->where('id', Auth::user()->id ?? null)->select('users.*', 'id', 'name', 'alamat', 'email', 'sim', 'no_telp', 'role_id')->first();
        $pinjams = DB::table('pinjam_mobils')->where('user_id', $penyewa->id ?? null)->select('pinjam_mobils.*', 'id', 'mobil_id', 'tanggal_pinjam', 'user_id')->get();

        return view('sewa.index', [
            'penyewa' => $penyewa,
            'pinjams' => $pinjams,
        ]);
    }

    public function create(Mobil $mobil)
    {
        return view('sewa.create', compact('mobil'));
    }

    public function store(Request $request, Mobil $mobil)
    {
        $request->validate([
            // 'mobil_id' => 'required|exists:mobils,id',
            'tanggal_pinjam' => 'required|date',
            'tanggal_kembali' => 'required|date|after:tanggal_pinjam',
        ]);

        PinjamMobil::create([
            'mobil_id' => $mobil->id,
            'user_id' => Auth::user()->id,
            'tanggal_pinjam' => $request->tanggal_pinjam
        ]);

        KembaliMobil::create([
            'mobil_id' => $mobil->id,
            'user_id' => Auth::user()->id,
            'tanggal_kembali' => $request->tanggal_kembali
        ]);

        $mobil->update(['status' => 'Tersewa']);

        return redirect()->route('mobil.sewa.show', $mobil->id)->with('success', 'Mobil berhasil disewa!');
    }

    public function show(Mobil $mobil)
    {
        return view('sewa.show', compact('mobil'));
    }
}
