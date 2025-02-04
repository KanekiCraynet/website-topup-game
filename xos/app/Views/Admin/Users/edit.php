<?php $this->extend('template'); ?>

<?php $this->section('konten'); ?>
<div class="row justify-content-center">
    <div class="col-xl-8">
        <div class="card bg-coklat">
            <div class="card-body">
                <h5 class="card-title text-white">Edit User</h5>
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
                <form action="" method="POST">
                    <div class="mb-3 row">
                        <label class="col-form-label col-md-4">Username</label>
                        <div class="col-md-8">
                            <input type="text" class="form-control" autocomplete="off" name="username" value="<?= $user['username']; ?>">
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label class="col-form-label col-md-4">Saldo</label>
                        <div class="col-md-8">
                            <input type="number" class="form-control" autocomplete="off" name="balance" value="<?= $user['balance']; ?>">
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label class="col-form-label col-md-4">WhatsApp</label>
                        <div class="col-md-8">
                            <input type="number" class="form-control" autocomplete="off" name="whatsapp" value="<?= $user['whatsapp']; ?>">
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label class="col-form-label col-md-4">Level</label>
                        <div class="col-md-8">
                            <select name="level" class="form-control">
                                <option value="Member" <?= $user['level'] == 'Member' ? 'selected' : ''; ?>>Member</option>
                                <option value="Admin" <?= $user['level'] == 'Admin' ? 'selected' : ''; ?>>Admin</option>
                            </select>
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label class="col-form-label col-md-4">Status</label>
                        <div class="col-md-8">
                            <select name="status" class="form-control">
                                <option value="On" <?= $user['status'] == 'On' ? 'selected' : ''; ?>>On</option>
                                <option value="Off" <?= $user['status'] == 'Off' ? 'selected' : ''; ?>>Off</option>
                            </select>
                        </div>
                    </div>
                    <a href="<?= base_url(); ?>/admin/users" class="btn btn-warning">Kembali</a>
                    <div class="float-end">
                        <button class="btn btn-primary" type="submit" name="tombol" value="submit">Simpan</button>
                    </div>
                </form>
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

        $("#check-kostum").on('change', function () {
            if ($("#check-kostum").prop('checked')) {
                $("#kostum-price").removeClass('hide');
            } else {
                $("#kostum-price").addClass('hide');
            }
        });
    });
</script>
<?php $this->endSection(); ?>