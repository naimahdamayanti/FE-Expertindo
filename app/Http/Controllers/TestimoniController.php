<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Testimoni;
use Illuminate\Support\Facades\Http;
use App\Http\Controllers\Controller;

class TestimoniController extends Controller
{
    public function index(){
        $testimoni = Testimoni::all();
        return view('testimoni.index', compact('testimoni'));
    }

    public function create(){
        return view('testimoni.create');
    }

    public function store(Request $request){

        request()->validate([
            'id_testimoni' => 'required',
            'nama' => 'required',            
            'jabatan' => 'required', 
            'isi' => 'required',              
        ]);

        $testimoni = Testimoni::create($request->all());
        return redirect()->route('testimoni.index')->with('success', 'Data Berhasil Ditambahkan');
    }

    public function show(string $id)
    {
        //
    }

    public function edit(string $id_testimoni){
        $testimoni = Testimoni::findOrFail($id_testimoni);
        return view('testimoni.edit', ['testimoni' => $testimoni]);
    }

    public function update(Request $request, string $id)
    {
        

        $request->validate([
            'nama' => 'required|string',
            'jabatan' => 'required|string',
            'isi' => 'required|string'
        ]);
    
        // Kirim data ke API untuk update
        $response = Http::put("http://localhost:8080/testimoni/{$id}", [
            'nama' => $request->nama,
            'jabatan' => $request->jabatan,
            'isi' => $request->isi
        ]);
        if ($response->successful()) {
            return redirect()->route('testimoni.index')->with('success', 'Data testimoni berhasil diperbarui.');
        } else {
            // Tampilkan pesan error dari API
            $errorMessage = $response->json()['message'] ?? 'Gagal memperbarui data testimoni. Silakan coba lagi.';
            return back()->with('error', $errorMessage);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $response = Http::delete("http://localhost:8080/testimoni/{$id}");

        // Cek respons dari API
        if ($response->successful()) {
            return redirect()->route('testimoni.index')->with('success', 'testimoni berhasil dihapus.');
        } else {
            return redirect()->route('testimoni.index')->with('error', 'Gagal menghapus data testimoni.');
        }
    }
}
