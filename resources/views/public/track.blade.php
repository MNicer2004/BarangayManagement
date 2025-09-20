@extends('layouts.app')
@section('title','Track My Request')

@section('content')
<style>
  .card-glass{ background: rgba(255,255,255,.06); border:1px solid rgba(255,255,255,.15); border-radius:16px; box-shadow: 0 12px 30px rgba(0,0,0,.25); }
  .text-ink-300{ color:#B3CFE5; }

  /* Status badges */
  .badge-status{ font-weight:700; border:1px solid rgba(255,255,255,.25); }
  .status-pending{ background:#3a4760; color:#F6FAFD; }
  .status-verified{ background:#2b5a78; color:#F6FAFD; }
  .status-processing{ background:#264d66; color:#F6FAFD; }
  .status-ready{ background:#1A3D63; color:#fff; }
  .status-completed{ background:#1f7a4a; color:#fff; }
  .status-rejected{ background:#7a2a2a; color:#fff; }

  /* Progress bar tint */
  .progress{ height:10px; background:rgba(255,255,255,.15); }
  .progress-bar{ background:#4A7FA7; }

  /* Table styling */
  .table-dark-lite{ --bs-table-bg: rgba(255,255,255,.03); --bs-table-border-color: rgba(255,255,255,.12); color:#F6FAFD; }
  .table-dark-lite thead th{ color:#B3CFE5; font-weight:700; }

  .btn-pill{ border-radius:999px; }
  .btn-ghost{ border:1px solid var(--bs-border-color-translucent); color:#F6FAFD; background:transparent; }
  .btn-ghost:hover{ border-color:#fff; }
</style>

<section class="py-5">
  <div class="container" style="max-width:1200px">

    <div class="text-center mb-4">
      <h1 class="fw-bolder mb-1" style="font-size:clamp(28px,3.2vw,44px)">TRACK YOUR REQUEST</h1>
      <div class="text-ink-300">Enter your tracking code (e.g., <code>BCLR-2025-ABCDE</code>) or your full name.</div>
    </div>

    <!-- Search / filters -->
    <div class="card-glass p-3 p-md-4 mb-4">
      <form id="searchForm" class="row g-3 align-items-center">
        <div class="col-12 col-lg">
          <input id="query" type="text" class="form-control" placeholder="Search by tracking code or name">
        </div>
        <div class="col-6 col-lg-3">
          <select id="filterService" class="form-select">
            <option value="">All services</option>
            <option value="Barangay Clearance">Barangay Clearance</option>
            <option value="Residency Certificate">Residency Certificate</option>
            <option value="Barangay Business Permit">Barangay Business Permit</option>
          </select>
        </div>
        <div class="col-6 col-lg-3">
          <select id="filterStatus" class="form-select">
            <option value="">All statuses</option>
            <option value="Pending">Pending</option>
            <option value="Verified">Verified</option>
            <option value="Processing">Processing</option>
            <option value="Ready for Pickup">Ready for Pickup</option>
            <option value="Completed">Completed</option>
            <option value="Rejected">Rejected</option>
          </select>
        </div>
        <div class="col-12 col-lg-auto d-flex gap-2">
          <button class="btn btn-light text-dark fw-bold btn-pill px-4" type="submit">Search</button>
          <button id="clearBtn" class="btn btn-ghost btn-pill px-3" type="button">Clear</button>
        </div>
      </form>
    </div>

    <!-- Primary result card -->
    <div id="primaryCard" class="card-glass p-3 p-md-4 mb-4 d-none"></div>

    <!-- Results table -->
    <div class="card-glass p-3 p-md-4">
      <div class="d-flex justify-content-between align-items-center mb-2">
        <h5 class="m-0 fw-bold">Results</h5>
        <small class="text-ink-300" id="resultCount">0 record(s)</small>
      </div>
      <div class="table-responsive">
        <table class="table table-dark-lite align-middle mb-0">
          <thead>
            <tr>
              <th>Tracking Code</th>
              <th>Name</th>
              <th>Service Type</th>
              <th>Pick-up Date</th>
              <th>Date Requested</th>
              <th>Status</th>
              <th></th>
            </tr>
          </thead>
          <tbody id="rowsBody">
          </tbody>
        </table>
      </div>
    </div>

  </div>
</section>

<script>
(() => {
  const storeKey = 'bm_requests'; // (optional) saved by forms in this browser
  // Load stored requests or use demo data
  const fromStorage = JSON.parse(localStorage.getItem(storeKey) || '[]');

  // Demo seed so page looks alive even without storage
  const seed = [
    {
      code: 'BCLR-2025-ABCDE',
      name: 'John Cena',
      service: 'Barangay Clearance',
      pickup: '2025-09-01',
      requested: '2025-08-01T16:30:00',
      status: 'Pending'
    },
    {
      code: 'RSID-2025-ZYXWV',
      name: 'Maria Santos',
      service: 'Residency Certificate',
      pickup: '2025-09-03',
      requested: '2025-08-31T10:00:00',
      status: 'Processing'
    },
    {
      code: 'BPER-2025-QWERT',
      name: 'Juan Dela Cruz',
      service: 'Barangay Business Permit',
      pickup: '2025-09-05',
      requested: '2025-09-01T09:15:00',
      status: 'Ready for Pickup'
    }
  ];

  let data = [...seed, ...fromStorage];

  // DOM
  const form = document.getElementById('searchForm');
  const q = document.getElementById('query');
  const fService = document.getElementById('filterService');
  const fStatus = document.getElementById('filterStatus');
  const rowsBody = document.getElementById('rowsBody');
  const primary = document.getElementById('primaryCard');
  const resultCount = document.getElementById('resultCount');
  const clearBtn = document.getElementById('clearBtn');

  const statuses = ['Pending','Verified','Processing','Ready for Pickup','Completed'];
  const statusClass = (s) => ({
    'Pending':'status-pending',
    'Verified':'status-verified',
    'Processing':'status-processing',
    'Ready for Pickup':'status-ready',
    'Completed':'status-completed',
    'Rejected':'status-rejected',
  }[s] || 'status-pending');

  const fmtDate = (d) => {
    if(!d) return '—';
    const dt = new Date(d);
    if (isNaN(dt)) return d; // already formatted
    const opts = {year:'numeric', month:'short', day:'2-digit'};
    return dt.toLocaleDateString(undefined, opts);
  };
  const fmtDateTime = (d) => {
    if(!d) return '—';
    const dt = new Date(d);
    if (isNaN(dt)) return d;
    const opts = {year:'numeric', month:'short', day:'2-digit', hour:'numeric', minute:'2-digit'};
    return dt.toLocaleString(undefined, opts);
  };

  function filterData(){
    const term = (q.value || '').trim().toLowerCase();
    const sFilter = fService.value;
    const stFilter = fStatus.value;

    return data.filter(r => {
      const matchTerm = !term ||
        r.code.toLowerCase().includes(term) ||
        (r.name && r.name.toLowerCase().includes(term));
      const matchService = !sFilter || r.service === sFilter;
      const matchStatus = !stFilter || r.status === stFilter;
      return matchTerm && matchService && matchStatus;
    });
  }

  function renderPrimary(rec){
    if(!rec){ primary.classList.add('d-none'); primary.innerHTML = ''; return; }

    const stepIndex = Math.max(0, statuses.indexOf(rec.status));
    const percent = Math.round((stepIndex / (statuses.length-1)) * 100);

    primary.classList.remove('d-none');
    primary.innerHTML = `
      <div class="d-flex flex-column flex-lg-row gap-3 align-items-lg-center justify-content-between">
        <div>
          <div class="text-ink-300 small">Tracking Code</div>
          <div class="h4 fw-bold d-flex align-items-center gap-2">
            <span>${rec.code}</span>
            <button class="btn btn-sm btn-ghost btn-pill py-1 px-2" id="copyMain">Copy</button>
          </div>
        </div>
        <div class="text-lg-end">
          <div class="text-ink-300 small">Status</div>
          <span class="badge badge-status ${statusClass(rec.status)}">${rec.status}</span>
        </div>
      </div>

      <div class="row g-3 mt-3">
        <div class="col-12 col-md-3">
          <div class="text-ink-300 small">Name</div>
          <div class="fw-semibold">${rec.name || '—'}</div>
        </div>
        <div class="col-12 col-md-3">
          <div class="text-ink-300 small">Service</div>
          <div class="fw-semibold">${rec.service}</div>
        </div>
        <div class="col-6 col-md-3">
          <div class="text-ink-300 small">Pick-up Date</div>
          <div class="fw-semibold">${fmtDate(rec.pickup)}</div>
        </div>
        <div class="col-6 col-md-3">
          <div class="text-ink-300 small">Date Requested</div>
          <div class="fw-semibold">${fmtDateTime(rec.requested)}</div>
        </div>
      </div>

      <div class="mt-3">
        <div class="d-flex justify-content-between">
          <small class="text-ink-300">Submitted</small>
          <small class="text-ink-300">Completed</small>
        </div>
        <div class="progress mt-1">
          <div class="progress-bar" role="progressbar" style="width:${percent}%;" aria-valuenow="${percent}" aria-valuemin="0" aria-valuemax="100"></div>
        </div>
        <div class="d-flex justify-content-between text-ink-300 small mt-1 flex-wrap gap-2">
          ${statuses.map(s=>`<span>${s}</span>`).join('')}
        </div>
      </div>
    `;

    // Copy handler
    document.getElementById('copyMain')?.addEventListener('click', () => {
      navigator.clipboard.writeText(rec.code);
    });
  }

  function renderTable(list){
    rowsBody.innerHTML = '';
    if(!list.length){
      rowsBody.innerHTML = `<tr><td colspan="7" class="text-center text-ink-300 py-4">No matching records.</td></tr>`;
      resultCount.textContent = '0 record(s)';
      return;
    }

    list.forEach(r => {
      const tr = document.createElement('tr');
      tr.innerHTML = `
        <td class="fw-semibold">${r.code}</td>
        <td>${r.name || '—'}</td>
        <td>${r.service}</td>
        <td>${fmtDate(r.pickup)}</td>
        <td>${fmtDateTime(r.requested)}</td>
        <td><span class="badge badge-status ${statusClass(r.status)}">${r.status}</span></td>
        <td class="text-end">
          <button class="btn btn-sm btn-ghost btn-pill viewBtn">View</button>
        </td>
      `;
      tr.querySelector('.viewBtn').addEventListener('click', () => renderPrimary(r));
      rowsBody.appendChild(tr);
    });
    resultCount.textContent = `${list.length} record(s)`;
  }

  function doSearch(e){
    if(e) e.preventDefault();
    const list = filterData();
    renderPrimary(list[0]);
    renderTable(list);
  }

  form.addEventListener('submit', doSearch);
  clearBtn.addEventListener('click', () => {
    q.value = '';
    fService.value = '';
    fStatus.value = '';
    doSearch();
  });

  // Initial render (show all / most recent first)
  data.sort((a,b)=> new Date(b.requested || 0) - new Date(a.requested || 0));
  doSearch();
})();
</script>
@endsection
