                    <?php $this->extend('template'); ?>

                    <?php $this->section('konten'); ?>
                    <div class="row justify-content-center">
                        <div class="col-md-10">
                            <div class="card bg-coklat">
                                <div class="card-body text-white">
                                    <h5 class="card-title text-white">
                                        <a href="<?= base_url(); ?>/admin/page"><i class="me-1" data-feather="arrow-left"></i></a>
                                        Bantuan
                                    </h5>
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
                                        <div class="mb-3">
                                            <label class="mb-1">Email</label>
                                            <input type="email" class="form-control" autocomplete="off" name="email" value="<?= $help['email']; ?>">
                                        </div>
                                        <div class="mb-3">
                                            <label class="mb-1">Telpon</label>
                                            <input type="text" class="form-control" autocomplete="off" name="telpon" value="<?= $help['telpon']; ?>">
                                        </div>
                                        <div class="text-end">
                                            <button class="btn btn-default" type="reset">Batal</button>
                                            <button class="btn btn-primary" type="submit" name="tombol" value="submit">Simpan</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php $this->endSection(); ?>

                    <?php $this->section('js'); ?>
                    <?php $this->endSection(); ?>