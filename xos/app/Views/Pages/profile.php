<?php $this->extend('template'); ?>

<?php $this->section('konten'); ?>
<div class="row justify-content-center">
    <div class="col-xl-10 col-lg-10 col-md-10">
        <?php if (session('error')): ?>
            <div class="alert alert-danger">
                <b>Gagal</b> <?= session('error'); ?>
            </div>
        <?php endif ?>
        <?php if (session('success')): ?>
            <div class="alert alert-success">
                <b>Berhasil</b> <?= session('success'); ?>
            </div>
        <?php endif ?>
        <div class="card bg-coklat">
            <div class="card-body">
                <h3 class="card-title text-white">Profile</h3>
                <form action="" method="POST">
                    <div class="mb-3 row">
                        <label class="col-form-label col-md-4">Username</label>
                        <div class="col-md-8">
                            <input type="text" class="form-control" autocomplete="off" value="<?= $users['username']; ?>" readonly>
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label class="col-form-label col-md-4">WhatsApp</label>
                        <div class="col-md-8">
                            <input type="number" class="form-control" autocomplete="off" value="<?= $users['whatsapp']; ?>" readonly>
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label class="col-form-label col-md-4">Terdaftar</label>
                        <div class="col-md-8">
                            <input type="text" class="form-control" autocomplete="off" value="<?= $users['date_create']; ?>" readonly>
                        </div>
                    </div>
                </form>
            </div>
        </div>

        <div class="card bg-coklat">
            <div class="card-body">
                <h3 class="card-title text-white">Password</h3>
                <form action="" method="POST">
                    <div class="mb-3 row">
                        <label class="col-form-label col-md-4">Password Lama</label>
                        <div class="col-md-8">
                            <input type="password" class="form-control" autocomplete="off" placeholder="Masukkan password lama" name="passwordl">
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label class="col-form-label col-md-4">Password Baru</label>
                        <div class="col-md-8">
                            <input type="password" class="form-control" autocomplete="off" placeholder="Masukkan password baru" name="passwordb">
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label class="col-form-label col-md-4">Ulangi Password Baru</label>
                        <div class="col-md-8">
                            <input type="password" class="form-control" autocomplete="off" placeholder="Masukkan password baru" name="passwordbb">
                        </div>
                    </div>
                    <div class="text-end">
                        <button class="btn btn-secondary" type="reset">Batal</button>
                        <button class="btn btn-primary" type="submit" name="tombol" value="reset">Simpan</button>
                    </div>
                </form>
            </div>
        </div>

        <div class="card bg-coklat">
            <div class="card-body">
                <h3 class="card-title text-white">Pesanan</h3>
                <div class="table-responsive">
                    <table id="my-datatables" class="table border table-dark">
                        <thead>
                            <tr>
                                <th width="10">No</th>
                                <th>Order ID</th>
                                <th>WhatsApp</th>
                                <th>Games</th>
                                <th>Produk</th>
                                <th>Harga</th>
                                <th>Target</th>
                                <th>Ket/SN</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $no = 1; foreach ($orders as $order): ?>
                            <tr>
                                <td><?= $no++; ?></td>
                                <td><?= $order['order_id']; ?></td>
                                <td><?= $order['whatsapp']; ?></td>
                                <td>
                                    <?php if (filter_var($order['games_img'], FILTER_VALIDATE_URL)): ?>
                                        <img src="<?= $order['games_img']; ?>" width="50" class="rounded-3" alt="">
                                    <?php else: ?>
                                        <img src="<?= base_url(); ?>/assets/images/games/<?= $order['games_img']; ?>" width="50" class="rounded-3" alt="">
                                    <?php endif ?>
                                </td>
                                <td><?= $order['product']; ?></td>
                                <td>Rp <?= number_format($order['price'], 0, ',', '.'); ?></td>
                                <td><?= $order['target']; ?></td>
                                <td><?= $order['note']; ?></td>
                                <td>
                                    <?php 
                                    if ($order['status'] == 'Pending') {
                                        echo '<span class="badge bg-warning p-2" style="font-size: 12px;">'.$order['status'].'</span>';
                                    } else if ($order['status'] == 'Processing') {
                                        echo '<span class="badge bg-info p-2" style="font-size: 12px;">'.$order['status'].'</span>';
                                    } else if ($order['status'] == 'Completed') {
                                        echo '<span class="badge bg-success p-2" style="font-size: 12px;">'.$order['status'].'</span>';
                                    } else {
                                        echo '<span class="badge bg-danger p-2" style="font-size: 12px;">'.$order['status'].'</span>';
                                    }
                                    ?>
                                </td>
                                <td><a href="<?= $order['payment_url']; ?>" class="btn btn-sm btn-primary border-0">Bayar</a></td>
                            </tr>
                            <?php endforeach ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

    </div>
</div>
<?php $this->endSection(); ?>

<?php $this->section('js'); ?>
                    <script>
                    	$("#my-datatables").DataTable({
                    		ordering: false,
                    	});
                    </script>
                    <script>
                        function method(id) {
                            
                            $("#input-method").val(id);

                            $("#method-select").remove();
                            $(".method-list").removeClass('active');

                            $("#method-" + id).addClass('active');
                            $("#method-" + id).prepend('<span id="method-select" class="bg-primary"></span>');
                        }
                    </script>
                    <?php $this->endSection(); ?>