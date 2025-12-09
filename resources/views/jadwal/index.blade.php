@extends('layout')
@section('title','Jadwal')
@section('judul','Jadwal')
@section('isi')

@if (Session::has('create'))
<div class="alert alert-success alert-dismissible fade show" role="alert">
    <strong>Data Berhasil Di Tambah</strong> You should check in on some of those fields below.
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>
@endif

@if (Session::has('delete'))
<div class="alert alert-danger alert-dismissible fade show" role="alert">
    <strong>Data Berhasil Di Hapus!</strong> You should check in on some of those fields below.
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>
@endif

@if (Session::has('update'))
<div class="alert alert-warning alert-dismissible fade show" role="alert">
    <strong>Data Berhasil Di Edit!</strong> You should check in on some of those fields below.
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>
@endif

@if (Session::has('daftar'))
<div class="alert alert-success alert-dismissible fade show" role="alert">
    <strong>Pendaftaran Berhasil!</strong> Anda telah terdaftar dalam training ini.
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>
@endif

<style>
    .jadwal-container {
        background-color: white;
        padding: 20px;
        border-radius: 8px;
        box-shadow: 0 2px 4px rgba(0,0,0,0.1);
        margin-top: 20px;
    }

    .jadwal-title {
        text-align: center;
        font-size: 20px;
        margin-bottom: 20px;
        color: #333;
        font-weight: 600;
    }

    .search-box {
        max-width: 400px;
        margin: 0 auto 40px;
        position: relative;
    }
    
    .search-box input {
        width: 100%;
        padding: 12px 20px 12px 45px;
        border: 2px solid #e0e0e0;
        border-radius: 25px;
        font-size: 14px;
        transition: all 0.3s;
    }
    
    .search-box input:focus {
        outline: none;
        border-color: #4CAF50;
        box-shadow: 0 0 10px rgba(76, 175, 80, 0.1);
    }
    
    .search-box i {
        position: absolute;
        left: 18px;
        top: 50%;
        transform: translateY(-50%);
        color: #999;
    }

    .table-jadwal {
        width: 100%;
        border-collapse: collapse;
    }

    .table-jadwal thead {
        background-color: #f8f8f8;
    }

    .table-jadwal th {
        padding: 12px;
        text-align: center;
        font-weight: 600;
        font-size: 14px;
        color: #333;
        border: 1px solid #ddd;
    }

    .table-jadwal tbody tr {
        border: 1px solid #ddd;
    }

    .table-jadwal tbody tr:nth-child(even) {
        background-color: #f9f9f9;
    }

    .table-jadwal td {
        padding: 12px;
        text-align: center;
        font-size: 14px;
        color: #555;
        border: 1px solid #ddd;
    }

    .btn-tambah {
        margin-bottom: 20px;
    }

    .header-action {
        display: flex;
        justify-content: flex-end;
        margin-bottom: 15px;
    }

    .btn-daftar-sekarang {
        background-color: #dc3545;
        color: white;
        border: none;
        padding: 6px 16px;
        border-radius: 4px;
        font-size: 12px;
        cursor: pointer;
        transition: background-color 0.3s;
    }

    .btn-daftar-sekarang:hover {
        background-color: #c82333;
    }

    @media (max-width: 768px) {
        .jadwal-container {
            padding: 15px;
        }

        .table-jadwal th, 
        .table-jadwal td {
            padding: 8px;
            font-size: 12px;
        }
    }
</style>

<div class="container-fluid mb-3">
    <a href="{{ url('/dashboard') }}" class="back-button">
        <i class="fas fa-arrow-left"></i> Jadwal Training
    </a>
    <div class="row">
        <div class="col-12 text-end">
            @if(session('user') && session('user')->role === 'admin')
                <a href="{{ route('jadwal.create') }}" class="btn btn-success btn-lg">
                    <i class="fas fa-plus"></i> Tambah Jadwal
                </a>
            @endif
        </div>
    </div>
</div>

<div class="container-fluid">
    <div class="jadwal-container">
        <h1 class="jadwal-title">Jadwal Training</h1>
        <div class="search-box">
            <i class="fas fa-search"></i>
            <input type="text" id="searchInput" placeholder="Cari" onkeyup="filterTable()">
        </div>
        
        <div class="table-responsive">
            <table class="table-jadwal" id="trainingTable">
                <thead>
                    <tr>
                        <th scope="col">Judul Training</th>
                        <th scope="col">Tanggal Mulai</th>
                        <th scope="col">Tanggal Selesai</th>
                        <th scope="col">Lokasi</th>
                        <th scope="col">
                            @if(session('user') && session('user')->role === 'admin')
                                Aksi
                            @else
                                Daftar
                            @endif
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($jadwal as $data)
                    <tr>
                        <td>{{ $data->judul_training }}</td>
                        <td>{{ \Carbon\Carbon::parse($data->tgl_mulai)->format('d-m-Y') }}</td>
                        <td>{{ \Carbon\Carbon::parse($data->tgl_selesai)->format('d-m-Y') }}</td>
                        <td>{{ $data->lokasi }}</td>
                        <td>
                            @if(session('user') && session('user')->role === 'admin')
                                <!-- Tampilan untuk Admin -->
                                <a href="{{ route('jadwal.edit', $data->id) }}">
                                    <button class="btn btn-warning btn-sm text-white">
                                        <i class="fas fa-edit"></i> EDIT
                                    </button>
                                </a>
                                <form action="{{ route('jadwal.destroy', $data->id) }}" method="POST" style="display: inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?');">
                                        <i class="fas fa-trash"></i> HAPUS
                                    </button>
                                </form>
                            @else
                                <!-- Tampilan untuk User -->
                                <a href="https://docs.google.com/forms/d/e/1FAIpQLSfvq91dPTt6z6hVB3tYrVE7bzlMVZ3r5g0x0BKkuFJM0kuHBA/viewform" target="_blank">
                                    <button type="button" class="btn-daftar-sekarang">
                                        Daftar
                                    </button>
                                </a>
                            @endif
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5" class="text-center">Tidak ada data jadwal training</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>

<script>
    function filterTable() {
        const input = document.getElementById('searchInput');
        const filter = input.value.toLowerCase();
        const table = document.getElementById('trainingTable');
        const rows = table.getElementsByTagName('tbody')[0].getElementsByTagName('tr');

        for (let i = 0; i < rows.length; i++) {
            const cells = rows[i].getElementsByTagName('td');
            let found = false;

            for (let j = 0; j < cells.length; j++) {
                const cell = cells[j];
                if (cell) {
                    const textValue = cell.textContent || cell.innerText;
                    if (textValue.toLowerCase().indexOf(filter) > -1) {
                        found = true;
                        break;
                    }
                }
            }

            rows[i].style.display = found ? '' : 'none';
        }
    }
</script>

@endsection