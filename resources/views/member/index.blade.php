@extends('layouts.main')

@section('title')
    Members
@endsection
@section('container')
<h2>@yield('title')</h2>
  <div class="d-sm-flex align-items-center justify-content-between border-bottom">
    <div class="col-lg-12 grid-margin stretch-card mt-4">
        <div class="card">
          <div class="card-body">
            <div class="d-flex align-items-center justify-content-between">
              <div class="col-md-9">
                {{-- <button  class="btn btn-primary btn-lg text-white mb-0 me-0" data-bs-toggle="modal" data-bs-target="#form-modal" type="button"><i class=" mdi mdi-bookmark-plus"></i>Tambah Member</button> --}}
              </div>
              <div class="col-md-3">
                <div class="form-group mb-0 me-0">
                  <form action="{{ route('member.index') }}">
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
            <div class="table-responsive">
              @if ($members->count() > 0)
              <table class="table table-striped mt-3">
                <thead>
                  <tr>
                   <th>No</th>
                   <th>Kode</th>
                   <th>Nama</th>
                   <th>Telepon</th>
                   <th>Alamat</th>
                   <th width="15%">Action</th>
                  </tr>
                </thead>
                <tbody>
                  @foreach ($members as $member)
                  <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td><span class="badge badge-primary">{{ $member->kode_member }}</span></td>
                    <td>{{ $member->nama }}</td>
                    <td>{{ $member->telepon }}</td>
                    <td>{{ $member->alamat }}</td>
                    <td>
                      <button type="button" class="badge badge-success" data-bs-toggle="modal" data-bs-target="#edit{{ $member->id_member }}">Edit</button>
                      <button type="button" class="badge badge-danger" data-bs-toggle="modal" data-bs-target="#delete{{ $member->id_member }}">Hapus</button>
                      @include('member.form_edit')
                      @include('member.form_delete')
                    </td>
                  </tr>
                  @endforeach
                </tbody>
              </table>
              @else
                  <p class="text-center mt-4">Tidak ada data member.</p>
              @endif
            </div>
          </div>
          <div class="d-flex justify-content-center">
            {{ $members->links() }}
          </div>
        </div>
    </div>
  </div>
    @include('member.form_create')
    
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