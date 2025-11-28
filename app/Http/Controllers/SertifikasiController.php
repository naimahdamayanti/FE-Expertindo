<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Sertifikasi;
use App\Models\Jadwal;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Http;



class SertifikasiController extends Controller
{
    public function index()
    {
        $response = Http::get('http://localhost:8080/sertifikasi'); 
        $sertifikasi = Sertifikasi::all();
        return view('sertifikasi.index', compact('sertifikasi'));
    }

    public function show($id)
    {
        $response = Http::get('http://localhost:8080/sertifikasi/'.$id);
        $sertifikasi = Sertifikasi::findOrFail($id);
        return view('sertifikasi.show', compact('sertifikasi'));
    }

    public function jadwal($id)
    {
        $response = Http::get('http://localhost:8080/sertifikasi/jadwal/'.$id);
        $sertifikasi = Sertifikasi::findOrFail($id);
        $jadwal = $sertifikasi->jadwal;
        return view('sertifikasi.jadwal', compact('jadwal'));
    }
}
