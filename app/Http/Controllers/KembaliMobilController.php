<?php

namespace App\Http\Controllers;

use App\Models\KembaliMobil;
use App\Models\Mobil;
use App\Models\PinjamMobil;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class KembaliMobilController extends Controller
{
    public function destroy(Mobil $mobil)
    {
        // $mobil = DB::table('mobils')->where('id', $kembali->mobil_id ?? null)->select('mobils.*', 'id', 'merek', 'model', 'status', 'no_plat')->first();

        $mobil->update(['status' => 'Kembali']);

        $kembali = DB::table('kembali_mobils')->where('mobil_id', $mobil->id ?? null)->select('kembali_mobils.*', 'id', 'mobil_id', 'tanggal_kembali', 'user_id')->first();
        $pinjam = DB::table('pinjam_mobils')->where('mobil_id', $mobil->id ?? null)->select('pinjam_mobils.*', 'id', 'mobil_id', 'tanggal_pinjam', 'user_id')->first();
        // dd($pinjam, $kembali);
        // $kembali->update(['tanggal_kembali' => now()]);
        // $pinjam->delete();

        return redirect()->route('mobil.index')->with('success', 'Mobil berhasil dikembalikan!');
    }
}
