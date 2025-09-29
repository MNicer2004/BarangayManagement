@extends('layouts.app')
@section('title','Home')

@section('content')
<section class="hero-center"><!-- centers vertically within viewport -->
  <div class="container" style="max-width:1200px">
    <div class="card-glass p-4 p-md-5">
      <div class="row g-4 g-lg-5 align-items-center">
        <!-- Logo -->
        <div class="col-12 col-md-4 text-center">
          {{-- Put your logo at public/assets/images/logo.png --}}
          <img src="/assets/images/logo.png" alt="Barangay Logo" class="img-fluid" style="max-width:240px">
        </div>

        <!-- Text -->
        <div class="col-12 col-md-8">
          <div class="text-uppercase small fw-bold text-ink-300 mb-2">Welcome to</div>
          <h1 class="fw-bolder mb-4" style="font-size:clamp(28px,3.2vw,44px);line-height:1.2">
            SAN PEDRO <span class="text-white">APARTADO</span>
          </h1>

          <!-- Increased line spacing with .lh-lg -->
          <ul class="list-unstyled text-ink-300 lh-lg mb-4">
            <li>Barangay San Pedro Apartado, Purok 3, Alcala Pangasinan</li>
            <li>Open Hours: Monday to Friday, 8:00 AM – 5:00 PM</li>
            <li><a href="mailto:brgysanpedroapartado31@gmail.com" class="link-light text-decoration-underline">brgysanpedroapartado31@gmail.com</a></li>
          </ul>

          <div class="d-flex flex-wrap gap-2">
            <button type="button" class="btn btn-light text-dark fw-bold btn-pill px-4 py-2" data-bs-toggle="modal" data-bs-target="#aboutUsModal">About us</button>
            <a href="{{ route('public.track') }}" class="btn btn-ghost fw-bold btn-pill px-4 py-2">Track my request</a>
          </div>
        </div>
      </div>

      <!-- Stats -->
      <div class="row g-3 mt-4 mt-md-5">
        <div class="col-12 col-sm-4">
          <div class="d-flex align-items-center gap-2 p-3 rounded-3 card-glass">
            <div class="fs-5 fw-bold text-white">3</div>
            <div class="text-ink-300 fw-semibold">Core Services</div>
          </div>
        </div>
        <div class="col-12 col-sm-4">
          <div class="d-flex align-items-center gap-2 p-3 rounded-3 card-glass">
            <div class="fs-5 fw-bold text-white">5k+</div>
            <div class="text-ink-300 fw-semibold">Residents</div>
          </div>
        </div>
        <div class="col-12 col-sm-4">
          <div class="d-flex align-items-center gap-2 p-3 rounded-3 card-glass">
            <div class="fs-5 fw-bold text-white">M–F</div>
            <div class="text-ink-300 fw-semibold">8AM–5PM</div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

<!-- About Us Modal -->
<div class="modal fade" id="aboutUsModal" tabindex="-1" aria-labelledby="aboutUsModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg modal-dialog-centered">
    <div class="modal-content border-0" style="background: linear-gradient(135deg, #1A3D63 0%, #0A1832 100%); border-radius: 16px; box-shadow: 0 20px 40px rgba(0,0,0,0.4);">
      <div class="modal-header border-0 pb-0">
        <h4 class="modal-title fw-bold text-white" id="aboutUsModalLabel">
          <i class="fas fa-heart text-danger me-2"></i>About Us
        </h4>
        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body pt-3">
        <div class="text-center mb-4">
          <img src="/assets/images/logo.png" alt="Barangay Logo" class="img-fluid mb-3" style="max-width:120px; opacity: 0.9;">
          <h5 class="text-white fw-semibold">Barangay San Pedro Apartado</h5>
        </div>
        
        <div class="text-white lh-lg">
          <p class="mb-4">
            Barangay San Pedro Apartado is committed to serving the needs of its residents with <span class="text-warning fw-semibold">transparency</span>, <span class="text-info fw-semibold">efficiency</span>, and <span class="text-success fw-semibold">compassion</span>. We believe that effective governance starts with being responsive to the everyday concerns of our people, and we strive to create programs and services that directly improve the quality of life in our community.
          </p>
          
          <p class="mb-4">
            As the local government unit closest to the people, we provide core services such as <span class="text-warning">peace and order</span>, <span class="text-info">health and sanitation</span>, <span class="text-success">infrastructure development</span>, and <span class="text-primary">community assistance</span>. We also work hand-in-hand with residents, civic organizations, and other institutions to ensure that every family feels supported and heard.
          </p>
          
          <p class="mb-4">
            Through this <span class="text-warning fw-semibold">Barangay Management System</span>, we aim to bring services closer to the people, making transactions more convenient, faster, and more transparent. This platform allows residents to request documents, track their concerns, and stay updated on barangay initiatives—all in one place.
          </p>
          
          <p class="mb-0">
            Our barangay continues to uphold the values of <span class="text-warning fw-semibold">unity</span>, <span class="text-info fw-semibold">accountability</span>, and <span class="text-success fw-semibold">progress</span>, guided by the principle that true development can only be achieved when government and community work together.
          </p>
        </div>
      </div>
      <div class="modal-footer border-0 pt-0">
        <div class="text-center w-100">
          <small class="text-light">
            <i class="fas fa-map-marker-alt me-1"></i>
            Purok 3, Alcala Pangasinan • 
            <i class="fas fa-envelope me-1"></i>
            <a href="mailto:brgysanpedroapartado31@gmail.com" class="text-warning text-decoration-underline">brgysanpedroapartado31@gmail.com</a>
          </small>
        </div>
      </div>
    </div>
  </div>
</div>

@endsection
