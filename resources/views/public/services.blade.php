@extends('layouts.app')
@section('title','Services')

@section('content')
<style>
  /* Page-specific styles (Bootstrap-friendly) */
  .svc-card{
    background: rgba(255,255,255,.06);
    border:1px solid rgba(255,255,255,.15);
    border-radius:22px;
    transition: transform .18s ease, box-shadow .18s ease, border-color .18s ease;
    min-height: 360px;
  }
  .svc-card:hover{
    transform: translateY(-6px);
    box-shadow: 0 18px 36px rgba(0,0,0,.35);
    border-color: rgba(255,255,255,.35);
  }
  .svc-icon{
    width:110px;height:110px;border-radius:999px;
    display:grid;place-items:center;margin:0 auto 18px;
    background: rgba(255,255,255,.10);
    border:1px solid rgba(255,255,255,.20);
  }
  .svc-title{ letter-spacing:.3px; }
  .svc-desc{ color:#B3CFE5; } /* ink-300 */
  .btn-pill{ border-radius:999px; }
  @media (max-width: 575.98px){ .svc-card{ min-height: 0; } }
</style>

<section class="py-5 py-md-6">
  <div class="container" style="max-width:1200px">
    <!-- Page heading -->
    <div class="text-center mb-4 mb-md-5">
      <h1 class="fw-bolder mb-1" style="font-size:clamp(26px,3.2vw,40px)">SERVICES</h1>
      <div class="text-uppercase small fw-bold text-ink-300">Online documents offered</div>
    </div>

    <!-- Cards -->
    <div class="row g-4 g-xl-5">
      <!-- Barangay Clearance -->
      <div class="col-12 col-md-6 col-lg-4 d-flex">
        <div class="svc-card p-4 p-lg-5 w-100 d-flex flex-column text-center">
          <div class="svc-icon">
            <!-- phone icon (inline SVG so no extra CDN needed) -->
            <svg width="44" height="44" viewBox="0 0 24 24" fill="none" stroke="#F6FAFD" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
              <rect x="5" y="2" width="14" height="20" rx="2" ry="2"></rect>
              <line x1="12" y1="18" x2="12.01" y2="18"></line>
            </svg>
          </div>

          <h3 class="h5 fw-bold svc-title mb-2">Barangay Clearance</h3>
          <p class="svc-desc small mb-4">
            View the requirements needed for Barangay Clearance and acquire online now.
          </p>

          <div class="mt-auto">
            <a href="{{ route('request.clearance') }}" class="btn btn-light text-dark fw-bold btn-pill px-4 py-2">Proceed</a>
              
            </a>
          </div>
        </div>
      </div>

      <!-- Residency Certificate -->
      <div class="col-12 col-md-6 col-lg-4 d-flex">
        <div class="svc-card p-4 p-lg-5 w-100 d-flex flex-column text-center">
          <div class="svc-icon">
            <svg width="44" height="44" viewBox="0 0 24 24" fill="none" stroke="#F6FAFD" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
              <rect x="5" y="2" width="14" height="20" rx="2" ry="2"></rect>
              <line x1="12" y1="18" x2="12.01" y2="18"></line>
            </svg>
          </div>

          <h3 class="h5 fw-bold svc-title mb-2">Residency Certificate</h3>
          <p class="svc-desc small mb-4">
            View the requirements needed for Barangay Residency and acquire online now.
          </p>

          <div class="mt-auto">
            <a href="{{ route('request.residency') }}" class="btn btn-light text-dark fw-bold btn-pill px-4 py-2">Proceed</a>
            </a>
          </div>
        </div>
      </div>

      <!-- Barangay Business Permit -->
      <div class="col-12 col-md-6 col-lg-4 d-flex">
        <div class="svc-card p-4 p-lg-5 w-100 d-flex flex-column text-center">
          <div class="svc-icon">
            <svg width="44" height="44" viewBox="0 0 24 24" fill="none" stroke="#F6FAFD" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
              <rect x="5" y="2" width="14" height="20" rx="2" ry="2"></rect>
              <line x1="12" y1="18" x2="12.01" y2="18"></line>
            </svg>
          </div>

          <h3 class="h5 fw-bold svc-title mb-2">Barangay Business Permit</h3>
          <p class="svc-desc small mb-4">
            View the requirements needed for Barangay Business Permit and acquire online now.
          </p>

          <div class="mt-auto">
            <a href="{{ route('request.business') }}" class="btn btn-light text-dark fw-bold btn-pill px-4 py-2">Proceed</a>
            </a>
          </div>
        </div>
      </div>
    </div><!-- /row -->
  </div>
</section>
@endsection
