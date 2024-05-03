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
    <!-- <script src="<?php echo base_url("assets/js/kabupaten.js") ?>"></script> -->
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