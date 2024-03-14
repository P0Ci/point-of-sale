@foreach ($products as $product)

    @method('put')
    @csrf
    <div class="modal fade text-left" id="edit{{ $product->id_product }}" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">

                <div class="modal-header">
                    <h5 class="modal-title">{{ __('Edited Product') }}</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('product.update', [$product]) }}" method="POST" >
                        @method('put')
                        @csrf
                        <div class="form-group row">
                            <label for="nama_product" class="col-md-4 col-md-offset-1 control-label">Nama Product</label>
                            <div class="col-md-8">
                                <input type="text" name="nama_product" id="nama_product" class="form-control" required autofocus value="{{ $product->nama_product }}">
                                <span class="help-block with-errors"></span>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="id_categories" class="col-md-4 col-md-offset-1 control-label">Kategori</label>
                            <div class="col-md-8">
                                <select name="id_categories" id="id_categories" class="form-control" required>
                                    <option value="">Pilihan Kategori</option>
                                    @foreach ($categories as $key => $item)
                                    <option value="{{ $key }}" {{ $key == $product->id_categories ? 'selected' : '' }}>{{ $item }}</option>
                                    @endforeach
                                </select>
                                <span class="help-block with-errors"></span>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="merk" class="col-md-4 col-md-offset-1 control-label">Merk</label>
                            <div class="col-md-8">
                                <input type="text" name="merk" id="merk" class="form-control" value="{{ $product->merk }}">
                                <span class="help-block with-errors"></span>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="harga" class="col-md-4 col-md-offset-1 control-label">Harga</label>
                            <div class="col-md-8">
                                <input type="number" name="harga" id="harga" class="form-control" value="{{ $product->harga }}">
                                <span class="help-block with-errors"></span>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="stok" class="col-md-4 col-md-offset-1 control-label">Stok</label>
                            <div class="col-md-8">
                                <input type="number" name="stok" id="stok" class="form-control" required value="{{ $product->stok }}">
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