
    <div class="modal fade text-left" id="form-modal" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">{{ __('Create New Member') }}</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('member.store') }}" method="POST" >
                        @csrf    
                    <div class="form-group row">
                        <label for="nama" class="col-md-4 col-md-offset-1 control-label">Nama</label>
                        <div class="col-md-8">
                            <input type="text" name="nama" id="nama" class="form-control" required autofocus >
                            <span class="help-block with-errors"></span>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="alamat" class="col-md-4 col-md-offset-1 control-label">Alamat</label>
                        <div class="col-md-8">
                            <input type="text" name="alamat" id="alamat" class="form-control" required autofocus >
                            <span class="help-block with-errors"></span>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="telepon" class="col-md-4 col-md-offset-1 control-label">Telepon</label>
                        <div class="col-md-8">
                            <input type="text" name="telepon" id="telepon" class="form-control" required autofocus >
                            <span class="help-block with-errors"></span>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                <button type="submit" class="btn btn-primary text-white">Simpan</button>
                  <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                </div>
                </form>
            </div>
        </div>
    </div>
