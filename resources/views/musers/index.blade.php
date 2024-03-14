@extends('layouts.main')

@section('title')
    Users
@endsection
@section('container')
<h2>@yield('title')</h2>
<div class="d-sm-flex align-items-center justify-content-between border-bottom">
    <div class="col-lg-12 grid-margin stretch-card mt-4">
        <div class="card">
          <div class="card-body">
            <button  class="btn btn-primary btn-lg text-white mb-0 me-0" data-bs-toggle="modal" data-bs-target="#form-modal" type="button"><i class=" mdi mdi-bookmark-plus"></i>Tambah Petugas</button>
            @if (session()->has('success')) 
            <div class="alert alert-success alert-dismissible fade show error col-lg-8 mt-3 mb-1" role="alert">
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
                   <th>Email</th>
                   <th>Level</th>
                   <th width="15%">Action</th>
                  </tr>
                </thead>
                <tbody>
                  @foreach ($users as $user)
                  <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $user->name }}</td>
                    <td>{{ $user->email }}</td>
                    <td>
                        @if($user->level === 'Petugas')
                            <span class="badge badge-warning">{{ ucfirst($user->level) }}</span>
                        @elseif($user->level === 'Admin')
                            <span class="badge badge-success ">{{ ucfirst($user->level) }}</span>
                        @endif
                    </td>
                    <td>
                      <button type="button" class="badge badge-success" data-bs-toggle="modal" data-bs-target="#edit{{ $user->id }}">Edit</button>
                      @if($user->level !== 'Admin')
                      <button type="button" class="badge badge-danger" data-bs-toggle="modal" data-bs-target="#delete{{ $user->id }}">Hapus</button>
                      @endif
                      @include('musers.form_edit')
                      @include('musers.form_delete')
                    </td>
                  </tr>
                  @endforeach
                </tbody>
              </table>
            </div>
          </div>
          <div class="d-flex justify-content-center">
            {{ $users->links() }}
          </div>
        </div>
    </div>
    @include('musers.form_create')
</div>
@endsection