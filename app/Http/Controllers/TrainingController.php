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
            'judul' => 'required',  
            'isi' => 'required',
            'tgl_rilis' => 'required',
            'gambar' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',    
            
        ]);

        $data = [
        'judul' => $request->judul,
        'isi' => $request->isi,
        'tgl_rilis' => $request->tgl_rilis,
    ];

    if ($request->hasFile('gambar')) {
        // Buat folder jika belum ada
        if (!file_exists(public_path('images/inhouse'))) {
            mkdir(public_path('images/inhouse'), 0777, true);
        }
        
        $image = $request->file('gambar');
        $imageName = time() . '.' . $image->extension();
        $image->move(public_path('images/inhouse'), $imageName);
        $data['gambar'] = $imageName;
    }

    Training::create($data);
    
    return redirect()->route('training.index')->with('create', 'Data Berhasil Ditambahkan');
    }

    public function show(string $id)
    {
        $training = Training::findOrFail($id);
        return view('training.show', compact('training'));
    }

    public function edit(string $id){
        $training = Training::findOrFail($id);
        return view('training.edit', ['training' => $training]);
    }

    public function update(Request $request, string $id)
    {
        $request->validate([
            'judul' => 'required|string',
            'isi' => 'required|string',
            'tgl_rilis' => 'required|string',
            'gambar' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $training = Training::findOrFail($id);
        
        $data = [
            'judul' => $request->judul,
            'isi' => $request->isi,
            'tgl_rilis' => $request->tgl_rilis,
        ];

        if ($request->hasFile('gambar')) {
            if ($training->gambar && file_exists(public_path('images/inhouse/' . $training->gambar))) {
                unlink(public_path('images/inhouse/' . $training->gambar));
            }
            
            $image = $request->file('gambar');
            $imageName = time() . '.' . $image->extension();
            $image->move(public_path('images/inhouse'), $imageName);
            $data['gambar'] = $imageName;
        }

        $training->update($data);
        
        return redirect()->route('training.index')->with('update', 'Data berhasil diupdate');
    }

    public function destroy(string $id)
    {
        $training = training::findOrFail($id);
        
        if ($training->gambar && file_exists(public_path('images/inhouse/' . $training->gambar))) {
            unlink(public_path('images/inhouse/' . $training->gambar));
        }
        
        $training->delete();
        
        return redirect()->route('training.index')->with('delete', 'Data berhasil dihapus');
    }
}
