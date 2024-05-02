<div class="sidebar boxShadow2">
    <!-- <div class="top">
        <div class="container">
            <div class="d-flex justify-content-between align-items-center">
                <img src="<?php echo base_url("assets/image/logo.png") ?>" width="70px">
                <span class="title" style="line-height: 1.25;">DINAS PETERNAKAN DAN KESEHATAN HEWAN PROVINSI PAPUA</span>
            </div>
        </div>
    </div> -->
    <div class="content-sidebar">
        <div class="container">
            <ul>
                <li class="container">
                    <a class="<?php echo $page && $page == "Admin/kabupaten/dashboard.php" ? "active" : "" ?>" href=" <?php echo base_url("admin_kab/dashboard") ?>">
                        Dashboard
                    </a>
                </li>
                <li class="container">
                    <a class="<?php echo $page && $page == "Admin/kabupaten/data_peternak.php" ? "active" : "" ?>" href=" <?php echo base_url("admin_kab/data_peternak") ?>">
                        Peternak
                    </a>
                </li>
                <li style="width:fit-content;" class="container dropdown-nav-parent">
                    <div style="width:fit-content;" class="d-flex justify-content-start align-items-center">
                        <span class="me-4 <?php echo $page && str_contains($page, "peserta") ? "active":""?>">
                            Peserta
                        </span>
                        <img src="<?php echo base_url("assets/image/up-arrow.svg") ?>" width="19px">
                    </div>
                    <div class="d-flex flex-column dropdown-nav-items-parent boxShadow">
                        <div class="items-dropdown">
                            <span class="<?php echo $page && $page == "Admin/kabupaten/daftar_peserta.php" ? "active" : "" ?>" data-id-link="<?php echo base_url("admin_kab/daftar_peserta") ?>">
                                Daftar peserta
                            </span>
                            <span class="<?php echo $page && $page == "Admin/kabupaten/data_peserta.php" ? "active" : "" ?>" data-id-link="<?php echo base_url("admin_kab/data_peserta") ?>">
                                Data peserta
                            </span>
                        </div>
                    </div>
                </li>
                <li class="container">
                    <a class="<?php echo $page && $page == "admin/kabupaten/jadwal_vaksin.php" ? "active" : "" ?>" href=" <?php echo base_url("admin_kab/jadwal_vaksin") ?>">
                        Jadwal vaksin
                    </a>
                </li>
                <!-- <li class="container">
                    <a class="<?php echo $page && $page == "Admin/kabupaten/data_peternak.php" ? "active" : "" ?>" href=" <?php echo base_url("admin_kab/data_peternak") ?>">
                        Usulan
                    </a>
                </li> -->
                <!-- <li class="container dropdown-nav-parent">
                    <div class="d-flex justify-content-between align-items-center">
                        <span class="me-2">
                            Vaksin
                        </span>
                        <img src="<?php echo base_url("assets/image/up-arrow.svg") ?>" width="19px">
                    </div>
                    <div class="d-flex flex-column dropdown-nav-items-parent boxShadow">
                        <div class="items">
                            <a class="<?php echo $page && $page == "admin/kabupaten/jenis_vaksin.php" ? "active" : "" ?>" href=" <?php echo base_url("admin_kab/data_jenis_vaksin") ?>">
                                Jenis Vaksin
                            </a>
                            <a>
                                Jadwal Vaksin
                            </a>
                        </div>
                    </div>
                </li> -->
                <li class="container">
                    <a class="<?php echo $page && $page == "Admin/kabupaten/data_dokumentasi.php" ? "active" : "" ?>" href=" <?php echo base_url("admin_kab/data_dokumentasi") ?>">
                        Dokumentasi
                    </a>
                </li>
            </ul>
        </div>
    </div>
</div>