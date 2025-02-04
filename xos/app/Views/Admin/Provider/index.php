                    <?php $this->extend('template'); ?>

                    <?php $this->section('konten'); ?>
                    <div class="row justify-content-center">
                        <div class="col-xl-8">
                        	<div class="card bg-coklat">
                        		<div class="card-body">
                        			<h5 class="card-title text-white">Provider</h5>
                                    <div class="mb-3">
                                        <a href="<?= base_url(); ?>/admin/provider/add" class="btn btn-primary">Tambah Kategori</a>
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
                        			    <th>Provider</th>
                                                    <th>Saldo</th>
                                                    <th>Api ID</th>
                                                    <th>Api Key</th>
                                                    <th>Status</th>
                        			    <th width="10">Action</th>
                        			</tr>
                        		    </thead>
                        		    <tbody>
                                                <?php $no = 1; foreach ($providers as $provider): ?>
                        			<tr>
                        			    <td align="center"><?= $no++; ?></td>
                        			    <td><?= $provider['provider']; ?></td>
                                                    <td>Rp <?= $provider['saldo']; ?></td>
                                                    <td>Rp <?= $provider['api_id']; ?></td>
                                                    <td>Rp <?= $provider['api_key']; ?></td>
                                                    <td>Rp <?= $provider['status']; ?></td>
                        			    <td style="width: 10;white-space: nowrap;">
                                                        <a href="<?= base_url(); ?>/admin/provider/edit/<?= $provider['id']; ?>" class="btn btn-sm btn-primary border-0">Edit</a>
                        				<button onclick="hapus('<?= base_url(); ?>/admin/provider/delete/<?= $provider['id']; ?>');" class="btn btn-sm btn-danger border-0">Hapus</button>
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
                    
                    <?php $this->endSection(); ?>