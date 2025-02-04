                    <?php $this->extend('template'); ?>

                    <?php $this->section('konten'); ?>
                    <div class="row justify-content-center">
                        <div class="col-xl-10">                                   
                                                       
                        	<div class="card bg-coklat">
                        		<div class="card-body">
                        			<h5 class="card-title text-white">Kelola Produk</h5>
                                    <div class="mb-3">
                                        <a href="<?= base_url(); ?>/admin/product/add" class="btn btn-primary">Tambah Produk</a>
                                        
                                    </div>
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
                        							<th width="10">Games</th>
                        							<th>Nama</th>
                                                                                <th>Produk</th>
                                                                                <th>Harga</th>
                                                                                <th>Profit</th>
                        							<th width="10">Action</th>
                        						</tr>
                        					</thead>
                        					<tbody>
                                                <?php $no = 1; foreach ($products as $product): ?>
                        						<tr>
                        							<td align="center"><?= $no++; ?></td>
                        							<td>
                                                        <?php if (filter_var($product['img'], FILTER_VALIDATE_URL)): ?>
                                                        <img src="<?= $product['img']; ?>" width="60" class="rounded-3" alt="">
                                                        <?php else: ?>
                                                        <img src="<?= base_url(); ?>/assets/images/games/<?= $product['img']; ?>" width="60" class="rounded-3" alt="">
                                                        <?php endif; ?>
                                                    </td>
                        							<td><?= $product['name']; ?></td>
                                                    <td><?= $product['product']; ?></td>
                                                    <td>Rp&nbsp;<?= number_format($product['price'],0,',','.'); ?></td>
                                                    <td>Rp&nbsp;<?= number_format($product['profit'],0,',','.'); ?></td>
                        							<td style="width: 10;white-space: nowrap;">
                        								<a href="<?= base_url(); ?>/admin/product/detail/<?= $product['id']; ?>" class="btn btn-sm btn-success border-0">Detail</a>
                                                        <a href="<?= base_url(); ?>/admin/product/edit/<?= $product['id']; ?>" class="btn btn-sm btn-primary border-0">Edit</a>
                        								<button onclick="hapus('<?= base_url(); ?>/admin/product/delete/<?= $product['id']; ?>');" class="btn btn-sm btn-danger border-0">Hapus</button>
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