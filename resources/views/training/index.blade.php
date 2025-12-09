@extends('layout')
@section('title', 'In House Training')
@section('judul', 'In House Training')
@section('isi')

<style>
    
    .training-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(350px, 1fr));
        gap: 30px;
        margin-top: 30px;
    }

    .training-card {
        background: white;
        border-radius: 12px;
        overflow: hidden;
        box-shadow: 0 2px 10px rgba(0,0,0,0.08);
        transition: all 0.3s;
        display: flex;
        flex-direction: column;
    }

    .training-card:hover {
        transform: translateY(-8px);
        box-shadow: 0 8px 25px rgba(0,0,0,0.15);
    }

    .training-card-image {
        width: 100%;
        height: 250px;
        object-fit: cover;
        background-color: #e9ecef;
    }

    .training-card-body {
        padding: 25px;
        flex: 1;
        display: flex;
        flex-direction: column;
    }

    .training-card-title {
        font-size: 22px;
        font-weight: 700;
        color: #333;
        margin: 0 0 15px 0;
        line-height: 1.4;
        display: -webkit-box;
        -webkit-line-clamp: 2;
        -webkit-box-orient: vertical;
        overflow: hidden;
        min-height: 60px;
    }

    .training-card-meta {
        display: flex;
        gap: 20px;
        font-size: 14px;
        color: #666;
        margin-bottom: 15px;
        padding-bottom: 15px;
        border-bottom: 1px solid #eee;
    }

    .training-card-meta-item {
        display: flex;
        align-items: center;
        gap: 6px;
    }

    .training-card-meta-item i {
        color: #007bff;
        font-size: 13px;
    }

    .training-card-content {
        font-size: 15px;
        color: #666;
        line-height: 1.8;
        margin-bottom: 20px;
        flex: 1;
        display: -webkit-box;
        -webkit-line-clamp: 3;
        -webkit-box-orient: vertical;
        overflow: hidden;
    }

    .training-actions {
        display: flex;
        align-items: center;
        gap: 10px;
        padding-top: 15px;
        margin-top: auto;
    }

    .btn-edit
    {
        padding: 10px 20px;
        border: none;
        border-radius: 8px;
        font-size: 14px;
        font-weight: 600;
        cursor: pointer;
        transition: all 0.3s;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 8px;
        text-decoration: none;
    }

    .btn-edit {
        background-color: #ffc107;
        color: white;
    }

    .btn-edit:hover {
        background-color: #e0a800;
        transform: translateY(-2px);
        box-shadow: 0 4px 12px rgba(255, 193, 7, 0.3);
        color: white;
    }

</style>

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
<div class="container mt-5">
    @if(session('create'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        <i class="fas fa-check-circle"></i> {{ session('create') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
    @endif

    @if(session('update'))
    <div class="alert alert-info alert-dismissible fade show" role="alert">
        <i class="fas fa-info-circle"></i> {{ session('update') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
    @endif

    @if(session('delete'))
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        <i class="fas fa-trash-alt"></i> {{ session('delete') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
    @endif

    <div class="container mt-5">
    @forelse($training as $data)
    <div class="card shadow-lg border-0">
        @if($data->gambar)
            <img src="{{ asset('images/inhouse/' . $data->gambar) }}" 
                alt="{{ $data->judul }}" 
                class="card-img-top"
                style="height: 400px; object-fit: cover;">
        @else
            <div class="bg-gradient text-white d-flex align-items-center justify-content-center" 
                style="height: 400px; background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);">
                <i class="fas fa-newspaper fa-5x"></i>
            </div>
        @endif
        
        <div class="card-body p-5">
            <h1 class="card-title display-5 fw-bold mb-3">{{ $data->judul }}</h1>
            
            <div class="d-flex gap-4 text-muted mb-4 pb-3 border-bottom">
                <div>
                    <i class="far fa-calendar text-primary"></i>
                    <span>{{ \Carbon\Carbon::parse($data->tgl_rilis)->translatedFormat('d F Y') }}</span>
                </div>
                @if($data->created_at)
                <div>
                    <i class="far fa-clock text-primary"></i>
                    <span>{{ \Carbon\Carbon::parse($data->created_at)->diffForHumans() }}</span>
                </div>
                @endif
            </div>
            
            <div class="article-content" style="font-size: 16px; line-height: 1.8;">
                {{ Str::limit(strip_tags($data->isi), 180) }}
            </div>
            
            @if(session('user') && session('user')->role === 'admin')
            <div class="training-actions">
                <a href="{{ route('training.edit', $data->id) }}" class="btn-edit">
                    <i class="fas fa-edit"></i> Edit
                </a>
                <form action="{{ route('training.destroy', $data->id) }}" 
                      method="POST" 
                      style="flex: 1; display: inline;">
                    @csrf
                </form>
            </div>
            @endif
        </div>
    </div>
    @empty
        <div class="text-center py-5">
            <h3 class="text-muted">Belum ada training tersedia.</h3>
        </div>
    @endforelse
</div>
        
    </div>
</div>

@endsection