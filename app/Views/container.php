<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Welcome to CodeIgniter 4!</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" type="image/png" href="/favicon.ico">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link href=" https://cdn.jsdelivr.net/npm/@splidejs/splide@3.6.12/dist/css/splide.min.css " rel="stylesheet">
    <link href="https://cdn.datatables.net/1.13.7/css/dataTables.bootstrap5.min.css" rel="stylesheet">

    <link href="https://cdn.datatables.net/2.0.2/css/dataTables.bootstrap5.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url("assets/style/style.css") ?>">
</head>

<body style="background-color: #EAEFF2;">
    <?php if ($page) {
        echo view($page);
    } ?>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js" integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.7.1.js"></script>
    <script src="https://cdn.datatables.net/2.0.2/js/dataTables.js"></script>
    <script src="https://cdn.datatables.net/2.0.2/js/dataTables.bootstrap5.js"></script>
    <?php if ($page == "Admin/kabupaten/data_jadwal_vaksin.php") { ?>
        <script>
            const btnJadwalModal = document.querySelectorAll(".btn-modal-jadwal");
            let idJadwalVaksin = "";
            let myModal, myModalEl;
            let modalWrap = null;
            let body = [{

                    "content": ""
                },
                {

                    "content": ""
                },
                {
                    "content": ""
                }
            ]
            let idx = 0;
            let data = 0;
            const editElem = (x) => {
                x.forEach((elem, idx) => {
                    elem.onclick = () => {
                        const tgl = elem.getAttribute("data-id-tgl");
                        const idJadwal = elem.getAttribute("data-id-jadwal");
                        idx = 2;
                        body[idx].content = `
                                <form id="form-edit">
                                    <div class="modal-body">
                                        <div class="input-group d-flex align-items-end col-12">
                                            <div class="col">
                                                <label for="tgl_pemberian" class="form-label fw-bold" style="line-height: 0.75;color:#636363">Tanggal pemberian *</label>
                                                <input value="${tgl}" class="form-control" type="date" name="tgl_pemberian" id="tgl_pemberian">
                                            </div>
                                            <button class="btn btn-primary" id="btn-submit" style="width: 170px;">
                                                Submit
                                            </button>
                                        </div>
                                    </div>
                                </form>

                                `;
                        document.getElementById("data").innerHTML = body[idx].content;
                        const editForm = document.getElementById("form-edit");
                        const btnSubmit = document.getElementById("btn-submit");
                        btnSubmit.onclick = () => {
                            var http = new XMLHttpRequest();
                            var url = `<?php echo base_url("admin_kab/edit_jadwal/") ?>${idJadwal}`;
                            const formData = new FormData(editForm);
                            var object = {};
                            formData.forEach((value, key) => object[key] = value);
                            var json = JSON.stringify(object);
                            http.onreadystatechange = function() { //Call a function when the state changes.
                                if (http.readyState == 4 && http.status == 200) {
                                    alert("EDIT BERHASIL");
                                }
                            }
                            http.open('PUT', url, true);
                            //Send the proper header information along with the request
                            http.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
                            http.send(json);
                        }
                    }
                })
            }
            const showModal = (x) => {
                body[idx].content = ""
                body[idx].id = ""
                var xmlhttp = new XMLHttpRequest();
                xmlhttp.onreadystatechange = function() {
                    if (this.readyState == 4 && this.status == 200) {
                        let a = JSON.parse(this.responseText);
                        body[idx].content = `
                                <table class="table">
                                <thead>
                                    <tr>
                                        <th scope="col">Jenis</th>
                                        <th scope="col">Dosis</th>
                                        <th scope="col">Tanggal</th>
                                        <th scope="col"></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    ${a["data"].map((x, idx) => {
                                        return (
                                            `
                                                <tr class="position-relative w-100 h-100 data-jadwal">
                                                    <td>${x.jenis}</td>
                                                    <td>${x.jumlah_dosis}</td>
                                                    <td>${x.tgl_pemberian}</td>
                                                    <td style="text-align: end;width:140px;">
                                                        <div class="overflow-hidden h-100 w-100 d-flex justify-content-between ms-auto position-relative">
                                                            <button data-id-tgl="${x.tgl_pemberian}" class="btn show-form-delete delete-jadwal btn-danger btn-sm">
                                                                Delete
                                                            </button>
                                                            <button data-id-jadwal="${x.id_jadwal}" data-id-tgl="${x.tgl_pemberian}"  class="btn edit-jadwal btn-primary btn-sm">
                                                                Edit
                                                            </button>
                                                        </div>
                                                    </td>
                                                    <td
                                                        style="width: 100%;height:100%;"
                                                        class="form-delete-jadwal2 bg-dark justify-content-between"
                                                    >
                                                        <span class="text-light">Hapus data?</span>
                                                        <div clas="d-flex justify-content-between border border-danger" style="width: 200px;">
                                                            <Button data-id-jadwal="${x.id_jadwal}" class="btn col-5 btn-danger delete-jadwal-btn btn-sm">Yes</Button>
                                                            <Button class="btn col-5 btn-primary btn-sm">No</Button>
                                                        </div>
                                                    </td>
                                                </tr>
                                            `
                                        )
                                    }).join("")}
                                </tbody>
                                </table>
                        `
                        document.getElementById("data").innerHTML = body[idx].content;
                        const editJadwal = document.querySelectorAll(".edit-jadwal");
                        const back = document.querySelectorAll(".back");
                        const deleteJadwal = document.querySelectorAll(".delete-jadwal");
                        const deleteJadwalBtn = document.querySelectorAll(".delete-jadwal-btn");
                        const formDeleteParent = document.querySelectorAll(".show-form-delete");
                        formDeleteParent.forEach((elem, idx) => {
                            elem.onclick = () => {
                                for (let i = 0; i < formDeleteParent.length; i++) {
                                    let a = document.querySelectorAll(".form-delete-jadwal2")[i];
                                    if (idx === i) {
                                        a.classList.add("show");
                                        a.lastElementChild.onclick = () => {
                                            a.classList.remove("show");
                                        }
                                    } else {
                                        a.classList.remove("show");
                                    }
                                }
                            }
                        })
                        deleteJadwalBtn.forEach((elem, idx) => {
                            const idJadwal = elem.getAttribute("data-id-jadwal");
                            elem.onclick = () => {
                                var xmlhttp = new XMLHttpRequest();
                                xmlhttp.onreadystatechange = () => {
                                    if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
                                        let timeOut = setTimeout(() => {
                                            showModal(data);
                                        }, 570)
                                        document.querySelectorAll(".data-jadwal")[idx].style.opacity = 0;
                                    }

                                }
                                xmlhttp.open("DELETE", "<?php echo base_url("admin_kab/delete_jadwal/") ?>" + idJadwal, true);
                                xmlhttp.send()
                            }
                        })
                        editElem(editJadwal)
                        back.forEach((elem, idx) => {
                            elem.onclick = () => {
                                document.getElementById("data").innerHTML = "Loading..."
                                showModal(data);
                                // modalWrap.remove();
                            }
                        })
                    };
                };

                xmlhttp.open("GET", "<?php echo base_url("admin_kab/data_jadwal_vaksin/detail/") ?>" + x, true);
                xmlhttp.send();

            }
            btnJadwalModal.forEach((elem, idx) => {
                console.log(idx);
                elem.onclick = () => {
                    data = elem.getAttribute("data-id-vaksin");
                    console.log(data);
                    if (modalWrap !== null) {
                        modalWrap.remove();
                    };
                    modalWrap = document.createElement("div");
                    modalWrap.innerHTML = `
                        <div class="modal modal-lg fade" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h1 class="modal-title fs-5" id="staticBackdropLabel">Detail jadwal</h1>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <div id="data">
                                            <span>Loading..</span>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                    <button class="btn btn-info back" style="width: 90px;" type="submit">
                                            Back
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        `
                    document.body.append(modalWrap);
                    let modal = new bootstrap.Modal(modalWrap.querySelector(".modal"));
                    modal.show()
                    showModal(data);
                }
            })
        </script>
    <?php } ?>
    <script>
        new DataTable("#example");
    </script>
    <script src="<?php echo base_url("assets/js/kabupaten.js") ?>"></script>

    <?php if ($page && $page == "Admin/provinsi/data_kabupaten.php") { ?>
        <script>
            const selectKabupaten = document.querySelectorAll(".select-kabupaten");
            const formAdd = document.getElementById("form-add");

            const btnAdd = document.getElementById("btn-add");
            var dt_kab = <?php echo json_encode($data_kab); ?>;
            selectKabupaten.forEach((elem, idx) => {
                // <option value="" selected>Open this select menu</option>
                let option = document.createElement("option");
                option.value = "";
                option.setAttribute("selected", "");
                option.innerText = "Open this select menu";
                elem.appendChild(option);
                kabupaten.forEach(item => {
                    let a = dt_kab.find(x => {
                        return x["nama_kabupaten"] === item.nama
                    });

                    option = document.createElement("option");
                    option.value = item.nama;
                    if (a) {
                        option.setAttribute("disabled", "")
                    }
                    option.innerText = item.nama;
                    elem.appendChild(option);
                })
            });
            // console.log(kabupaten)
        </script>
    <?php } ?>
</body>

</html>