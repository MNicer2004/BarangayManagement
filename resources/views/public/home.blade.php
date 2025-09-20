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
            <a href="{{ route('public.services') }}" class="btn btn-light text-dark fw-bold btn-pill px-4 py-2">About us</a>
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
@endsection
