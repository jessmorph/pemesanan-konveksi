<div class="modal modal-lg fade" id="tambahRole" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
            <form id="form-user" method="post" action="/user">
            @csrf
            <input type="hidden" name="userId">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="tambahRoleLabel">Tambah User</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3" controlId="formRoleName">

                        <div class="row align-items-center">
                            <label class="col-3">Username</label>
                            <input class="col-7" type="text" id="username" name="username" placeholder="Masukan Username" />
                        </div>

                    </div>
                    <div class="mb-3" controlId="formRolePassword">

                        <div class="row align-items-center">
                            <label class="col-3">Nama</label>
                            <input class="col-7" type="text" id="nama" name="nama" placeholder="Masukan Nama"  />
                        </div>

                    </div>
                    <div class="mb-3" controlId="formRolePassword">

                        <div class="row align-items-center">
                            <label class="col-3">Password</label>
                            <input class="col-7" type="password" id="password" name="password" placeholder="Masukan Password" />
                        </div>

                    </div>
                    <div class="mb-3" controlId="formRolePassword">

                        <div class="row align-items-center">
                            <label class="col-3">Confirm Password</label>
                            <input class="col-7" type="password" id="confirmpass" name="confirmpass" placeholder="Masukan Password" />
                        </div>

                    </div>
                    <div class="mb-3" controlId="formRolePassword">

                        <div class="row align-items-center">
                            <label class="col-3">Role</label>
                            <select class="form-select" id="role" name="role" aria-label="Default select example">
                                <option selected disabled>--Open this select menu--</option>
                                @foreach ($listRoles as $option)
                                <option value="{{ $option->id }}">{{ $option->name }}</option>
                                @endforeach
                            </select>
                        </div>

                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" id="tombolSaveUser" class="btn btn-primary">Save changes</button>
                </div>
            </div>
        </form>
    </div>
</div>
