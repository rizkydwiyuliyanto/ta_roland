<div class="content-parent">
    <?php include("sidebar.php") ?>
    <div class="content">
        <?php include("header.php") ?>
        <div class="mt-4">
            <!-- Jadwal -->


            <div class="my-container">
                <div class="d-flex mb-4 justify-content-between align-items-center">
                    <h2>
                        Data vaksin
                    </h2>
                </div>
                <div class="data">
                    <?php echo session()->getFlashdata("message") ?>
                    <div class="container py-2 p-0">
                        <?php print_r($data_jadwal_vaksin_detail); ?>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>