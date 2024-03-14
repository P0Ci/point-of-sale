@extends('layouts.main')

@section('title')
    Tambah Transaksi
@endsection
@section('container')
<h2>@yield('title')</h2>
{{-- <div class="content-wrapper"> --}}
    <div class="row">
        <div class="col-lg-6 grid-margin stretch-card mt-4">
            <div class="card">
            <div class="card-body">
                {{-- <div class="row mt-2">
                    <div class="col-md-4">
                        <label for="member">Nama Member:</label>
                    </div>
                    <div class="col-md-8">
                        <select name="member" id="member" class="form-control" onchange="showProductInputs()">
                            <option value="">Pilih Member</option>
                            <option value="member1">Member 1</option>
                            <option value="member2">Member 2</option>
                            <!-- Tambahkan pilihan lainnya sesuai kebutuhan -->
                        </select>
                    </div>
                </div> --}}
                {{-- <div id="productInputs" style="display: none;"> --}}
                    <div class="row mt-2">
                        <div class="col-md-4">
                            <label for="">Kode Product</label>
                        </div>
                        <div class="col-md-8">
                            <form method="get">
                                <div class="d-flex">
                                    <select name="id_product" class="form-control" id="" >
                                        <option value="">{{ isset($p_detail) ? $p_detail->kode_product : "--Kode Produk--" }}</option>
                                        @foreach ($products as $item)
                                        <option value="{{ $item->id_product }}">{{ $item->kode_product }} - {{ $item->nama_product }}</option>
                                        @endforeach
                                    </select>
                                    <button type="submit" class="btn btn-md btn-primary text-white">Pilih</button>
                                </div>
                            </form>
                        </div>
                    </div>
                    <form action="/penjualan/detail/create" method="post">
                        @csrf
                        <input type="hidden" class="form-control" name="id_penjualan" value="{{ $transaksi->id_penjualan }}">
                        <input type="hidden" class="form-control" name="id_member" value="{{ $transaksi->id_member }}">
                        <input type="hidden" class="form-control" name="id_product" value="{{ isset($p_detail) ? $p_detail->id_product : "" }}">
                        <input type="hidden" class="form-control" name="nama_product" value="{{ isset($p_detail) ? $p_detail->nama_product : "" }}">
                        <input type="hidden" class="form-control" name="subtotal" value="{{ $subtotal }}">
                        <div class="row mt-2">
                            <div class="col-md-4">
                                <label for="">Nama Produk</label>
                            </div>
                            <div class="col-md-8">
                                <input type="text" class="form-control" name="nama_product" value="{{ isset($p_detail) ? $p_detail->nama_product : "" }}" readonly required>
                            </div>
                        </div>
                        <div class="row mt-2">
                            <div class="col-md-4">
                                <label for="">Harga Satuan</label>
                            </div>
                            <div class="col-md-8">
                                <input type="text" class="form-control" name="harga_satuan" value="{{ isset($p_detail) ? format_uang($p_detail->harga) : "" }}" readonly required>
                            </div>
                        </div>
                        <div class="row mt-2">
                            <div class="col-md-4">
                                <label for="">QTY</label>
                            </div>
                            <div class="col-md-8">
                                <div class="d-flex">
                                    <a href="?id_product={{ request('id_product') }}&act=min&qty={{ $qty }}" class="btn btn-primary"><i class="mdi mdi-minus "></i></a>
                                    <input type="number" value="{{ $qty }}" class="form-control text-center" name="qty" required readonly>
                                    <a href="?id_product={{ request('id_product') }}&act=plus&qty={{ $qty }}" class="btn btn-primary ml-2"><i class="mdi mdi-plus "></i></a>
                                </div>
                                @error('qty')
                                <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        {{-- </div> --}}
                        <div class="row mt-2">
                            <div class="col-md-4">

                            </div>
                            <div class="col-md-8">
                                <h5>Subtotal : Rp {{ isset($subtotal) ? format_uang($subtotal) : "" }}</h5>
                            </div>
                        </div>
                        <div class="row mt-2">
                            <div class="col-md-4">

                            </div>
                            <div class="col-md-8">
                                <a href="{{ route('penjualan.index') }}" class="btn btn-primary btn-lg text-white "><i class=" mdi mdi-arrow-left"></i>Kembali</a>
                                <button type="submit" class="btn btn-primary btn-lg text-white">Tambah<i class=" mdi mdi-arrow-right"></i></button>
                            </div>
                        </div>
                    </form>
               </div>
            </div>
        </div>
        <div class="col-lg-6 grid-margin stretch-card mt-4">
            <div class="card">
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-striped p-auto">
                            <tr>
                                <th>No</th>
                                <th>Nama Produk</th>
                                <th>QTY</th>
                                <th>Subtotal</th>
                                <th>#</th>
                            </tr>
                            @foreach ($transaksi_detail as $item)
                                
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $item->nama_product }}</td>
                                <td>{{ $item->jumlah_product }}</td>
                                <td>{{ 'Rp. '.format_rupiah($item->subtotal) }}</td>
                                <td>
                                    <a href="/penjualan/detail/delete?id={{ $item->id_penjualan_detail }}"><i class=" mdi mdi-delete"></i></a>
                                </td>
                            </tr>
                            @endforeach
                        </table>
                    </div>
                    <a href="{{ url('penjualan/detail/selesai/'.$item->id_penjualan) }}" class="btn btn-success btn-lg text-white mt-2"><i class=" mdi mdi-check"></i>Selesai </a>
                    <a href="/penjualan" class="btn btn-success btn-lg text-white mt-2">Pending <i class=" mdi mdi-check"></i></a>
                </div>
            </div>
        </div>
        <div class="col-lg-12 grid-margin stretch-card mt-4 justify-content-center text-align-center">
            <div class="card">
                <div class="card-body">
                    <form action="" method="get">
                    <div class="form-group">
                        <label for="">Total Belanja</label>
                        <input type="number" name="total_belanja" value="{{ format_rupiah($transaksi->total_harga) }}" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="">Dibayarkan</label>
                        <input type="number" name="dibayarkan" value="{{ format_rupiah(request('dibayarkan')) }}" class="form-control">
                    </div>
                    <button type="submit" class="btn btn-primary btn-block text-white">Hitung</button>
                </form>
                    <hr>
                    <div class="form-group">
                        <label for="">Uang Kembalian</label>
                        <input type="number" disabled name="kembalian" value="{{ format_rupiah($kembalian) }}" class="form-control">
                    </div>
                </div>
            </div>
        </div>
    </div>
{{-- </div> --}}


@endsection

@push('scripts')
<script>
    // function showProductInputs() {
    //     var memberSelect = document.getElementById("member");
    //     var productInputsDiv = document.getElementById("productInputs");

    //     if (memberSelect.value !== "") {
    //         productInputsDiv.style.display = "block";
    //     } else {
    //         productInputsDiv.style.display = "none";
    //     }
    // }
</script>
@endpush

