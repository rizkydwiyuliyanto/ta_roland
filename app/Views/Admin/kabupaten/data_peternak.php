<div class="content-parent">
    <div class="content">
        <?php include("header.php") ?>
        <div class="mt-4">
            <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                <div class="modal-dialog modal-xl">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h1 class="modal-title fs-5" id="staticBackdropLabel">Tambah data peternak</h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <form method="post" action="<?php echo base_url("admin_kab/add_peternak") . "?kabupaten=" . session()->get("user")["id"] ?>">
                            <div class="modal-body">
                                <div class="mb-4">
                                    <div class="mb-4">
                                        <div class="col-12">
                                            <div class="search mt-1 mb-1">
                                                <i class="fa fa-search"></i>
                                                <input type="text" class="form-control" id="search" placeholder="Masukkan nama">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="mt-2 mb-4" id="result"></div>
                                    <div class="mt-2 mb-4">
                                        <input type="hidden" name="usulan" id="usulan" value="">
                                        <span id="selected">Selected: </span>
                                    </div>
                                </div>
                                <div class="mb-2">
                                    <label for="nik" class="form-label fw-bold" style="line-height: 0.75;color:#636363">NIK *</label>
                                    <input class="form-control" type="number" name="nik" id="nik">
                                </div>
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
            <div class="my-container">
                <div>
                    <div class="d-flex mb-4 justify-content-start align-items-center">
                        <h4>
                            Data peternak
                        </h4>
                        <button type="button" class="btn btn-outline-primary ms-4" data-bs-toggle="modal" data-bs-target="#staticBackdrop">
                            Tambah
                        </button>
                    </div>
                    <?php echo session()->getFlashdata("message") ?>
                    <div class="data boxShadow">
                        <?php if (count($data_peternak) > 0) { ?>
                            <div class="table-parent">
                                <table id="example" class="table table-striped table-fs-small" style="width:100%;">
                                    <thead>
                                        <tr>
                                            <th scope="col">Peternak</th>
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
                                                <td style="text-align:start"><?php echo $x["no_hp_pemilik"] ?></td>
                                                <td><?php echo $x["alamat_pemilik"] ?></td>
                                                <td style="text-align: end;">
                                                    <img style="cursor: pointer;" data-id-nama="<?php echo $x["nama_pemilik"] ?>" data-id-nik="<?php echo $x["nik"] ?>" class="me-4 btn-modal-edit" src="<?php echo base_url("assets/image/pen-fill.svg") ?>" width="19px">
                                                    <img style="cursor: pointer;" data-id-nama="<?php echo $x["nama_pemilik"] ?>" data-id-nik="<?php echo $x["nik"] ?>" class="btn-modal-delete" src="<?php echo base_url("assets/image/trash-fill.svg") ?>" width="19px">
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

        </div>
        <?php include("footer.php") ?>
    </div>
</div>
<script src="https://code.jquery.com/jquery-3.7.1.js"></script>
<script src="https://cdn.datatables.net/2.0.2/js/dataTables.js"></script>
<script src="https://cdn.datatables.net/2.0.2/js/dataTables.bootstrap5.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css"></script>
<?php include("dropdown_nav.php") ?>
<script>
    const btmModalDelete = document.querySelectorAll(".btn-modal-delete");
    const btnModalEdit = document.querySelectorAll(".btn-modal-edit");
    let modalWrap = null;
    const searchUsulan = (searchElement, resultElement, usulanElement, selectedElement, usulan, selected, columns, text) => {
        searchElement.oninput = (e) => {
            console.log(selected)
            resultElement.innerHTML = ``;
            if (e.target.value !== "") {
                const result = usulan.filter(x => {
                    return x["nama"].toLowerCase().startsWith(e.target.value.toLowerCase());
                });
                resultElement.innerHTML = `
                            <div class="card-radio">
                                <div class="card-radio-content">
                                    ${
                                        result.map((y, idx) => {
                                            return (
                                                `
                                                    <input data-id-usulan="${y["id"]}" class="radio-item d-none" id="radio${text}${idx}" type="radio" name="rd" />
                                                `
                                            )
                                        }).join("")
                                    }
                                    <div class="grid-parent">
                                        ${
                                            result.map((y, idx) => {
                                                return (
                                                    `
                                                        <label data-id-nama="${y["nama"]}" data-id-usulan="${y["id"]}" for="radio${text}${idx}"  class="box radio-label">
                                                            <div class="plan mb-2">
                                                                <span class="circle"></span>
                                                                <span class="yearly">${y["nama"]}</span>
                                                            </div>
                                                            ${columns.map((col, idx2) => {
                                                                return (
                                                                    `
                                                                        <div class="${idx2 !== 0?"mt-1":""} d-flex justify-content-start">
                                                                            <span style="width:150px" class="col-5 price">${col.label}</span>
                                                                            <span class="price col-7">: ${y[col.id]}</span>
                                                                        </div>
                                                                    `
                                                                )
                                                            }).join("")}
                                                        </label>
                                                    `
                                                )
                                            }).join("")
                                        }
                                    </div>
                                </div>
                            </div>
                            
                        `
                const checkSelected = (id, nama) => {
                    document.querySelectorAll(".radio-item").forEach((elem2, idx2) => {
                        const circle = document.querySelectorAll(".circle")[idx2]
                        const radioLabel = document.querySelectorAll(".radio-label")[idx2]
                        const idInputUsulan = elem2.getAttribute("data-id-usulan");
                        if ((id === idInputUsulan)) {
                            selectedElement.innerHTML = "Selected: " + nama;
                            usulanElement.value = id
                            elem2.checked = true;
                            // radioLabel.style.borderColor = "#8e49e8";
                            radioLabel.style.backgroundColor = "#d5bbf7";
                            circle.style.borderColor = "#8e49e8"
                            circle.style.backgroundColor = "#fff";
                        } else {
                            elem2.checked = false;
                            // radioLabel.style.barderColor = "#DDDDDD";
                            radioLabel.style.backgroundColor = "#DDDDDD";
                            circle.style.borderColor = "#CCCCCC";
                            circle.style.backgroundColor = "#B0B0B0";
                        }
                    })
                }

                checkSelected(selected.id, selected.nama)
                const b = document.querySelectorAll(".radio-label");
                b.forEach((elem, idx) => {
                    elem.onclick = () => {
                        const nama = elem.getAttribute("data-id-nama");
                        const id = elem.getAttribute("data-id-usulan");
                        selected.nama = nama;
                        selected.id = id;
                        checkSelected(selected.id, selected.nama);
                    }
                });
            };
        }
    }
    btnModalEdit.forEach((elem, idx) => {
        const nik = elem.getAttribute("data-id-nik");
        elem.onclick = () => {
            if (modalWrap !== null) {
                modalWrap.remove();
            };
            modalWrap = document.createElement("div");
            modalWrap.innerHTML = `
                <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                    <div class="modal-dialog modal-xl">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h1 class="modal-title fs-5" id="staticBackdropLabel">Edit data peternak</h1>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div id="data">
                                <div class="p-3">
                                    <span>Loading...</span>
                                
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                `;
            document.body.append(modalWrap);
            let modal = new bootstrap.Modal(modalWrap.querySelector(".modal"));
            modal.show();
            var xmlhttp = new XMLHttpRequest();
            xmlhttp.onreadystatechange = function() {
                if (this.readyState === 4 && this.status === 200) {
                    const a = JSON.parse(this.responseText);
                    const {
                        select_usulan
                    } = a;
                    const createColumn = (id, label) => {
                        return {
                            id: id,
                            label: label
                        }
                    }
                    const {
                        nik,
                        id_usulan,
                        id_kab,
                        alamat,
                        jumlah_ternak,
                        nama_pemilik,
                        no_hp,
                        nama
                    } = a.detail_peternak;
                    console.log(a)
                    document.getElementById("data").innerHTML = `
                        <form method="post" action="<?php echo base_url("admin_kab/edit_data_peternak/") ?>${nik}">
                            <input type="hidden" name="_method" value="PUT">
                            <div class="modal-body">
                                <div class="mb-4">
                                    <div class="mb-4">
                                        <div class="col-12">
                                            <div class="search mt-1 mb-1">
                                                <i class="fa fa-search"></i>
                                                <input type="text" class="form-control" id="search2" placeholder="Masukkan nama">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="mt-2 mb-4" id="result2"></div>
                                    <div class="mt-2 mb-4">
                                        <input type="hidden" name="usulan" id="usulan2" value="${id_usulan}">
                                        <span id="selected2">Selected: ${nama}</span>
                                    </div>
                                </div>
                                <div class="mb-2">
                                    <label for="nik" class="form-label fw-bold" style="line-height: 0.75;color:#636363">NIK *</label>
                                    <input class="form-control" type="number" name="nik" id="nik" value="${nik}">
                                </div>
                                <div class="mb-2">
                                    <label for="nama_pemilik" class="form-label fw-bold" style="line-height: 0.75;color:#636363">Nama pemilik *</label>
                                    <input class="form-control" type="text" name="nama_pemilik" id="nama_pemilik" value="${nama_pemilik}">
                                </div>
                                <div class="mb-2">
                                    <label for="no_hp" class="form-label fw-bold" style="line-height: 0.75;color:#636363">No. HP *</label>
                                    <input type="number" class="form-control" name="no_hp" id="no_hp" value="${no_hp}">
                                </div>
                                <div>
                                    <label for="alamat" class="form-label fw-bold" style="line-height: 0.75;color:#636363">Alamat *</label>
                                    <textarea class="form-control" name="alamat" id="alamat" rows="4">${alamat}</textarea>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button class="btn btn-primary" id="btn-add" style="width: 170px;" type="submit">
                                    Submit
                                </button>
                            </div>
                        </form>
                    `
                    const columns = [
                        // createColumn("nama", "Nama"),
                        createColumn("alamat", "Alamat"),
                        createColumn("jumlah_ternak", "Jumlah ternak"),
                        createColumn("no_hp", "Nomor HP")
                    ];
                    let selected = {
                        "nama": nama,
                        "id": id_usulan
                    }
                    const searchElem = document.getElementById("search2");
                    const resultElem = document.getElementById("result2");
                    const usulanElem = document.getElementById("usulan2");
                    const selectedElem = document.getElementById("selected2");
                    searchUsulan(searchElem, resultElem, usulanElem, selectedElem, select_usulan, selected, columns, "edit");
                }
            }
            xmlhttp.open("get", "<?php echo base_url("admin_kab/detail_peternak/") ?>" + nik);
            xmlhttp.send();
        }
    })
    btmModalDelete.forEach((elem, idx) => {
        const nik = elem.getAttribute("data-id-nik");
        const nama = elem.getAttribute("data-id-nama");
        elem.onclick = () => {
            if (modalWrap !== null) {
                modalWrap.remove();
            };
            modalWrap = document.createElement("div");
            modalWrap.innerHTML = `
            <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h1 class="modal-title fs-5" id="staticBackdropLabel">Hapus peternak</h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <form method="post" action="<?php echo base_url("admin_kab/delete_peternak/") ?>${nik}">
                            <input type="hidden" name="_method" value="delete">
                            <div class="modal-body">
                                <span>Peternak: ${nama}</span>
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
            `;
            document.body.append(modalWrap);
            let modal = new bootstrap.Modal(modalWrap.querySelector(".modal"));
            modal.show();
        }
    })
    var xmlhttp = new XMLHttpRequest;
    xmlhttp.onreadystatechange = function() {
        if (this.readyState === 4 && this.status === 200) {
            const a = JSON.parse(this.responseText);

            const {
                usulan
            } = a;
            const createColumn = (id, label) => {
                return {
                    id: id,
                    label: label
                }
            }
            const columns = [
                // createColumn("nama", "Nama"),
                createColumn("alamat", "Alamat"),
                createColumn("jumlah_ternak", "Jumlah ternak"),
                createColumn("no_hp", "Nomor HP")
            ];
            const search = document.getElementById("search");
            const resultElem = document.getElementById("result");
            const usulanElem = document.getElementById("usulan");
            const selectedElem = document.getElementById("selected");
            let selected = {
                "nama": "",
                "id": ""
            }
            searchUsulan(search, resultElem, usulanElem, selectedElem, usulan, selected, columns, "")
        };
    };
    xmlhttp.open("get", "<?php echo base_url("admin_kab/select_usulan") ?>")
    xmlhttp.send();
</script>
<script>
    new DataTable("#example");
</script>