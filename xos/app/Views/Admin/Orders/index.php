<?php $this->extend('template'); ?>

<?php $this->section('konten'); ?>
<div class="row justify-content-center">
    <div class="col-xl-12">
        <div class="card bg-coklat">
            <div class="card-body">
                <h5 class="card-title text-white">Kelola Pembelian</h5>
                <?php if (session('success')): ?>
                <div class="alert alert-success">
                    <b>Berhasil</b> <?= session('success'); ?>
                </div>
                <?php endif ?>
                <?php if (session('error')): ?>
                <div class="alert alert-danger">
                    <b>Gagal</b> <?= session('error'); ?>
                </div>
                <?php endif ?>
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
                                <th>Profit</th>
                                <th>Target</th>
                                <th>Status</th>
                                <th width="10">Action</th>
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
                                <td>Rp&nbsp;<?= number_format($order['price'], 0, ',', '.'); ?></td>
                                <td>Rp&nbsp;<?= number_format($order['profit'], 0, ',', '.'); ?></td>
                                <td><?= $order['target']; ?></td>
                                <td>
                                    <?php 
                                    $status = $order['status'];
                                    $badgeClass = '';
                                    
                                    switch ($status) {
                                        case 'Pending':
                                            $badgeClass = 'bg-warning';
                                            break;
                                        case 'Processing':
                                            $badgeClass = 'bg-info';
                                            break;
                                        case 'Completed':
                                            $badgeClass = 'bg-success';
                                            break;
                                        default:
                                            $badgeClass = 'bg-danger';
                                            break;
                                    }
                                    
                                    echo '<span class="badge ' . $badgeClass . ' p-2" style="font-size: 12px;">' . $status . '</span>';
                                    ?>
                                </td>
                                <td style="width: 10;white-space: nowrap;">
                                    <a href="<?= base_url(); ?>/admin/orders/detail/<?= $order['id']; ?>" class="btn btn-sm btn-success border-0">Detail</a>
                                    <a href="<?= base_url(); ?>/admin/orders/edit/<?= $order['id']; ?>" class="btn btn-sm btn-primary border-0">Edit</a>
                                    <button onclick="hapus('<?= base_url(); ?>/admin/orders/delete/<?= $order['id']; ?>');" class="btn btn-sm btn-danger border-0">Hapus</button>
                                </td>
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
    $(document).ready(function () {
        $("#my-datatables").DataTable({
            ordering: false,
        });
    });
</script>
<?php $this->endSection(); ?>