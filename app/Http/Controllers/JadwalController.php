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
            'judul_training' => 'required',
            'tgl_mulai' => 'required|date',
            'tgl_selesai' => 'required|date',
            'lokasi' => 'required',          
        ]);

        Jadwal::create([
        'tipe' => 'training',
        'judul_training' => $request->judul_training,
        'tgl_mulai' => $request->tgl_mulai,
        'tgl_selesai' => $request->tgl_selesai,
        'lokasi' => $request->lokasi
    ]);
        return redirect()->route('jadwal.index')->with('success', 'Data Berhasil Ditambahkan');
    }
    
    public function show(string $id)
    {
        //
    }

    public function edit(string $id){
        $jadwal = Jadwal::findOrFail($id);
        return view('jadwal.edit', ['jadwal' => $jadwal]);
    }

    public function update(Request $request, string $id)
    {
        $request->validate([
            'judul_training' => 'required|string',
            'tgl_mulai' => 'required|date',
            'tgl_selesai' => 'required|date',
            'lokasi' => 'required|string'
        ]);

        try {
            $jadwal = Jadwal::findOrFail($id);
            $jadwal->update([
                'judul_training' => $request->judul_training,
                'tgl_mulai' => $request->tgl_mulai,
                'tgl_selesai' => $request->tgl_selesai,
                'lokasi' => $request->lokasi
            ]);
            
            return redirect()->route('jadwal.index')->with('success', 'Data jadwal berhasil diperbarui.');
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
            $jadwal = Jadwal::findOrFail($id);
            $jadwal->delete();
            
            return redirect()->route('jadwal.index')->with('success', 'Jadwal berhasil dihapus.');
        } catch (\Exception $e) {
            return redirect()->route('jadwal.index')->with('error', 'Gagal menghapus data jadwal: ' . $e->getMessage());
        }
    }
}
