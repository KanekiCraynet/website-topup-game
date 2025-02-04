<?php $this->extend('template'); ?>

<?php $this->section('konten'); ?>
<div class="row justify-content-center">
    <div class="col-xl-10">
        <div class="card bg-coklat">
            <div class="card-body">
                <h5 class="card-title text-white">Kelola Deposit</h5>
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
                                <th>Topup ID</th>
                                <th>Metode</th>
                                <th>Jumlah</th>
                                <th>Status</th>
                                <th width="10">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $no = 1; foreach ($topup as $loop): ?>
                            <tr>
                                <td align="center"><?= $no++; ?></td>
                                <td><?= $loop['topup_id']; ?></td>
                                <td><?= $loop['metode']; ?></td>
                                <td>Rp <?= number_format($loop['quantity'], 0, ',', '.'); ?></td>
                                <td>
                                    <?php
                                    if ($loop['status'] == 'Pending') {
                                        $badge = 'warning';
                                    } else if ($loop['status'] == 'Success') {
                                        $badge = 'success';
                                    } else {
                                        $badge = 'danger';
                                    }
                                    ?>
                                    <span class="badge bg-<?= $badge; ?>"><?= $loop['status']; ?></span>
                                </td>
                                <td style="width: 10;white-space: nowrap;">
                                    <a href="<?= base_url(); ?>/admin/topup/edit/<?= $loop['id']; ?>" class="btn btn-sm btn-primary border-0">Edit</a>
                                    <button onclick="hapus('<?= base_url(); ?>/admin/topup/delete/<?= $loop['id']; ?>');" class="btn btn-sm btn-danger border-0">Hapus</button>
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
    $("#my-datatables").DataTable({
        ordering: false,
    });
</script>
<?php $this->endSection(); ?>