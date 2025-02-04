                    <?php $this->extend('template'); ?>

                    <?php $this->section('konten'); ?>
                    <div class="row justify-content-center">
                        <div class="col-xl-6 col-lg-8 col-md-10">
                            <div class="card bg-coklat">
                                <div class="card-body">
                                    <h5 class="card-title text-white">Status Pembelian</h5>
                                    <p>Silahkan masukan Order ID pesanan kamu</p>
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
                                    <form action="" method="GET">
                                        <div class="input-group mb-3">
                                            <input type="number" class="form-control" placeholder="Order ID" name="order_id" autocomplete="off">
                                            <button class="btn btn-primary" type="submit" name="tombol" value="submit">Cari</button>
                                        </div>
                                    </form>
                                    <?php if (session('detail')): ?>
                                    <div class="mt-4">
                                        <h4>Order ID : #<?= session('detail')['order_id']; ?></h4>
                                        <p>Berikut ini adalah detail dari pembelian anda.</p>
                                        <div class="mt-4 mb-3">
                                            <?php if (filter_var($order['games_img'], FILTER_VALIDATE_URL)): ?>    
                                                        <img src="<?= session('detail')['games_img']; ?>" width="200" class="r m-auto" alt="">
                                                        <?php else: ?>
                                                        <img src="<?= base_url(); ?>/assets/images/games/<?= session('detail')['games_img']; ?>" width="200" class="r m-auto" alt="">
                                                        <?php endif ?>
                                        </div>
                                        <table>
                                            <tr>
                                                <th class="pb-2">Produk</th>
                                                <td class="ps-5 pb-2 pe-2">:</td>
                                                <td class="pb-2"><?= session('detail')['product']; ?></td>
                                            </tr>
                                            <tr>
                                                <th class="pb-2">Harga</th>
                                                <td class="ps-5 pb-2 pe-2">:</td>
                                                <td class="pb-2">Rp&nbsp;<?= number_format(session('detail')['price'],0,',','.'); ?></td>
                                            </tr>
                                            <tr>
                                                <th class="pb-2">Target</th>
                                                <td class="ps-5 pb-2 pe-2">:</td>
                                                <td class="pb-2"><?= session('detail')['target']; ?></td>
                                            </tr>
                                            <tr>
                                                <th class="pb-2">Status Pembelian</th>
                                                <td class="ps-5 pb-2 pe-2">:</td>
                                            <?php 
                                            if (session('detail')['status'] === 'Pending') {
                                                $bg = 'warning';
                                            } else if (session('detail')['status'] === 'Processing') {
                                                $bg = 'info';
                                            } else if (session('detail')['status'] === 'Completed') {
                                                $bg = 'success';
                                            } else {
                                                $bg = 'danger';
                                            }
                                            ?>
                                                <td class="pb-2"><h6 class="bg-<?= $bg; ?> d-inline-block px-3 py-2 rounded-3 text-white"><?= session('detail')['status']; ?></h6></td>
                                            </tr>
                                            <tr>
                                                <th class="pb-2">Ket/SN</th>
                                                <td class="ps-5 pb-2 pe-2">:</td>
                                                <td class="pb-2"><h6 class="bg-<?= $bg; ?> d-inline-block px-3 py-2 rounded-3 text-white"><?= session('detail')['note']; ?></h6></td>
                                                
                                            </tr>
                                            <tr>
                                                <th class="pb-2">Tgl Pemesanan</th>
                                                <td class="ps-5 pb-2 pe-2">:</td>
                                                <td class="pb-2"><?= session('detail')['date_create']; ?></td>
                                            </tr>
                                        </table>
                                        <?php if (session('detail')['status'] === 'Pending'): ?>                                   
                                                <a class="btn btn-primary w-100" tyipe="button" href="<?= session('detail')['payment_url']; ?>">Bayar</a>                                     
                                            
                                        <?php endif ?>
                                        <p class="mt-3">Terimakasih telah melakukan pembelian kebutuhan game kamu di <?= $web['title']; ?>.</p>
                                    </div>
                                    <?php endif ?>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php $this->endSection(); ?>

                    <?php $this->section('js'); ?>
                    <?php $this->endSection(); ?>