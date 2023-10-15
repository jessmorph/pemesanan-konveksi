@push('head')
    <!-- Script Calculate Total Qty -->
    <script src="{{ asset('js/inputform/calculateTotalQty.js') }}"></script>
@endpush
<div class="modal modal-lg fade" id="modalAddBaju" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <form id="form-baju" enctype="multipart/form-data">
            @csrf
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5">Input Baju</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <div class="row align-items-center">
                            <label class="col-2">Bahan</label>
                            <input class="col-3" id="bahan" type="text" name="bahan" placeholder="Enter Bahan" style="text-transform: capitalize;"
                                required />
                        </div>
                    </div>
                    <div class="mb-3" >
                        <div class="row align-items-center">
                            <label class="col-2">Warna</label>
                            <input class="col-3" id="warna" type="text" name="warna" placeholder="Enter Warna" style="text-transform: capitalize;"
                                required />
                        </div>
                    </div>
                    <div class="mb-3">
                        <div class="row align-items-center">
                            <label class="col-2">Model</label>
                            <input class="col-3" id="model" type="text" name="model" placeholder="Enter Model" style="text-transform: capitalize;"
                                required />
                        </div>
                    </div>
                    <div class="mb-3" >
                        <div class="row align-items-center">

                            <label class="col-2">Nama</label>
                            <input class="col-3" id="nama" type="text" name="nama" placeholder="Enter Nama" style="text-transform: capitalize;"
                                required />

                        </div>
                    </div>
                    <div class="mb-3" >
                        <div class="row align-items-center">

                            <label class="col-2">XXS</label>
                            <input class="col-3" type="number" id="inputXXS" name="xxs" placeholder=""
                                value="0" min="0" required />
                            <label class="col-2">XL</label>
                            <input class="col-3" type="number" id="inputXL" name="xl" placeholder=""
                                value="0" min="0" required />

                        </div>
                    </div>
                    <div class="mb-3" >
                        <div class="row align-items-center">

                            <label class="col-2">XS</label>
                            <input class="col-3" type="number" id="inputXS" name="xs" placeholder=""
                                value="0" min="0" required />

                            <label class="col-2">XXL</label>
                            <input class="col-3" type="number" id="inputXXL" name="xxl" placeholder=""
                                value="0" min="0" required />

                        </div>
                    </div>
                    <div class="mb-3">
                        <div class="row align-items-center">

                            <label class="col-2">S</label>
                            <input class="col-3" type="number" id="inputS" name="s" placeholder=""
                                value="0" min="0" required />

                            <label class="col-2">XXXL</label>
                            <input class="col-3" type="number" id="inputXXXL" name="xxxl" placeholder=""
                                value="0" min="0" required />

                        </div>
                    </div>
                    <div class="mb-3">
                        <div class="row  align-items-center">

                            <label class="col-2">M</label>
                            <input class="col-3" type="number" id="inputM" name="m" placeholder=""
                                value="0" min="0" required />


                            <label class="col-2">XXXXL</label>
                            <input class="col-3" type="number" id="inputXXXXL" name="xxxxl" placeholder=""
                                value="0" min="0" required />

                        </div>
                    </div>
                    <div class="mb-3" >
                        <div class="row align-items-center">

                            <label class="col-2">L</label>
                            <input class="col-3" type="number" id="inputL" name="l" placeholder=""
                                value="0" min="0" required />

                            <label class="col-2">Total</label>
                            <input class="col-3" type="number" id="inputTotal" name="totalQty" placeholder=""
                                value="0" disabled />


                        </div>
                    </div>
                    <div class="mb-3">
                        <div class="row align-items-center">

                            <label class="col-2">Harga/pcs</label>
                            <input class="col-3" type="number" id="inputHargaSatuan" name="hargaSatuan"
                                placeholder="Rp." required />

                            <label class="col-2">Gambar</label>
                            <input class="col-3" type="file" id="gambar" accept="image/*" />
                            <input class="col-3" type="hidden" name="gambar" />
                            <input class="col-3" type="hidden" name="gambarLama" />

                        </div>
                        <div id="preview" style="display: none">
                            <label class="col-2 mt-3">Preview Gambar:</label>
                            <img id="preview-image" class="p-3" width="100%">
                        </div>
                    </div>
                    <div class="mb-3">
                        <div class="row align-items-center">
                            <label class="col-2 ">Keterangan</label>
                            <textarea class="col-4" as="textarea" id="inputKeterangan" name="keterangan" placeholder="Masukan keterangan"
                                required></textarea>
                        </div>
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary button-close" data-bs-dismiss="modal">Close</button>
                    <button type="submit" id="tombolSimpan" class="btn btn-primary">Add Baju</button>
                    <button type="submit" id="tombolUpdate" class="btn btn-primary">Save</button>
                </div>
            </div>
        </form>
    </div>
</div>
