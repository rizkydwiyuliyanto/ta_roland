<header>
    <div class="my-container h-100 position-relative">
        <div class="d-flex justify-content-between h-100">
            <h5>
                Sistem informasi <br> Monitoring penjadwalan vaksinasi hewan
            </h5>
            <div class="account d-flex flex-column">
                <div>
                    <img src="<?php echo base_url("assets/image/location-pin.svg") ?>" width="19.5px">
                    <span><?php echo session()->get("user")["nama_kabupaten"] ?></span>
                </div>
                <div class="mt-2 ms-auto">
                    <a style="text-decoration: none;color:#FFFFFF;" href="<?php echo base_url("logout")?>">
                        Log out
                    </a>
                </div>
            </div>
        </div>
        <?php include("sidebar.php") ?>
    </div>
</header>