                    <?php $this->extend('template'); ?>

                    <?php $this->section('konten'); ?>
                    <div class="row justify-content-center">
                        <div class="col-xl-8">
                        	<div class="card bg-coklat">
                        		<div class="card-body">
                        			<h5 class="card-title text-white">Detail Produk</h5>
                                    <table class="table border">
                                        <tr class="bg-primary text-white">
                                            <th colspan="2">Detail Umum</th>
                                        </tr>
                                        
                                        <tr>
                                            <th>Games</th>
                                            <td><?= $games['name']; ?></td>
                                        </tr>
                                        <tr>
                                            <th>Produk</th>
                                            <td><?= $product['product']; ?></td>
                                        </tr>
                                        <tr>
                                            <th>Harga</th>
                                            <td>Rp&nbsp;<?= number_format($product['price'],0,',','.'); ?></td>
                                        </tr>
                                        <tr>
                                            <th>Kode SKU</th>
                                            <td><?= $product['sku']; ?></td>
                                        </tr>
                                        <tr>
                                            <th>Provider</th>
                                            <td><?= $product['provider']; ?></td>
                                        </tr>
                                        <tr class="bg-primary text-white">
                                            <th colspan="2">Kostum Harga</th>
                                        </tr>
                                        <?php foreach ($methods as $method): ?>
                                        <tr>
                                            <td><img src="<?= $method['images']; ?>" alt="" width="100"></td>
                                            <td>Rp&nbsp;<?= number_format($method['price'],0,',','.'); ?></td>
                                        </tr>
                                        <?php endforeach ?>
                                    </table>
                                    <small>Jika dikostum harga tertera 0, maka harga menggunakan harga default</small>
                                    <div class="mt-3">
                                        <a href="<?= base_url(); ?>/admin/product" class="btn btn-warning">Kembali</a>
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
                        $("#check-kostum").on('change', function() {
                            if ($("#check-kostum").prop('checked')) {
                                $("#kostum-price").removeClass('hide');
                            } else {
                                $("#kostum-price").addClass('hide');
                            }
                        })
                    </script>
                    <?php $this->endSection(); ?>