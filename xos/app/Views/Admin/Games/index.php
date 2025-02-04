                    <?php $this->extend('template'); ?>

                    <?php $this->section('konten'); ?>
                    <div class="row justify-content-center">
                        <div class="col-xl-10">
                        	<div class="card bg-coklat">
                        		<div class="card-body">
                        			<h5 class="card-title text-white">Kelola Games</h5>
                        			<div class="mb-3">
                                        <a href="<?= base_url(); ?>/admin/games/add" class="btn btn-primary">Tambah Games</a>
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
                        							<th>Gambar</th>
                        							<th>Game</th>
                        							<th>Brand</th>
                                                    <th>Kategori</th>
                                                    <th>Urutan</th>
                        							<th width="10">Action</th>
                        						</tr>
                        					</thead>
                        					<tbody>
                                                <?php $no = 1; foreach ($gamess as $games): ?>
                        						<tr>
                        							<td><?= $no++; ?></td>
                        							<td>
                                                        <?php if (filter_var($games['images'], FILTER_VALIDATE_URL)): ?>
                                                        <img src="<?= $games['images']; ?>" width="60" class="rounded-3" alt="">
                                                        <?php else: ?>
                                                        <img src="<?= base_url(); ?>/assets/images/games/<?= $games['images']; ?>" width="60" class="rounded-3" alt="">
                                                        <?php endif ?>
                                                    </td>
                        							<td><?= $games['name']; ?></td>
                        							<td><?= $games['brand']; ?></td>
                                                    <td><?= $games['category_name']; ?></td>
                                                    <td>
                                                        <input onchange="update_sort('<?= $games['id']; ?>', this.value);" type="text" class="form-control text-center" style="width: 50px;" value="<?= $games['sort']; ?>">
                                                    </td>
                        							<td style="width: 10;white-space: nowrap;">
                        								<a href="<?= base_url(); ?>/admin/games/edit/<?= $games['id']; ?>" class="btn btn-sm btn-primary border-0">Edit</a>
                        								<button onclick="hapus('<?= base_url(); ?>/admin/games/delete/<?= $games['id']; ?>');" class="btn btn-sm btn-danger border-0">Hapus</button>
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
                                url: '<?= base_url(); ?>/admin/games/update/sort/' + value + '/' + id,
                                success: function(result) {
                                    
                                }
                            });
                        }
                    </script>
                    <?php $this->endSection(); ?>