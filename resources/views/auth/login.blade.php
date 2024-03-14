@extends('layouts.lay_login')

@section('container')  
<div class="container-scroller">
  <div class="container-fluid page-body-wrapper full-page-wrapper">
    <div class="content-wrapper d-flex align-items-center auth px-0">
      <div class="row w-100 mx-0">
        <div class="col-lg-3 mx-auto">
          @if (session()->has('LoginError'))
          <div class="alert alert-danger alert-dismissible fade show error" role="alert">
              {{ session('LoginError') }}
              <button type="button" class="btn-close error" data-bs-dismiss="alert" aria-label="Close"></button>
          </div>
          @endif
          <div class="auth-form-light text-left py-5 px-4 px-sm-5">
            <div class="brand-logo text-center">
              <img src="images/gpos_logo.svg" alt="logo" style="width: 150px;">
            </div>
            <h6 class="fw-light text-center">Silahkan Login</h6>
            <form action="{{ route('login') }}" method="post" class="pt-3">
              @csrf
              <div class="form-group">
                <input type="email" class="form-control form-control-lg @error('email') is-invalid @enderror" name="email" id="email" placeholder="Email" value="{{ old('email') }}">
                @error('email')
                <div class="invalid-feedback">
                  {{ $message }}
                </div>
              @enderror
              </div>
              <div class="form-group">
                <input type="password" class="form-control form-control-lg @error('password') is_invalid @enderror" name="password" id="password" placeholder="Password">
                @error('password')
                  <div class="invalid-feedback">
                      {{ $message }}
                  </div>
                @enderror
              </div>
              <button class="w-100 btn btn-lg btn-primary" type="submit">Login</button>
            </form>
            @if (Route::has('register') && App\Models\User::count() === 0)
            <p class="text-center mt-2">Anda belum mempunyai akun, silahkan<a href="{{ route('register') }}" class="text-sm text-gray-700 underline"> Register</a></p>
            @endif
          </div>
        </div>
      </div>
    </div>
    <!-- content-wrapper ends -->
  </div>
  <!-- page-body-wrapper ends -->
</div>
@endsection

