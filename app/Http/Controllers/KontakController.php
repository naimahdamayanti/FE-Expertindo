<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Kontak;
use App\Http\Controllers\Controller;

class KontakController extends Controller
{
    public function index(){
        $kontak = Kontak::all();
        return view('kontak.index', compact('kontak'));
    }

    public function create(){
        return view('kontak.create');
    }

    public function store(Request $request){

        request()->validate([
            'nama' => 'required',
            'email' => 'required|email',
            'telepon' => 'required|integer',
            'pesan' => 'required',        
        ]);

        kontak::create([
        'nama' => $request->nama,
        'email' => $request->email,
        'telepon' => $request->telepon,
        'pesan' => $request->pesan
    ]);
        return redirect()->route('kontak.index')->with('success', 'Data Berhasil Ditambahkan');
    }
    
    public function show(string $id)
    {
        //
    }

    public function edit(string $id){
        $kontak = Kontak::findOrFail($id);
        return view('kontak.edit', ['kontak' => $kontak]);
    }

    public function update(Request $request, string $id)
    {
        $request->validate([
            'nama' => 'required',
            'email' => 'required|email',
            'telepon' => 'required|integer',
            'pesan' => 'required',
        ]);

        try {
            $kontak = Kontak::findOrFail($id);
            $kontak->update([
                'nama' => $request->nama,
                'email' => $request->email,
                'telepon' => $request->telepon,
                'pesan' => $request->pesan
            ]);
            
            return redirect()->route('kontak.index')->with('success', 'Data kontak berhasil diperbarui.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Gagal memperbarui data: ' . $e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            $kontak = Kontak::findOrFail($id);
            $kontak->delete();
            
            return redirect()->route('kontak.index')->with('success', 'kontak berhasil dihapus.');
        } catch (\Exception $e) {
            return redirect()->route('kontak.index')->with('error', 'Gagal menghapus data kontak: ' . $e->getMessage());
        }
    }
}