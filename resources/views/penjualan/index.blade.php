@extends('layouts.main')

@section('title')
    Transaksi
@endsection
@section('container')
<h2>@yield('title')</h2>

  <div class="d-sm-flex align-items-center justify-content-between border-bottom">
    <div class="col-lg-12 grid-margin stretch-card mt-4">
        <div class="card">
          <div class="card-body">
            
            <div class="d-flex align-items-center justify-content-between">
              <div class="col-md-9">
                <button  class="btn btn-primary btn-lg text-white mb-0 me-0" data-bs-toggle="modal" data-bs-target="#form-modal" type="button"><i class=" mdi mdi-bookmark-plus"></i>Tambah Member</button>
              </div>
              <div class="col-md-3">
                <div class="form-group mb-0 me-0">
                  <form action="{{ route('penjualan.index') }}">
                    <div class="input-group">
                        <input type="text" class="form-control" name="member" value="{{ request('member') }}" aria-label="Recipient's username">
                        <div class="input-group-append">
                          <button class="btn btn-primary text-white" type="submit"><i class="icon-search"></i></button>
                        </div>
                    </div>
                  </form>
                </div>
              </div>
            </div>
            
            @if (session()->has('success')) 
            <div class="alert alert-success alert-dismissible fade show error mt-3 mb-1" role="alert">
              {{ session('success') }}
              <button type="button" class="btn-close error" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
            @endif

            @if (session()->has('error'))
            <div class="alert alert-warning d-flex align-items-center alert-dismissible fade show error mt-3 mb-1" role="alert">
              <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" class="bi bi-exclamation-triangle-fill flex-shrink-0 me-2" viewBox="0 0 16 16" role="img" aria-label="Warning:">
                <path d="M8.982 1.566a1.13 1.13 0 0 0-1.96 0L.165 13.233c-.457.778.091 1.767.98 1.767h13.713c.889 0 1.438-.99.98-1.767L8.982 1.566zM8 5c.535 0 .954.462.9.995l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 5.995A.905.905 0 0 1 8 5zm.002 6a1 1 0 1 1 0 2 1 1 0 0 1 0-2z"/>
              </svg>
              <div>
                {{ session('error') }}
              </div>
              <button type="button" class="btn-close error" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
            @endif

            <div class="table-responsive">
              @if ($transaksi->count() > 0)
              <table class="table table-striped mt-3">
                <thead>
                  <tr>
                   <th>No</th>
                   <th>Kode</th>
                   <th>Nama</th>
                   <th>Telepon</th>
                   <th>Alamat</th>
                   <th>Status</th>
                   <th>Total Pembayaran</th>
                   <th width="15%">Action</th>
                  </tr>
                </thead>
                <tbody>
                  @foreach ($transaksi as $penjualan)
                  <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td><span class="badge badge-primary">{{ optional($penjualan->member)->kode_member }}</span></td>
                    <td>{{ optional($penjualan->member)->nama }}</td>
                    <td>{{ optional($penjualan->member)->telepon }}</td>
                    <td>{{ optional($penjualan->member)->alamat}}</td>
                    @if($penjualan->status === 'pending')
                    <td><span class="badge badge-warning">{{ ucfirst($penjualan->status) }}</span></td>
                    @elseif($penjualan->status === 'selesai')
                    <td><span class="badge badge-success">{{ ucfirst($penjualan->status) }}</span></td>
                    @endif
                    <td>{{ $penjualan->total_harga }}</td>
                    <td>
                      <a href="{{ url('penjualan/create/'.$penjualan->id_penjualan) }}" class="btn btn-primary btn-lg text-white "><i class=" mdi mdi-bookmark-plus"></i>Tambah Transaksi</a>
                      <a href="{{ url('penjualan/detail/'.$penjualan->id_penjualan) }}" class="btn btn-success btn-lg text-white "><i class=" mdi mdi-bookmark-plus"></i>Detail</a>
                      @include('member.form_edit')
                      @include('member.form_delete')
                    </td>
                  </tr>
                  @endforeach
                </tbody>
              </table>
              @else
                  <p class="text-center mt-4">Tidak ada data penjualan.</p>
              @endif
              <div class="d-flex justify-content-center">
                {{ $transaksi->links() }}
              </div>
            </div>
          </div>
        </div>
    </div>
    @include('penjualan.form_create')
    
    {{-- @includeIf('category.form') --}}
@endsection

@push('scripts')
<script>
     
</script>
@endpush