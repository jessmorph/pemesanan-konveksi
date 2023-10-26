$(document).ready(function () {
    let listBaju = [];
    let selectedId = 0;
    const bajuRequiredField = [
        "bahan",
        "warna",
        "model",
        "nama",
        "inputTotal",
        "inputHargaSatuan",
        "inputKeterangan",
    ];

    const inputFormRequiredField = [
        "deadline",
        "noTelp",
        "pemesan",
        "kota",
        "provinsi",
        "alamat",
        "persenDP",
        "keteranganTambahan",
        "sk",
    ];

    function checkListBaju() {
        const bajus = $("#listBaju").val();
        if (bajus) {
            listBaju = JSON.parse(bajus);
            renderListBaju();
        }
    }

    function getFormData($form) {
        var unindexed_array = $form.serializeArray();
        var indexed_array = {};

        $.map(unindexed_array, function (n, i) {
            indexed_array[n["name"]] = n["value"];
        });

        return indexed_array;
    }

    function calculateHargaDP() {
        const persenDP = $("#persenDP").val();
        const totalHarga = $("[name=hargaPOTotal]").val();
        const hargaDP = persenDP * 0.01 * totalHarga;
        $("#hargaPODP").val(parseToCurrency(hargaDP));
        $("[name=hargaPODP]").val(hargaDP);
    }

    function updateBaju() {
        if (validate(bajuRequiredField)) {
            let $form = $("#form-baju");
            let data = getFormData($form);
            let totalQty = parseInt($("#inputTotal").val());
            listBaju[selectedId] = {
                totalQty,
                ...data,
                gambar: $("[name=gambar]").val(),
                gambarLama: $("[name=gambarLama]").val(),
            };
            renderListBaju();
        }
    }

    function fillFormBaju(dataBaju) {
        const {
            bahan,
            warna,
            model,
            nama,
            hargaSatuan,
            totalQty,
            xxs,
            xs,
            s,
            m,
            l,
            xl,
            xxl,
            xxxl,
            xxxxl,
            keterangan,
            gambar,
        } = dataBaju;
        $("#bahan").val(bahan);
        $("#warna").val(warna);
        $("#model").val(model);
        $("#nama").val(nama);
        $("#inputXXS").val(xxs);
        $("#inputXS").val(xs);
        $("#inputS").val(s);
        $("#inputM").val(m);
        $("#inputL").val(l);
        $("#inputXL").val(xl);
        $("#inputXXL").val(xxl);
        $("#inputXXXL").val(xxxl);
        $("#inputXXXXL").val(xxxxl);
        $("#inputTotal").val(totalQty);
        $("#inputHargaSatuan").val(hargaSatuan);
        $("#inputKeterangan").val(keterangan);
        if (gambar) {
            $("#preview").show();
            $("#preview-image").attr("src", gambar);
            $("[name=gambar]").val(gambar);
            $("[name=gambarLama]").val(gambar);
        } else {
            $("#preview").hide();
            $("#preview-image").attr("src", "");
            $("[name=gambar]").val("");
            $("[name=gambarLama]").val("");
        }
        setupModeEditBaju();
    }

    function renderListBaju() {
        let html = "";
        listBaju
            .filter((baju) => !baju.isDeleted)
            .map((baju, index) => {
                const {
                    bahan,
                    warna,
                    model,
                    nama,
                    hargaSatuan,
                    totalQty,
                    xxs,
                    xs,
                    s,
                    m,
                    l,
                    xl,
                    xxl,
                    xxxl,
                    xxxxl,
                    keterangan,
                } = baju;
                html += "<tr>";

                html += "<tr>";
                html += `<td>${index + 1}</td>`;
                html += `<td style="text-transform: capitalize;">${bahan}</td>`;
                html += `<td style="text-transform: capitalize;">${warna}</td>`;
                html += `<td style="text-transform: capitalize;">${model}</td>`;
                html += `<td style="text-transform: capitalize;">${nama}</td>`;
                html += `<td>${parseToCurrency(hargaSatuan)}</td>`;
                html += `<td>${totalQty}</td>`;
                html += "</tr>";

                html += "<tr>";
                html += "<td></td>";
                html += `<td>XXS: ${xxs}</td>`;
                html += `<td>M: ${m}</td>`;
                html += `<td>XXL: ${xxl}</td>`;
                html += "<th>Keterangan</th>";
                html += "<th colspan='2'>Total Harga</th>";
                html += "</tr>";

                html += "<tr>";
                html += "<th>Size</th>";
                html += `<td>XS: ${xs}</td>`;
                html += `<td>L: ${l}</td>`;
                html += `<td>XXXL: ${xxxl}</td>`;
                html += "<td rowspan='2'>";
                html += `<textarea disabled class="p-2" name="keterangan" id="" cols="30" rows="2" style="text-transform: capitalize;">${keterangan}</textarea>`;
                html += `</td>`;
                html += `<td rowspan="2" colspan="2"> ${parseToCurrency(
                    totalQty * hargaSatuan
                )}</td>`;
                html += "</tr>";

                html += "<tr>";
                html += "<td></td>";
                html += `<td>S: ${s}</td>`;
                html += `<td>XL: ${xl}</td>`;
                html += `<td>XXXXL: ${xxxxl}</td>`;
                html += "</tr>";

                html += "<tr>";
                html += `<td colspan='3'><button type='button' id=${index} data-bs-toggle='modal' data-bs-target='#modalPreview' class='click-preview'>Preview Image</button></td>`;
                html += "<td colspan='2'></td>";
                html += `<td><button type='button' id=${index} class='click-edit' data-bs-toggle='modal' data-bs-target='#modalAddBaju'>Edit</button></td>`;
                html += `<td><button type='button' id=${index} data-bs-toggle='modal' data-bs-target='#deleteBaju' class='click-delete''>Delete</button></td>`;
                html += "</tr>";

                html += "</tr>";
            });
        $("#listBaju").val(JSON.stringify(listBaju));
        $("#listBajuTable").html(html);
        $("#form-baju")[0].reset();
        $("#modalAddBaju").modal("hide");
        let totalAllQty = listBaju.reduce((a, b) => {
            return a + b.totalQty;
        }, 0);
        $("#totalPOQty").val(totalAllQty);
        $("[name=totalPOQty]").val(totalAllQty);
        let totalHarga = listBaju.reduce((a, b) => {
            return a + b.totalQty * b.hargaSatuan;
        }, 0);
        $("#hargaPOTotal").val(parseToCurrency(totalHarga));
        $("[name=hargaPOTotal]").val(totalHarga);
        calculateHargaDP();
    }

    $("body").on("click", ".click-preview", (e) => {
        const id = e.target.id;
        const gambar = listBaju[id].gambar;
        if (gambar) {
            $("#preview-image-modal").attr("src", gambar);
            $("#preview-image-modal").show();
            $("#no-preview-image-modal").hide();
        } else {
            $("#no-preview-image-modal").show();
            $("#preview-image-modal").hide();
        }
    });

    $("body").on("click", ".click-delete", (e) => {
        const id = e.target.id;
        $(".tombolDeleteBaju").attr("id", id);
    });

    $("body").on("click", ".click-edit", (e) => {
        const currId = Number(e.target.id);
        selectedId = currId;
        fillFormBaju(listBaju[currId]);
    });

    $("#tombolSimpan").click((e) => {
        e.preventDefault();
        if (
            $("#tombolSimpan").css("display") !== "none" &&
            validate(bajuRequiredField)
        ) {
            let $form = $("#form-baju");
            let data = getFormData($form);
            listBaju.push({
                totalQty: parseInt($("#inputTotal").val()),
                ...data,
            });
            renderListBaju();
        }
    });

    $("#tombolUpdate").click((e) => {
        e.preventDefault();
        if ($("#tombolUpdate").css("display") !== "none") {
            updateBaju();
        }
    });

    $(".tombolDeleteBaju").click((e) => {
        e.preventDefault();
        const currId = Number(e.currentTarget.id);
        listBaju[currId] = {
            ...listBaju[currId],
            isDeleted: true,
        };
        renderListBaju();
        $("#deleteBaju").modal("hide");
    });

    $("#persenDP").change(() => {
        calculateHargaDP();
    });

    $(".input-form").submit(() => {
        const pendingRequiredField = [
            "noTelp",
            "pemesan",
            "kota",
            "provinsi",
            "alamat",
        ];
        if (!validate(pendingRequiredField) || !validateListBaju()) {
            return false;
        }
    });

    $("#submit-form").click((e) => {
        e.preventDefault();
        $("[name=type]").val("Submit");
        if (validate(inputFormRequiredField) && validateListBaju()) {
            $(".input-form").submit();
            return true;
        }
        return false;
    });

    checkListBaju();
});
