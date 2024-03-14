@extends('layouts.main')

@section('title')
    Laporan Transaksi
@endsection
@section('container')
<h2>@yield('title')</h2>

  <div class="d-sm-flex align-items-center justify-content-between border-bottom">
    <div class="col-lg-12 grid-margin stretch-card mt-4">
        <div class="card">
          <div class="card-body">
            @if (session()->has('error'))
            <div class="alert alert-danger d-flex align-items-center alert-dismissible fade show error mt-3 mb-3" role="alert">
              <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" class="bi bi-exclamation-triangle-fill flex-shrink-0 me-2" viewBox="0 0 16 16" role="img" aria-label="Warning:">
                <path d="M8.982 1.566a1.13 1.13 0 0 0-1.96 0L.165 13.233c-.457.778.091 1.767.98 1.767h13.713c.889 0 1.438-.99.98-1.767L8.982 1.566zM8 5c.535 0 .954.462.9.995l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 5.995A.905.905 0 0 1 8 5zm.002 6a1 1 0 1 1 0 2 1 1 0 0 1 0-2z"/>
              </svg>
              <div>
                {{ session('error') }}
              </div>
              <button type="button" class="btn-close error" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
            @endif
            <div class="row">
              <div class="col-md-6">
                <div class="form-group row">
                  <label for="tglawal" class="col-md-4 col-md-offset-1 control-label">Tanggal Awal</label>
                  <div class="col-md-8">
                      <input type="date" name="tglawal" id="tglawal" class="form-control" required >
                      <span class="help-block with-errors"></span>
                  </div>
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group row">
                  <label for="tglakhir" class="col-md-4 col-md-offset-1 control-label">Tanggal Akhir</label>
                  <div class="col-md-8">
                      <input type="date" name="tglakhir" id="tglakhir" class="form-control" required >
                      <span class="help-block with-errors"></span>
                  </div>
                </div>
              </div>
              <div class="col-md-6">
                  <a href="#" onclick="cetakPenjualan()" class="btn btn-md btn-warning">Download Pdf</a>
              </div>
            </div>
          </div>
        </div>
    </div>
    
    {{-- @includeIf('category.form') --}}
@endsection

@push('scripts')
<script>
    function cetakPenjualan() {
        var tglawal = document.getElementById('tglawal').value;
        var tglakhir = document.getElementById('tglakhir').value;

        // Validasi input tanggal
        if (!tglawal || !tglakhir) {
            alert('Tanggal awal dan tanggal akhir harus diisi!');
            return false; // Mencegah link dari diikuti jika validasi gagal
        }

        // Redirect ke URL cetak dengan tanggal yang dipilih
        window.location.href = 'cetak-penjualan-pertanggal/' + tglawal + '/' + tglakhir;
    }
</script>
@endpush