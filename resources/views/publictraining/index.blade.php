@extends('layout')
@section('title','Public Training')
@section('judul','Public Training')
@section('isi')

<!-- Alert Messages -->
@if (Session::has('create'))
<div class="alert alert-success alert-dismissible fade show" role="alert">
    <strong>Data Berhasil Ditambah!</strong> Training baru telah berhasil ditambahkan.
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>
@endif

@if (Session::has('delete'))
<div class="alert alert-danger alert-dismissible fade show" role="alert">
    <strong>Data Berhasil Dihapus!</strong> Training telah dihapus dari sistem.
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>
@endif

@if (Session::has('update'))
<div class="alert alert-warning alert-dismissible fade show" role="alert">
    <strong>Data Berhasil Diupdate!</strong> Perubahan telah disimpan.
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>
@endif

@if(session('success'))
<div class="alert alert-success alert-dismissible fade show" role="alert">
    <strong>Sukses!</strong> {{ session('success') }}
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>
@endif

    <!-- CSS untuk styling card grid -->
<style>

    .training-header {
        text-align: center;
        margin-bottom: 30px;
    }
    
    .training-header h2 {
        font-size: 28px;
        font-weight: 600;
        color: #333;
        margin-bottom: 20px;
    }

    .training-grid-container {
        padding: 20px;
        background-color: #f8f9fa;
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

    .training-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(250px, 1fr));
        gap: 20px;
        margin-top: 20px;
    }

    .training-card {
        background: white;
        border-radius: 8px;
        overflow: hidden;
        box-shadow: 0 2px 8px rgba(0,0,0,0.1);
        transition: transform 0.3s ease, box-shadow 0.3s ease;
        cursor: pointer;
        text-decoration: none;
        color: inherit;
        display: block;
    }

    .training-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 4px 16px rgba(0,0,0,0.15);
    }

    .training-card-image {
        width: 100%;
        height: 200px;
        object-fit: cover;
        background-color: #e9ecef;
    }

    .training-card-body {
        padding: 15px;
    }

    .training-card-title {
        font-size: 16px;
        font-weight: 600;
        color: #333;
        margin: 0 0 10px 0;
        line-height: 1.4;
        display: -webkit-box;
        -webkit-line-clamp: 2;
        -webkit-box-orient: vertical;
        overflow: hidden;
    }

    .training-card-meta {
        font-size: 13px;
        color: #666;
        margin: 5px 0;
    }

    .training-card-meta i {
        margin-right: 5px;
        color: #007bff;
    }

    .no-results {
        text-align: center;
        padding: 40px;
        color: #666;
        font-size: 16px;
    }

        .btn-edit,
    .btn-delete {
        padding: 6px 12px;
        border-radius: 5px;
        border: none;
        cursor: pointer;
        font-size: 14px;
        transition: all 0.3s;
        display: inline-flex;
        align-items: center;
        justify-content: center;
    }

    .btn-edit {
        background-color: #ffc107;
        color: white;
        text-decoration: none;
    }

    .btn-edit:hover {
        background-color: #e0a800;
    }

    .btn-delete {
        background-color: #dc3545;
        color: white;
    }

    .btn-delete:hover {
        background-color: #c82333;
    }
</style>

<div class="container-fluid mb-3">
    <a href="{{ url('/dashboard') }}" class="back-button">
        <i class="fas fa-arrow-left"></i> Public Training
    </a>
    <div class="row">
        <div class="col-12 text-end">
            @if(session('user') && session('user')->role === 'admin')
                <a href="{{ route('publictraining.create') }}" class="btn btn-success btn-lg">
                    <i class="fas fa-plus"></i> Tambah Public Training
                </a>
            @endif
        </div>
    </div>
</div>

<div class="container-fluid">
    <div class="training-header">
        <h2>Public Training</h2>
        <div class="search-box">
            <i class="fas fa-search"></i>
            <input type="text" id="searchInput" placeholder="Cari" onkeyup="searchPublicTraining()">
        </div>
    </div>
<div class="training-grid" id="trainingGrid">
    @forelse($publictraining as $data)
    <a href="{{ route('jadwal.index', $data->id_public) }}" class="training-card" data-title="{{ strtolower($data->gambar ?? '') }}">
        @if($data->gambar)
            <img src="{{ asset('images/publictraining/' . $data->gambar) }}" 
                alt="{{ $data->gambar ?? 'Public Training' }}" 
                class="training-card-image">
        @endif
        
        <div class="training-card-body">
            @if(session('user') && session('user')->role === 'admin')
            <div class="training-actions">
                <a href="{{ route('publictraining.edit', $data->id_public) }}" 
                class="btn-edit" 
                onclick="event.stopPropagation();">
                    <i class="fas fa-edit"></i>
                </a>
                <form action="{{ route('publictraining.destroy', $data->id_public) }}" 
                    method="POST" 
                    style="display: inline;" 
                    onclick="event.stopPropagation();">
                    @csrf
                    @method('DELETE')
                    <button type="submit" 
                            class="btn-delete" 
                            onclick="return confirm('Apakah Anda yakin ingin menghapus pelatihan ini?');">
                        <i class="fas fa-trash"></i>
                    </button>
                </form>
            </div>
            @endif
        </div>
    </a>
    @empty
    <div style="grid-column: 1/-1; text-align: center; padding: 50px;">
        <i class="fas fa-inbox" style="font-size: 48px; color: #ccc; margin-bottom: 15px;"></i>
        <p style="color: #999; font-size: 16px;">Belum ada pelatihan tersedia</p>
    </div>
    @endforelse
</div>
</div>

<!-- JavaScript untuk Search -->
<script>
function searchTraining() {
    const input = document.getElementById('searchInput');
    const filter = input.value.toLowerCase();
    const grid = document.getElementById('trainingGrid');
    const cards = grid.getElementsByClassName('training-card');
    const noResults = document.getElementById('noResults');
    let visibleCount = 0;

    for (let i = 0; i < cards.length; i++) {
        const title = cards[i].getElementsByClassName('training-card-title')[0];
        const txtValue = title.textContent || title.innerText;
        
        if (txtValue.toLowerCase().indexOf(filter) > -1) {
            cards[i].style.display = "";
            visibleCount++;
        } else {
            cards[i].style.display = "none";
        }
    }

    // Show/hide no results message
    if (visibleCount === 0) {
        noResults.style.display = 'block';
        grid.style.display = 'none';
    } else {
        noResults.style.display = 'none';
        grid.style.display = 'grid';
    }
}
</script>


@endsection