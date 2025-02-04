<?php $this->extend('template'); ?>

                    <?php $this->section('konten'); ?>
                    <div class="row justify-content-center">
                        <div class="col-xl-10 col-lg-10 col-md-10">
                                    <?php if (session('error')): ?>
                                    <div class="alert alert-danger">
                                        <b>Gagal</b> <?= session('error'); ?>
                                    </div>
                                    <?php endif ?>
                                    <?php if (session('success')): ?>
                                    <div class="alert alert-success">
                                        <b>Berhasil</b> <?= session('success'); ?>
                                    </div>
                                    <?php endif ?>
                            <div class="card bg-coklat">
                                <div class="card-body">
                                    <h3 class="card-title text-white">Isi Saldo</h3>
                                                    <form action="" method="POST">
                                                        <div class="mb-3 row">
                                                            <label class="col-form-label col-md-4">Jumlah deposit</label>
                                                            <div class="col-md-8">
                                                                <input type="hidden" name="method" id="input-method">
                                                                <input type="number" class="form-control" autocomplete="off" placeholder="masukkan nominal deposit" name="quantity">
                                                            </div>
                                                        </div>
                                                        <?php foreach ($methods as $method): ?>
                                                        <div id="method-<?= $method['id']; ?>" class="border p-3 metode-list mb-3 cursor-pointer" onclick="method('<?= $method['id']; ?>');">
                                                            <div class="row">
                                                                <div class="col-7 ps-2">
                                                                    <div style="margin: 5px 0;">
                                                                        <img src="<?= base_url(); ?>/assets/images/pembayaran/<?= $method['images']; ?>" alt="" width="120" class="mt-1">
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <?php endforeach; ?>
                                                        <div class="text-end">
                                                            <button class="btn btn-secondary" type="reset">Batal</button>
                                                            <button class="btn btn-primary" type="submit" name="isi_saldo" value="submit">Isi Saldo</button>
                                                        </div>
                                                    </form>
                                
                                </div>
                            </div>
                            
                            <div class="table-responsive">
                        				<table id="my-datatables" class="table border table-dark">
                        					<thead>
                        						<tr>
                        							<th width="10">No</th>
                        							<th>Metode</th>
                                                    <th>Jumlah</th>
                                                    <th>Status</th>
                                                    <th>Action</th>
                        							
                        						</tr>
                        					</thead>
                        					<tbody>
                                                <?php $no = 1; foreach ($deposit as $loop): ?>
                        						<tr>
                        							<td align="center"><?= $no++; ?></td>
                        							
                        							<td><?= $loop['metode']; ?></td>
                                                    <td>Rp <?= number_format($loop['quantity'],0,',','.'); ?></td>
                                                    <td>
                                                        <?php
                                                        if ($loop['status'] == 'Pending') {
                                                            $badge = 'warning';
                                                        } else if ($loop['status'] == 'Success') {
                                                            $badge = 'success';
                                                        } else {
                                                            $badge = 'danger';
                                                        }
                                                        ?>
                                                        <span class="badge bg-<?= $badge; ?>"><?= $loop['status']; ?></span>
                                                    </td>
                                                    <td><a href="<?= $loop['target']; ?>" class="btn btn-sm btn-primary border-0">Bayar</a></td>
                        							
                        						</tr>
                                                <?php endforeach ?>
                        					</tbody>
                        				</table>
                        			</div>
                            
                        </div>
                    </div>
                    <?php $this->endSection(); ?>

                    <?php $this->section('js'); ?>
                    <script>
                        function method(id) {
                            
                            $("#input-method").val(id);

                            $("#method-select").remove();
                            $(".method-list").removeClass('active');

                            $("#method-" + id).addClass('active');
                            $("#method-" + id).prepend('<span id="method-select" class="bg-primary"></span>');
                        }
                    </script>
                    <script>
                    	$("#my-datatables").DataTable({
                    		ordering: false,
                    	});
                    </script>
                    <?php $this->endSection(); ?>