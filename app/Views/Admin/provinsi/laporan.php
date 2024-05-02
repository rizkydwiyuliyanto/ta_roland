<div class="content-parent">
    <?php include("sidebar.php") ?>
    <div class="content">
        <?php include("header.php") ?>
        <div class="mt-4">
            <div class="my-container">
                <div class="d-flex mb-4 justify-content-between align-items-center">
                    <h2>
                        Laporan
                    </h2>
                </div>
                <div class="data mb-4">
                    <form id="form-laporan" class="d-flex flex-column">
                        <div class="mb-4">
                            <label for="kabupaten" class="form-label fw-bold" style="line-height: 0.75;color:#636363">Kabupaten</label>
                            <select class="form-select" name="kabupaten" id="kabupaten">
                                <option value="" selected>
                                    Open select menu
                                </option>
                                <?php foreach ($kabupaten as $x) : ?>
                                    <option value="<?php echo $x["id_kab"] ?>">
                                        <?php echo $x["nama_kabupaten"] ?>
                                    </option>
                                <?php endforeach ?>
                            </select>
                        </div>
                        <div class="mb-1">
                            <label for="tanggal-from" class="form-label fw-bold" style="line-height: 0.75;color:#636363">Dari:</label>
                            <input class="form-control" type="date" name="tanggal-from" id="tanggal-from">
                        </div>
                        <div class="mb-1">
                            <label for="tanggal-to" class="form-label fw-bold" style="line-height: 0.75;color:#636363">Sampai:</label>
                            <input class="form-control" type="date" name="tanggal-to" id="tanggal-to">
                        </div>
                        <button class="mt-2 btn btn-primary ms-auto" type="submit">
                            Submit
                        </button>
                    </form>
                </div>
                <div id="table-laporan">
                    
                </div>
            </div>

        </div>
    </div>
</div>