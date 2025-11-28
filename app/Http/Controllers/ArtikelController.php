<?php

namespace App\Http\Controllers;

use App\Models\Artikel;
use Illuminate\Support\Facades\Http;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ArtikelController extends Controller
{
    public function index(){
        $artikel = Artikel::all();
        return view('artikel.index', compact('artikel'));
    }

    public function create(){
        return view('artikel.create');
    }

    public function store(Request $request){

        request()->validate([
            'id_artikel' => 'required',
            'judul' => 'required',            
            'isi' => 'required',            
            'tgl_rilis' => 'required'
        ]);

        $artikel = Artikel::create($request->all());
        return redirect()->route('artikel.index')->with('success', 'Data Berhasil Ditambahkan');
    }

    public function show(string $id)
    {
        //
    }

    public function edit(string $id_artikel){
        $artikel = Artikel::findOrFail($id_artikel);
        return view('artikel.edit', ['artikel' => $artikel]);
    }

    public function update(Request $request, string $id)
    {
        

        $request->validate([
            'judul' => 'required|string',
            'isi' => 'required|string',
            'tgl_rilis' => 'required|date'
        ]);
    
        // Kirim data ke API untuk update
        $response = Http::put("http://localhost:8080/Artikel/{$id}", [
            'judul' => $request->judul,
            'isi' => $request->isi,
            'tgl_rilis' => $request->tgl_rilis
        ]);
        if ($response->successful()) {
            return redirect()->route('artikel.index')->with('success', 'Data artikel berhasil diperbarui.');
        } else {
            // Tampilkan pesan error dari API
            $errorMessage = $response->json()['message'] ?? 'Gagal memperbarui data artikel. Silakan coba lagi.';
            return back()->with('error', $errorMessage);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $response = Http::delete("http://localhost:8080/Artikel/{$id}");

        // Cek respons dari API
        if ($response->successful()) {
            return redirect()->route('artikel.index')->with('success', 'Artikel berhasil dihapus.');
        } else {
            return redirect()->route('artikel.index')->with('error', 'Gagal menghapus data artikel.');
        }
    }
}
