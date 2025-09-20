@extends('layouts.app')
@section('title','Residency Certificate')

@section('content')
<style>
  .form-shell .form-control{
    background: rgba(255,255,255,.04);
    border: 1px solid rgba(255,255,255,.20);
    color: #F6FAFD; padding: .6rem .9rem;
  }
  .form-shell .form-control::placeholder{ text-transform: uppercase; color: #b9cfe5cc; }
  .form-shell .form-control:focus{
    border-color: rgba(255,255,255,.45);
    box-shadow: 0 0 0 .15rem rgba(255,255,255,.12);
  }
  .form-shell .form-select{
    background:#F6FAFD;color:#0A1832;border:1px solid rgba(0,0,0,.25);padding:.6rem .9rem;
  }
  .form-shell .form-select:focus{ border-color:#4A7FA7; box-shadow:0 0 0 .15rem rgba(74,127,167,.25); }
  .form-shell .form-select option{ color:#0A1832; background:#F6FAFD; }

  .card-glass{ background: rgba(255,255,255,.06); border:1px solid rgba(255,255,255,.15); border-radius:16px; box-shadow: 0 12px 30px rgba(0,0,0,.25); }
  .side-card{ border-radius:16px; overflow:hidden; }
  .side-card__img{ background:#0e2240; display:grid; place-items:center; padding:24px; }
  .side-card__meta{ background: rgba(255,255,255,.05); border-top:1px solid rgba(255,255,255,.12); }

  .section-title{ font-weight:800; letter-spacing:.02em; }
  .text-ink-300{ color:#B3CFE5; }
  .item-check{ display:flex; gap:.55rem; align-items:flex-start; margin:.35rem 0; color:#B3CFE5; }
  .item-check svg{ flex:0 0 auto; margin-top:.2rem }
  .badge-dot{ width:8px;height:8px;border-radius:50%;display:inline-block;margin-right:.45rem;background:#4A7FA7 }

  .btn-submit{ background:#F6FAFD;color:#0A1832;border-color:#F6FAFD;font-weight:700; }
  .btn-submit:hover{ background:#1A3D63;border-color:#1A3D63;color:#fff; }
</style>

<section class="py-4 py-md-5">
  <div class="container" style="max-width:1200px">
    <div class="row g-4 g-xl-5">
      <!-- LEFT -->
      <div class="col-12 col-lg-4">
        <div class="card-glass side-card h-100">
          <div class="side-card__img">
            <img src="/assets/images/logo.png" alt="Logo" class="img-fluid" style="max-width:220px">
          </div>

          <!-- Fees / contact -->
          <div class="p-3 p-md-4 side-card__meta">
            <div class="d-flex align-items-center mb-2">
              <span class="badge-dot"></span>
              <div class="fw-semibold">Fees: <span class="text-white">₱100</span></div>
            </div>
            <div class="d-flex align-items-center">
              <span class="badge-dot"></span>
              <div class="fw-semibold">GCash: <a class="link-light text-decoration-underline" href="tel:09301826311">09301826311</a></div>
            </div>
          </div>

          <!-- Requirements -->
          <div class="px-3 px-md-4 pt-3">
            <div class="section-title text-uppercase small mb-2">Requirements</div>
            <div class="item-check">
              <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="#4A7FA7" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polyline points="20 6 9 17 4 12"/></svg>
              <span>Valid government-issued ID (present original upon pickup)</span>
            </div>
            <div class="item-check">
              <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="#4A7FA7" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polyline points="20 6 9 17 4 12"/></svg>
              <span>Community Tax Certificate (Cedula), current year</span>
            </div>
            <div class="item-check">
              <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="#4A7FA7" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polyline points="20 6 9 17 4 12"/></svg>
              <span>Proof of residency (Barangay ID/Voter’s record/utility bill)</span>
            </div>
            <div class="item-check">
              <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="#4A7FA7" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polyline points="20 6 9 17 4 12"/></svg>
              <span>Length of stay (years/months) for certification details</span>
            </div>
            <div class="text-ink-300 small mt-2">
              * Requirements may vary per LGU/barangay. Additional documents may be requested.
            </div>
          </div>

          <!-- Notes -->
          <div class="px-3 px-md-4 py-3">
            <div class="section-title text-uppercase small mb-2">Notes &amp; Reminders</div>
            <div class="item-check">
              <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="#4A7FA7" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polyline points="20 6 9 17 4 12"/></svg>
              <span>Pick up at the <strong>Barangay Hall</strong>; bring the <strong>original ID</strong>.</span>
            </div>
            <div class="item-check">
              <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="#4A7FA7" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polyline points="20 6 9 17 4 12"/></svg>
              <span>For <strong>GCash</strong>, present the <strong>reference number</strong> at pickup.</span>
            </div>
            <div class="item-check">
              <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="#4A7FA7" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polyline points="20 6 9 17 4 12"/></svg>
              <span>Processing: typically <strong>1–2 working days</strong>.</span>
            </div>
          </div>
        </div>
      </div>

      <!-- RIGHT: Form (same fields as clearance) -->
      <div class="col-12 col-lg-8">
        <div class="card-glass form-shell">
          <div class="border-bottom border-white border-opacity-25 px-3 px-md-4 py-3">
            <h2 class="h5 m-0 fw-bold text-uppercase">Residency Certificate</h2>
          </div>

          <form id="residencyForm" class="p-3 p-md-4">
            <div class="row g-3">
              <div class="col-12">
                <label class="form-label fw-semibold">Full Name</label>
                <input id="fullName" type="text" class="form-control" placeholder="Enter your name" required>
              </div>
              <div class="col-12 col-md-6">
                <label class="form-label fw-semibold">Mobile Number</label>
                <input id="mobile" type="tel" class="form-control" placeholder="09XXXXXXXXX" required>
              </div>
              <div class="col-12 col-md-6">
                <label class="form-label fw-semibold">Email (optional)</label>
                <input id="email" type="email" class="form-control" placeholder="you@example.com">
              </div>
              <div class="col-12">
                <label class="form-label fw-semibold">Complete Address</label>
                <input id="address" type="text" class="form-control" placeholder="House No., Street, Purok/Sitio, Barangay, Town/City" required>
              </div>
            </div>

            <div class="row g-3 mt-1">
              <div class="col-12 col-md-6">
                <label class="form-label fw-semibold">Pick-up Date</label>
                <input id="pickupDate" type="date" class="form-control" required>
              </div>
              <div class="col-12 col-md-6">
                <label class="form-label fw-semibold">Valid ID to present</label>
                <select id="validId" class="form-select" required>
                  <option value="" disabled selected>Select an ID</option>
                  <option>PhilSys/Postal ID</option>
                  <option>Driver’s License</option>
                  <option>Voter’s ID</option>
                  <option>Student ID</option>
                  <option>Passport</option>
                  <option>Others</option>
                </select>
              </div>
              <div class="col-12 col-md-6">
                <label class="form-label fw-semibold">Payment Method</label>
                <select id="paymentMethod" class="form-select" required>
                  <option value="" selected disabled>Select payment method</option>
                  <option value="Walk-in">Walk-in (pay at pickup)</option>
                  <option value="GCash">GCash</option>
                  <option value="Other">Other</option>
                </select>
              </div>
              <div class="col-12 col-md-6" id="gcashRefWrap">
                <label class="form-label fw-semibold">GCash Reference No.</label>
                <input id="gcashRef" type="text" class="form-control" placeholder="Enter GCash reference no.">
              </div>
            </div>

            <div class="mt-3">
              <label class="form-label fw-semibold">Purpose</label>
              <textarea id="purpose" class="form-control" rows="3" placeholder="Enter purpose (e.g., School, Employment, Banking)" required></textarea>
            </div>

            <div class="mt-3">
              <div class="form-check">
                <input class="form-check-input" type="checkbox" id="agreePrivacy" required>
                <label class="form-check-label" for="agreePrivacy">I agree to the collection and processing of my personal data.</label>
              </div>
              <div class="form-check mt-2">
                <input class="form-check-input" type="checkbox" id="agreeTruth" required>
                <label class="form-check-label" for="agreeTruth">I certify that the information provided is true and correct.</label>
              </div>
            </div>

            <div class="pt-3">
              <button type="submit" class="btn btn-submit px-4">Submit</button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</section>

<!-- Success Modal -->
<div class="modal fade" id="successModal" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content" style="background:#0A1832;color:#F6FAFD;border:1px solid rgba(255,255,255,.2)">
      <div class="modal-header border-0">
        <h5 class="modal-title fw-bold">Request Submitted</h5>
        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body pt-0">
        <p class="mb-2">Here is your temporary tracking code:</p>
        <div class="d-flex align-items-center gap-2 mb-3">
          <code id="previewCode" class="fs-5 fw-bold">RSID-0000-XXXXX</code>
          <button id="copyCode" type="button" class="btn btn-sm btn-outline-light">Copy</button>
        </div>
        <div class="small text-ink-300 mb-3">
          Bring a valid ID and your GCash reference (if applicable). Pick-up date: <span id="previewPickup" class="text-white fw-semibold">—</span>.
        </div>
        <a href="{{ route('public.track') }}" class="btn btn-light text-dark fw-bold">Go to Track My Request</a>
      </div>
      <div class="modal-footer border-0">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>

<script>
  document.addEventListener('DOMContentLoaded', () => {
    const today = new Date();
    const yyyy = today.getFullYear(), mm = String(today.getMonth()+1).padStart(2,'0'), dd = String(today.getDate()).padStart(2,'0');
    const pickup = document.getElementById('pickupDate'); if (pickup) pickup.min = `${yyyy}-${mm}-${dd}`;

    const method = document.getElementById('paymentMethod');
    const refWrap = document.getElementById('gcashRefWrap');
    const ref = document.getElementById('gcashRef');
    const toggleRef = () => { const show = method && method.value === 'GCash'; refWrap.style.display = show ? '' : 'none'; if (ref) { ref.required = show; if(!show) ref.value=''; } };
    if (method) { method.addEventListener('change', toggleRef); toggleRef(); }

    document.getElementById('residencyForm').addEventListener('submit', e => {
      e.preventDefault();
      const code = `RSID-${new Date().getFullYear()}-${Math.random().toString(36).slice(2,7).toUpperCase()}`;
      document.getElementById('previewCode').textContent = code;
      document.getElementById('previewPickup').textContent = pickup.value || '—';
      const modal = new bootstrap.Modal(document.getElementById('successModal')); modal.show();
      document.getElementById('copyCode').onclick = () => { navigator.clipboard.writeText(code).then(()=>{ const b=document.getElementById('copyCode'); b.textContent='Copied!'; setTimeout(()=>b.textContent='Copy',1200); }); };
    });
  });
</script>
@endsection
