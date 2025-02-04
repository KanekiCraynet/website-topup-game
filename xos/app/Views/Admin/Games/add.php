                    <?php $this->extend('template'); ?>

                    <?php $this->section('konten'); ?>
                    <div class="row justify-content-center">
                        <div class="col-xl-8">
                            <div class="card bg-coklat">
                                <div class="card-body">
                                    <h5 class="card-title text-white">Tambah Games</h5>
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
                                    <form action="" method="POST" enctype="multipart/form-data">
                                        <div class="mb-3 row">
                                            <label class="col-form-label col-md-4">Url Gambar</label>
                                            <div class="col-md-8">
                                                <input type="file" class="form-control" autocomplete="off" name="images" autocomplete="off">
                                            </div>
                                        </div>
                                        <div class="mb-3 row">
                                            <label class="col-form-label col-md-4">Nama Game</label>
                                            <div class="col-md-8">
                                                <input type="text" class="form-control" autocomplete="off" name="name" autocomplete="off">
                                            </div>
                                        </div>
                                        <div class="mb-3 row">
                                            <label class="col-form-label col-md-4">Brand</label>
                                            <div class="col-md-8">
                                                <input type="text" class="form-control" autocomplete="off" name="brand" autocomplete="off">
                                                <small><span class="text-danger">*</span> Sesuaikan Brand dengan nama produk digiflazz untuk mendapatkan produk/layanan secara otomatis</small>
                                            </div>
                                        </div>
                                        <div class="mb-3 row">
                                            <label class="col-form-label col-md-4">Slug</label>
                                            <div class="col-md-8">
                                                <input type="text" class="form-control" autocomplete="off" name="slug" autocomplete="off">
                                                <small><span class="text-danger">*</span> Pastikan slug bersifat unik tidak sama dengan nama slug game lainnya</small>
                                            </div>
                                        </div>
                                        <div class="mb-3 row">
                                            <label class="col-form-label col-md-4">Kategori</label>
                                            <div class="col-md-8">
                                                <select name="category" class="form-control">
                                                    <option value="">Pilih salah satu</option>
                                                    <?php foreach ($categorys as $category): ?>
                                                    <option value="<?= $category['id']; ?>"><?= $category['category']; ?></option>
                                                    <?php endforeach ?>
                                                </select>
                                                <hr class="mt-4">
                                            </div>
                                        </div>
                                        <div class="mb-3 row">
                                            <label class="col-form-label col-md-4">Deskripsi</label>
                                            <div class="col-md-8">
                                                <textarea name="content"></textarea>
                                                <hr class="mt-4">
                                            </div>
                                        </div>
                                        <div class="mb-3 row">
                                            <label class="col-form-label col-md-4">Sistem Target</label>
                                            <div class="col-md-8">
                                                <select name="target" class="form-control">
                                                    <option value="A">1 Target (ID Player)</option>
                                                    <option value="B">2 Target (ID Player / User ID)</option>
                                                    <option value="C">2 Target (ID Player / Server)</option>
                                                    <option value="D">3 Nomor Tujuan</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="mb-3 row">
                                            <label class="col-form-label col-md-4">Validasi ID</label>
                                            <div class="col-md-8">
                                                <div class="input-group">
                                                    <select name="validasi_status" class="form-control">
                                                        <option value="Y">Ya</option>
                                                        <option value="N" selected="">Tidak</option>
                                                    </select>
                                                    <input type="text" name="validasi_kode" class="form-control" autocomplete="off" autocomplete="off" readonly="">
                                                </div>
                                            </div>
                                        </div>
                                        <a href="<?= base_url(); ?>/admin/games" class="btn btn-warning">Kembali</a>
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
                    <script src="https://cdn.ckeditor.com/4.17.1/standard/ckeditor.js"></script>
                    <script>
                        CKEDITOR.replace('content');
                    </script>
                    <script>
                        $("select[name=validasi_status]").on('change', function() {
                            if ($(this).val() == 'Y') {
                                $("input[name=validasi_kode]").removeAttr('readonly');
                            } else {
                                $("input[name=validasi_kode]").attr('readonly', 'readonly');
                            }
                        });
                    </script>
                    <?php $this->endSection(); ?>