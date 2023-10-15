<div class="modal modal-lg fade" id="deleteProgress" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
      <form id="form-delete" action="/delete-transactions" method="post" >
          @csrf
          <input type="hidden" name="idDelete" id="idDelete">
          <div class="modal-content">
              <div class="modal-header">
                  <h1 class="modal-title fs-5" id="labelModalDelete">Hapus Pekerjaan</h1>
                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
              </div>
              <div class="modal-body" id="body-pekerjaan">
                <p>Pekerjaan ini akan dihapus: <b id="no-po-delete"></b></p>
              </div>
              <div class="modal-footer">
                  <button type="button" class="btn me-5 bg-danger" style="color:white" data-bs-dismiss="modal"><strong>Tidak</strong></button>
                  <input type="submit" id="tombolDelete" class="btn ms-5" value="Hapus" style="background-color:green; color:white">
              </div>
          </div>
      </form>
  </div>
</div>