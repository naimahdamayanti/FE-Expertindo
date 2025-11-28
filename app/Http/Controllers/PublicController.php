<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Controllers\Controller;
use App\Models\PublicTraining;
use Illuminate\Support\Facades\Http;


class PublicController extends Controller
{
    public function index()
    {
        $response = Http::get('http://localhost:8080/publictraining'); 
        $publictraining = PublicTraining::all();
        return view('publictraining.index', compact('publictraining'));
    }

    public function show($id)
    {
        $response = Http::get('http://localhost:8080/publictraining/'.$id);
        $publictraining = PublicTraining::findOrFail($id);
        return view('publictraining.show', compact('publictraining'));
    }

    public function jadwal($id)
    {
        $response = Http::get('http://localhost:8080/publictraining/jadwal/'.$id);
        $publictraining = PublicTraining::findOrFail($id);
        $jadwal = $publictraining->jadwal;
        return view('publictraining.jadwal', compact('jadwal'));
    }
}
