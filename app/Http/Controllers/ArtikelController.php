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
            'judul' => 'required',  
            'tgl_rilis' => 'required',
            'gambar' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',         
            'isi' => 'required',      
            
        ]);

        $data = [
        'judul' => $request->judul,
        'tgl_rilis' => $request->tgl_rilis,
        'isi' => $request->isi,
    ];

    if ($request->hasFile('gambar')) {
        // Buat folder jika belum ada
        if (!file_exists(public_path('images/artikel'))) {
            mkdir(public_path('images/artikel'), 0777, true);
        }
        
        $image = $request->file('gambar');
        $imageName = time() . '.' . $image->extension();
        $image->move(public_path('images/artikel'), $imageName);
        $data['gambar'] = $imageName;
    }

    Artikel::create($data);
    
    return redirect()->route('artikel.index')->with('create', 'Data Berhasil Ditambahkan');
    }

    public function show(string $id)
    {
        $artikel = Artikel::findOrFail($id);
        return view('artikel.detail', compact('artikel'));
    }

    public function edit(string $id){
        $artikel = Artikel::findOrFail($id);
        return view('artikel.edit', ['artikel' => $artikel]);
    }

    public function update(Request $request, string $id)
    {
        $request->validate([
            'judul' => 'required|string',
            'tgl_rilis' => 'required|date',
            'gambar' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'isi' => 'required|string',
        ]);

        $artikel = Artikel::findOrFail($id);
        
        $data = [
            'judul' => $request->judul,
            'tgl_rilis' => $request->tgl_rilis,
            'isi' => $request->isi,
        ];

        if ($request->hasFile('gambar')) {
            if ($artikel->gambar && file_exists(public_path('images/artikel/' . $artikel->gambar))) {
                unlink(public_path('images/artikel/' . $artikel->gambar));
            }
            
            $image = $request->file('gambar');
            $imageName = time() . '.' . $image->extension();
            $image->move(public_path('images/artikel'), $imageName);
            $data['gambar'] = $imageName;
        }

        $artikel->update($data);
        
        return redirect()->route('artikel.index')->with('update', 'Data berhasil diupdate');
    }

    public function destroy(string $id)
    {
        $artikel = Artikel::findOrFail($id);
        
        if ($artikel->gambar && file_exists(public_path('images/artikel/' . $artikel->gambar))) {
            unlink(public_path('images/artikel/' . $artikel->gambar));
        }
        
        $artikel->delete();
        
        return redirect()->route('artikel.index')->with('delete', 'Data berhasil dihapus');
    }
}
