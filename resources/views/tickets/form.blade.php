@extends('layouts.app')
@section('content')
<div class="container py-5">
    <h2 class="mb-4 text-center text-white">🎫 Submit a Support Ticket</h2>

    <form method="POST" action="{{ route('ticket.submit') }}" enctype="multipart/form-data" class="card p-4 shadow-lg bg-light rounded-3 border-0 mx-auto" style="max-width: 700px;">
        @csrf
        <input type="hidden" name="category" value="{{ $category }}">

        <div class="mb-3">
            <label class="form-label fw-bold">Name <span class="text-danger">*</span></label>
            <input type="text" name="name" class="form-control form-control-lg" placeholder="Your full name" required>
        </div>

        <div class="mb-3">
            <label class="form-label fw-bold">Email</label>
            <input type="email" name="email" class="form-control form-control-lg" placeholder="example@email.com" required>
        </div>

        <div class="mb-3">
            <label class="form-label fw-bold">Phone</label>
            <input type="text" name="phone" class="form-control form-control-lg" placeholder="+60 12-345 6789" required>
        </div>

        <div class="mb-3">
            <label class="form-label fw-bold">Domain</label>
            <input type="text" name="domain" class="form-control form-control-lg" placeholder="example.com" required>
        </div>

        <div class="mb-3">
            <label class="form-label fw-bold">Title <span class="text-danger">*</span></label>
            <input type="text" name="title" class="form-control form-control-lg" placeholder="Short summary of the issue" required>
        </div>

        <div class="mb-3">
            <label class="form-label fw-bold">Description <span class="text-danger">*</span></label>
            <textarea name="description" rows="5" class="form-control form-control-lg" placeholder="Describe your issue in detail..." required></textarea>
        </div>

        <div class="mb-4">
            <label class="form-label fw-bold">Attachment (optional)</label>
            <input type="file" name="attachment" class="form-control">
        </div>

        <button class="btn btn-primary btn-lg w-100 shadow-sm" type="submit">Submit Ticket</button>
    </form>
</div>

{{-- Custom CSS --}}
<style>
    body {
        background-color: #f8f9fa;
    }

    h2 {
        font-weight: 700;
    }

    .card {
        transition: all 0.3s ease;
    }

    .card:hover {
        transform: translateY(-3px);
        box-shadow: 0 10px 20px rgba(0,0,0,0.1);
    }

    .form-control:focus {
        border-color: #0d6efd;
        box-shadow: 0 0 0 0.2rem rgba(13, 110, 253, 0.25);
    }

    .btn-primary {
        background: linear-gradient(90deg, #0d6efd 0%, #6610f2 100%);
        border: none;
    }

    .btn-primary:hover {
        background: linear-gradient(90deg, #6610f2 0%, #0d6efd 100%);
    }
</style>
@endsection
