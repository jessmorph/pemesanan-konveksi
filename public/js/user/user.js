$(document).ready(function () {
    function setFormUser(data) {
        const { id, namaUser, username, roleId } = data;
        $("[name=userId]").val(id);
        $("[name=username]").val(username);
        $("[name=nama]").val(namaUser);
        $("[name=role]").val(roleId);
    }

    function clearFormUser() {
        $("[name=username]").val("");
        $("[name=nama]").val("");
        $("[name=role]").prop("selectedIndex", 0);
    }

    $(".record-select-options li a").click(function () {
        var selText = $(this).text();
        $(this)
            .parents(".record-select")
            .find(".dropdown-toggle")
            .html(selText + ' <span class="caret"></span>');
    });

    $(".btn-tambah-user").click((e) => {
        setupModeAddUser();
        clearFormUser();
    });

    $(".btn-edit-user").click((e) => {
        const selectedId = e.currentTarget.id;
        $.ajax({
            url: `/user/${selectedId}`,
            type: "GET",
            success: function (data) {
                setupModeEditUser();
                setFormUser(data);
                $("#tambahRole").modal("show");
            },
            error: function (data) {
                console.log("Error:", data);
                $("#tambahRole").modal("show");
            },
        });
    });

    $("#form-user").submit(() => {
        const userRequiredField = [
            "username",
            "nama",
            "password",
            "confirmpass",
            "role",
        ];
        if (!$("[name=userId]").val()) {
            if (!validate(userRequiredField) || !validatePassword()) {
                return false;
            }
        }
        if ($("[name=password]").val() || $("[name=confirmpass]").val()) {
            if (!validatePassword()) {
                return false;
            }
        }
    });

    $(".btn-delete-user").click((e) => {
        const currentId = e.currentTarget.id;
        const selectedName = e.currentTarget.value;
        $("#idDelete").val(currentId);
        setupModeDeleteUser(selectedName);
        $("#deleteProgress").modal("show");
    })
});
