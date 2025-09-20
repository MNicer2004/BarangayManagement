@extends('layouts.app')
@section('title','Map')

@section('content')
{{-- Leaflet (no API key) --}}
<link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css">
<script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>

<style>
  .card-glass{ background: rgba(255,255,255,.06); border:1px solid rgba(255,255,255,.15); border-radius:16px; box-shadow: 0 12px 30px rgba(0,0,0,.25); }
  .text-ink-300{ color:#B3CFE5; }

  /* Bigger map, centered section */
  .map-wrap{ height: clamp(560px, 72vh, 820px); border-radius:16px; overflow:hidden; }
  .leaflet-control-attribution{ font-size:.75rem; }
  .btn-pill{ border-radius:999px; }
  .btn-ghost{ border:1px solid var(--bs-border-color-translucent); color:#F6FAFD; background:transparent; }
  .btn-ghost:hover{ border-color:#fff; }

  .list-dot{ list-style:none; padding-left:0; margin:0; }
  .list-dot li{ display:flex; gap:.5rem; align-items:flex-start; margin:.35rem 0; color:#B3CFE5; }
  .list-dot svg{ flex:0 0 auto; margin-top:.15rem }

  /* Popup theming for dark UI */
  .leaflet-popup-content-wrapper, .leaflet-popup-tip {
    background:#0A1832; color:#F6FAFD; border:1px solid rgba(255,255,255,.2);
  }
  .leaflet-container a.leaflet-popup-close-button { color:#fff; }
</style>

<!-- hero-center keeps it away from the navbar and visually centered -->
<section class="hero-center">
  <div class="container" style="max-width:1280px">
    <div class="row g-4 g-xl-5 align-items-stretch">
      <!-- LEFT PANEL -->
      <div class="col-12 col-lg-4">
        <div class="card-glass p-3 p-md-4 h-100 d-flex flex-column">
          <div class="text-uppercase small fw-bold text-ink-300">You’re viewing</div>
          <h1 class="h3 fw-bolder mb-2">Barangay San Pedro Apartado</h1>
          <div class="text-ink-300">
            Purok 3, Alcala, Pangasinan<br>
            Open Hours: Mon–Fri, 8:00 AM – 5:00 PM
          </div>

          <hr class="border-white border-opacity-25 my-3">

          <ul class="list-dot">
            <li>
              <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="#4A7FA7" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M21 10c0 7-9 12-9 12S3 17 3 10a9 9 0 1 1 18 0Z"/><circle cx="12" cy="10" r="3"/></svg>
              <span id="addrTxt">Approx. location shown on map</span>
            </li>
            <li>
              <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="#4A7FA7" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M16 2v4M8 2v4M3 10h18M7 14h.01M11 14h.01M15 14h2"/></svg>
              <span class="small">Email: <a class="link-light text-decoration-underline" href="mailto:brgysanpedroapartado31@gmail.com">brgysanpedroapartado31@gmail.com</a></span>
            </li>
          </ul>

          <div class="d-flex flex-wrap gap-2 mt-3">
            <a id="dirBtn" target="_blank" class="btn btn-light text-dark fw-bold btn-pill px-4">Get Directions</a>
            <button id="resetBtn" class="btn btn-ghost btn-pill px-3" type="button">Reset view</button>
          </div>

          <div class="text-ink-300 small mt-3">
            Tip: Switch between <strong>Streets</strong> and <strong>Dark</strong> tiles using the control on the map.
          </div>

          <div class="mt-auto small text-ink-300 pt-3">
            * Marker shows the barangay hall vicinity. For exact directions, use the button above.
          </div>
        </div>
      </div>

      <!-- MAP -->
      <div class="col-12 col-lg-8">
        <div id="map" class="map-wrap card-glass"></div>
      </div>
    </div>
  </div>
</section>

<script>
(function(){
  // === Configure your barangay location here ===
  const BRGY = {
    name: "Barangay San Pedro Apartado",
    coords: [15.8465, 120.5160], // (approx) update to exact lat,lng if you have it
    address: "Purok 3, Alcala, Pangasinan",
    email: "brgysanpedroapartado31@gmail.com"
  };

  // Build "Get Directions" URL for Google Maps
  const dirUrl = `https://www.google.com/maps/dir/?api=1&destination=${encodeURIComponent(BRGY.coords[0]+','+BRGY.coords[1])}&travelmode=driving&query=${encodeURIComponent(BRGY.name+' '+BRGY.address)}`;
  document.getElementById('dirBtn').href = dirUrl;

  // Init Leaflet
  const streets = L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', { maxZoom: 20, attribution: '&copy; OpenStreetMap' });
  const dark = L.tileLayer('https://{s}.basemaps.cartocdn.com/dark_all/{z}/{x}/{y}{r}.png', { maxZoom: 20, attribution: '&copy; OpenStreetMap &copy; CARTO' });

  const map = L.map('map', { center: BRGY.coords, zoom: 16, layers: [streets] });
  L.control.layers({ "Streets": streets, "Dark": dark }, null, { position:'topleft' }).addTo(map);

  // Marker + popup
  const pin = L.icon({
    iconUrl: 'https://unpkg.com/leaflet@1.9.4/dist/images/marker-icon.png',
    shadowUrl: 'https://unpkg.com/leaflet@1.9.4/dist/images/marker-shadow.png',
    iconAnchor:[12,41], popupAnchor:[1,-34]
  });

  const popupHtml = `
    <div class="fw-bold">${BRGY.name}</div>
    <div class="text-ink-300 small">${BRGY.address}</div>
    <div class="mt-2">
      <a class="btn btn-sm btn-light text-dark fw-bold btn-pill" target="_blank" href="${dirUrl}">Open in Google Maps</a>
    </div>
  `;
  const marker = L.marker(BRGY.coords, { icon: pin }).addTo(map).bindPopup(popupHtml).openPopup();

  // Reset view
  document.getElementById('resetBtn').addEventListener('click', () => {
    map.setView(BRGY.coords, 16);
    marker.openPopup();
  });

  // Fill address text
  document.getElementById('addrTxt').textContent = BRGY.address;
})();
</script>
@endsection
