<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Sertifikasi;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Http;



class SertifikasiController extends Controller
{
    public function index(){
        $sertifikasi = Sertifikasi::all();
        return view('sertifikasi.index', compact('sertifikasi'));
    }

    public function create(){
        return view('sertifikasi.create');
    }

    public function store(Request $request){

        request()->validate([
            'gambar' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',   
            
        ]);

        $data = [
        'gambar' => $request->gambar,
    ];

    if ($request->hasFile('gambar')) {
        // Buat folder jika belum ada
        if (!file_exists(public_path('images/sertifikasi'))) {
            mkdir(public_path('images/sertifikasi'), 0777, true);
        }
        
        $image = $request->file('gambar');
        $imageName = time() . '.' . $image->extension();
        $image->move(public_path('images/sertifikasi'), $imageName);
        $data['gambar'] = $imageName;
    }

        Sertifikasi::create($data);
        return redirect()->route('sertifikasi.index')->with('success', 'Data Berhasil Ditambahkan');
    }
    
    public function show(string $id)
    {
        //
    }

    public function edit(string $id){
        $sertifikasi = Sertifikasi::findOrFail($id);
        return view('sertifikasi.edit', ['sertifikasi' => $sertifikasi]);
    }

    public function update(Request $request, string $id)
    {
        $request->validate([
            'gambar' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);

        $sertifikasi = Sertifikasi::findOrFail($id);
        
        $data = [
            'gambar' => $request->gambar,
        ];

        if ($request->hasFile('gambar')) {
            if ($sertifikasi->gambar && file_exists(public_path('images/sertifikasi/' . $sertifikasi->gambar))) {
                unlink(public_path('images/sertifikasi/' . $sertifikasi->gambar));
            }
            
            $image = $request->file('gambar');
            $imageName = time() . '.' . $image->extension();
            $image->move(public_path('images/sertifikasi'), $imageName);
            $data['gambar'] = $imageName;
        }

        $sertifikasi->update($data);
        
        return redirect()->route('sertifikasi.index')->with('update', 'Data berhasil diupdate');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $sertifikasi = Sertifikasi::findOrFail($id);
        
        if ($sertifikasi->gambar && file_exists(public_path('images/sertifikasi/' . $sertifikasi->gambar))) {
            unlink(public_path('images/sertifikasi/' . $sertifikasi->gambar));
        }
        
        $sertifikasi->delete();
        
        return redirect()->route('sertifikasi.index')->with('delete', 'Data berhasil dihapus');
    }

    public function jadwal($id)
    {
        $response = Http::get('http://localhost:8080/sertifikasi/jadwal/'.$id);
        $sertifikasi = Sertifikasi::findOrFail($id);
        $jadwal = $sertifikasi->jadwal;
        return view('sertifikasi.jadwal', compact('jadwal'));
    }
}
