<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Staff;
use Illuminate\Support\Facades\Http;
use App\Http\Controllers\Controller;


class StaffController extends Controller
{
    public function index(){
        $staff = Staff::all();
        return view('staff.index', compact('staff'));
    }

    public function create(){
        return view('staff.create');
    }

    public function store(Request $request){

        request()->validate([
            'id_staff' => 'required',
            'nama' => 'required',            
            'jabatan' => 'required',           
        ]);

        $staff = Staff::create($request->all());
        return redirect()->route('staff.index')->with('success', 'Data Berhasil Ditambahkan');
    }

    public function show(string $id)
    {
        //
    }

    public function edit(string $id_staff){
        $staff = Staff::findOrFail($id_staff);
        return view('staff.edit', ['staff' => $staff]);
    }

    public function update(Request $request, string $id)
    {
        

        $request->validate([
            'nama' => 'required|string',
            'jabatan' => 'required|string'
        ]);
    
        // Kirim data ke API untuk update
        $response = Http::put("http://localhost:8080/staff/{$id}", [
            'nama' => $request->nama,
            'jabatan' => $request->jabatan
        ]);
        if ($response->successful()) {
            return redirect()->route('staff.index')->with('success', 'Data staff berhasil diperbarui.');
        } else {
            // Tampilkan pesan error dari API
            $errorMessage = $response->json()['message'] ?? 'Gagal memperbarui data staff. Silakan coba lagi.';
            return back()->with('error', $errorMessage);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $response = Http::delete("http://localhost:8080/staff/{$id}");

        // Cek respons dari API
        if ($response->successful()) {
            return redirect()->route('staff.index')->with('success', 'staff berhasil dihapus.');
        } else {
            return redirect()->route('staff.index')->with('error', 'Gagal menghapus data staff.');
        }
    }
}
