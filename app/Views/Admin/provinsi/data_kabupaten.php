<div class="content-parent">
    <?php include("sidebar.php") ?>
    <div class="content">
        <?php include("header.php") ?>
        <div class="mt-4">
            <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h1 class="modal-title fs-5" id="staticBackdropLabel">Tambah data kabupaten</h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <form method="post" action="<?php echo base_url("admin_prov/add_kabupaten") ?>" id="form-add">
                            <div class="modal-body">
                                <div class="mb-2">
                                    <label for="title" class="form-label fw-bold" style="line-height: 0.75;color:#636363">Kabupaten *</label>
                                    <select class="form-select select-kabupaten" name="kabupaten">
                                    </select>
                                </div>
                                <div class="col-12 d-flex justify-content-between">
                                    <div class="col-md-5">
                                        <label for="username" class="form-label fw-bold" style="line-height: 0.75;color:#636363">Username *</label>
                                        <input class="form-control" type="text" name="username" id="username">
                                    </div>
                                    <div class="col-md-5">
                                        <label for="password" class="form-label fw-bold" style="line-height: 0.75;color:#636363">Password *</label>
                                        <input class="form-control" name="password" id="password">
                                    </div>
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
            <!-- Edit Modal -->
            <?php $idx = 0; ?>
            <?php foreach ($data_kab as $x) : ?>
                <?php $idx = $idx + 1; ?>
                <div class="modal fade" id="editModal<?php echo $idx; ?>" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h1 class="modal-title fs-5" id="staticBackdropLabel">Edit data Kabupaten (<?php echo $x["nama_kabupaten"] ?>)</h1>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <form method="post" action="<?php echo base_url("admin_prov/edit_kabupaten/".$x["id_kab"]) ?>" id="form-add">
                                <input type="hidden" name="_method" value="PUT">
                                <div class="modal-body">
                                    <div class="mb-2">
                                        <label for="title" class="form-label fw-bold" style="line-height: 0.75;color:#636363">Kabupaten *</label>
                                        <select class="form-select select-kabupaten" name="kabupaten">
                                        </select>
                                    </div>
                                    <div class="col-12 d-flex justify-content-between">
                                        <div class="col-md-5">
                                            <label for="username" class="form-label fw-bold" style="line-height: 0.75;color:#636363">Username *</label>
                                            <input class="form-control" type="text" placeholder="<?php echo $x["username"] ?>" name="username" id="username">
                                        </div>
                                        <div class="col-md-5">
                                            <label for="password" class="form-label fw-bold" style="line-height: 0.75;color:#636363">Password *</label>
                                            <input class="form-control" placeholder="<?php echo $x["password"] ?>" name="password" id="password">
                                        </div>
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
            <!-- delete modal -->
            <?php $idx = 0; ?>
            <?php foreach ($data_kab as $x) : ?>
                <?php $idx = $idx + 1; ?>
                <div class="modal fade" id="deleteModal<?php echo $idx ?>" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h1 class="modal-title fs-5"><?php echo $x["nama_kabupaten"] ?></h1>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <form method="post" action="<?php echo base_url("admin_prov/delete_kabupaten/" . $x["id_kab"]) ?>">
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
        </div>
        <div class="my-container">
            <div class="d-flex mb-4 justify-content-between align-items-center">
                <h2>
                    Data Kabupaten
                </h2>
                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#staticBackdrop">
                    Tambah
                </button>
            </div>
            <div class="data">
                <?php echo session()->getFlashdata("message") ?>
                <div class="container py-2 p-0">
                    <!-- <span>Table</span> -->
                    <div class="table-parent">
                        <table id="example" class="table table-striped" style="width:100%;">
                            <thead>
                                <tr>
                                    <th style="text-align:center" scope="col">Id</th>
                                    <th scope="col">Nama</th>
                                    <th scope="col">Username</th>
                                    <th scope="col">Password</th>
                                    <th scope="col"></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $idx = 0 ?>
                                <?php foreach ($data_kab as $x) : ?>
                                    <?php $idx = $idx + 1; ?>
                                    <tr class="table-light">
                                        <td style="text-align:center"><?php echo $x["id_kab"] ?></td>
                                        <td><?php echo $x["nama_kabupaten"] ?></td>
                                        <td><?php echo $x["username"] ?></td>
                                        <td><?php echo $x["password"] ?></td>
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