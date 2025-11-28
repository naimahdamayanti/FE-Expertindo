<?php

namespace App\Http\Controllers;

use App\Models\Jadwal;
use Illuminate\Support\Facades\Http;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;


class JadwalController extends Controller
{
    public function index(){
        $jadwal = Jadwal::all();
        return view('jadwal.index', compact('jadwal'));
    }

    public function create(){
        return view('jadwal.create');
    }

    public function store(Request $request){

        request()->validate([
            'id_kategori' => 'required',
            'kategori' => 'required',            
            'tema' => 'required',            
        ]);

        $jadwal = Jadwal::create($request->all());
        return redirect()->route('jadwal.index')->with('success', 'Data Berhasil Ditambahkan');
    }

    public function show(string $id)
    {
        //
    }

    public function edit(string $id_kategori){
        $jadwal = Jadwal::findOrFail($id_kategori);
        return view('jadwal.edit', ['jadwal' => $jadwal]);
    }

    public function update(Request $request, string $id)
    {
        

        $request->validate([
            'kategori' => 'required|string',
            'tema' => 'required|string'
        ]);
    
        // Kirim data ke API untuk update
        $response = Http::put("http://localhost:8080/Jadwal/{$id}", [
            'kategori' => $request->kategori,
            'tema' => $request->tema
        ]);
        if ($response->successful()) {
            return redirect()->route('jadwal.index')->with('success', 'Data jadwal berhasil diperbarui.');
        } else {
            // Tampilkan pesan error dari API
            $errorMessage = $response->json()['message'] ?? 'Gagal memperbarui data jadwal. Silakan coba lagi.';
            return back()->with('error', $errorMessage);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $response = Http::delete("http://localhost:8080/Jadwal/{$id}");

        // Cek respons dari API
        if ($response->successful()) {
            return redirect()->route('jadwal.index')->with('success', 'Jadwal berhasil dihapus.');
        } else {
            return redirect()->route('jadwal.index')->with('error', 'Gagal menghapus data jadwal.');
        }
    }
}
