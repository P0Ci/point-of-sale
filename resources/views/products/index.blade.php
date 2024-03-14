@extends('layouts.main')

@section('title')
    Products
@endsection
@section('container')
<h2>@yield('title')</h2>
  <div class="d-sm-flex align-items-center justify-content-between border-bottom">
    <div class="col-lg-12 grid-margin stretch-card mt-4">
        <div class="card">
          <div class="card-body">
            <div class="d-flex align-items-center justify-content-between">
              <div class="col-md-9">
                <button  class="btn btn-primary btn-lg text-white mb-0 me-0" data-bs-toggle="modal" data-bs-target="#form-modal" type="button"><i class=" mdi mdi-bookmark-plus"></i>Tambah Products</button>
                <a href="#" class="btn btn-danger btn-lg text-white mb-0 me-0" id="deleteAllSelectedRecord">Hapus</a>
              </div>
              <div class="col-md-3">
                <div class="form-group mb-0 me-0">
                  <form action="{{ route('penjualan.index') }}">
                    <div class="input-group">
                        <input type="text" class="form-control" name="product" value="{{ request('product') }}" aria-label="Recipient's username">
                        <div class="input-group-append">
                          <button class="btn btn-primary text-white" type="submit"><i class="icon-search"></i></button>
                        </div>
                    </div>
                  </form>
                </div>
              </div>
            </div>
            
            {{-- <button onclick="cetakBarcode({{ route('product.cetak_barcode') }})" class="btn btn-primary btn-lg text-white mb-0 me-0">Cetak Barcode</button> --}}
            @if (session()->has('success')) 
            <div class="alert alert-success alert-dismissible fade show error mt-3 mb-1" role="alert">
              {{ session('success') }}
              <button type="button" class="btn-close error" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
            @endif
            <div class="table-responsive">
              @if ($products->count() > 0)
              <table class="table table-striped mt-3">
                <thead>
                  <tr>
                   <th><input type="checkbox" name="" id="select_all_ids"></th>
                   <th>No</th>
                   <th>Kode</th>
                   <th>Nama</th>
                   <th>Kategori</th>
                   <th>Merk</th>
                   <th>Harga</th>
                   <th>Stok</th>
                   <th width="15%">Action</th>
                  </tr>
                </thead>
                <tbody>
                  @foreach ($products as $product)
                  <tr id="product_ids{{ $product->id_product }}">
                    <td><input type="checkbox" name="ids" class="checkbox_ids" value="{{ $product->id_product }}"></td>
                    <td>{{ $loop->iteration }}</td>
                    <td><span class="badge badge-success">{{ $product->kode_product }}</span></td>
                    <td>{{ $product->nama_product}}</td>
                    <td>{{ optional($product->categories)->nama_categories }}</td>
                    <td>{{ $product->merk }}</td>
                    <td>{{ format_uang($product->harga) }}</td>
                    <td>{{ $product->stok }}</td>
                    <td>
                      <button type="button" class="badge badge-success" data-bs-toggle="modal" data-bs-target="#edit{{ $product->id_product }}">Edit</button>
                      <button type="button" class="badge badge-danger" data-bs-toggle="modal" data-bs-target="#delete{{ $product->id_product }}">Hapus</button>
                      @include('products.form_edit')
                      @include('products.form_delete')
                    </td>
                  </tr>
                  @endforeach
                </tbody>
              </table>
              @else
              <p class="text-center mt-4">Tidak ada data poduct.</p>
              @endif
            </div>
          </div>
        </div>
    </div>
    @include('products.form_create')
    
    @includeIf('products.form')
@endsection

@push('scripts')
<script>
    
    $(function(e) {
      $("#select_all_ids").click(function(){
        $('.checkbox_ids').prop('checked',$(this).prop('checked'));
      });

      $('#deleteAllSelectedRecord').click(function(e){
        e.preventDefault();
        var all_ids = [];
        $('input:checkbox[name=ids]:checked').each(function(){
          all_ids.push($(this).val());
        });

        $.ajax({
          url:"{{ route('product.delete') }}",
          type:"DELETE",
          data:{
            ids:all_ids,
            _token:'{{ csrf_token() }}'
          },
          success:function(reponse){
            $.each(all_ids,function(key,val){
              $('#product_ids'+val).remove();
            });
          }
        });
      });
    });

    function cetakBarcode(url){
      if($('input:checked').length < 1){
        alert('Pilih data yang akan dicetak');
        return;
      } else if($('input:checked').length < 3){
        alert('Pilih minimal 3 yang akan dicetak');
        return;
      }
    }
</script>
@endpush