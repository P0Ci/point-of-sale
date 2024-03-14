@foreach ($users as $user)

    @method('put')
    @csrf
    <div class="modal fade text-left" id="edit{{ $user->id }}" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">

                <div class="modal-header">
                    <h5 class="modal-title">{{ __('Edited Member') }}</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('users.update', [$user]) }}" method="POST" >
                        @method('put')
                        @csrf
                        <div class="form-group row">
                            <label for="name" class="col-md-4 col-md-offset-1 control-label">Nama</label>
                            <div class="col-md-8">
                                <input type="text" name="name" id="name" class="form-control" required autofocus value="{{ $user->name }}">
                                <span class="help-block with-errors"></span>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="email" class="col-md-4 col-md-offset-1 control-label">Email</label>
                            <div class="col-md-8">
                                <input type="email" name="email" id="email" class="form-control" required autofocus value="{{ $user->email }}">
                                <span class="help-block with-errors"></span>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="level" class="col-md-4 col-md-offset-1 control-label">Posisi</label>
                            <div class="col-md-8">
                                <select name="level" id="level" class="form-control" required>
                                    <option value="">Pilih Status</option>
                                    @foreach(\App\Models\User::$enumLevel as $value)
                                    <option value="{{ $value }}" {{ $user->level === $value ? 'selected' : '' }}>{{ ucfirst($value) }}</option>                                    @endforeach
                                </select>
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