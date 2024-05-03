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
                <li class="container <?php echo $page && $page == "Admin/provinsi/dashboard.php" ? "active" : "" ?>">
                    <a href=" <?php echo base_url("admin_prov/dashboard") ?>">
                        Dashboard
                    </a>
                </li>
                <li class="container <?php echo $page && $page == "Admin/provinsi/data_kabupaten.php" ? "active" : "" ?>">
                    <a href="<?php echo base_url("admin_prov/data_kabupaten") ?>">
                        Data Kabupaten
                    </a>
                </li>
                <li class="container <?php echo $page && $page == "Admin/provinsi/jenis_vaksin.php" ? "active" : "" ?>">
                    <a href="<?php echo base_url("admin_prov/data_jenis_vaksin") ?>">
                        Jenis vaksin
                    </a>
                </li>
                <li class="container <?php echo $page && $page == "Admin/provinsi/distribusi_vaksin.php" ? "active" : "" ?>">
                    <a href="<?php echo base_url("admin_prov/data_distribusi_vaksin") ?>">
                        Distribusi vaksin
                    </a>
                </li>
                <li class="container <?php echo $page && $page == "Admin/provinsi/laporan.php" ? "active" : "" ?>">
                    <a href="<?php echo base_url("admin_prov/laporan") ?>">
                        Laporan
                    </a>
                </li>
            </ul>
        </div>
    </div>
</div>