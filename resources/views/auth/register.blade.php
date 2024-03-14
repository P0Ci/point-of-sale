

@extends('layouts.lay_login')

@section('container')  
<div class="container-scroller">
  <div class="container-fluid page-body-wrapper full-page-wrapper">
    <div class="content-wrapper d-flex align-items-center auth px-0">
      <div class="row w-100 mx-0">
        <div class="col-lg-3 mx-auto">
          @if (session()->has('RegisterError'))
          <div class="alert alert-danger alert-dismissible fade show error" role="alert">
              {{ session('RegisterError') }}
              <button type="button" class="btn-close error" data-bs-dismiss="alert" aria-label="Close"></button>
          </div>
          @endif
          <div class="auth-form-light text-left py-5 px-4 px-sm-5">
            <div class="brand-logo text-center">
              <img src="images/gpos_logo.svg" alt="logo" style="width: 150px;">
            </div>
            <h6 class="fw-light text-center">Silahkan Register</h6>
            <form action="{{ route('register') }}" method="post" class="pt-3">
              @csrf
              <div class="form-group">
                <input type="text" class="form-control form-control-lg @error('name') is-invalid @enderror" name="name" id="name" placeholder="Name" value="{{ old('name') }}">
                @error('name')
                <div class="invalid-feedback">
                  {{ $message }}
                </div>
              @enderror
              </div>
              <div class="form-group">
                <input type="email" class="form-control form-control-lg @error('email') is-invalid @enderror" name="email" id="email" placeholder="Email" value="{{ old('email') }}">
                @error('email')
                <div class="invalid-feedback">
                  {{ $message }}
                </div>
              @enderror
              </div>
              <div class="form-group">
                <input type="password" class="form-control form-control-lg @error('password') is-invalid @enderror" name="password" id="password" placeholder="Password" required autocomplete="new-password">
                @error('email')
                <div class="invalid-feedback">
                  {{ $message }}
                </div>
              @enderror
              </div>
              <div class="form-group">
                <input type="password" class="form-control form-control-lg @error('password_confirmation') is_invalid @enderror" name="password_confirmation" id="password_confirmation" placeholder="Konfirmasi Password" required autocomplete="new-password">
                @error('password')
                  <div class="invalid-feedback">
                      {{ $message }}
                  </div>
                @enderror
              </div>
              @if (Laravel\Jetstream\Jetstream::hasTermsAndPrivacyPolicyFeature())
                <div class="mt-4">
                    <x-jet-label for="terms">
                        <div class="flex items-center">
                            <x-jet-checkbox name="terms" id="terms"/>

                            <div class="ml-2">
                                {!! __('I agree to the :terms_of_service and :privacy_policy', [
                                        'terms_of_service' => '<a target="_blank" href="'.route('terms.show').'" class="underline text-sm text-gray-600 hover:text-gray-900">'.__('Terms of Service').'</a>',
                                        'privacy_policy' => '<a target="_blank" href="'.route('policy.show').'" class="underline text-sm text-gray-600 hover:text-gray-900">'.__('Privacy Policy').'</a>',
                                ]) !!}
                            </div>
                        </div>
                    </x-jet-label>
                </div>
              @endif
              <input type="text" class="form-control form-control-lg" name="level" id="level" placeholder="Level" value="Admin" hidden>
              <button class="w-100 btn btn-lg btn-primary" type="submit">Register</button>
            </form>
          </div>
        </div>
      </div>
    </div>
    <!-- content-wrapper ends -->
  </div>
  <!-- page-body-wrapper ends -->
</div>
@endsection


