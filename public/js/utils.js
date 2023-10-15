function parseToCurrency(n) {
    return Number(n).toLocaleString("id-ID", {
        style: "currency",
        currency: "IDR",
    });
}

function setupModeEditBaju() {
    document.getElementById("tombolSimpan").style.display = "none";
    document.getElementById("tombolUpdate").style.display = "block";
}

function setupModeAddBaju() {
    document.getElementById("tombolSimpan").style.display = "block";
    document.getElementById("tombolUpdate").style.display = "none";
}

function setupModeEditUser() {
    document.getElementById("tambahRoleLabel").innerHTML = "Edit User";
}

function setupModeAddUser() {
    document.getElementById("tambahRoleLabel").innerHTML = "Tambah User";
}

function setupModeDeleteUser(nama) {
    document.getElementById("labelModalDelete").innerHTML = `Apakah Anda yakin ingin menghapus ${nama}?`;
    document.getElementById("body-pekerjaan").style.display = 'none';
    document.getElementById("form-delete").action = "/delete-user";
}

function setupModeDeleteTransaksi() {
    document.getElementById("labelModalDelete").innerHTML = 'Hapus Pekerjaan';
    document.getElementById("form-delete").action = "/delete-transactions";
}

function validate(requiredField) {
    const failedField = requiredField.map((field) => {
        const value = $(`#${field}`).val();
        if (!value || parseInt(value) === NaN) return field;
    });
    const alertMessage = {
        bahan: "Bahan harus diisi",
        warna: "Warna harus diisi",
        model: "Model harus diisi",
        nama: "Nama harus diisi",
        inputTotal: "Total Qty harus lebih dari 0",
        inputHargaSatuan: "Harga per pcs harus diisi",
        inputKeterangan: "Keterangan harus diisi",
        deadline: "Deadline harus diisi",
        noTelp: "No Telp harus diisi",
        pemesan: "Pemesan harus diisi",
        kota: "Kota harus diisi",
        provinsi: "Provinsi harus diisi",
        alamat: "Alamat harus diisi",
        persenDP: "DP harus diisi",
        keteranganTambahan: "Keterangan Tambahan harus diisi",
        sk: "Syarat dan Ketentuan harus diisi",
        username: "Username harus diisi",
        nama: "Nama harus diisi",
        role: "Role harus diisi",
        password: "Password harus diisi",
        confirmpass: "Confirm Password harus diisi",
    };
    const message = failedField
        .filter((field) => field)
        .map((field) => alertMessage[field])
        .join("\n");
    if (message) {
        alert(message);
        return false;
    }
    return true;
}

function validateListBaju() {
    if ($("#listBaju").val() && JSON.parse($("#listBaju").val()).length > 0) {
        return true;
    }
    alert("Minimal ada 1 baju yang diinput!");
    return false;
}

function validatePassword() {
    const password = $("[name=password]").val();
    const confirmPassword = $("[name=confirmpass]").val();
    if (password !== confirmPassword) {
        alert("Password harus sama dengan Confirm Password!");
        return false;
    }
    return true;
}
