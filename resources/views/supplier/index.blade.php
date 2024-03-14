@extends('layouts.main')

@section('title')
    Suppliers
@endsection
@section('container')
<h2>@yield('title')</h2>
  <div class="d-sm-flex align-items-center justify-content-between border-bottom">
    <div class="col-lg-12 grid-margin stretch-card mt-4">
        <div class="card">
          <div class="card-body">
            <button  class="btn btn-primary btn-lg text-white mb-0 me-0" data-bs-toggle="modal" data-bs-target="#form-modal" type="button"><i class=" mdi mdi-bookmark-plus"></i>Tambah Supplier</button>
            @if (session()->has('success')) 
            <div class="alert alert-success alert-dismissible fade show error col-lg-12 mt-3 mb-1" role="alert">
              {{ session('success') }}
              <button type="button" class="btn-close error" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
            @endif
            <div class="table-responsive">
              <table class="table table-striped mt-3">
                <thead>
                  <tr>
                   <th>No</th>
                   <th>Nama</th>
                   <th>Alamat</th>
                   <th>Telepon</th>
                   <th width="15%">Action</th>
                  </tr>
                </thead>
                <tbody>
                  @foreach ($suppliers as $supplier)
                  <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $supplier->nama }}</td>
                    <td>{{ $supplier->alamat }}</td>
                    <td>{{ $supplier->telepon }}</td>
                    <td>
                      <button type="button" class="badge badge-success" data-bs-toggle="modal" data-bs-target="#edit{{ $supplier->id_supplier }}">Edit</button>
                      <button type="button" class="badge badge-danger" data-bs-toggle="modal" data-bs-target="#delete{{ $supplier->id_supplier }}">Hapus</button>
                      @include('supplier.form_edit')
                      @include('supplier.form_delete')
                    </td>
                  </tr>
                  @endforeach
                </tbody>
              </table>
            </div>
          </div>
        </div>
    </div>
    @include('supplier.form_create')
    
    {{-- @includeIf('category.form') --}}
@endsection

{{-- @push('scripts')
<script>
     $(function () {
      table = $('.table').DataTable({
            responsive: true,
            processing: true,
            serverSide: true,
            autoWidth: false,
            ajax: {
                url: '{{ route('category.data') }}',
            },
            columns: [
                {data: 'DT_RowIndex', searchable: false, sortable: false},
                {data: 'nama_categori'},
                {data: 'aksi', searchable: false, sortable: false},
            ]
        });
        $('#modal-form').validator().on('submit', function (e) {
            if (! e.preventDefault()) {
                $.post($('#modal-form form').attr('action'), $('#modal-form form').serialize())
                    .done((response) => {
                        $('#modal-form').modal('hide');
                        table.ajax.reload();
                    })
                    .fail((errors) => {
                        alert('Tidak dapat menyimpan data');
                        return;
                    });
            }
        });
      });


    function addForm(url) {
        $('#modal-form').modal('show');
        $('#modal-form .modal-title').text('Tambah Kategori');

        $('#modal-form form')[0].reset();
        $('#modal-form form').attr('action', url);
        $('#modal-form [name=_method]').val('post');
        $('#modal-form [name=nama_kategori]').focus();
    };
</script>
@endpush --}}