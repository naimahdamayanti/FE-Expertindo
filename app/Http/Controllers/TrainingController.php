<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Training;

use Illuminate\Support\Facades\Http;
use App\Http\Controllers\Controller;

class TrainingController extends Controller
{
    public function index(){
        $training = Training::all();
        return view('training.index', compact('training'));
    }

    public function create(){
        return view('training.create');
    }

    public function store(Request $request){

        request()->validate([
            'id_training' => 'required',
            'judul' => 'required',            
            'isi' => 'required', 
            'tgl_rilis' => 'required',           
        ]);

        $training = Training::create($request->all());
        return redirect()->route('training.index')->with('success', 'Data Berhasil Ditambahkan');
    }

    public function show(string $id)
    {
        //
    }

    public function edit(string $id_training){
        $training = Training::findOrFail($id_training);
        return view('training.edit', ['training' => $training]);
    }

    public function update(Request $request, string $id)
    {
        

        $request->validate([
            'judul' => 'required|string',
            'isi' => 'required|string',
            'tgl_rilis' => 'required|date'
        ]);
    
        // Kirim data ke API untuk update
        $response = Http::put("http://localhost:8080/training/{$id}", [
            'judul' => $request->judul,
            'isi' => $request->isi,
            'tgl_rilis' => $request->tgl_rilis
        ]);
        if ($response->successful()) {
            return redirect()->route('training.index')->with('success', 'Data training berhasil diperbarui.');
        } else {
            // Tampilkan pesan error dari API
            $errorMessage = $response->json()['message'] ?? 'Gagal memperbarui data training. Silakan coba lagi.';
            return back()->with('error', $errorMessage);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $response = Http::delete("http://localhost:8080/training/{$id}");

        // Cek respons dari API
        if ($response->successful()) {
            return redirect()->route('training.index')->with('success', 'training berhasil dihapus.');
        } else {
            return redirect()->route('training.index')->with('error', 'Gagal menghapus data training.');
        }
    }
}
