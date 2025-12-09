@extends('layout')
@section('title','Edit Jadwal')
@section('judul','Form Edit Jadwal')
@section('isi')

<style>
    .page-header {
        margin: 0;
        font-size: 28px;
        font-weight: 700;
        text-align: center;
    }

    .form-container {
        background-color: white;
        padding: 40px;
        border-radius: 12px;
        box-shadow: 0 2px 10px rgba(0,0,0,0.08);
        max-width: 700px;
        margin: 0 auto;
    }

    .form-group {
        margin-bottom: 25px;
    }

    .form-group label {
        font-weight: 600;
        color: #444;
        margin-bottom: 8px;
        display: block;
        font-size: 14px;
    }

    .form-control-modern {
        width: 100%;
        padding: 12px 15px;
        border: 2px solid #e0e0e0;
        border-radius: 8px;
        font-size: 14px;
        transition: all 0.3s;
        background-color: #fafafa;
    }

    .form-control-modern:focus {
        outline: none;
        border-color: #f5576c;
        background-color: white;
        box-shadow: 0 0 0 3px rgba(245, 87, 108, 0.1);
    }

    .form-control-modern:hover {
        border-color: #b0b0b0;
    }

    select.form-control-modern {
        cursor: pointer;
        appearance: none;
        background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='12' height='12' viewBox='0 0 12 12'%3E%3Cpath fill='%23333' d='M6 9L1 4h10z'/%3E%3C/svg%3E");
        background-repeat: no-repeat;
        background-position: right 15px center;
        padding-right: 40px;
    }

    .input-icon-wrapper {
        position: relative;
    }

    .input-icon-wrapper i {
        position: absolute;
        left: 15px;
        top: 50%;
        transform: translateY(-50%);
        color: #999;
    }

    .input-icon-wrapper .form-control-modern {
        padding-left: 45px;
    }

    .btn-update {
        background: linear-gradient(135deg, #f093fb 0%, #f5576c 100%);
        color: white;
        padding: 12px 35px;
        border: none;
        border-radius: 8px;
        font-size: 15px;
        font-weight: 600;
        cursor: pointer;
        transition: all 0.3s;
        box-shadow: 0 4px 6px rgba(245, 87, 108, 0.3);
    }

    .btn-update:hover {
        transform: translateY(-2px);
        box-shadow: 0 6px 12px rgba(245, 87, 108, 0.4);
        color: white;
    }

    .btn-back {
        background-color: #f0f0f0;
        color: #666;
        padding: 12px 35px;
        border: 2px solid #e0e0e0;
        border-radius: 8px;
        font-size: 15px;
        font-weight: 600;
        cursor: pointer;
        transition: all 0.3s;
        text-decoration: none;
        display: inline-block;
    }

    .btn-back:hover {
        background-color: #e0e0e0;
        border-color: #d0d0d0;
        color: #333;
        text-decoration: none;
    }

    .button-group {
        display: flex;
        gap: 15px;
        justify-content: center;
        margin-top: 35px;
        padding-top: 25px;
        border-top: 1px solid #e0e0e0;
    }

    .alert {
        padding: 15px 20px;
        border-radius: 8px;
        margin-bottom: 25px;
        border-left: 4px solid;
    }

    .alert-danger {
        background-color: #fee;
        border-left-color: #e74c3c;
        color: #c33;
    }

    .alert ul {
        margin: 0;
        padding-left: 20px;
    }

    .alert li {
        margin: 5px 0;
    }

    .badge-edit {
        background: linear-gradient(135deg, #f093fb 0%, #f5576c 100%);
        color: white;
        padding: 5px 15px;
        border-radius: 20px;
        font-size: 12px;
        font-weight: 600;
        display: inline-block;
        margin-left: 10px;
    }

    @media (max-width: 768px) {
        .form-container {
            padding: 25px;
        }

        .page-header {
            padding: 20px;
        }

        .page-header h2 {
            font-size: 22px;
        }

        .button-group {
            flex-direction: column;
        }

        .btn-update, .btn-back {
            width: 100%;
        }
    }
</style>

<div class="container-fluid">
    <div class="page-header">
        <h2><i class="fas fa-edit"></i> Edit Jadwal Training</h2>
    </div>

    <div class="form-container">
        @if ($errors->any())
        <div class="alert alert-danger">
            <strong><i class="fas fa-exclamation-circle"></i> Terdapat kesalahan!</strong>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif

        <form action="{{ route('jadwal.update', $jadwal->id) }}" method="post">
            @csrf
            @method('PUT')

            <div class="form-group">
                <label for="kategori">
                    <i class="fas fa-graduation-cap"></i> Judul Training 
                    <span class="badge-edit">EDIT MODE</span>
                </label>
                <div class="input-icon-wrapper">
                    <i class="fas fa-tag"></i>
                    <input 
                        type="text" 
                        name="judul_training" 
                        id="judul_training"
                        class="form-control-modern" 
                        placeholder="Masukkan Judul Training"
                        value="{{ $jadwal->judul_training }}"
                    >
                </div>
            </div>

            <div class="form-group">
                <label for="tgl_mulai">
                    <i class="fas fa-calendar-alt"></i> Tanggal Mulai
                </label>
                <input 
                        type="date" 
                        name="tgl_mulai" 
                        id="tgl_mulai"
                        class="form-control-modern" 
                        placeholder="Masukkan Tanggal Mulai"
                        value="{{ $jadwal->tgl_mulai}}"
                    >
            </div>

            <div class="form-group">
                <label for="tgl_selesai">
                    <i class="fas fa-calendar-check"></i> Tanggal Selesai
                </label>
                <input 
                        type="date" 
                        name="tgl_selesai" 
                        id="tgl_selesai"
                        class="form-control-modern" 
                        placeholder="Masukkan Tanggal Selesai"
                        value="{{ $jadwal->tgl_selesai}}"
                    >
            </div>

            <div class="form-group">
                <label for="lokasi">
                    <i class="fas fa-map-marker-alt"></i> Lokasi
                </label>
                <input 
                        type="text" 
                        name="lokasi" 
                        id="lokasi"
                        class="form-control-modern" 
                        placeholder="Masukkan Lokasi"
                        value="{{ $jadwal->lokasi}}"
                    >
            </div>

            <div class="button-group">
                <button type="submit" class="btn-update">
                    <i class="fas fa-save"></i> Update
                </button>
                <a href="{{ route('jadwal.index') }}" class="btn-back">
                    <i class="fas fa-arrow-left"></i> Kembali
                </a>
            </div>
        </form>
    </div>
</div>

@endsection