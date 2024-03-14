@extends('layouts.main')

@section('title')
    Dashbord
@endsection
@section('container')
<h2>@yield('title')</h2>
  <div class="d-sm-flex align-items-center justify-content-between border-bottom">
    <div class="row flex-grow">
      <div class="col-md-6 col-lg-4 grid-margin stretch-card mt-4">
        <div class="card bg-primary card-rounded">
          <div class="card-body pb-0">
            <div class="row mb-4">
              <div class="col-md-6">
                <h4 class="card-title card-title-dash text-white mb-4">Data Product</h4>
                <div class="">
                  <p class="status-summary-ight-white mb-1">Jumlah Data</p>
                  <h2 class="text-info">{{ $products }}</h2>
                </div>
              </div>
              <div class="col-md-6">
                <div class="status-summary-chart-wrapper pb-4 text-white text-center">
                  <i class=" mdi mdi-cube-outline mb-2" style="font-size: 7em;"></i>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="col-md-6 col-lg-4 grid-margin stretch-card mt-4">
        <div class="card bg-warning card-rounded">
          <div class="card-body pb-0">
            <div class="row">
              <div class="col-md-6">
                <h4 class="card-title card-title-dash text-white mb-4">Data Penjualan</h4>
                <div class="">
                  <p class="status-summary-ight-white mb-1">Jumlah Data</p>
                  <h2 class="text-danger">{{ $penjualan }}</h2>
                </div>
              </div>
              <div class="col-md-6">
                <div class="status-summary-chart-wrapper pb-4 text-white text-center">
                  <i class=" mdi mdi-cash-multiple mb-2" style="font-size: 7em;"></i>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      @can('admin')
      <div class="col-md-6 col-lg-4 grid-margin stretch-card mt-4">
        <div class="card bg-success card-rounded">
          <div class="card-body pb-0">
            <div class="row">
              <div class="col-md-6">
                <h4 class="card-title card-title-dash text-white mb-4">Data Member</h4>
                <div class="">
                  <p class="status-summary-ight-white mb-1">Jumlah Data</p>
                  <h2 class="text-primary">{{ $pelanggan }}</h2>
                </div>
              </div>
              <div class="col-md-6">
                <div class="status-summary-chart-wrapper pb-4 text-white text-center">
                  <i class=" mdi mdi-account-star mb-2" style="font-size: 7em;"></i>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      @endcan
    </div>
  </div>
@endsection