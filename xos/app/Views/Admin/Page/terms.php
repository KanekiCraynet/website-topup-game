                    <?php $this->extend('template'); ?>

                    <?php $this->section('konten'); ?>
                    <div class="row justify-content-center">
                        <div class="col-md-10">
                            <div class="card bg-coklat">
                                <div class="card-body">
                                    <h5 class="card-title text-white">
                                        <a href="<?= base_url(); ?>/admin/page"><i class="me-1" data-feather="arrow-left"></i></a>
                                        Syarat & Ketentuan
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
                                        <textarea name="terms"><?= $terms; ?></textarea>
                                        <div class="mt-3 text-end">
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
                    <script src="https://cdn.ckeditor.com/4.18.0/standard/ckeditor.js"></script>
                    <script>
                        CKEDITOR.replace('terms', {
                            height: 900,
                        });
                    </script>
                    <?php $this->endSection(); ?>