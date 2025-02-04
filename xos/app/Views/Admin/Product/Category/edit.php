                    <?php $this->extend('template'); ?>

                    <?php $this->section('konten'); ?>
                    <div class="row justify-content-center">
                        <div class="col-xl-8">
                        	<div class="card bg-coklat">
                        		<div class="card-body">
                        			<h5 class="card-title text-white">Edit Kategori</h5>
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
                                            <label class="col-form-label col-md-4">Nama Kategori</label>
                                            <div class="col-md-8">
                                                <input type="text" class="form-control" autocomplete="off" name="category" autocomplete="off" value="<?= $category['category']; ?>">
                                            </div>
                                        </div>
                                        <div class="mb-3 row">
                                            <label class="col-form-label col-md-4">Urutan</label>
                                            <div class="col-md-8">
                                                <input type="number" class="form-control" autocomplete="off" name="sort" autocomplete="off" value="<?= $category['sort']; ?>">
                                            </div>
                                        </div>
                                        <a href="<?= base_url(); ?>/admin/product/category" class="btn btn-warning">Kembali</a>
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
                    <?php $this->endSection(); ?>