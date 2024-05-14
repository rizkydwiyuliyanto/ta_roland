<?php include("navbar.php") ?>
<div class="banner mb-2">
    <div class="container banner-content">
        <div class="ms-auto">
            <?php echo session()->getFlashdata("message") ?>
        </div>
        <section id="contact">
            <div id="form">
                <div class="header-form">
                    <h4 class="mb-4">
                        Form usulan
                    </h4>
                </div>
                <form class="d-flex flex-column" action="<?php echo base_url("add_usulan") ?>" id="contactForm" method="post">
                    <div class="form-items">
                        <span>Nama</span>
                        <input type="text" name="nama" placeholder="Masukkan nama" tabindex=1 />
                    </div>
                    <div class="form-items">
                        <span>No Hp</span>
                        <input type="text" name="no_hp" id="no_hp" placeholder="Masukkan Nomor HP" tabindex=2 />
                    </div>
                    <div class="form-items">
                        <span>Jumlah ternak</span>
                        <input type="number" name="jumlah_ternak" placeholder="Masukkan jumlah ternak" tabindex=2 />
                    </div>
                    <!-- <span id="captcha"></span>
                    <input type="text" name="captcha" class="captcha" maxlength="4" size="4" placeholder="Enter captcha code" tabindex=3 /> -->
                    <div class="form-items">
                        <span>Alamat</span>
                        <textarea name="alamat" placeholder="Masukkan alamat" tabindex=4></textarea>
                    </div>
                    <button type="submit" class="submit">SUBMIT FORM</button>
                </form>
            </div>
        </section>
    </div>
</div>
<section class="py-5">
    <div class="container">
        <h3 class="text-center mb-2">
            Distribusi vaksin
        </h3>
        <div class="d-flex flex-column align-items-center mt-4">
            <?php foreach ($data_kab as $x) : ?>
                <p data-id-kab="<?php echo $x["id_kab"] ?>" class="distribusi-item">
                    <?php echo $x["nama_kabupaten"] ?>
                </p>
            <?php endforeach; ?>
        </div>
    </div>
</section>
<script src="https://code.jquery.com/jquery-3.7.1.js"></script>
<script src="https://cdn.datatables.net/2.0.2/js/dataTables.js"></script>
<script src="https://cdn.datatables.net/2.0.2/js/dataTables.bootstrap5.js"></script>
<script>
    new DataTable("#example");
</script>
<script>
    const distribusiItems = document.querySelectorAll(".distribusi-item");
    let modalWrap = null
    distribusiItems.forEach(elem => {
        const idKab = elem.getAttribute("data-id-kab");
        elem.onclick = () => {
            if (modalWrap !== null) {
                modalWrap.remove();
            }
            modalWrap = document.createElement("div");
            modalWrap.innerHTML = `
                <div class="modal fade"  data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                    <div class="modal-dialog modal-lg">
                        <div class="modal-content">
                            <div class="modal-header">
                                <div class="modal-title d-flex m-0 p-0 align-items-center justify-content-between">
                                    <h1 class="fs-5 me-4 lh-0 m-0 p-0" id="staticBackdropLabel">${elem.innerHTML}</h1>
                                </div>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body p-0">
                                <div class="p-3" id="data">
                                    <span>Loading...</span>
                                </div>
                            </div>
                            <div class="modal-footer">
                            </div>
                        </div>
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
                    // console.log(a);
                    // console.log("ET")
                    const {
                        data_vaksin
                    } = a;
                    document.getElementById("data").innerHTML = `
                        <div>
                            <label class="form-label" for="pilih-vaksin">Vaksin</label>
                            <select class="form-select" name="pilih-vaksin" id="pilih-vaksin">
                                <option value="">Pilih vaksin</option>
                                ${data_vaksin.map((x) => {
                                    return (
                                        `
                                            <option value="${x["id_jenis_vaksin"]}">${x["jenis_vaksin"]}</option>
                                        `
                                    )
                                }).join("")}
                            </select>
                            <div
                                id="table"
                                class="mt-5"
                            >
                            
                            </div>
                        </div>
                    `
                    document.getElementById("pilih-vaksin").onblur = (e) => {
                        const idJenisVaksin = e.target.value;
                        if (idJenisVaksin !== "") {
                            const url = "<?php echo base_url("select_jenis_vaksin/") ?>" + idJenisVaksin;
                            var xmlhttp = new XMLHttpRequest;
                            xmlhttp.onreadystatechange = function() {
                                if (this.readyState === 4 && this.status === 200) {
                                    const a = JSON.parse(this.responseText)
                                    const {
                                        data_tahun_vaksin
                                    } = a;
                                    document.getElementById("table").innerHTML = `
                                        <table id="example" class="table table-striped" style="width:100%;">
                                            <thead>
                                                <tr>
                                                    <th style="text-align:start" scope="col">Tahun</th>
                                                    <th style="text-align:start" scope="col">Jumlah dosis</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                ${data_tahun_vaksin.map((x, idx) =>{
                                                    return (
                                                        `
                                                            <tr>
                                                                <td style="text-align:start">${x["tahun_vaksin"]}</td>
                                                                <td style="text-align:start">${x["total_jumlah_vaksin"]}</td>
                                                            </tr>
                                                        `
                                                    )
                                                }).join("")}
                                            </tbody>
                                        </table>
                                    `
                                    new DataTable("#example");
                                }
                            }
                            xmlhttp.open("get", url)
                            xmlhttp.send()
                        }
                    }
                }
            }
            xmlhttp.open("get", "<?php echo base_url("distribusi_vaksin_detail/") ?>" + idKab);
            xmlhttp.send();
        }
    })
</script>