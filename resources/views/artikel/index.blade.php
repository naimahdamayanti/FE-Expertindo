@extends('layout')
@section('title','Artikel')
@section('judul','Artikel')
@section('isi')

@if (Session::has('create'))
<div class="alert alert-success alert-dismissible fade show" role="alert">
  <strong>Data Berhasil Di Tambah</strong>
  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>
@endif

@if (Session::has('delete'))
<div class="alert alert-danger alert-dismissible fade show" role="alert">
  <strong>Data Berhasil Di Hapus!</strong>
  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>
@endif

@if (Session::has('update'))
<div class="alert alert-warning alert-dismissible fade show" role="alert">
  <strong>Data Berhasil Di Edit!</strong>
  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>
@endif

<style>
    .artikel-header {
        text-align: center;
        margin-bottom: 30px;
    }
    
    .artikel-header h2 {
        font-size: 28px;
        font-weight: 600;
        color: #333;
        margin-bottom: 20px;
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
    
    .artikel-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(320px, 1fr));
        gap: 25px;
        padding: 0 15px;
    }
    
    .artikel-card {
        background: white;
        border: 1px solid #e0e0e0;
        border-radius: 12px;
        padding: 25px;
        transition: all 0.3s ease;
        box-shadow: 0 2px 8px rgba(0,0,0,0.05);
        display: flex;
        flex-direction: column;
        height: 100%;
    }
    
    .artikel-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 8px 20px rgba(0,0,0,0.12);
        border-color: #4CAF50;
    }
    
    .artikel-card h3 {
        font-size: 18px;
        font-weight: 600;
        color: #333;
        margin-bottom: 8px;
        line-height: 1.4;
        min-height: 50px;
    }
    
    .artikel-date {
        font-size: 12px;
        color: #999;
        margin-bottom: 15px;
        display: flex;
        align-items: center;
        gap: 5px;
    }
    
    .artikel-content {
        font-size: 14px;
        color: #666;
        line-height: 1.6;
        margin-bottom: 20px;
        flex-grow: 1;
        overflow: hidden;
        display: -webkit-box;
        -webkit-line-clamp: 4;
        -webkit-box-orient: vertical;
    }
    
    .artikel-actions {
        display: flex;
        gap: 10px;
        margin-top: auto;
    }
    
    .btn-detail {
        flex: 1;
        background: #dc3545;
        color: white;
        border: none;
        padding: 10px 20px;
        border-radius: 6px;
        font-size: 13px;
        font-weight: 500;
        cursor: pointer;
        transition: all 0.3s;
        text-align: center;
        text-decoration: none;
        display: inline-block;
    }
    
    .btn-detail:hover {
        background: #c82333;
        color: white;
        transform: translateY(-2px);
        box-shadow: 0 4px 12px rgba(220, 53, 69, 0.3);
    }
    
    .btn-edit {
        background: #ffc107;
        color: white;
        border: none;
        padding: 10px 15px;
        border-radius: 6px;
        font-size: 13px;
        cursor: pointer;
        transition: all 0.3s;
    }
    
    .btn-edit:hover {
        background: #e0a800;
        transform: translateY(-2px);
    }
    
    .btn-delete {
        background: #dc3545;
        color: white;
        border: none;
        padding: 10px 15px;
        border-radius: 6px;
        font-size: 13px;
        cursor: pointer;
        transition: all 0.3s;
    }
    
    .btn-delete:hover {
        background: #c82333;
        transform: translateY(-2px);
    }
    
    .btn-tambah {
        margin-bottom: 20px;
    }
    
    @media (max-width: 768px) {
        .artikel-grid {
            grid-template-columns: 1fr;
        }
    }
</style>

<div class="container-fluid mb-3">
    <div class="row">
        <div class="col-12 text-end">
            @if(session('user') && session('user')->role === 'admin')
                <a href="{{ route('artikel.create') }}" class="btn btn-success btn-lg">
                    <i class="fas fa-plus"></i> Tambah Artikel
                </a>
            @endif
        </div>
    </div>
</div>

<div class="container-fluid">
    <div class="artikel-header">
        <h2>Artikel Terbaru</h2>
        
        <div class="search-box">
            <i class="fas fa-search"></i>
            <input type="text" id="searchInput" placeholder="Cari" onkeyup="searchArtikel()">
        </div>
    </div>
    
    <div class="artikel-grid" id="artikelGrid">
    @forelse($artikel as $data)
    <div class="artikel-card" data-title="{{ strtolower($data->judul) }}" data-content="{{ strtolower($data->isi) }}">
        @if($data->gambar)
            <img src="{{ asset('images/artikel/' . $data->gambar) }}" 
                alt="{{ $data->judul }}" 
                style="width: 100%; height: 200px; object-fit: cover; border-radius: 8px; margin-bottom: 15px;">
        @endif
        
        <h3>{{ $data->judul }}</h3>
        <div class="artikel-date">
            <i class="far fa-calendar"></i>
            {{ \Carbon\Carbon::parse($data->tgl_rilis)->format('d M Y') }}
        </div>
        <p class="artikel-content">{{ $data->isi }}</p>
        
        @if(session('user') && session('user')->role === 'admin')
        <div class="artikel-actions">
            <a href="{{ route('artikel.edit', $data->id) }}" class="btn-edit">
                <i class="fas fa-edit"></i>
            </a>
            <form action="{{ route('artikel.destroy', $data->id) }}" method="POST" style="display: inline;">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn-delete" onclick="return confirm('Apakah Anda yakin ingin menghapus artikel ini?');">
                    <i class="fas fa-trash"></i>
                </button>
            </form>
            <a href="{{ route('artikel.show', $data->id) }}" class="btn-detail">Detail ></a>
        </div>
        @else
        <div class="artikel-actions">
            <a href="{{ route('artikel.show', $data->id) }}" class="btn-detail">Detail ></a>
        </div>
        @endif
    </div>
    @empty
    <div style="text-align: center; padding: 50px; grid-column: 1/-1;">
        <i class="fas fa-inbox" style="font-size: 48px; color: #ccc; margin-bottom: 15px;"></i>
        <p style="color: #999; font-size: 16px;">Belum ada artikel tersedia</p>
    </div>
    @endforelse
</div>
</div>



<script>
function searchArtikel() {
    const input = document.getElementById('searchInput');
    const filter = input.value.toLowerCase();
    const cards = document.querySelectorAll('.artikel-card');
    
    cards.forEach(card => {
        const title = card.getAttribute('data-title');
        const content = card.getAttribute('data-content');
        
        if (title.includes(filter) || content.includes(filter)) {
            card.style.display = '';
        } else {
            card.style.display = 'none';
        }
    });
}
</script>

@endsection