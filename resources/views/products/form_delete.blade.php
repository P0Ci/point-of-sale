@foreach ($products as $product)

    <div class="modal fade text-left" id="delete{{ $product->id_product }}" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">

                <div class="modal-header">
                    <h5 class="modal-title">{{ __('Delete Product') }}</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('product.destroy', [$product]) }}" method="POST" >
                        @method('delete')
                        @csrf
                        <div class="form-group row">
                            <div class="col-md-12">
                                <p>Apa kamu yakin ingin menghapus kategori <strong class="text-red">{{ $product->nama_product }}</strong>?</p>
                            </div>
                        </div>
                    
                </div>
                <div class="modal-footer">
                <button type="submit" class="btn btn-primary text-white">Hapus</button>
                  <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                </div>
            </form>
            </div>
        </div>
    </div>
@endforeach