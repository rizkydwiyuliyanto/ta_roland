<div class="content-parent">
    <?php include("sidebar.php") ?>
    <div class="content">
        <?php include("header.php") ?>
        <div class="mt-4">
            <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h1 class="modal-title fs-5" id="staticBackdropLabel">Tambah data peternak</h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <form method="post" action="<?php echo base_url("admin_kab/add_peternak") . "?kabupaten=" . session()->get("user")["id"] ?>">
                            <div class="modal-body">
                                <div class="mb-2">
                                    <label for="nama_pemilik" class="form-label fw-bold" style="line-height: 0.75;color:#636363">Nama pemilik *</label>
                                    <input class="form-control" type="text" name="nama_pemilik" id="nama_pemilik">
                                </div>
                                <div class="mb-2">
                                    <label for="no_hp" class="form-label fw-bold" style="line-height: 0.75;color:#636363">No. HP *</label>
                                    <input type="number" class="form-control" name="no_hp" id="no_hp">
                                </div>
                                <div>
                                    <label for="alamat" class="form-label fw-bold" style="line-height: 0.75;color:#636363">Alamat *</label>
                                    <textarea class="form-control" name="alamat" id="alamat" rows="4"></textarea>
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
            <!-- Delete Modal -->
            <?php $idx = 0; ?>
            <?php foreach ($data_peternak as $x) : ?>
                <?php $idx = $idx + 1; ?>
                <div class="modal fade" id="deleteModal<?php echo $idx ?>" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h1 class="modal-title fs-5"><?php echo $x["nama_pemilik"] ?></h1>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <form method="post" action="<?php echo base_url("admin_kab/delete_peternak/" . $x["id_pemilik_ternak"]) ?>">
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
            <?php endforeach ?>
            <!-- Edit Modal -->
            <?php $idx = 0; ?>
            <?php foreach ($data_peternak as $x) : ?>
                <?php $idx = $idx + 1; ?>
                <div class="modal fade" id="editModal<?php echo $idx ?>" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h1 class="modal-title fs-5" id="staticBackdropLabel">Edit data peternak</h1>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <form method="post" action="<?php echo base_url("admin_kab/edit_peternak") . "/" . $x["id_pemilik_ternak"] ?>">
                                <input type="hidden" name="_method" value="PUT">
                                <div class="modal-body">
                                    <div class="mb-2">
                                        <label for="nama_pemilik" class="form-label fw-bold" style="line-height: 0.75;color:#636363">Nama pemilik *</label>
                                        <input value="<?php echo $x["nama_pemilik"] ?>" class="form-control" type="text" name="nama_pemilik" id="nama_pemilik">
                                    </div>
                                    <div class="mb-2">
                                        <label for="no_hp" class="form-label fw-bold" style="line-height: 0.75;color:#636363">No. HP *</label>
                                        <input value="<?php echo $x["no_hp"] ?>" type="number" class="form-control" name="no_hp" id="no_hp">
                                    </div>
                                    <div>
                                        <label for="alamat" class="form-label fw-bold" style="line-height: 0.75;color:#636363">Alamat *</label>
                                        <textarea class="form-control" name="alamat" id="alamat" rows="4"><?php echo $x["alamat"] ?></textarea>
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
            <?php endforeach ?>
            <div class="my-container">
                <div class="d-flex mb-4 justify-content-between align-items-center">
                    <h2>
                        Data peternak
                    </h2>
                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#staticBackdrop">
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
                                        <th scope="col">Kabupaten</th>
                                        <th style="text-align:start" scope="col">No. HP</th>
                                        <th scope="col">Alamat</th>
                                        <th scope="col"></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $idx = 0; ?>
                                    <?php foreach ($data_peternak as $x) : ?>
                                        <?php $idx = $idx + 1; ?>
                                        <tr class="table-light">
                                            <td><?php echo $x["nama_pemilik"] ?></td>
                                            <td><?php echo $x["nama_kabupaten"] ?></td>
                                            <td style="text-align:start"><?php echo $x["no_hp"] ?></td>
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
    </div>
</div>