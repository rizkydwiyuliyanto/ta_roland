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
            let body1 = "";
            let body2 = "";
            const showModal = (x) => {
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
                            <div class="modal-body" id="data">
                                <span>Loading..</span>
                            </div>
                            <div class="modal-footer">
                                <button class="btn btn-danger back" id="btn-add" style="width: 170px;" type="submit">
                                    Close
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
                `
                body1 = "";
                var xmlhttp = new XMLHttpRequest();
                xmlhttp.onreadystatechange = function() {
                    if (this.readyState == 4 && this.status == 200) {
                        let a = JSON.parse(this.responseText);
                        body1 = `
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
                                                <tr>
                                                    <td>${x.jenis}</td>
                                                    <td>${x.jumlah_dosis}</td>
                                                    <td>${x.tgl_pemberian}</td>
                                                    <td style="text-align: end;">
                                                        <button class="btn delete-jadwal btn-danger me-2 btn-sm">
                                                            Delete
                                                        </button>
                                                        <button class="btn edit-jadwal btn-primary btn-sm">
                                                            DeleteEditutton>
                                                    </td>
                                                </tr>
                                            `
                                        )
                                    }).join("")}
                                </tbody>
                                </table>
                        `
                        document.getElementById("data").innerHTML = body1;
                        console.log(a);
                        const editJadwal = document.querySelectorAll(".edit-jadwal");
                        const back = document.querySelectorAll(".back");
                        const deleteJadwal = document.querySelectorAll(".delete-jadwal");
                        deleteJadwal.forEach((elem, idx) => {
                            elem.onclick = () => {
                                body2 = idx;
                                document.getElementById("data").innerHTML = `
                                    <span>${body2}</span>
                            `
                            }
                        })
                        back.forEach((elem, idx) => {
                            elem.onclick = () => {
                                console.log("asdsd")
                                document.getElementById("data").innerHTML = body1;
                                const deleteJadwal = document.querySelectorAll(".delete-jadwal");
                                deleteJadwal.forEach((elem, idx) => {
                                    elem.onclick = () => {
                                        body2 = idx;
                                        document.getElementById("data").innerHTML = `
                                    <span>${body2}</span>
                            `
                                    }
                                })
                            }
                        })
                        console.log(deleteJadwal);
                    };
                };

                xmlhttp.open("GET", "<?php echo base_url("admin_kab/data_jadwal_vaksin/detail/") ?>" + x, true);
                xmlhttp.send();

                document.body.append(modalWrap);
                let modal = new bootstrap.Modal(modalWrap.querySelector(".modal"));
                modal.show()
            }
            btnJadwalModal.forEach((elem, idx) => {
                console.log(idx);
                const data = elem.getAttribute("data-id-vaksin");
                elem.onclick = () => {
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