
    <div class="modal fade text-left" id="form-modal" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">{{ __('Create New Member') }}</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('users.store') }}" method="POST" >
                        @csrf    
                    <div class="form-group row">
                        <label for="name" class="col-md-4 col-md-offset-1 control-label">Nama</label>
                        <div class="col-md-8">
                            <input type="text" name="name" id="name" class="form-control" required autofocus >
                            <span class="help-block with-errors"></span>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="email" class="col-md-4 col-md-offset-1 control-label">Email</label>
                        <div class="col-md-8">
                            <input type="text" name="email" id="email" class="form-control" required autofocus >
                            <span class="help-block with-errors"></span>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="password" class="col-md-4 col-md-offset-1 control-label">Password</label>
                        <div class="col-md-8">
                            <input type="password" name="password" id="password" class="form-control" required autofocus >
                            <span class="help-block with-errors"></span>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="level" class="col-md-4 col-md-offset-1 control-label">Posisi</label>
                        <div class="col-md-8">
                            <select name="level" id="level" class="form-control" required>
                                <option value="">Pilih Status</option>
                                @foreach(\App\Models\User::$enumLevel as $value)
                                <option value="{{ $value }}">{{ ucfirst($value) }}</option>
                                @endforeach
                            </select>
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
