<header>
    <div class="my-container h-100 position-relative">
        <div class="d-flex justify-content-between h-100">
            <h5>
                Sistem informasi <br> Monitoring penjadwalan vaksinasi hewan
            </h5>
            <div class="account">
                <img src="<?php echo base_url("assets/image/location-pin.svg") ?>" width="19.5px">
                <span><?php echo session()->get("user")["nama_kabupaten"] ?></span>
            </div>
        </div>
        <?php include("sidebar.php") ?>
    </div>
</header>