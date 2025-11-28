@extends('layout')
@section('title','Input Public Training')
@section('judul','Public Training')
@section('isi')
@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
<form action="{{ route('publictraining.store')}}" method="post">
        @csrf
        <div class="form-group mb-2">
            <label>ID Kehadiran</label>
            <input type="text" name="id_kehadiran" type="text"  class="form-control">
        </div>
        <div class="form-group mb-2">
            <label>NPM</label>
            <input type="text" name="npm" type="text"  class="form-control">
        </div>
        <div class="form-group mb-2">
            <label>ID Dosen</label>
            <input type="text" name="id_dosen" type="text"  class="form-control">
        </div>
        <div class="form-group mb-2">
            <label>ID Mata Kuliah</label>
            <input type="text" name="id_matkul" type="text"  class="form-control">
        </div>
        <div class="form-group mb-2">
                    <label for="validationCustom01" class="form-label">Pertemuan</label>
                    <select value=" {{ old('pertemuan')}}" class="form-control " name="pertemuan">
                    <option value="">--Pilih Pertemuan--</option>
                    <option value="1">Pertemuan 1</option>
                    <option value="2">Pertemuan 2</option>
                    <option value="3">Pertemuan 3</option>
                    <option value="4">Pertemuan 4</option>
                    <option value="5">Pertemuan 5</option>
                    </select>
            </div>
            <div class="form-group mb-2">
                    <label for="validationCustom01" class="form-label">Keterangan</label>
                    <select name="keterangan" class="form-control">
                    <option value="">--Pilih Keterangan--</option>
                    <option value="H">H</option>
                    <option value="I">I</option>
                    <option value="S">S</option>
                    <option value="A">A</option>
                    </select>
            </div>
            
            <div class="form-group">
            <button class="btn btn-primary" type="submit">Save</button>
            <a href="{{ route('absensi.index') }}" class="btn btn-secondary">Kembali</a>
        </div>
    </form>
@endsection
