                    <?php $this->extend('template'); ?>

                    <?php $this->section('konten'); ?>
                    <div class="row justify-content-center">
                        <div class="col-xl-8">
                        	<div class="card bg-coklat">
                        		<div class="card-body">
                        			<h5 class="card-title text-white">Edit Pembayaran</h5>
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
                                                <input type="file" class="form-control" autocomplete="off" name="images" autocomplete="off" value="<?= $method['images']; ?>">
                                            </div>
                                        </div>
                                        <div class="mb-3 row">
                                            <label class="col-form-label col-md-4">Nama</label>
                                            <div class="col-md-8">
                                                <input type="text" class="form-control" autocomplete="off" name="name" autocomplete="off" value="<?= $method['name']; ?>">
                                            </div>
                                        </div>
                                        <div class="mb-3 row">
                                            <label class="col-form-label col-md-4">Provider</label>
                                            <div class="col-md-8">
                                                <input type="text" class="form-control" autocomplete="off" name="provider" autocomplete="off" value="<?= $method['provider']; ?>">
                                            </div>
                                        </div>
                                        <div class="mb-3 row">
                                            <label class="col-form-label col-md-4">Kode</label>
                                            <div class="col-md-8">
                                                <input type="text" class="form-control" autocomplete="off" name="code" autocomplete="off" value="<?= $method['code']; ?>">
                                            </div>
                                        </div>
                                        <a href="<?= base_url(); ?>/admin/payment" class="btn btn-warning">Kembali</a>
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