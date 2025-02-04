                    <?php $this->extend('template'); ?>

                    <?php $this->section('konten'); ?>
                    <div class="row justify-content-center">
                        <div class="col-xl-8">
                        	<div class="card bg-coklat">
                        		<div class="card-body">
                        			<h5 class="card-title text-white">Edit Produk</h5>
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
                                            <label class="col-form-label col-md-4">Games</label>
                                            <div class="col-md-8">
                                                <select name="games_id" class="form-control">
                                                    <?php foreach ($gamess as $games): ?>
                                                    <option value="<?= $games['id']; ?>" <?= $product['games_id'] == $games['id'] ? 'selected' : ''; ?>><?= $games['name']; ?></option>
                                                    <?php endforeach ?>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="mb-3 row">
                                            <label class="col-form-label col-md-4">Nama Produk</label>
                                            <div class="col-md-8">
                                                <input type="text" class="form-control" autocomplete="off" name="product" autocomplete="off" value="<?= $product['product']; ?>">
                                            </div>
                                        </div>
                                        <div class="mb-3 row">
                                            <label class="col-form-label col-md-4">
                                                Harga <code>(default)</code>
                                            </label>
                                            <div class="col-md-8">
                                                <input type="number" class="form-control mb-2" autocomplete="off" name="price" value="<?= $product['price']; ?>">
                                                <div class="form-check">
                                                    <input type="checkbox" class="form-check-input" id="check-kostum" <?= $custom_price !== 0 ? 'checked' : ''; ?>>
                                                    <label class="form-check-label" for="check-kostum">Kostum Harga</label>
                                                </div>
                                                <div class="mb-3 mt-3 <?= $custom_price !== 0 ? '' : 'hide'; ?>" id="kostum-price">
                                                    <?php foreach ($methods as $method): ?>
                                                    <div class="row mb-3">
                                                        <div class="col-5">
                                                            <img src="<?= base_url(); ?>/assets/images/pembayaran/<?= $method['images']; ?>" alt="" width="100" class="mt-2">
                                                        </div>
                                                        <div class="col-7">
                                                            <input type="hidden" name="c_method_id[]" value="<?= $method['id']; ?>">
                                                            <input type="number" class="form-control" autocomplete="off" placeholder="Harga" name="c_price[]" value="<?= $method['price']; ?>">
                                                        </div>
                                                    </div>
                                                    <?php endforeach ?>
                                                    <small>Jika dikosongkan maka harga yang digunakan adalah harga <code>default</code></small>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="mb-3 row">
                                            <label class="col-form-label col-md-4">Profit</label>
                                            <div class="col-md-8">
                                                <input type="text" class="form-control" autocomplete="off" name="profit" autocomplete="off" value="<?= $product['profit']; ?>">
                                            </div>
                                        </div>
                                        <div class="mb-3 row">
                                            <label class="col-form-label col-md-4">Provider</label>
                                            <div class="col-md-8">
                                                <select name="provider" class="form-control">
                                                    <?php foreach ($providers as $provider): ?>
                                                    <option value="<?= $provider['provider']; ?>" <?= $product['provider'] == $provider['provider'] ? 'selected' : ''; ?>><?= $provider['provider']; ?></option>
                                                    <?php endforeach ?>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="mb-3 row">
                                            <label class="col-form-label col-md-4">Kode SKU</label>
                                            <div class="col-md-8">
                                                <input type="text" class="form-control" autocomplete="off" name="sku" autocomplete="off" value="<?= $product['sku']; ?>">
                                            </div>
                                        </div>
                                        <a href="<?= base_url(); ?>/admin/product" class="btn btn-warning">Kembali</a>
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