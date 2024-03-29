<div class="sidebar d-flex flex-column">
    <div class="top">
        <div class="container">
            <div class="d-flex justify-content-between align-items-center">
                <img src="<?php echo base_url("assets/image/logo.png") ?>" width="70px">
                <span class="title" style="line-height: 1.25;">DINAS PETERNAKAN DAN KESEHATAN HEWAN PROVINSI PAPUA</span>
            </div>
        </div>
    </div>
    <div class="content">
        <ul class="py-4">
            <li class="container <?php echo $page && $page == "Admin/kabupaten/dashboard.php" ? "active" : "" ?>">
                <a href=" <?php echo base_url("admin_kab/dashboard") ?>">
                    Dashboard
                </a>
            </li>
            <li class="container <?php echo $page && $page == "Admin/kabupaten/data_peternak.php" ? "active" : "" ?>">
                <a href=" <?php echo base_url("admin_kab/data_peternak") ?>">
                    Data peternak
                </a>
            </li>
            <li class="container <?php echo $page && $page == "Admin/kabupaten/data_vaksin.php" ? "active" : "" ?>">
                <a href=" <?php echo base_url("admin_kab/data_vaksin") ?>">
                    Data vaksin
                </a>
            </li>
            <li class="container <?php echo $page && $page == "Admin/kabupaten/data_jadwal_vaksin.php" ? "active" : "" ?>">
                <a href=" <?php echo base_url("admin_kab/data_jadwal_vaksin") ?>">
                    Data jadwal vaksin
                </a>
            </li>
            <li class="container <?php echo $page && $page == "Admin/kabupaten/data_dokumentasi.php" ? "active" : "" ?>">
                <a href=" <?php echo base_url("admin_kab/data_dokumentasi") ?>">
                    Data dokumentasi
                </a>
            </li>
        </ul>
    </div>
    <div class="bottom mt-auto py-2">
        <div class="container">
            <span>2024</span>
        </div>
    </div>
</div>