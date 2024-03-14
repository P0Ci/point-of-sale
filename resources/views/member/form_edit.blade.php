@foreach ($members as $member)

    @method('put')
    @csrf
    <div class="modal fade text-left" id="edit{{ $member->id_member }}" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">

                <div class="modal-header">
                    <h5 class="modal-title">{{ __('Edited Member') }}</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('member.update', [$member]) }}" method="POST" >
                        @method('put')
                        @csrf
                        <div class="form-group row">
                            <label for="nama" class="col-md-4 col-md-offset-1 control-label">Nama</label>
                            <div class="col-md-8">
                                <input type="text" name="nama" id="nama" class="form-control" required autofocus value="{{ $member->nama }}">
                                <span class="help-block with-errors"></span>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="alamat" class="col-md-4 col-md-offset-1 control-label">Alamat</label>
                            <div class="col-md-8">
                                <input type="text" name="alamat" id="alamat" class="form-control" required autofocus value="{{ $member->alamat }}">
                                <span class="help-block with-errors"></span>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="telepon" class="col-md-4 col-md-offset-1 control-label">Telepon</label>
                            <div class="col-md-8">
                                <input type="text" name="telepon" id="telepon" class="form-control" required autofocus value="{{ $member->telepon }}">
                                <span class="help-block with-errors"></span>
                            </div>
                        </div>
                    
                </div>
                <div class="modal-footer">
                <button type="submit" class="btn btn-primary text-white">Edit</button>
                  <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                </div>
            </form>
            </div>
        </div>
    </div>
@endforeach