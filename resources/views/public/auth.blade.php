@extends('layouts.app')
@section('title','Sign in / Create account')

@section('content')
<style>
  .card-glass{ background: rgba(255,255,255,.06); border:1px solid rgba(255,255,255,.15); border-radius:20px; box-shadow: 0 18px 36px rgba(0,0,0,.35); }
  .text-ink-300{ color:#B3CFE5; }
  .btn-pill{ border-radius:999px; }
  .btn-primary-soft{ background:#1A3D63; border-color:#1A3D63; }
  .btn-primary-soft:hover{ filter:brightness(1.1); }

  .form-control, .form-select{
    background:rgba(255,255,255,.06); border:1px solid rgba(255,255,255,.25); color:#F6FAFD;
  }
  .form-control::placeholder{ color:#B3CFE5; text-transform:uppercase; }
  .form-control:focus, .form-select:focus{ border-color:#B3CFE5; box-shadow:0 0 0 .15rem rgba(179,207,229,.2); }

  /* TAB STYLE (so it doesn't look like a button) */
  .nav-tabs { border-bottom: 1px solid rgba(255,255,255,.15); }
  .nav-tabs .nav-link{
    color:#B3CFE5; border:none; background:transparent; font-weight:600;
    border-bottom:2px solid transparent; border-radius:0; padding:.6rem 1rem;
  }
  .nav-tabs .nav-link:hover{ color:#F6FAFD; }
  .nav-tabs .nav-link.active{
    color:#fff; border-bottom-color:#1A3D63; background:transparent;
  }

  /* Light select just for the Role dropdown */
  .select-light{
    background:#F6FAFD !important; color:#0A1832 !important; border:1px solid rgba(0,0,0,.25) !important;
  }
  .select-light:focus{
    border-color:#4A7FA7 !important; box-shadow:0 0 0 .15rem rgba(74,127,167,.25) !important;
    background:#F6FAFD !important; color:#0A1832 !important;
  }
  .select-light option{ color:#0A1832; background:#F6FAFD; }

  .auth-hero{ min-height:clamp(520px, 70vh, 780px); display:grid; place-items:center; }
  .brand-circle{ width:120px;height:120px;border-radius:999px; display:grid; place-items:center; border:1px solid rgba(255,255,255,.25); background:rgba(255,255,255,.04); }
  .caps{ letter-spacing:.08em; }
  
  .alert-danger {
    background-color: rgba(220, 53, 69, 0.1);
    border: 1px solid rgba(220, 53, 69, 0.3);
    color: #f8d7da;
  }
</style>

<section class="py-5">
  <div class="container" style="max-width:1080px">
    <div class="row g-4 align-items-stretch">
      {{-- Left: branding / message --}}
      <div class="col-12 col-lg-5">
        <div class="card-glass auth-hero p-4 p-lg-5 text-center h-100">
          <div>
            <div class="brand-circle mx-auto mb-3">
              <img src="/assets/images/logo.png" alt="Logo" style="max-width:85px">
            </div>
            <div class="caps text-ink-300 small fw-bold">Barangay Management System</div>
            <h1 class="fw-bolder my-2" style="font-size:clamp(24px,3vw,36px)">Welcome back, Kap &amp; Team</h1>
            <p class="text-ink-300 mb-4">
              Access the admin dashboard to manage requests, residents, certificates, permits and inventory.
              Accounts are provisioned by the barangay captain. If you don't have one yet, request an invite.
            </p>
            <div class="small text-ink-300">
              Need help? Email <a class="link-light text-decoration-underline" href="mailto:brgysanpedroapartado31@gmail.com">brgysanpedroapartado31@gmail.com</a>
            </div>
          </div>
        </div>
      </div>

      {{-- Right: auth forms --}}
      <div class="col-12 col-lg-7">
        <div class="card-glass p-3 p-lg-4 h-100">
          {{-- Tabs (underline style, not buttons) --}}
          <ul class="nav nav-tabs mb-3" id="authTabs" role="tablist">
            <li class="nav-item" role="presentation">
              <button class="nav-link active" id="signin-tab" data-bs-toggle="tab" data-bs-target="#signin-pane" type="button" role="tab">Sign in</button>
            </li>
            <li class="nav-item" role="presentation">
              <button class="nav-link" id="signup-tab" data-bs-toggle="tab" data-bs-target="#signup-pane" type="button" role="tab">Create account</button>
            </li>
          </ul>

          <div class="tab-content" id="authTabsContent">
            {{-- SIGN IN --}}
            <div class="tab-pane fade show active" id="signin-pane" role="tabpanel" aria-labelledby="signin-tab" tabindex="0">
              @if ($errors->any())
                <div class="alert alert-danger">
                  <ul class="mb-0">
                    @foreach ($errors->all() as $error)
                      <li>{{ $error }}</li>
                    @endforeach
                  </ul>
                </div>
              @endif

              <form method="POST" action="{{ route('login') }}" class="mt-2">
                @csrf
                <div class="mb-3">
                  <label class="form-label fw-semibold">Email</label>
                  <input type="email" name="email" class="form-control" placeholder="your@email.com" value="{{ old('email') }}" required autofocus>
                </div>
                <div class="mb-2">
                  <label class="form-label fw-semibold">Password</label>
                  <div class="input-group">
                    <input type="password" name="password" class="form-control" id="siPass" placeholder="••••••••" required>
                    <button class="btn btn-outline-light" type="button" id="siToggle">Show</button>
                  </div>
                </div>
                <div class="d-flex justify-content-between align-items-center mb-3">
                  <div class="form-check">
                    <input class="form-check-input" type="checkbox" name="remember" id="rememberMe">
                    <label class="form-check-label" for="rememberMe">Remember me</label>
                  </div>
                  @if (Route::has('password.request'))
                    <a href="{{ route('password.request') }}" class="small link-light text-decoration-underline">Forgot password?</a>
                  @endif
                </div>
                <button type="submit" class="btn btn-light text-dark fw-bold btn-pill px-4">Log in</button>
                <div class="small text-ink-300 mt-2">
                  
                </div>
              </form>
            </div>

            {{-- SIGN UP --}}
            <div class="tab-pane fade" id="signup-pane" role="tabpanel" aria-labelledby="signup-tab" tabindex="0">
              @if ($errors->any())
                <div class="alert alert-danger">
                  <ul class="mb-0">
                    @foreach ($errors->all() as $error)
                      <li>{{ $error }}</li>
                    @endforeach
                  </ul>
                </div>
              @endif

              <form method="POST" action="{{ route('register') }}" class="mt-2">
                @csrf
                <div class="row g-3">
                  <div class="col-12">
                    <label class="form-label fw-semibold">Full Name</label>
                    <input type="text" name="name" class="form-control" placeholder="Juan Dela Cruz" value="{{ old('name') }}" required>
                  </div>
                  <div class="col-12 col-md-6">
                    <label class="form-label fw-semibold">Email</label>
                    <input type="email" name="email" class="form-control" placeholder="your@email.com" value="{{ old('email') }}" required>
                  </div>
                  <div class="col-12 col-md-6">
                    <label class="form-label fw-semibold">Role</label>
                    <select name="role" class="form-select select-light" required>
                      <option value="" disabled selected>Select role</option>
                      <option value="captain" {{ old('role') == 'captain' ? 'selected' : '' }}>Barangay Captain</option>
                      <option value="staff" {{ old('role') == 'staff' ? 'selected' : '' }}>Barangay Secretary</option>
                      <option value="bhw" {{ old('role') == 'bhw' ? 'selected' : '' }}>BHW</option>
                    </select>
                  </div>
                  <div class="col-12 col-md-6">
                    <label class="form-label fw-semibold">Password</label>
                    <div class="input-group">
                      <input type="password" name="password" class="form-control" id="suPass" placeholder="Create password" required>
                      <button class="btn btn-outline-light" type="button" id="suToggle">Show</button>
                    </div>
                  </div>
                  <div class="col-12 col-md-6">
                    <label class="form-label fw-semibold">Confirm Password</label>
                    <input type="password" name="password_confirmation" class="form-control" id="suPass2" placeholder="Repeat password" required>
                  </div>
                </div>

                <div class="form-check mt-3">
                  <input class="form-check-input" type="checkbox" id="agree" required>
                  <label class="form-check-label" for="agree">I agree to the Terms &amp; Privacy Policy.</label>
                </div>

                <div class="d-flex gap-2 mt-3">
                  <button type="submit" class="btn btn-primary-soft fw-bold btn-pill px-4">Submit Request</button>
                  <button type="button" class="btn btn-ghost btn-pill px-3" data-bs-toggle="tab" data-bs-target="#signin-pane">I already have an account</button>
                </div>
                <div class="small text-ink-300 mt-2">
                  Your account request will be reviewed by the barangay captain. You'll receive email confirmation once approved.
                </div>
              </form>
            </div>
          </div>

        </div>
      </div>
    </div>
  </div>
</section>

<script>
  // Show / hide password toggles
  const toggle = (btnId, inputId) => {
    const btn = document.getElementById(btnId), inp = document.getElementById(inputId);
    if(!btn || !inp) return;
    btn.onclick = () => {
      const type = inp.type === 'password' ? 'text' : 'password';
      inp.type = type;
      btn.textContent = type === 'password' ? 'Show' : 'Hide';
    };
  };
  toggle('siToggle','siPass');
  toggle('suToggle','suPass');
</script>
@endsection
