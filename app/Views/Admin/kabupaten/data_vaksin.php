<div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="staticBackdropLabel">Tambah data peternak</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form method="post" action="<?php echo base_url("admin_kab/add_vaksin") ?>">
                <div class="modal-body">
                    <div class="mb-2">
                        <label for="id_peternak" class="form-label fw-bold" style="line-height: 0.75;color:#636363">Peternak *</label>
                        <select class="form-control" name="id_peternak">
                            <option value="" selected>Open this select menu</option>
                            <?php foreach ($data_peternak as $x) : ?>
                                <option value="<?php echo $x["id_pemilik_ternak"] ?>"><?php echo $x["nama_pemilik"] ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="mb-2">
                        <label for="jumlah_dosis" class="form-label fw-bold" style="line-height: 0.75;color:#636363">Jumlah dosis *</label>
                        <input type="number" class="form-control" name="jumlah_dosis" id="jumlah_dosis">
                    </div>
                    <div>
                        <label for="jenis" class="form-label fw-bold" style="line-height: 0.75;color:#636363">Jenis vaksin *</label>
                        <input type="text" class="form-control" name="jenis" id="jenis">
                    </div>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-primary" id="btn-add" style="width: 170px;" type="submit">
                        Submit
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- Delete modal -->
<?php $idx = 0; ?>
<?php foreach ($data_vaksin as $x) : ?>
    <?php $idx = $idx + 1; ?>
    <div class="modal fade" id="deleteModal<?php echo $idx ?>" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5"><?php echo $x["jenis"] ?></h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form method="post" action="<?php echo base_url("admin_kab/delete_vaksin/" . $x["id_vaksinasi"]) ?>">
                    <input type="hidden" name="_method" value="DELETE">
                    <div class="modal-body">
                        <span>
                            Hapus dari database?
                        </span>
                    </div>
                    <div class="modal-footer">
                        <button class="btn btn-primary" style="width: 170px;" type="submit">
                            Submit
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
<?php endforeach; ?>
<!-- Edit Modal -->
<?php $idx = 0; ?>
<?php foreach ($data_vaksin as $x) : ?>
    <?php $idx = $idx + 1; ?>
    <div class="modal fade" id="editModal<?php echo $idx; ?>" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5">Edit data peternak</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form method="post" action="<?php echo base_url("admin_kab/edit_vaksin") . "/" . $x["id_vaksinasi"] ?>">
                    <input type="hidden" name="_method" value="PUT">
                    <div class="modal-body">
                        <div class="mb-2">
                            <label for="id_peternak" class="form-label fw-bold" style="line-height: 0.75;color:#636363">Peternak *</label>
                            <select class="form-control" name="id_peternak">
                                <?php foreach ($data_peternak as $y) : ?>
                                    <option value="<?php echo $y["id_pemilik_ternak"] ?>" <?php if ($x["id_peternak"] == $y["id_pemilik_ternak"]) {
                                                                                                echo "selected";
                                                                                            } ?>><?php echo $y["nama_pemilik"] ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="mb-2">
                            <label for="jumlah_dosis" class="form-label fw-bold" style="line-height: 0.75;color:#636363">Jumlah dosis *</label>
                            <input value="<?php echo $x["jumlah_dosis"] ?>" type="number" class="form-control" name="jumlah_dosis" id="jumlah_dosis">
                        </div>
                        <div>
                            <label for="jenis" class="form-label fw-bold" style="line-height: 0.75;color:#636363">Jenis vaksin *</label>
                            <input value="<?php echo $x["jenis"] ?>" type="text" class="form-control" name="jenis" id="jenis">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button class="btn btn-primary" id="btn-add" style="width: 170px;" type="submit">
                            Submit
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
<?php endforeach; ?>

<div class="content-parent">
    <div class="content">
        <?php include("header.php") ?>
        <div class="mt-4">
            <div class="my-container">
                <div class="d-flex mb-4 justify-content-start align-items-center">
                    <h4>
                        Data jenis vaksin
                    </h4>
                    <button type="button" class="btn btn-outline-primary ms-4" data-bs-toggle="modal" data-bs-target="#staticBackdrop">
                        Tambah
                    </button>
                </div>
                <div class="data">
                    <?php echo session()->getFlashdata("message") ?>
                    <div class="container py-2 p-0">
                        <div class="table-parent">
                            <table id="example" class="table table-striped" style="width:100%;">
                                <thead>
                                    <tr>
                                        <th scope="col">Peternak</th>
                                        <th style="text-align:start;" scope="col">No. HP</th>
                                        <th scope="col">Jenis vaksin</th>
                                        <th style="text-align:center;" scope="col">Dosis</th>
                                        <th scope="col">Alamat</th>
                                        <th scope="col"></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $idx = 0; ?>
                                    <?php foreach ($data_vaksin as $x) : ?>
                                        <?php $idx = $idx + 1; ?>
                                        <tr class="table-light">
                                            <td><?php echo $x["nama_pemilik"] ?></td>
                                            <td style="text-align:start;"><?php echo $x["no_hp"] ?></td>
                                            <td><?php echo $x["jenis"] ?></td>
                                            <td style="text-align:center;"><?php echo $x["jumlah_dosis"] ?></td>
                                            <td><?php echo $x["alamat"] ?></td>
                                            <td style="text-align: end;">
                                                <img style="cursor: pointer;" data-bs-toggle="modal" data-bs-target="#editModal<?php echo $idx; ?>" class="me-4" src="<?php echo base_url("assets/image/pen-fill.svg") ?>" width="19px">
                                                <img style="cursor: pointer;" data-bs-toggle="modal" data-bs-target="#deleteModal<?php echo $idx; ?>" src="<?php echo base_url("assets/image/trash-fill.svg") ?>" width="19px">
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

        </div>
        <?php include("footer.php") ?>
    </div>
</div>