<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Konsultan;
use Illuminate\Support\Facades\Storage;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Http;

class KonsultanController extends Controller
{
    public function index(){
        $konsultan = Konsultan::all();
        return view('konsultan', compact('konsultan'));
        
    }

    public function create(){
        return view('konsultan.create');
    }

    public function store(Request $request){

        request()->validate([
            'judul' => 'required',
            'isi' => 'required',
            'gambar' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',      
        ]);

        konsultan::create([
        'judul' => $request->judul,
        'isi' => $request->isi,
        'gambar' => $request->gambar,
    ]);
        return redirect()->route('konsultan.index')->with('success', 'Data Berhasil Ditambahkan');
    }
    
    public function show(string $id)
    {
        //
    }

    public function edit(string $id){
        $konsultan = Konsultan::findOrFail($id);
        return view('konsultan.edit', ['konsultan' => $konsultan]);
    }

    public function update(Request $request, string $id)
    {
        $request->validate([
            'judul' => 'required|string',
            'isi' => 'required|string',
            'gambar' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);

        try {
            $konsultan = Konsultan::findOrFail($id);
            $konsultan->update([
                'judul' => $request->judul,
                'isi' => $request->isi,
                'gambar' => $request->gambar
            ]);
            
            return redirect()->route('konsultan.index')->with('success', 'Data konsultan berhasil diperbarui.');
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
            $konsultan = Konsultan::findOrFail($id);
            $konsultan->delete();
            
            return redirect()->route('konsultan.index')->with('success', 'konsultan berhasil dihapus.');
        } catch (\Exception $e) {
            return redirect()->route('konsultan.index')->with('error', 'Gagal menghapus data konsultan: ' . $e->getMessage());
        }
    }
}
