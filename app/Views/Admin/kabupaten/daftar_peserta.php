<div class="content-parent">
    <div class="content">
        <?php include("header.php") ?>
        <div class="mt-4">
            <div class="my-container">
                <div class="d-flex mb-4 justify-content-start align-items-center">
                    <h4>
                        Pilih vaksin
                    </h4>
                </div>
                <?php echo session()->getFlashdata("message") ?>
                <div class="grid-parent">
                    <?php foreach ($data_jadwal_vaksin as $x) : ?>
                        <div data-id-nama-vaksin="<?php echo $x["jenis_vaksin"] ?>" data-id-vaksin="<?php echo $x["id"] ?>" class="d-flex justify-content-between align-items-center data-jadwal mb-4 boxShadow">
                            <div>
                                <h4 class="p-0 m-0">
                                    <?php echo $x["jenis_vaksin"] ?>
                                </h4>
                            </div>
                            <img src="<?php echo base_url("assets/image/schedule-add.svg") ?>" alt="schedule-add">
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
            <!-- data_jadwal_vaksin -->
        </div>
        <?php include("footer.php") ?>

    </div>
</div>
<?php include("dropdown_nav.php") ?>
<script>
    let modalWrap = null;
    const dataJadwal = document.querySelectorAll(".data-jadwal");
    dataJadwal.forEach(elem => {
        const idVaksin = elem.getAttribute("data-id-vaksin");
        const namaVaksin = elem.getAttribute("data-id-nama-vaksin");
        elem.onclick = () => {
            if (modalWrap !== null) {
                modalWrap.remove();
            };
            modalWrap = document.createElement("div");
            modalWrap.innerHTML = `
                <div class="modal fade" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                    <div class="modal-dialog">
                    <form method="post" action="<?php echo base_url("admin_kab/add_peserta")?>">
                        <div class="modal-content">
                            <div class="modal-header">
                                <div class="modal-title d-flex m-0 p-0 align-items-center justify-content-between">
                                    <h1 class="fs-5 me-4 lh-0 m-0 p-0" id="staticBackdropLabel">Daftar peserta</h1>
                                </div>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body p-0">
                                <div class="p-3" id="data">
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" data-bs-dismiss="modal" type="button" class="btn btn-danger">Tidak</button>
                                <button type="submit" class="btn btn-primary" id="btn-submit" disabled>submit</button>
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
            xmlhttp.onreadystatechange =function() {
                if (this.readyState === 4 && this.status === 200) {
                    const a = JSON.parse(this.responseText);
                    console.log(a);
                    document.getElementById("data").innerHTML = `
                    <span>Vaksin ${namaVaksin}</span>
                    <div class="mb-4 mt-2">
                        <label for="jadwal" class="form-label fw-bold" style="line-height: 0.75;color:#636363">Jadwal vaksin *</label>
                            <select class="form-select" name="jadwal" id="jadwal">
                                <option value="">Pilih Jadwal Vaksin</option>
                                ${a.jadwal_vaksin.map(x => {
                                    return (
                                        `
                                            <option
                                                value="${x["id_jadwal"]}"
                                            >
                                                ${x["tgl_vaksin"]}
                                            </option>
                                        `
                                    )
                                })}
                            </select>
                    </div>
                    <div>
                        <label for="peternak" class="form-label fw-bold" style="line-height: 0.75;color:#636363">Pemilik ternak *</label>
                            <select class="form-select" name="peternak" id="peternak">
                                <option value="">Pilih Pemilik Peternak</option>
                                ${a.data_peternak.map(x => {
                                    return (
                                        `
                                            <option
                                                value="${x["nik"]}"
                                            >
                                                ${x["nama_pemilik"]} | ${x["no_hp"]}
                                            </option>
                                        `
                                    )
                                })}
                            </select>
                    </div>
                    `
                    document.getElementById("btn-submit").removeAttribute("disabled");
                }
            }
            xmlhttp.open("get", "<?php echo base_url("admin_kab/detail_daftar_peserta/") ?>" + idVaksin);
            xmlhttp.send();
        }
    })
</script>