<div class="content-parent">
    <?php include("sidebar.php") ?>
    <div class="content">
        <?php include("header.php") ?>
        <div class="mt-4">
            <div class="modal fade modal-lg" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h1 class="modal-title fs-5" id="staticBackdropLabel">Tambah data peternak</h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <form method="post" action="<?php echo base_url("admin_kab/add_peternak") . "?kabupaten=" . session()->get("user")["id"] ?>">
                            <div class="modal-body">
                                <div class="mb-4">
                                    <label for="id_vaksin" class="form-label fw-bold" style="line-height: 0.75;color:#636363">Vaksin *</label>
                                    <select class="form-control" id="id_vaksin" name="id_vaksin">
                                        <option value="" selected>Open this selecl menu</option>
                                        <?php foreach ($data_jadwal_vaksin as $x) : ?>
                                            <option value="<?php echo $x["id_vaksinasi"] ?>">
                                                <?php echo $x["nama_pemilik"] ?> | <?php echo $x["jenis"] ?> | <?php echo $x["jumlah_dosis"] ?>
                                            </option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                                <div>
                                    <label for="tgl_pemberian" class="form-label fw-bold" style="line-height: 0.75;color:#636363">Tanggal pemberian *</label>
                                    <input class="form-control" type="date" name="tgl_pemberian" id="tgl_pemberian">
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
            <!-- Jadwal -->
            <div class="my-container">
                <div class="d-flex mb-4 justify-content-between align-items-center">
                    <h2>
                        Data vaksin
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
                                        <th style="text-align:start" scope="col">No. HP</th>
                                        <th scope="col">Jenis vaksin</th>
                                        <th scope="col">Alamat</th>
                                        <th scope="col"></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $idx = 0; ?>
                                    <?php foreach ($data_jadwal_vaksin as $x) : ?>
                                        <?php $idx = $idx + 1; ?>
                                        <tr class="table-light">
                                            <td><?php echo $x["nama_pemilik"] ?></td>
                                            <td style="text-align:start"><?php echo $x["no_hp"] ?></td>
                                            <td><?php echo $x["jenis"] ?></td>
                                            <td><?php echo $x["alamat"] ?></td>
                                            <td style="text-align: end;">
                                                <button data-id-vaksin="<?php echo $x["id_vaksinasi"]; ?>" class="btn btn-primary btn-sm me-4 btn-modal-jadwal">Jadwal</button>
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