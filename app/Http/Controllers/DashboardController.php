<?php

namespace App\Http\Controllers;

use App\Models\Jadwal;
use App\Models\Staff;
use App\Models\Training;
use App\Models\Testimoni;
use App\Models\Sertifikasi;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class DashboardController extends Controller
{
    public function index(){
        $jadwal = Jadwal::count();
        $staff = Staff::count();
        $training = Training::count();
        $testimoni = Testimoni::count();
        $sertifikasi = Sertifikasi::count();
    
        $user = (object) [
        'id' => session('id'),
        'nama' => session('nama', 'User'),
        'email' => session('email'),
        'role' => session('role', 'user')
        ];
        
        return view('dashboard', compact('jadwal', 'staff', 'training','testimoni'));
    }
    

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
