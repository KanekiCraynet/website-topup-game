<?php $this->extend('template'); ?>

<?php $this->section('konten'); ?>
<div class="row justify-content-center">
    <div class="col-xl-8">
        <div class="card bg-coklat">
            <div class="card-body">
                <h5 class="card-title text-white">Detail Pembelian</h5>
                <table class="table border">
                    <tr class="bg-primary text-white">
                        <th colspan="2">Detail Umum</th>
                    </tr>
                    <tr>
                        <th>Order ID</th>
                        <td><?= $order['order_id']; ?></td>
                    </tr>
                    <tr>
                        <th>WhatsApp</th>
                        <td><?= $order['whatsapp']; ?></td>
                    </tr>
                    <tr>
                        <th>Games</th>
                        <td>
                            <?php if (filter_var($order['games_img'], FILTER_VALIDATE_URL)): ?>
                                <img src="<?= $order['games_img']; ?>" width="60" class="rounded-3" alt="">
                            <?php else: ?>
                                <img src="<?= base_url(); ?>/assets/images/games/<?= $order['games_img']; ?>" width="60" class="rounded-3" alt="">
                            <?php endif ?>
                        </td>
                    </tr>
                    <tr>
                        <th>Produk</th>
                        <td><?= $order['product']; ?></td>
                    </tr>
                    <tr>
                        <th>Harga</th>
                        <td>Rp <?= number_format($order['price'], 0, ',', '.'); ?></td>
                    </tr>
                    <tr>
                        <th>Target</th>
                        <td><input type="text" value="<?= $order['target']; ?>" readonly class="form-control"></td>
                    </tr>
                    <tr>
                        <th>Status</th>
                        <td><?= $order['status']; ?></td>
                    </tr>
                    <tr class="bg-primary text-white">
                        <th colspan="2">Pembayaran</th>
                    </tr>
                    <tr>
                        <th>Kode</th>
                        <td><?= $order['payment_code']; ?></td>
                    </tr>
                    <tr>
                        <th>Url</th>
                        <td><a href="<?= $order['payment_url']; ?>" target="_blank" class="btn btn-primary">Bayar</a></td>
                    </tr>
                    <tr class="bg-primary text-white">
                        <th colspan="2">Lainnya</th>
                    </tr>
                    <tr>
                        <th>IP</th>
                        <td><?= $order['ip']; ?></td>
                    </tr>
                    <tr>
                        <th>Tanggal</th>
                        <td><?= $order['date_create']; ?></td>
                    </tr>
                    <tr>
                        <th>Update</th>
                        <td><?= $order['date_update']; ?></td>
                    </tr>
                </table>
                <div class="mt-3">
                    <a href="<?= base_url(); ?>/admin/orders" class="btn btn-warning">Kembali</a>
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
    $("#check-kostum").on('change', function() {
        if ($("#check-kostum").prop('checked')) {
            $("#kostum-price").removeClass('hide');
        } else {
            $("#kostum-price").addClass('hide');
        }
    })
</script>
<?php $this->endSection(); ?>