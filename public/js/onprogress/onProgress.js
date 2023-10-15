$(document).ready(function () {
    $(".selesai").click((e) => {
        const id = e.target.id;
        $("#idSelesai").val(id);
        const noPO = $(`[name=transactions-${id}]`).val();
        $("#no-po-selesai").html(noPO);
    })
    $(".delete").click((e) => {
        const id = e.target.id;
        const noPO = $(`[name=transactions-${id}]`).val();
        setupModeDeleteTransaksi(noPO);
        $("#idDelete").val(id);
        $("#no-po-delete").html(noPO);
    })
});