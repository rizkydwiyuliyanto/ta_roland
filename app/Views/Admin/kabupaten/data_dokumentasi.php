<!-- <div class="modal fade" id="addDokumentasi" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="staticBackdropLabel">Tambah data Dokumentasi</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <?= form_open_multipart("admin_kab/add_dokumentasi") ?>
            <div class="modal-body">
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
</div> -->
<div class="content-parent">
    <div class="content">
        <?php include("header.php") ?>
        <div class="mt-4">
            <div class="my-container">
                <div class="d-flex mb-4 justify-content-start align-items-center">
                    <h4>
                        Data dokumentasi
                    </h4>
                    <!-- <button type="button" class="btn btn-outline-primary ms-4" data-bs-toggle="modal" data-bs-target="#addDokumentasi">
                        Tambah
                    </button> -->
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
                                                <button data-id-peserta="<?php echo $x["id_peserta"] ?>" class="btn btn-info btn-sm btn-dokumentasi">
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
        console.log(x);
        let page = {
            "detail": "",
            "tambahDokumentasi": "",
            "editDokumentasi": "",
            "hapusDokumentasi": "",
            "previousPage": ""
        }
        xmlhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                let a = JSON.parse(this.responseText);
                console.log(a);
                const setPageDetail = (page, idPeserta) => {
                    page.detail = `
                                <div class="mb-2">
                                    <Button class="btn btn-primary btn-sm" id="tambah-dokumentasi">
                                        Tambah dokumentasi
                                    </Button>
                                </div>
                                <div class="d-flex flex-column">
                                    <div id="data-items">

                                    </div>

                                </div>
                            `
                    document.getElementById("data").innerHTML = page.detail;
                    page.previousPage = page.detail;
                    var xmlhttp = new XMLHttpRequest;
                    xmlhttp.onreadystatechange = function() {
                        if (this.readyState === 4 && this.status === 200) {
                            const a = JSON.parse(this.responseText);
                            console.log(a);

                            document.getElementById("data-items").innerHTML = `
                                <div class="grid-parent mt-4">
                                    ${a.data.map((x, idx) => {
                                        return (
                                            `
                                                <div class="boxShadow rounded overflow-hidden" style="height:200px;">
                                                    <img src="${x.foto}" style="width: 100%;height:100%;object-fit:cover;">
                                                </div>
                                            `
                                        )
                                    }).join("")}
                                </div>
                            `;
                        }
                    }
                    xmlhttp.open("get", "<?php echo base_url("admin_kab/dokumentasi_items/") ?>" + idPeserta)
                    xmlhttp.send()
                }
                setPageDetail(page, x);
                const tambahDokumentasi = document.getElementById("tambah-dokumentasi");
                const btnEditDokumentasi = document.querySelectorAll(".btn-edit-dokumentasi");
                const btnDeleteDokumentasi = document.querySelectorAll(".btn-delete-dokumentasi");
                const backBtnDokumentasi = document.querySelectorAll(".btn-back-dokumentasi")
                // console.log(backBtnDokumentasi)
                const setPageTambah = (page, idPeserta) => {
                    console.log(idPeserta)
                    const hari = ["Minggu", "Senin", "Selasa", "Rabu", "Kamis", "Jum'at", "Sabtu"];
                    page.tambahDokumentasi =
                        `
                        <form class="d-flex flex-column" id="form-submit">
                            <div style="background-color: #a5a5a5;width:100%;height:200px;" class="rounded position-relative d-flex align-items-center justify-content-center overflow-hidden mb-2">
                                <span style="color:white;font-size:40px">+</span>
                                <img class="preview-image" id="preview-image" alt="previewImage" style="display:none;position: absolute;width:100%;height:100%;object-fit:cover;">
                                <input name="foto" style="position: absolute;height:100%;width:100%;opacity:0;" class="form-control" id="input-image" type="file" accept="image/*">
                            </div>
                            <div class="mb-2">
                                <label for="tanggal" class="form-label">Tanggal</label>
                                <input type="date" class="form-control" name="tanggal" id="tanggal">
                            </div>
                            <div class="mb-2">
                                <label for="hari" class="form-label">Hari</label>
                                <select class="form-select" name="hari" id="hari">
                                    <option>Pilih hari</option>
                                    ${hari.map(x => {
                                        return (
                                            `
                                                <option value="${x}">${x}</option>
                                            `
                                        )
                                    }).join("")}
                                </select>
                            </div>
                            <div class="mb-2">
                                <label for="alamat" class="form-label">Alamat</label>
                                <textarea class="form-control" name="alamat" id="alamat" rows="2"></textarea>
                            </div>
                            <div class="mb-4">
                                <label for="keterangan" class="form-label">Keterangan</label>
                                <textarea class="form-control" name="keterangan" id="keterangan" rows="2"></textarea>
                            </div>
                            <div class="ms-auto">
                                <button type="button" class="btn btn-primary btn-sm" id="btn-submit">
                                    Submit
                                </button>
                            </div>
                        </form>
                    `
                    document.getElementById("data").innerHTML = page.tambahDokumentasi;
                    fn_inputImage(
                        document.getElementById("input-image"),
                        document.getElementById("preview-image")
                    );
                    const formSubmit = document.getElementById("form-submit");
                    document.getElementById("btn-submit").onclick = () => {
                        const formData = new FormData(formSubmit);
                        const inputImage = document.getElementById("input-image");
                        fetch("<?php echo base_url("admin_kab/add_dokumentasi2/") ?>" + idPeserta, {
                            method: "post",
                            body: formData
                        }).then(response => {
                            response.json().then(e => {
                                if (e.success) {
                                    setPageDetail(page, x);
                                    const tambahDokumentasi = document.getElementById("tambah-dokumentasi");
                                    tambahDokumentasi.onclick = () => {
                                        setPageTambah(page, x);
                                    };
                                    // window.location.href = "<?php echo base_url("admin_kab/data_kabupaten") ?>"
                                };
                                console.log(e);
                            })
                        }).catch(err => {
                            console.log(err);
                        });
                    }
                }
                tambahDokumentasi.onclick = () => {
                    setPageTambah(page, x);
                };
                backBtnDokumentasi.forEach((elem, idx) => {
                    elem.onclick = () => {
                        setPageDetail(page, x);
                        const tambahDokumentasi = document.getElementById("tambah-dokumentasi");
                        tambahDokumentasi.onclick = () => {
                            setPageTambah(page, x);
                        };
                        // showModalDokumentasi(data2);
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
            const idPeserta = elem.getAttribute("data-id-peserta");
            data2 = idPeserta;
            if (modalWrapDokumentasi !== null) {
                modalWrapDokumentasi.remove();
            };
            modalWrapDokumentasi = document.createElement("div");
            modalWrapDokumentasi.innerHTML = `
                        <div class="modal modal-lg fade" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                            <div class="modal-dialog modal-lg">
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
                                        <button class="btn btn-info btn-back-dokumentasi btn-sm" style="width: 90px;" type="submit">
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
    // fn_inputImage(
    //     document.getElementById("input-image"),
    //     document.getElementById("preview-image")
    // );
</script>
<script>
    new DataTable("#example");
</script>