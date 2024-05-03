<div class="d-flex justify-content-center">
    <?php echo session()->getFlashdata("message"); ?>
</div>
<div class="form-login d-flex flex-column">
    <div class="mb-2">
        <img src="<?php echo base_url("assets/image/logo.png") ?>" width="70px">
        <h5 class="fw-bold">Login</h5>
    </div>
    <form class="form m-0" method="post" action="<?php echo base_url("save_auth") ?>">
        <div class="col-12 d-flex flex-column">
            <div class="mb-2">
                <div>
                    <label for="username" class="form-label fw-bold" style="line-height: 0.75;color:#636363">Username *</label>
                    <input class="form-control" type="text" name="username" id="username">
                </div>
            </div>
            <div class="mb-2">
                <div>
                    <label for="password" class="form-label fw-bold" style="line-height: 0.75;color:#636363">Password *</label>
                    <input class="form-control" name="password" id="password">
                </div>
            </div>
            <div>
                <label for="role" class="form-label fw-bold" style="line-height: 0.75;color:#636363">Role *</label>
                <select class="form-select" name="role" id="role">
                    <option value="admin_prov" selected>
                        Admin Provinsi
                    </option>
                    <option value="admin_kab">
                        Admin Kabupaten
                    </option>
                </select>
            </div>
            <span style="margin-top:4px;margin-left:auto;font-size:14px;" class="my-2">Lupa password</span>
            <div>
                <button class="btn-submit">Login</button>
            </div>
        </div>
    </form>
</div>