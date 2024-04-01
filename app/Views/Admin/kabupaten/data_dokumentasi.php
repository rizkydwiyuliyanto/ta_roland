<div class="content-parent">
    <?php include("sidebar.php") ?>
    <div class="content">
        <?php include("header.php") ?>
        <div class="mt-4">
            <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h1 class="modal-title fs-5" id="staticBackdropLabel">Tambah data Dokumentasi</h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <?= form_open_multipart("admin_kab/add_dokumentasi")?>
                            <div class="modal-body">
                                <div class="mb-4">
                                    <label for="jadwal" class="form-label">Jadwal</label>
                                    <select class="form-control" name="id_jadwal" id="jadwal">
                                        <option value="" selected>Open this select menu</option>
                                        <?php foreach ($data_dokumentasi as $x) : ?>
                                            <option value="<?php echo $x["id_jadwal"] ?>">
                                                <?php echo $x["nama_pemilik"] ?> | <?php echo $x["jenis"] ?> (<?php echo $x["jumlah_dosis"] ?>), <?php echo $x["tgl_pemberian"] ?>
                                            </option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                                <div style="background-color: #a5a5a5;width:100%;height:200px;" class="rounded position-relative d-flex align-items-center justify-content-center overflow-hidden mb-2">
                                    <span style="color:white;font-size:40px">+</span>
                                    <img class="preview-image" id="preview-image" alt="previewImage" style="display:none;position: absolute;width:100%;height:100%;object-fit:cover;">
                                    <input name="foto" style="position: absolute;height:100%;width:100%;opacity:0;" class="form-control" id="input-image" type="file" accept="image/*">
                                </div>
                                <div>
                                    <label for="keterangan" class="form-label">Keterangan</label>
                                    <textarea class="form-control" name="keterangan" id="keterangan" rows="2"></textarea>
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
            <div class="my-container">
                <div class="d-flex mb-4 justify-content-between align-items-center">
                    <h2>
                        Data dokumentasi
                    </h2>
                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#staticBackdrop">
                        Tambah
                    </button>
                </div>
                <div class="data">
                    <?php echo session()->getFlashdata("message") ?>
                    <div class="container d-flex flex-column py-2 p-0">
                        <!-- <div class="mb-2 ms-auto">
                            <img src="<?php echo base_url("assets/image/filter-right.svg") ?>" width="32px">
                        </div> -->
                        <div class="table-parent">
                            <table id="example" class="table table-striped" style="width:100%;">
                                <thead>
                                    <tr>
                                        <th scope="col">Peternak</th>
                                        <th style="text-align:start" scope="col">No. HP</th>
                                        <th scope="col">Jenis vaksin</th>
                                        <th scope="col">Alamat</th>
                                        <th scope="col">Tanggal pemberian</th>
                                        <th scope="col">Jumlah dosis</th>
                                        <th scope="col"></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $idx = 0; ?>
                                    <?php foreach ($data_dokumentasi as $x) : ?>
                                        <?php $idx = $idx + 1; ?>
                                        <tr class="table-light">
                                            <td><?php echo $x["nama_pemilik"] ?></td>
                                            <td style="text-align:start"><?php echo $x["no_hp"] ?></td>
                                            <td><?php echo $x["jenis"] ?></td>
                                            <td><?php echo $x["alamat"] ?></td>
                                            <td><?php echo $x["tgl_pemberian"] ?></td>
                                            <td><?php echo $x["jumlah_dosis"] ?></td>
                                            <td style="text-align: end;">
                                                <button data-id-jadwal="<?php echo $x["id_jadwal"] ?>" class="btn btn-dokumentasi btn-primary btn-sm me-4">Dokumentasi</button>
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