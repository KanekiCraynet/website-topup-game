                    <?php $this->extend('template'); ?>

                    <?php $this->section('konten'); ?>
                    <div class="row justify-content-center">
                        <div class="col-xl-8">
                        	<div class="card bg-coklat">
                        		<div class="card-body">
                        			<h5 class="card-title text-white">Kelola Kategori</h5>
                                    <div class="mb-3">
                                        <a href="<?= base_url(); ?>/admin/product/category/add" class="btn btn-primary">Tambah Kategori</a>
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
                        				<table id="my-datatables" class="table border">
                        					<thead>
                        						<tr>
                        							<th width="10">No</th>
                        							<th>Kategori</th>
                                                    <th>Total</th>
                                                    <th>Urutan</th>
                        							<th width="10">Action</th>
                        						</tr>
                        					</thead>
                        					<tbody>
                                                <?php $no = 1; foreach ($categorys as $category): ?>
                        						<tr>
                        							<td align="center"><?= $no++; ?></td>
                        							<td><?= $category['category']; ?></td>
                                                    <td><?= $category['total']; ?>&nbsp;Games</td>
                                                    <td>
                                                        <input onchange="update_sort('<?= $category['id']; ?>', this.value);" type="text" class="form-control text-center" style="width: 50px;" value="<?= $category['sort']; ?>">
                                                    </td>
                        							<td style="width: 10;white-space: nowrap;">
                                                        <a href="<?= base_url(); ?>/admin/product/category/edit/<?= $category['id']; ?>" class="btn btn-sm btn-primary border-0">Edit</a>
                        								<button onclick="hapus('<?= base_url(); ?>/admin/product/category/delete/<?= $category['id']; ?>');" class="btn btn-sm btn-danger border-0">Hapus</button>
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

                        function update_sort(id, value) {
                            $.ajax({
                                url: '<?= base_url(); ?>/admin/product/category/update/'+id+'/sort/' + value,
                                success: function(result) {
                                    
                                }
                            });
                        }
                    </script>
                    <?php $this->endSection(); ?>