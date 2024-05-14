<div class="content-parent">
    <div class="content">
        <?php include("header.php") ?>
        <div class="mt-4">
            <div class="my-container">
                <div class="d-flex mb-4 justify-content-start align-items-center">
                    <h4>
                        Data peserta
                    </h4>
                </div>
                <?php echo session()->getFlashdata("message") ?>
                <div class="data boxShadow">
                    <?php if (count($data_peserta) > 0) { ?>
                        <!-- <?php print_r($data_peserta) ?> -->
                        <div class="table-parent">
                            <table id="example" class="table table-striped" style="width:100%;">
                                <thead>
                                    <tr>
                                        <th style="text-align:center;" scope="col">NIK</th>
                                        <th style="text-align:start" scope="col">Pemilik</th>
                                        <th style="text-align:start" scope="col">Jenis vaksin</th>
                                        <th style="text-align:start" scope="col">Tanggal vaksin</th>
                                        <th scope="col"></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $idx = 0; ?>
                                    <?php foreach ($data_peserta as $x) : ?>
                                        <?php $idx = $idx + 1; ?>
                                        <tr class="table-light">
                                            <td style="text-align:center;"><?php echo $x["nik"] ?></td>
                                            <td style="text-align:start"><?php echo $x["nama_pemilik"] ?></td>
                                            <td style="text-align:start"><?php echo $x["jenis_vaksin"] ?></td>
                                            <td style="text-align:start"><?php echo $x["tgl_vaksin"] ?></td>
                                            <td style="text-align: end;">
                                                <button data-id-peserta="<?php echo $x["id_peserta"] ?>" class="btn btn-info btn-sm button-detail">
                                                    Detail
                                                </button>
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
    const btnDetail = document.querySelectorAll(".button-detail");
    btnDetail.forEach(elem => {
        const idPeserta = elem.getAttribute("data-id-peserta");
        elem.onclick = () => {
            console.log(idPeserta)
            if (modalWrap !== null) {
                modalWrap.remove();
            };
            modalWrap = document.createElement("div");
            modalWrap.innerHTML = `
            <div class="modal fade" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <div class="modal-title d-flex m-0 p-0 align-items-center justify-content-between">
                                    <h1 class="fs-5 me-4 lh-0 m-0 p-0" id="staticBackdropLabel">Detail peserta</h1>
                                </div>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body p-0">
                                <div class="p-3 d-flex flex-column" id="data">
                                    <span>Loading...</span>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button class="btn btn-primary btn-sm" id="back">
                                    Back
                                </button>
                            </div>
                        </div>
                    </div>
            </div>
            `
            document.body.append(modalWrap);
            let modal = new bootstrap.Modal(modalWrap.querySelector(".modal"));
            modal.show();
            const openDetail = () => {
                var xmlhttp = new XMLHttpRequest;
                xmlhttp.onreadystatechange = function() {
                    if (this.readyState === 4 && this.status === 200) {
                        const a = JSON.parse(this.responseText);
                        console.log(a)
                        let page = {
                            "detail": "",
                            "edit": "",
                            "hapus": ""
                        };
                        const setDetailPage = (a, page) => {
                            const createColumn = (id, label) => {
                                return {
                                    id: id,
                                    label: label
                                }
                            }
                            const columns = [
                                createColumn("nik", "NIK"),
                                createColumn("nama_pemilik", "Pemilik"),
                                createColumn("alamat", "Alamat"),
                                createColumn("no_hp", "No. HP"),
                                createColumn("jumlah_ternak", "Jumlah ternak"),
                                createColumn("tgl_vaksin", "Tanggal vaksin"),
                                createColumn("jenis_vaksin", "Jenis vaksin")
                            ];
                            page.detail = `
                                ${columns.map((prop, idx) => {
                                    return (
                                        `
                                            <div class="d-flex ${idx !== 0?"mt-2":""} justify-content-between">
                                                <span style="color:#494E58;" class="col-6">
                                                    ${prop.label}
                                                </span>
                                                <span class="col-6">
                                                :  ${a.data_peserta[prop.id]}
                                                </span>
                                            </div>
                                        `
                                    )
                                }).join("")}
                                <div class="mt-4">
                                    <button class="btn btn-primary me-2 btn-sm" id="btn-edit" data-id-jenis-vaksin="${a.data_peserta["id_jenis_vaksin"]}">Edit peserta</button>
                                    <button class="btn btn-danger btn-sm" id="btn-hapus">Hapus peserta</button>
                                </div>
                            `
                            document.getElementById("data").innerHTML = page.detail;
                        }
                        setDetailPage(a, page);
                        const setHapusPage = (page) => {
                            if (page.hapus === "") {
                                page.hapus = `
                                    <div class="d-flex align-items-center">
                                        <span>Hapus peserta vaksin?</span>
                                        <div class="d-flex ms-auto">
                                            <button class="btn me-2 btn-danger btn-sm">Tidak</button>
                                            <button class="btn btn-primary btn-sm" id="submit-hapus">Iya</button>
                                        </div>
                                    </div>
    
                                `
                            }
                            document.getElementById("data").innerHTML = page.hapus;
                            document.getElementById("submit-hapus").onclick = () => {
                                window.location.href = "<?php echo base_url("admin_kab/delete_peserta/") ?>" + idPeserta;
                            }
                        };
                        const setEditPages = (page, idJenisVaksin) => {
                                var xmlhttp = new XMLHttpRequest;
                                xmlhttp.onreadystatechange = function() {
                                    if (this.readyState === 4 && this.status === 200) {
                                        const a = JSON.parse(this.responseText);
                                        console.log(a);
                                        if (page.edit === "") {
                                            page.edit = `
                                                        <div class="mb-4">
                                                            <label for="select-jenis-vaksin" class="form-label fw-bold" style="line-height: 0.75;color:#636363">Jenis vaksin *</label>
                                                            <select class="form-select" id="select-jenis-vaksin">
                                                                    ${a.jenis_vaksin.map(x => {
                                                                        return (
                                                                            `
                                                                                <option
                                                                                    value="${x["id"]}"
                                                                                    ${idJenisVaksin === x["id"] ? "selected" : ""}
                                                                                >
                                                                                    ${x["jenis_vaksin"]}
                                                                                </option>
                                                                            `
                                                                        )
                                                                    })}
                                                                </select>
                                                        </div>
                                                        <form id="form-edit">
                                                            <div class="mb-4 mt-2">
                                                                <label for="jadwal" class="form-label fw-bold" style="line-height: 0.75;color:#636363">Jadwal vaksin *</label>
                                                                <select class="form-select" name="jadwal" id="jadwal">
                                                                        ${a.jadwal_vaksin.filter(x => {
                                                                            return x["id_jenis_vaksin"] === idJenisVaksin
                                                                        }).map(y => {
                                                                            return (
                                                                                `
                                                                                    <option
                                                                                        value="${y["id_jadwal"]}"
                                                                                        ${a.data_peserta["id_jadwal"] === y["id_jadwal"] ? "selected" : ""}
                                                                                    >
                                                                                        ${y["tgl_vaksin"]}
                                                                                    </option>  
                                                                                `
                                                                            )
                                                                        }).join("")}
                                                                    </select>
                                                            </div>
                                                            <div>
                                                                <label for="peternak" class="form-label fw-bold" style="line-height: 0.75;color:#636363">Pemilik ternak *</label>
                                                                    <select class="form-select" name="peternak" id="peternak">
                                                                        ${a.data_peternak.map(x => {
                                                                            return (
                                                                                `
                                                                                    <option
                                                                                        value="${x["nik"]}"
                                                                                        ${a.data_peserta["nik"] === x["nik"] ? "selected" : ""}
                                                                                    >
                                                                                        ${x["nama_pemilik"]} | ${x["no_hp"]}
                                                                                    </option>
                                                                                `
                                                                            )
                                                                        })}
                                                                    </select>
                                                            </div>
                                                        </form>
                                                        <button type="button" id="btn-submit-edit" class="btn mt-2 btn-primary btn-sm">Submit</button>
                                            `
                                        }
                                        document.getElementById("data").innerHTML = page.edit;
                                        let x = [];
                                        const changeJadwal = (arr, idJenisVaksin) => {
                                            x = arr.filter(x => {
                                                return x["id_jenis_vaksin"] === idJenisVaksin
                                            });
                                            return x;
                                        }                                            
                                        const checkEmpty = () => {
                                            const formLength = formEdit.elements.length;
                                            const isEmptyExist = Object.keys(formEdit.elements).find(prop => {
                                                return formEdit.elements[prop].value === ""
                                            });
                                            document.getElementById("btn-submit-edit").removeAttribute("disabled");
                                            if (isEmptyExist || x.length === 0) document.getElementById("btn-submit-edit").setAttribute("disabled", true);
                                        }
                                        const formEdit = document.getElementById("form-edit");
                                        document.getElementById("btn-submit-edit").onclick = () => {
                                            const formData = new FormData(formEdit);
                                            fetch("<?php echo base_url("admin_kab/edit_peserta/")?>"+idPeserta,{
                                                method:"post",
                                                body:formData
                                            }).then(response => {
                                                response.json().then(e => {
                                                    if(e.success) {
                                                        openDetail();
                                                    }
                                                })
                                            })
                                        };
    
                                        document.getElementById("select-jenis-vaksin").onchange = (e) => {
                                            const idJenisVaksin = e.target.value;
                                            // document.getElementById("")
                                            const jadwal =changeJadwal(a.jadwal_vaksin,idJenisVaksin);
                                            document.getElementById("jadwal").innerHTML = `
                                                ${jadwal.map((y, idx) => {
                                                        return (
                                                            `
                                                                <option
                                                                    value="${y["id_jadwal"]}"
                                                                    ${idx === 0 ? "selected" : ""}
                                                                >
                                                                    ${y["tgl_vaksin"]}
                                                                </option>  
                                                            `
                                                        )
                                                }).join("")}
                                            `
                                            checkEmpty();
                                        }
                                        document.getElementById("jadwal").onchange = () => {
                                            checkEmpty();
                                        }
                                        document.getElementById("peternak").onchange = () => {
                                            checkEmpty();
                                        }
                                    }
                                }
                                xmlhttp.open("get", "<?php echo base_url("admin_kab/detail_peserta_edit") ?>" + "?id_vaksin=" + a.data_peserta["id_jenis_vaksin"] + "&id_peserta=" + idPeserta);
                                xmlhttp.send()
                            
                        }
                        document.getElementById("btn-hapus").onclick = () => {
                            setHapusPage(page)
                        };
                        document.getElementById("btn-edit").onclick = (e) => {
                            const idJenisVaksin = document.getElementById("btn-edit").getAttribute("data-id-jenis-vaksin");
                            setEditPages(page, idJenisVaksin);
                        };
                        document.getElementById("back").onclick = () => {
                            document.getElementById("data").innerHTML = page.detail;
                            document.getElementById("btn-hapus").onclick = () => {
                                setHapusPage(page)
                            };
                            document.getElementById("btn-edit").onclick = (e) => {
                                const idJenisVaksin = document.getElementById("btn-edit").getAttribute("data-id-jenis-vaksin");
                                setEditPages(page, idJenisVaksin);
                            };
                        };
                    }
                }
                xmlhttp.open("get", "<?php echo base_url("admin_kab/detail_peserta/") ?>" + idPeserta);
                xmlhttp.send();
            }
            openDetail();
        }
    })
</script>
<script>
    new DataTable("#example");
</script>