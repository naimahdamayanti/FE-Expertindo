<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Controllers\Controller;
use App\Models\PublicTraining;
use Illuminate\Support\Facades\Http;


class PublicController extends Controller
{
    public function index(){
        $publictraining = Publictraining::all();
        return view('publictraining.index', compact('publictraining'));
    }

    public function create(){
        return view('publictraining.create');
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
        if (!file_exists(public_path('images/publictraining'))) {
            mkdir(public_path('images/publictraining'), 0777, true);
        }
        
        $image = $request->file('gambar');
        $imageName = time() . '.' . $image->extension();
        $image->move(public_path('images/publictraining'), $imageName);
        $data['gambar'] = $imageName;
    }

    Publictraining::create($data);
        return redirect()->route('publictraining.index')->with('success', 'Data Berhasil Ditambahkan');
    }
    
    public function show(string $id)
    {
        //
    }

    public function edit(string $id){
        $publictraining = Publictraining::findOrFail($id);
        return view('publictraining.edit', ['publictraining' => $publictraining]);
    }

    public function update(Request $request, string $id)
    {
        $request->validate([
            'gambar' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);

        $publictraining = Publictraining::findOrFail($id);
        
        $data = [
            'gambar' => $request->gambar,
        ];

        if ($request->hasFile('gambar')) {
            if ($publictraining->gambar && file_exists(public_path('images/publictraining/' . $publictraining->gambar))) {
                unlink(public_path('images/publictraining/' . $publictraining->gambar));
            }
            
            $image = $request->file('gambar');
            $imageName = time() . '.' . $image->extension();
            $image->move(public_path('images/publictraining'), $imageName);
            $data['gambar'] = $imageName;
        }

        $publictraining->update($data);
        return redirect()->route('publictraining.index')->with('update', 'Data berhasil diupdate');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $publictraining = Publictraining::findOrFail($id);
        
        if ($publictraining->gambar && file_exists(public_path('images/publictraining/' . $publictraining->gambar))) {
            unlink(public_path('images/publictraining/' . $publictraining->gambar));
        }
        
        $publictraining->delete();
        
        return redirect()->route('publictraining.index')->with('delete', 'Data berhasil dihapus');
    }

    public function jadwal($id)
    {
        $response = Http::get('http://localhost:8080/publictraining/jadwal/'.$id);
        $publictraining = PublicTraining::findOrFail($id);
        $jadwal = $publictraining->jadwal;
        return view('publictraining.jadwal', compact('jadwal'));
    }
}
