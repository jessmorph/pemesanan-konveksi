<div class="modal modal-lg fade" id="deleteBaju" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <form id="form-user">
            @csrf
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="labelModalDelete">Apakah Baju ingin dihapuskan</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn me-5 bg-danger" style="color:white" data-bs-dismiss="modal"><strong>Tidak</strong></button>
                    <button type="button" class="btn ms-5 tombolDeleteBaju" style="background-color:green; color:white"> <strong>Ya</strong></button>
                </div>
            </div>
        </form>
    </div>
</div>