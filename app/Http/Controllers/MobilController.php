<?php

namespace App\Http\Controllers;

use App\Models\Mobil;
use Illuminate\Http\Request;

class MobilController extends Controller
{
    public function index(Request $request)
    {
        // $cars = Mobil::all();

        // return view('admin.mobil.index', compact('cars'));
        $query = Mobil::query();

        if ($request->has('search')) {
            $search = $request->input('search');
            $query->where('merek', 'like', '%'.$search.'%')
                ->orWhere('model', 'like', '%'.$search.'%')
                ->orWhere('status', 'like', '%'.$search.'%');
        }

        $cars = $query->paginate(10);

        return view('admin.mobil.index', compact('cars'));
    }

    public function create() {
        return view('admin.mobil.create');
    }

    public function store(Request $request) {

        $attr = $request->all();

        Mobil::create($attr);

        return redirect()->route('mobil.index')->with('success', 'Berhasil menambahkan Mobil!');
    }

    public function edit(Mobil $mobil) {
        return view('admin.mobil.edit', compact('mobil'));
    }

    public function update(Request $request, Mobil $mobil) {

        $attr = $request->all();
        // dd($imagePath);
        $mobil->update($attr);

        return redirect()->route('mobil.index')->with('success', 'Berhasil mengubah data Mobil!');
    }

    public function destroy(Mobil $mobil) {
        $mobil->delete();

        return redirect()->route('mobil.index')->with('success', 'Berhasil menghapus data Mobil!');

    }

    public function confirm(Mobil $mobil)
    {
        $mobil->update(['status' => 'Tersedia']);

        return redirect()->route('mobil.index')->with('success', 'Mobil sudah tersedia!');
    }
}
