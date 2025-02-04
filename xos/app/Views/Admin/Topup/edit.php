                    <?php $this->extend('template'); ?>

                    <?php $this->section('konten'); ?>
                    <div class="row justify-content-center">
                        <div class="col-xl-8">
                        	<div class="card bg-coklat">
                        		<div class="card-body">
                        			<h5 class="card-title text-white">Edit Deposit</h5>
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
                                            <label class="col-form-label col-md-4">Topup ID</label>
                                            <div class="col-md-8">
                                                <input type="text" class="form-control" autocomplete="off" value="<?= $topup['topup_id']; ?>" readonly>
                                            </div>
                                        </div>
                                        <div class="mb-3 row">
                                            <label class="col-form-label col-md-4">Metode</label>
                                            <div class="col-md-8">
                                                <input type="text" class="form-control" autocomplete="off" name="metode" value="<?= $topup['metode']; ?>">
                                            </div>
                                        </div>
                                        <div class="mb-3 row">
                                            <label class="col-form-label col-md-4">Jumlah</label>
                                            <div class="col-md-8">
                                                <input type="number" class="form-control" autocomplete="off" name="quantity" value="<?= $topup['quantity']; ?>">
                                            </div>
                                        </div>
                                        <div class="mb-3 row">
                                            <label class="col-form-label col-md-4">Status</label>
                                            <div class="col-md-8">
                                                <select name="status" class="form-control">
                                                    <option value="Pending" <?= $topup['status'] == 'Pending' ? 'selected' : ''; ?>>Pending</option>
                                                    <option value="Success" <?= $topup['status'] == 'Success' ? 'selected' : ''; ?>>Success</option>
                                                    <option value="Canceled" <?= $topup['status'] == 'Canceled' ? 'selected' : ''; ?>>Canceled</option>
                                                </select>
                                            </div>
                                        </div>
                                        <a href="<?= base_url(); ?>/admin/topup" class="btn btn-warning">Kembali</a>
                                        <div class="float-end">
                                            <button class="btn btn-primary" type="submit" name="tombol" value="submit">Simpan</button>
                                        </div>
                                        <?php if ($topup['status'] == 'Pending'): ?>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <a class="btn btn-success w-100 mt-3" href="<?= base_url(); ?>/admin/topup/accept/<?= $topup['id']; ?>">Terima</a>
                                            </div>
                                            <div class="col-md-6">
                                                <a class="btn btn-danger w-100 mt-3" href="<?= base_url(); ?>/admin/topup/reject/<?= $topup['id']; ?>">Tolak</a>
                                            </div>
                                        </div>
                                        <?php endif; ?>
                                    </form>
                        		</div>
                        	</div>
                        </div>
                    </div>
                    <?php $this->endSection(); ?>

                    <?php $this->section('js'); ?>
                    <?php $this->endSection(); ?>