
  
  <!-- Modal -->
  <div class="modal fade" id="modal-form" tabindex="-1" aria-labelledby="modal-form" aria-hidden="true">
    <div class="modal-dialog">
     <form action="" method="post" class="form-horizontal">
            @csrf
            @method('post')
          
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Modal title</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <div class="form-group row">
                <label for="nama_categories" class="col-md-4 col-md-offset-1 control-label">Nama Kategori</label>
                <div class="col-md-8">
                    <input type="text" name="nama_categories" id="nama_categories" class="form-control" required autofocus>
                    <span class="help-block with-errors"></span>
                </div>
            </div>
        </div>
        <div class="modal-footer">
        <button type="submit" class="btn btn-primary text-white">Simpan</button>
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
        </div>
      </div>
     </form>
    </div>
  </div>
  