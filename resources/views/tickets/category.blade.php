@extends('layouts.app')
@section('content')
<div class="container py-5 text-center">
    <h2 class="mb-4 fw-bold text-white">🎯 Choose Ticket Category</h2>

    <div class="row mt-4 g-4 justify-content-center">
        @foreach(['Technical Issue','Payment Issue','Account Issue','Other Issue'] as $c)
        <div class="col-sm-6 col-md-3">
            <a href="{{ route('ticket.form',['category'=>$c]) }}" class="text-decoration-none">
                <div class="card h-100 shadow-sm border-0 rounded-3 category-card">
                    <div class="card-body d-flex flex-column justify-content-center align-items-center py-5">
                        <h5 class="card-title fw-bold text-dark">{{ $c }}</h5>
                        <i class="bi bi-arrow-right-circle fs-3 text-primary mt-3"></i>
                    </div>
                </div>
            </a>
        </div>
        @endforeach
    </div>
</div>

{{-- Custom CSS --}}
<style>
    body {
        background-color: #f8f9fa;
    }

    h2 {
        font-weight: 700;
    }

    .category-card {
        transition: all 0.3s ease;
        cursor: pointer;
        background: #fff;
    }

    .category-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 15px 30px rgba(0,0,0,0.1);
        background: linear-gradient(135deg, #f0f3ff, #e0ebff);
    }

    .card-title {
        font-size: 1.25rem;
    }

    .bi-arrow-right-circle {
        transition: transform 0.3s ease, color 0.3s ease;
    }

    .category-card:hover .bi-arrow-right-circle {
        transform: translateX(5px);
        color: #0d6efd;
    }
</style>

{{-- Bootstrap Icons CDN --}}
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
@endsection
