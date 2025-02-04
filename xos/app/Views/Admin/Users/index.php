<?php $this->extend('template'); ?>

<?php $this->section('konten'); ?>
<div class="row justify-content-center">
    <div class="col-xl-12">
        <div class="card bg-coklat">
            <div class="card-body">
                <h5 class="card-title text-white">Kelola User</h5>
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
                                <th>Username</th>
                                <th>Saldo</th>
                                <th>WhatsApp</th>
                                <th>Level</th>
                                <th>Status</th>
                                <th>IP</th>
                                <th>Login</th>
                                <th width="10">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $no = 1; foreach ($userss as $user): ?>
                            <tr>
                                <td><?= $no++; ?></td>
                                <td><?= $user['username']; ?></td>
                                <td>Rp <?= number_format($user['balance'],0,',','.'); ?></td>
                                <td><?= $user['whatsapp']; ?></td>
                                <td><?= $user['level']; ?></td>
                                <td><?= $user['status']; ?></td>
                                <td><?= $user['last_ip']; ?></td>
                                <td><?= $user['last_login']; ?></td>
                                <td style="width: 10;white-space: nowrap;">
                                    <a href="<?= base_url(); ?>/admin/users/edit/<?= $user['id']; ?>" class="btn btn-sm btn-primary border-0">Edit</a>
                                    <button onclick="hapus('<?= base_url(); ?>/admin/users/delete/<?= $user['id']; ?>');" class="btn btn-sm btn-danger border-0">Hapus</button>
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