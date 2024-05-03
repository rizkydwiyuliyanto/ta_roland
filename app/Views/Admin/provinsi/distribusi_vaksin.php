<div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="staticBackdropLabel">Tambah data kabupaten</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form method="post" action="<?php echo base_url("admin_prov/add_distribusi_vaksin") ?>" id="form-add">
                <div class="modal-body">
                    <div class="mb-2">
                        <label for="jenis" class="form-label fw-bold" style="line-height: 0.75;color:#636363">Nama vaksin *</label>
                        <select class="form-select" name="jenis" id="jenis">
                            <option value="">Pilih vaksin</option>
                            <?php foreach ($jenis_vaksin as $x) : ?>
                                <option value="<?php echo $x["id"] ?>"><?php echo $x["jenis_vaksin"] ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="mb-2">
                        <label for="kabupaten" class="form-label fw-bold" style="line-height: 0.75;color:#636363">Kabupaten *</label>
                        <select class="form-select" name="kabupaten" id="kabupaten">
                            <option value="">Pilih kabupaten</option>
                            <?php foreach ($kabupaten as $x) : ?>
                                <option value="<?php echo $x["id_kab"] ?>"><?php echo $x["nama_kabupaten"] ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="mb-2">
                        <label for="tahun_vaksin" class="form-label fw-bold" style="line-height: 0.75;color:#636363">Tahun vaksin *</label>
                        <input class="form-control" type="text" name="tahun_vaksin" id="tahun_vaksin">
                    </div>
                    <div>
                        <label for="jumlah_dosis" class="form-label fw-bold" style="line-height: 0.75;color:#636363">Jumlah dosis *</label>
                        <input class="form-control" type="number" name="jumlah_dosis" id="jumlah_dosis">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary" id="btn-add" style="width: 170px;" type="submit">
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
                        Data Distribusi vaksin
                    </h4>
                    <button type="button" class="btn btn-primary ms-4" data-bs-toggle="modal" data-bs-target="#staticBackdrop">
                        Tambah
                    </button>
                </div>
                <?php echo session()->getFlashdata("message") ?>
                <div class="data boxShadow">
                    <?php if (count($distribusi_vaksin) > 0) { ?>
                        <div class="table-parent">
                            <table id="example" class="table table-striped" style="width:100%;">
                                <thead>
                                    <tr>
                                        <th scope="col">Nama vaksin</th>
                                        <th scope="col">Jumlah dosis</th>
                                        <th scope="col">Tahun</th>
                                        <th scope="col">Kabupaten</th>
                                        <th scope="col"></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $idx = 0 ?>
                                    <?php foreach ($distribusi_vaksin as $x) : ?>
                                        <?php $idx = $idx + 1; ?>
                                        <tr class="table-light">
                                            <td><?php echo $x["jenis_vaksin"] ?></td>
                                            <td><?php echo $x["jumlah_dosis"] ?></td>
                                            <td><?php echo $x["tahun_vaksin"] ?></td>
                                            <td><?php echo $x["nama_kabupaten"] ?></td>
                                            <td style="text-align: end;">
                                                <img style="cursor: pointer;" data-id-distribusi="<?php echo $x["id_distribusi"] ?>" class="me-4 btn-edit-modal" src="<?php echo base_url("assets/image/pen-fill.svg") ?>" width="19px">
                                                <img style="cursor: pointer;" data-id-distribusi="<?php echo $x["id_distribusi"] ?>" class="btn-delete-modal" src="<?php echo base_url("assets/image/trash-fill.svg") ?>" width="19px">
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
    const btnHapusModal = document.querySelectorAll(".btn-delete-modal");
    const btnEditModal = document.querySelectorAll(".btn-edit-modal")
    let modalWrap = null;
    btnEditModal.forEach(elem => {
        const idDistribusi = elem.getAttribute("data-id-distribusi");
        elem.onclick = () => {
            if (modalWrap !== null) {
                modalWrap.remove();
            };
            modalWrap = document.createElement("div");
            modalWrap.innerHTML = `
                    <div class="modal fade" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                        <div class="modal-dialog">
                        <form method="post" action="<?php echo base_url("admin_prov/edit_distribusi_vaksin/") ?>${idDistribusi}">
                            <input type="hidden" name="_method" value="put">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <div class="modal-title d-flex m-0 p-0 align-items-center justify-content-between">
                                        <h1 class="fs-5 me-4 lh-0 m-0 p-0" id="staticBackdropLabel">Edit distribusi vaksin</h1>
                                    </div>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body p-0">
                                    <div class="p-3" id="data">
                                        <span>Loading...</span>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button data-bs-dismiss="modal" type="button" class="btn btn-danger">Tidak</button>
                                    <button class="btn btn-primary" id="submit-edit">Iya</button>
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
                    console.log(a);
                    const {
                        detail,
                        kabupaten,
                        jenis_vaksin
                    } = a
                    document.getElementById("data").innerHTML = `
                        <div class="mb-2">
                            <label for="jenis" class="form-label fw-bold" style="line-height: 0.75;color:#636363">Nama vaksin *</label>
                            <select class="form-select" name="jenis" id="jenis">
                                <option value="">Pilih vaksin</option>
                                ${jenis_vaksin.map(x => {
                                    return (
                                        `
                                            <option value="${x["id"]}" ${x["id"] === detail["id_jenis_vaksin"] ? "selected" : ""}>${x.jenis_vaksin}</option>
                                        `
                                    )
                                }).join("")}
                            </select>
                        </div>
                        <div class="mb-2">
                            <label for="kabupaten" class="form-label fw-bold" style="line-height: 0.75;color:#636363">Kabupaten *</label>
                            <select class="form-select" name="kabupaten" id="kabupaten">
                                <option value="">Pilih kabupaten</option>
                                ${kabupaten.map(x => {
                                    return (
                                        `
                                            <option value="${x["id_kab"]}" ${x["id_kab"] === detail["id_kabupaten"] ? "selected" : ""}>${x.nama_kabupaten}</option>
                                        `
                                    )
                                }).join("")}
                            </select>
                        </div>
                        <div class="mb-2">
                            <label for="tahun_vaksin" class="form-label fw-bold" style="line-height: 0.75;color:#636363">Tahun vaksin *</label>
                            <input class="form-control" type="text" name="tahun_vaksin" id="tahun_vaksin" value="${detail["tahun_vaksin"]}">
                        </div>
                        <div>
                            <label for="jumlah_dosis" class="form-label fw-bold" style="line-height: 0.75;color:#636363">Jumlah dosis *</label>
                            <input class="form-control" type="number" name="jumlah_dosis" id="jumlah_dosis" value="${detail["jumlah_dosis"]}">
                        </div>
                    `
                    document.getElementById("submit-edit").removeAttribute("disabled");
                }
            }
            xmlhttp.open("get", "<?php echo base_url("admin_prov/detail_distribusi_vaksin/") ?>" + idDistribusi);
            xmlhttp.send();
        }
    })
    btnHapusModal.forEach(elem => {
        const idDistribusi = elem.getAttribute("data-id-distribusi");
        elem.onclick = () => {
            console.log(idDistribusi);
            if (modalWrap !== null) {
                modalWrap.remove();
            };
            modalWrap = document.createElement("div");
            modalWrap.innerHTML = `
                    <div class="modal fade" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                        <div class="modal-dialog">
                        <form method="post" action="<?php echo base_url("admin_prov/delete_distribusi_vaksin/") ?>${idDistribusi}">
                            <input type="hidden" name="_method" value="delete">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <div class="modal-title d-flex m-0 p-0 align-items-center justify-content-between">
                                        <h1 class="fs-5 me-4 lh-0 m-0 p-0" id="staticBackdropLabel">Hapus distribusi vaksin</h1>
                                    </div>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body p-0">
                                    <div class="p-3">
                                    <span>Hapus distribusi vaksin?</span>
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
    })
</script>
<script>
    new DataTable("#example");
</script>