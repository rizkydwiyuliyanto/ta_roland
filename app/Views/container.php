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

<body>
    <?php if ($page) {
        echo view($page);
    } ?>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js" integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous"></script>
    <script src="<?php echo base_url("assets/js/kabupaten.js") ?>"></script>

    <?php if ($page && $page == "Admin/kabupaten/data_dokumentasi.php") { ?>
        <script>
            const btnDokumentasi = document.querySelectorAll(".btn-dokumentasi");
            const fn_inputImage = (input, preview) => {
                const inputImage = input;
                const previewImageElem = preview;
                const compressImage = async (file, {
                    quality = 1,
                    type = file.type
                }) => {
                    // Get as image data
                    const imageBitmap = await createImageBitmap(file);

                    // Draw to canvas
                    const canvas = document.createElement('canvas');
                    canvas.width = imageBitmap.width;
                    canvas.height = imageBitmap.height;
                    const ctx = canvas.getContext('2d');
                    ctx.drawImage(imageBitmap, 0, 0);

                    // Turn into Blob
                    const blob = await new Promise((resolve) =>
                        canvas.toBlob(resolve, type, quality)
                    );

                    // Turn Blob into File
                    return new File([blob], file.name, {
                        type: blob.type,
                    });
                };
                const dataTransfer = new DataTransfer();
                inputImage.onchange = async (e) => {
                    const [file] = inputImage.files;
                    if (file) {
                        // We don't have to compress files that aren't images
                        if (!file.type.startsWith('image')) {
                            // Ignore this file, but do add it to our result
                            dataTransfer.items.add(file);
                        }

                        // We compress the file by 50%
                        const compressedFile = await compressImage(file, {
                            quality: 0.25,
                            type: 'image/jpeg',
                        });
                        previewImageElem.previousElementSibling.style.display = "none";
                        previewImageElem.style.display = "block";
                        previewImageElem.src = URL.createObjectURL(compressedFile);
                    }
                }
            }
            let modalWrapDokumentasi = null;
            let data2;
            let body2 = [{
                    "content": ""
                },
                {
                    "content": ""
                },
                {
                    "content": ""
                }
            ]
            let idx2 = 0;
            let showModalDokumentasi = (x) => {
                body2[idx2].content = ""
                body2[idx2].id = ""
                var xmlhttp = new XMLHttpRequest();

                xmlhttp.onreadystatechange = function() {
                    if (this.readyState == 4 && this.status == 200) {
                        let a = JSON.parse(this.responseText);
                        console.log(a);
                        body2[idx2].content = `
                            <div class="d-flex flex-column">
                                <div class="grid-parent">
                                    ${a["data"].map((x, idx) => {
                                        return (
                                            `
                                                <div>
                                                    <button data-id-dokumentasi="${x.id_dokumentasi}" data-text="${x.text}" data-foto="${x["foto"]}" class="btn btn-primary btn-edit-dokumentasi btn-sm">EDIT</button>
                                                    <button data-id-dokumentasi="${x.id_dokumentasi}" data-foto="${x["foto"]}" class="btn btn-danger ms-2 btn-delete-dokumentasi btn-sm">DELETE</button>
                                                    <div style="background-color: #a5a5a5;width:100%;height:200px;cursor:pointer;" data-id-src="${x["foto"]}" data-id-image="${x["id_dokumentasi"]}" class="rounded mt-2 image-parent boxShadow d-flex align-items-center justify-content-center overflow-hidden mb-2">
                                                        <img src="${x["foto"]}" alt="${idx}" style="width:100%;height:100%;object-fit:cover;">
                                                    </div>
                                                </div>
                                            `
                                        )
                                    }).join("")}
                                </div>
                            </div>
                        `
                        document.getElementById("data").innerHTML = body2[idx2].content;
                        const btnEditDokumentasi = document.querySelectorAll(".btn-edit-dokumentasi");
                        const btnDeleteDokumentasi = document.querySelectorAll(".btn-delete-dokumentasi");
                        const backBtnDokumentasi = document.querySelectorAll(".btn-back-dokumentasi")
                        // console.log(backBtnDokumentasi)
                        backBtnDokumentasi.forEach((elem, idx) => {
                            elem.onclick = () => {
                                document.getElementById("data").innerHTML = "Loading..."
                                showModalDokumentasi(data2);
                                // modalWrap.remove();
                            }
                        })
                        btnDeleteDokumentasi.forEach((elem, idx) => {
                            const idDokumentasi = elem.getAttribute("data-id-dokumentasi");
                            const foto = elem.getAttribute("data-foto");
                            elem.onclick = () => {
                                // window.location.href = "<?php echo base_url("admin_kab/delete_dokumentasi/") ?>" + idDokumentasi;
                                idx2 = 2;
                                body2[idx2].content = `
                                <div style="background-color: #a5a5a5;width:100%;height:200px;" class="rounded position-relative d-flex align-items-center justify-content-center overflow-hidden mb-2">
                                                <span style="color:white;font-size:40px">+</span>
                                                <img src="${foto}" class="preview-image" id="preview-image2" alt="previewImage" style="display:block;position: absolute;width:100%;height:100%;object-fit:cover;">
                                                <input name="foto" style="position: absolute;height:100%;width:100%;opacity:0;" class="form-control" id="input-image2" type="file" accept="image/*">
                                </div>
                                `
                                document.getElementById("data").innerHTML = body2[idx2].content;
                            }
                        })
                        btnEditDokumentasi.forEach((elem, idx) => {
                            const idDokumentasi = elem.getAttribute("data-id-dokumentasi");
                            const text = elem.getAttribute("data-text");
                            const foto = elem.getAttribute("data-foto");
                            elem.onclick = () => {
                                idx2 = 1;
                                body2[idx2].content = `
                                <form method="post" id="form-dokumentasi" action="<?php echo base_url("admin_kab/edit_dokumentasi/") ?>${idDokumentasi}" enctype="multipart/form-data">
                                        <input type="hidden" name="_method" value="PUT">
                                        <div class="modal-body">
                                            <div class="mb-4">
                                                <span></span>
                                            </div>
                                            <div style="background-color: #a5a5a5;width:100%;height:200px;" class="rounded position-relative d-flex align-items-center justify-content-center overflow-hidden mb-2">
                                                <span style="color:white;font-size:40px">+</span>
                                                <img src="${foto}" class="preview-image" id="preview-image2" alt="previewImage" style="display:block;position: absolute;width:100%;height:100%;object-fit:cover;">
                                                <input name="foto" style="position: absolute;height:100%;width:100%;opacity:0;" class="form-control" id="input-image2" type="file" accept="image/*">
                                            </div>
                                            <div>
                                                <label for="keterangan" class="form-label">Keterangan</label>
                                                <textarea class="form-control" name="keterangan" id="keterangan" rows="2">${text}</textarea>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button class="btn btn-primary" id="btn-edit-dokumentasi" style="width: 170px;" type="submit">
                                                Submit
                                            </button>
                                        </div>
                                    </form>
                                `
                                document.getElementById("data").innerHTML = body2[idx2].content;
                                // document.getElementById("form-dokumentasi").onsubmit = (e) => {
                                //     e.preventDefault();
                                // }
                                document.getElementById("btn-edit-dokumentasi").onclick = () => {
                                    const formData = new FormData(document.getElementById("form-dokumentasi"));
                                    // let formData2 = new FormData();
                                    // formData2.append("keterangan", "FFIIKSKS");
                                    // // console.log(formData);
                                    // fetch(`<?php echo base_url("admin_kab/edit_dokumentasi/") ?>${idDokumentasi}`, {
                                    //     body: formData2,
                                    //     method: "put"
                                    // }).then(response => {
                                    //     console.log(formData2);
                                    //     response.json().then(e => {
                                    //         console.log(e);
                                    //     })
                                    // }).catch(err => {
                                    //     console.log(err);
                                    // });
                                }
                                fn_inputImage(
                                    document.getElementById("input-image2"),
                                    document.getElementById("preview-image2")
                                );
                            }
                        })
                    };
                };

                xmlhttp.open("GET", "<?php echo base_url("admin_kab/data_dokumentasi/detail/") ?>" + x, true);
                xmlhttp.send();

            }
            btnDokumentasi.forEach((elem, idx) => {
                elem.onclick = () => {
                    const idJadwal = elem.getAttribute("data-id-jadwal");
                    data2 = idJadwal;
                    if (modalWrapDokumentasi !== null) {
                        modalWrapDokumentasi.remove();
                    };
                    modalWrapDokumentasi = document.createElement("div");
                    modalWrapDokumentasi.innerHTML = `
                        <div class="modal modal-lg fade" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h1 class="modal-title fs-5" id="staticBackdropLabel">Dokumentasi</h1>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <div id="data">
                                            <span>Loading...</span>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                    <button class="btn btn-info btn-back-dokumentasi" style="width: 90px;" type="submit">
                                            Back
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        `
                    document.body.append(modalWrapDokumentasi);
                    let modal = new bootstrap.Modal(modalWrapDokumentasi.querySelector(".modal"));
                    modal.show();
                    showModalDokumentasi(data2);
                }
            });
            fn_inputImage(
                document.getElementById("input-image"),
                document.getElementById("preview-image")
            );
        </script>
    <?php } ?>

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
    <?php if ($page && $page == "Admin/provinsi/laporan.php") { ?>
        <script>
            const selectKabupaten2 = document.getElementById("kabupaten");
            const tanggal = document.getElementById("tanggal");
            const formLaporan = document.getElementById("form-laporan");
            formLaporan.onsubmit = (e) => {
                e.preventDefault();
                let http = new XMLHttpRequest();
                let myObj = {};
                const formData = new FormData(formLaporan);
                formData.forEach((value, key) => myObj[key] = value);
                console.log(myObj);
                let url = `<?php echo base_url("admin_prov/laporan_detail") ?>?kabupaten=${myObj.kabupaten}&from=${myObj["tanggal-from"]}&to=${myObj["tanggal-to"]}`;
                http.onreadystatechange = function() { //Call a function when the state changes.
                    if (http.readyState == 4 && http.status == 200) {
                        let a = JSON.parse(this.responseText);
                        console.log(a);
                        const parent = document.getElementById("table-laporan");
                        parent.innerHTML =
                            `
                            <h4 class="mb-2">Hasil</h4>
                            <div class="table-parent data mt-1">
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
                                        ${a.data.map((x, idx) => {
                                            return (
                                                `
                                                    <tr>
                                                        <td>${x.nama_pemilik}</td>
                                                        <td style="text-align:start">${x.no_hp}</td>
                                                        <td>${x.jenis}</td>
                                                        <td>${x.alamat}</td>
                                                        <td>${x.tgl_pemberian}</td>
                                                        <td>${x.jumlah_dosis}</td>
                                                        <td style="text-align: end;">
                                                            <button data-id-jadwal="${x.id_jadwal}" class="btn btn-download btn-primary btn-sm me-4">Download</button>
                                                        </td>
                                                    </tr>
                                                `
                                            )
                                        }).join("")}
                                    </tbody>
                                </table>
                            </div>
                        `
                        new DataTable("#example");

                        // alert("EDIT BERHASIL");
                        document.querySelectorAll(".btn-download").forEach((elem, idx) => {
                            const id_jadwal = elem.getAttribute("data-id-jadwal");
                            elem.onclick = () => {
                                console.log(id_jadwal)
                            }
                        })
                    }
                }
                http.open('GET', url, true);
                //Send the proper header information along with the request
                http.send();
            }
            // console.log(kabupaten)
        </script>
    <?php } ?>
</body>

</html>