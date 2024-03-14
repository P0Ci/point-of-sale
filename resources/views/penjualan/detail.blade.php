@extends('layouts.main')

@section('title')
    Transaksi Detail
@endsection
@section('container')
<h2>@yield('title')</h2>

  <div class="d-sm-flex align-items-center justify-content-between border-bottom">
    <div class="col-lg-12 grid-margin stretch-card mt-4">
        <div class="card">
          <div class="card-body">
            <div class="col-md-12 grid-margin">
                <div class="row">
                    <div class="col-md-4">
                        <h3 class="mb-4"><strong>Transaksi</strong></h3>
                        <table>
                            <tr>
                                <td><strong>ID Transaksi</strong></td>
                                <td>:</td>
                                <td>{{ $transaksi->id_penjualan }}</td>
                            </tr>
                            <tr>
                                <td>Tanggal</td>
                                <td>:</td>
                                <td>{{ $transaksi->created_at->format('d-m-Y') }}</td>
                            </tr>
                            <tr>
                                <td>Total</td>
                                <td>:</td>
                                <td>{{ format_uang($transaksi->total_harga) }}</td>
                            </tr>
                        </table>
                    </div>
                    <div class="col-md-4">
                        <h3 class="mb-4"><strong>Pelanggan</strong></h3>
                        <table>
                            <tr>
                                <td><strong>Nama Pelanggan</strong></td>
                                <td>:</td>
                                <td>{{ optional($transaksi->member)->nama }}</td>
                            </tr>
                            <tr>
                                <td>Alamat</td>
                                <td>:</td>
                                <td>{{ optional($transaksi->member)->alamat }}</td>
                            </tr>
                            <tr>
                                <td>No Telepon</td>
                                <td>:</td>
                                <td>{{ optional($transaksi->member)->telepon }}</td>
                            </tr>
                        </table>
                    </div>
                    <div class="col-md-4 text-center">
                        <h3 class="mb-4"></h3>
                        <a href="{{ url('penjualan/detail/cetak-pdf/'.$transaksi->id_penjualan) }}" class="btn btn-sm btn-warning">Download Invoice</a>
                    </div>
                </div>
            </div>
            <div class="col-md-12 grid-margin">
                <div class="table-responsive">
                    <table class="table table-striped mt-3">
                        <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama Product</th>
                            <th>Jumlah Product</th>
                            <th>Harga Product</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach ($p_details as $item)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $item->nama_product }}</td>
                            <td>{{ $item->jumlah_product }}</td>
                            <td>{{ 'Rp. '.format_uang($item->subtotal) }}</td>
                        </tr>
                        @endforeach
                        <tr>
                            <td colspan="3" class="text-center">Total Harga</td>
                            <td>{{ 'Rp. '.format_uang($transaksi->total_harga) }}</td>
                        </tr>
                        </tbody>
                    </table>
                </div>
            </div>
          </div>
        </div>
    </div>
    
    {{-- @includeIf('category.form') --}}
@endsection

@push('scripts')
<script>
     
</script>
@endpush