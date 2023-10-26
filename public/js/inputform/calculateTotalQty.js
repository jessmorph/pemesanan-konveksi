$(document).ready(function () {
    let arraySize = new Array(9).fill(0);

    function checkSizeValue() {
        arraySize[0] = parseInt($("#inputXXS").val()) || 0;
        arraySize[1] = parseInt($("#inputXS").val()) || 0;
        arraySize[2] = parseInt($("#inputS").val()) || 0;
        arraySize[3] = parseInt($("#inputM").val()) || 0;
        arraySize[4] = parseInt($("#inputL").val()) || 0;
        arraySize[5] = parseInt($("#inputXL").val()) || 0;
        arraySize[6] = parseInt($("#inputXXL").val()) || 0;
        arraySize[7] = parseInt($("#inputXXXL").val()) || 0;
        arraySize[8] = parseInt($("#inputXXXXL").val()) || 0;
        getTotal();
    }

    function getTotal() {
        const total = arraySize.reduce((a, b) => a + b, 0);
        $("#inputTotal").val(total);
    }

    function resetPreviewImage() {
        $("#gambar").val("");
        $("#preview").hide();
        $("#preview-image").attr("src", "");
        $("[name=gambar]").val("");
        $("[name=gambarLama]").val("");
    }

    function resetForm() {
        $("#form-baju")[0].reset();
        resetPreviewImage();
    }

    function validateFileUpload(file) {
        const maxFileSize = 5 * 1024 * 1024;
        const acceptedFilesType = ["image/png", "image/gif", "image/jpeg"];
        if (!file) return false;
        if (!acceptedFilesType.includes(file.type)) {
            alert("File harus bertipe Gambar!");
            resetPreviewImage();
            return false;
        }
        if (file.size > maxFileSize) {
            alert("File Gambar Terlalu Besar!");
            resetPreviewImage();
            return false;
        }
        return true;
    }

    $(".buttonModalAddBaju").click(() => {
        arraySize.fill(0);
        resetForm();
        setupModeAddBaju();
    });

    $(".button-close").click(() => {
        resetForm();
    });

    $("#gambar").change((e) => {
        e.preventDefault();
        const input = e.target.files[0];
        if (validateFileUpload(input)) {
            let reader = new FileReader();
            reader.onload = (e) => {
                $("#preview").show();
                $("#preview-image").attr("src", e.target.result);
                $("[name=gambar]").val(e.target.result);
            };
            reader.readAsDataURL(input);
        }
    });

    $("#inputXXS").change(() => {
        arraySize[0] = parseInt($("#inputXXS").val()) || 0;
        getTotal();
    });
    $("#inputXS").change(() => {
        arraySize[1] = parseInt($("#inputXS").val()) || 0;
        getTotal();
    });
    $("#inputS").change(() => {
        arraySize[2] = parseInt($("#inputS").val()) || 0;
        getTotal();
    });
    $("#inputM").change(() => {
        arraySize[3] = parseInt($("#inputM").val()) || 0;
        getTotal();
    });
    $("#inputL").change(() => {
        arraySize[4] = parseInt($("#inputL").val()) || 0;
        getTotal();
    });
    $("#inputXL").change(() => {
        arraySize[5] = parseInt($("#inputXL").val()) || 0;
        getTotal();
    });
    $("#inputXXL").change(() => {
        arraySize[6] = parseInt($("#inputXXL").val()) || 0;
        getTotal();
    });
    $("#inputXXXL").change(() => {
        arraySize[7] = parseInt($("#inputXXXL").val()) || 0;
        getTotal();
    });
    $("#inputXXXXL").change(() => {
        arraySize[8] = parseInt($("#inputXXXXL").val()) || 0;
        getTotal();
    });

    $("body").on("click", ".click-edit", (e) => {
        checkSizeValue();
    });

});
