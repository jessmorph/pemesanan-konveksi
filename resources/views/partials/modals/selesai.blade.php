<div class="modal modal-lg fade" id="selesaiProgress" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
      <form id="form-user" action="/end-transactions" method="post">
          @csrf
          <input type="hidden" name="idSelesai" id="idSelesai">
          <div class="modal-content">
              <div class="modal-header">
                  <h1 class="modal-title fs-5" id="labelModalDelete">Selesai Pekerjaan</h1>
                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
              </div>
              <div class="modal-body">
                <p>Pekerjaan ini sudah selesai: <b id="no-po-selesai"></b></p>
              </div>
              <div class="modal-footer">
                  <button type="button" class="btn me-5 bg-danger" style="color:white" data-bs-dismiss="modal"><strong>Tidak</strong></button>
                  <input type="submit" id="tombolSelesai" value="Selesai" class="btn ms-5" style="background-color:green; color:white">
              </div>
          </div>
      </form>
  </div>
</div>