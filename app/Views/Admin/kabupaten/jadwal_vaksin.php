<?php $hari = ["Minggu", "Senin", "Selasa", "Rabu", "Kamis", "Jum'at", "Sabtu"] ?>
<div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="staticBackdropLabel">Tambah data peternak</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form method="post" action="<?php echo base_url("admin_kab/add_jadwal_vaksin") ?>">
                <div class="modal-body">
                    <div class="mb-4">
                        <label for="jenis" class="form-label fw-bold" style="line-height: 0.75;color:#636363">Jenis vaksin *</label>
                        <select class="form-select" name="jenis" id="jenis">
                            <option value="">Pilih jenis vaksin</option>
                            <?php foreach ($jenis_vaksin as $x) : ?>
                                <option value="<?php echo $x["id"] ?>"><?php echo $x["jenis_vaksin"] ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="mb-4">
                        <label for="hari" class="form-label fw-bold" style="line-height: 0.75;color:#636363">Hari vaksin *</label>
                        <select class="form-select" name="hari" id="hari">
                            <option value="">Pilih hari vaksin</option>
                            <?php foreach ($hari as $x) : ?>
                                <option value="<?php echo $x ?>"><?php echo $x ?></option>
                            <?php endforeach ?>
                        </select>
                    </div>
                    <div>
                        <label for="tgl_vaksin" class="form-label fw-bold" style="line-height: 0.75;color:#636363">Tanggal vaksin *</label>
                        <input type="date" class="form-control" name="tgl_vaksin" id="tgl_vaksin">
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
<div class="content-parent">
    <div class="content">
        <?php include("header.php") ?>
        <div class="mt-4">
            <div class="my-container">
                <div class="d-flex mb-4 justify-content-start align-items-center">
                    <h4>
                        Data jadwal vaksin
                    </h4>
                    <button type="button" class="btn btn-outline-primary ms-4" data-bs-toggle="modal" data-bs-target="#staticBackdrop">
                        Tambah
                    </button>
                </div>
                <?php echo session()->getFlashdata("message") ?>
                <div class="data boxShadow">
                    <?php if (count($jadwal_vaksin) > 0) { ?>
                        <div class="table-parent">
                            <table id="example" class="table table-striped" style="width:100%;">
                                <thead>
                                    <tr>
                                        <th scope="col">Jenis vaksin</th>
                                        <th style="text-align:start" scope="col">Tanggal</th>
                                        <th style="text-align:start" scope="col">Hari</th>
                                        <th scope="col"></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $idx = 0; ?>
                                    <?php foreach ($jadwal_vaksin as $x) : ?>
                                        <?php $idx = $idx + 1; ?>
                                        <tr class="table-light">
                                            <td><?php echo $x["jenis_vaksin"] ?></td>
                                            <td style="text-align:start"><?php echo $x["tgl_vaksin"] ?></td>
                                            <td style="text-align:start"><?php echo $x["hari_vaksin"] ?></td>
                                            <td style="text-align: end;">
                                                <img style="cursor: pointer;" data-id-jadwal="<?php echo $x["id_jadwal"] ?>" class="me-4 btn-edit-modal" src="<?php echo base_url("assets/image/pen-fill.svg") ?>" width="19px">
                                                <img style="cursor: pointer;" data-id-jadwal="<?php echo $x["id_jadwal"] ?>" class="btn-delete-modal" src="<?php echo base_url("assets/image/trash-fill.svg") ?>" width="19px">
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                    <?php } else { ?>
                        <span>Data masih kosong</span>
                    <?php } ?>
                </div>
            </div>

        </div>
        <?php include("footer.php") ?>
    </div>
</div>
<script src="https://code.jquery.com/jquery-3.7.1.js"></script>
<script src="https://cdn.datatables.net/2.0.2/js/dataTables.js"></script>
<script src="https://cdn.datatables.net/2.0.2/js/dataTables.bootstrap5.js"></script>
<?php include("dropdown_nav.php") ?>
<script>
    let modalWrap = null;
    const btnEditModal = document.querySelectorAll(".btn-edit-modal");
    const btnDeleteModal = document.querySelectorAll(".btn-delete-modal");
    btnDeleteModal.forEach(elem => {
        const idJadwal = elem.getAttribute("data-id-jadwal");
        elem.onclick = () => {
            if (modalWrap !== null) {
                modalWrap.remove();
            };
            modalWrap = document.createElement("div");
            modalWrap.innerHTML = `
                <div class="modal fade" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                    <div class="modal-dialog">
                    <form method="post" action="<?php echo base_url("admin_kab/delete_jadwal_vaksin/") ?>${idJadwal}">
                        <input type="hidden" name="_method" value="delete">
                        <div class="modal-content">
                            <div class="modal-header">
                                <div class="modal-title d-flex m-0 p-0 align-items-center justify-content-between">
                                    <h1 class="fs-5 me-4 lh-0 m-0 p-0" id="staticBackdropLabel">Hapus jadwal vaksin</h1>
                                </div>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body p-0">
                                <div class="p-3">
                                <span>Hapus jadwal?</span>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button data-bs-dismiss="modal" type="button" class="btn btn-danger">Tidak</button>
                                <button class="btn btn-primary">Iya</button>
                            </div>
                        </div>
                    </form>
                    </div>
                </div>
                                `
            document.body.append(modalWrap);
            let modal = new bootstrap.Modal(modalWrap.querySelector(".modal"));
            modal.show();
        }
    });
    btnEditModal.forEach(elem => {
        const idJadwal = elem.getAttribute("data-id-jadwal");
        elem.onclick = () => {
            if (modalWrap !== null) {
                modalWrap.remove();
            };
            modalWrap = document.createElement("div");
            modalWrap.innerHTML = `
                <div class="modal fade" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                    <div class="modal-dialog">
                    <form method="post" action="<?php echo base_url("admin_kab/edit_jadwal_vaksin/") ?>${idJadwal}">
                        <input type="hidden" name="_method" value="put">
                        <div class="modal-content">
                            <div class="modal-header">
                                <div class="modal-title d-flex m-0 p-0 align-items-center justify-content-between">
                                    <h1 class="fs-5 me-4 lh-0 m-0 p-0" id="staticBackdropLabel">Edit jadwal vaksin</h1>
                                </div>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body p-0">
                                <div class="p-3" id="data">
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button data-bs-dismiss="modal" type="button" class="btn btn-danger">Tidak</button>
                                <button class="btn btn-primary" id="button-submit" disabled>Submit</button>
                            </div>
                        </div>
                    </form>
                    </div>
                </div>
                                `
            document.body.append(modalWrap);
            let modal = new bootstrap.Modal(modalWrap.querySelector(".modal"));
            modal.show();
            var xmlhttp = new XMLHttpRequest;
            xmlhttp.onreadystatechange = function() {
                if (this.readyState === 4 && this.status === 200) {
                    const a = JSON.parse(this.responseText);
                    const {
                        hari_vaksin,
                        tgl_vaksin,
                        id_jenis_vaksin
                    } = a.data.detail_jadwal_vaksin;
                    const hari = [
                        "Minggu", "Senin", "Selasa", "Rabu", "Kamis", "Jum'at", "Sabtu"
                    ]
                    document.getElementById("data").innerHTML = `
                        <div class="mb-4">
                            <label for="jenis" class="form-label fw-bold" style="line-height: 0.75;color:#636363">Jenis vaksin *</label>
                            <select class="form-select" name="jenis" id="jenis">
                                <option value="">Pilih jenis vaksin</option>
                                ${a.data.data_jenis_vaksin.map(x => {
                                    return (
                                        `
                                            <option
                                                value="${x["id"]}"
                                                ${x["id"] === id_jenis_vaksin?"selected" : ""}
                                            >
                                                ${x["jenis_vaksin"]}
                                            </option>
                                        `
                                    )
                                })}
                            </select>
                        </div>
                        <div class="mb-4">
                            <label for="hari" class="form-label fw-bold" style="line-height: 0.75;color:#636363">Hari vaksin *</label>
                            <select class="form-select" name="hari" id="hari">
                                <option value="">Pilih hari vaksin</option>
                                ${hari.map(x => {
                                    return (
                                        `
                                            <option
                                                value="${x}"
                                                ${x === hari_vaksin?"selected" : ""}
                                            >
                                                ${x}
                                            </option>
                                        `
                                    )
                                })}
                            </select>
                        </div>
                        <div>
                            <label for="tgl_vaksin" class="form-label fw-bold" style="line-height: 0.75;color:#636363">Tanggal vaksin *</label>
                            <input type="date" class="form-control" name="tgl_vaksin" id="tgl_vaksin" value="${tgl_vaksin}">
                        </div>
                    `
                    console.log(a);
                    document.getElementById("button-submit").removeAttribute("disabled");
                }
            }
            xmlhttp.open("get", "<?php echo base_url("admin_kab/detail_jadwal_vaksin/") ?>" + idJadwal);
            xmlhttp.send();
        }
    })
</script>

<script>
    new DataTable("#example");
</script>