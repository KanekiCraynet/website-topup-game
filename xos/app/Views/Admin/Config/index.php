                    <?php $this->extend('template'); ?>

                    <?php $this->section('konten'); ?>
                    <div class="row justify-content-center">
                        <div class="col-xl-8">
                           <h5 class="card-title text-white">Konfigurasi Web</h5>
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
                            
                            
                                     <div class="card bg-coklat">
                                        <div class="card-body">
                                            <h5 class="card-title text-white">Umum</h5>
                                            <form action="" method="POST">
                                                <div class="mb-3 row">
                                                    <label class="col-form-label col-md-4">Nama Website</label>
                                                    <div class="col-md-8">
                                                        <input type="text" class="form-control" autocomplete="off" name="title" value="<?= $web['title']; ?>">
                                                    </div>
                                                </div>
                                                <div class="mb-3 row">
                                                    <img src="<?= $web['icon']; ?>" class="mb-2 w-50">
                                                    <label class="col-form-label col-md-4">Icon Website</label>
                                                    <div class="col-md-8">
                                                        <input type="text" class="form-control" autocomplete="off" name="icon" value="<?= $web['icon']; ?>">
                                                    </div>
                                                </div>
                                                <div class="mb-3 row">
                                                    <img src="<?= $web['logo']; ?>" class="mb-2 w-50">
                                                    <label class="col-form-label col-md-4">Logo Website</label>
                                                    <div class="col-md-8">
                                                        
                                                        <input type="text" class="form-control" autocomplete="off" name="logo" value="<?= $web['logo']; ?>">
                                                    </div>
                                                </div>
                                                <div class="mb-3 row">
                                                    <label class="col-form-label col-md-4">Author</label>
                                                    <div class="col-md-8">
                                                        <input type="text" class="form-control" autocomplete="off" name="author" value="<?= $web['author']; ?>">
                                                    </div>
                                                </div>
                                                <div class="mb-3 row">
                                                    <label class="col-form-label col-md-4">Keywords</label>
                                                    <div class="col-md-8">
                                                        <input type="text" class="form-control" autocomplete="off" name="keywords" value="<?= $web['keywords']; ?>">
                                                    </div>
                                                </div>
                                                <div class="mb-3 row">
                                                    <label class="col-form-label col-md-4">Deskripsi</label>
                                                    <div class="col-md-8">
                                                        <textarea cols="30" rows="5" class="form-control" name="description"><?= $web['description']; ?></textarea>
                                                    </div>
                                                </div>
                                                <div class="mb-3 row">
                                                    <label class="col-form-label col-md-4">Pembayaran Saldo</label>
                                                    <div class="col-md-8">
                                                        <select name="pay_saldo" class="form-control">
                                                            <option value="On" <?= $pay_saldo == 'On' ? 'selected' : ''; ?>>On</option>
                                                            <option value="Off" <?= $pay_saldo == 'Off' ? 'selected' : ''; ?>>Off</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="mb-3 row">
                                                    <label class="col-form-label col-md-4">Profit</label>
                                                    <div class="col-md-8">
                                                        <input type="text" class="form-control" autocomplete="off" name="profit" placeholder="<?php echo $profit ?>" value="<?= $web['profit']; ?>">
                                                    </div>
                                                </div>
                                                <div class="text-end">
                                                    <button class="btn btn-secondary" type="reset">Batal</button>
                                                   <button class="btn btn-primary" type="submit" name="tombol" value="submit">Simpan</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                                
                               
                                <div class="card bg-coklat">
                                        <div class="card-body">
                                            <h5 class="card-title text-white">Slide</h5>
                                            <div class="mt-5 mx-auto" style="max-width: 650px;">
                        <div id="carouselExampleIndicators" class="carousel slide mb-5" data-bs-ride="carousel">
                            <div class="carousel-inner" style="border-radius: 16px;">
                                <?php for ($i = 1; $i <= 3; $i++): ?>
                                <div class="carousel-item <?= $i == 1 ? 'active' : ''; ?>">
                                    <img style="max-height: 350px;" src="<?= $slide[$i]; ?>" class="d-block w-100">
                                </div>
                                <?php endfor; ?>
                            </div>
                            <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="prev">
                                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                <span class="visually-hidden">Previous</span>
                            </button>
                            <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="next">
                                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                <span class="visually-hidden">Next</span>
                            </button>
                        </div>
                    </div>
                
                                            <form action="" method="POST">
                                                <div class="mb-3 row">
                                                    <label class="col-form-label col-md-4">Gambar Slide 1</label>
                                                    <div class="col-md-8">
                                                        <input type="text" class="form-control" autocomplete="off" name="slide_1" value="<?= $slide['1']; ?>">
                                                    </div>
                                                </div>
                                                <div class="mb-3 row">
                                                    <label class="col-form-label col-md-4">Gambar Slide 2</label>
                                                    <div class="col-md-8">
                                                        <input type="text" class="form-control" autocomplete="off" name="slide_2" value="<?= $slide['2']; ?>">
                                                    </div>
                                                </div>
                                                <div class="mb-3 row">
                                                    <label class="col-form-label col-md-4">Gambar Slide 3</label>
                                                    <div class="col-md-8">
                                                        <input type="text" class="form-control" autocomplete="off" name="slide_3" value="<?= $slide['3']; ?>">
                                                    </div>
                                                </div>
                                                <div class="text-end">
                                                    <button class="btn btn-secondary" type="reset">Batal</button>
                                                    <button class="btn btn-primary" type="submit" name="tombol_konten" value="submit">Simpan</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                    
                                    <div class="card bg-coklat">
                                        <div class="card-body">
                                            <h5 class="card-title text-white">SMTP</h5>
                                            <form action="" method="POST">
                                                <div class="mb-3 row">
                                                    <label class="col-form-label col-md-4">SMTP Host</label>
                                                    <div class="col-md-8">
                                                        <input type="text" class="form-control" autocomplete="off" name="s_host" value="<?= $s['host']; ?>">
                                                    </div>
                                                </div>
                                                <div class="mb-3 row">
                                                    <label class="col-form-label col-md-4">SMTP Username</label>
                                                    <div class="col-md-8">
                                                        <input type="text" class="form-control" autocomplete="off" name="s_user" value="<?= $s['user']; ?>">
                                                    </div>
                                                </div>
                                                <div class="mb-3 row">
                                                    <label class="col-form-label col-md-4">SMTP Password</label>
                                                    <div class="col-md-8">
                                                        <input type="password" class="form-control" autocomplete="off" name="s_pass" value="<?= $s['pass']; ?>">
                                                    </div>
                                                </div>
                                                <div class="mb-3 row">
                                                    <label class="col-form-label col-md-4">SMTP Port</label>
                                                    <div class="col-md-8">
                                                        <input type="number" class="form-control" autocomplete="off" name="s_port" value="<?= $s['port']; ?>">
                                                    </div>
                                                </div>
                                                <div class="text-end">
                                                    <button class="btn btn-secondary" type="reset">Batal</button>
                                                    <button class="btn btn-primary" type="submit" name="tombol_s" value="submit">Simpan</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                    
                                    <div class="card bg-coklat">
                                        <div class="card-body">
                                            <h5 class="card-title text-white">Tripay</h5>
                                            <form action="" method="POST">
                                                <div class="mb-3 row">
                                                    <label class="col-form-label col-md-4">Api Key</label>
                                                    <div class="col-md-8">
                                                        <input type="text" class="form-control" autocomplete="off" name="tripay_api" value="<?= $tripay['api']; ?>">
                                                    </div>
                                                </div>
                                                <div class="mb-3 row">
                                                    <label class="col-form-label col-md-4">Private Key</label>
                                                    <div class="col-md-8">
                                                        <input type="text" class="form-control" autocomplete="off" name="tripay_private" value="<?= $tripay['private']; ?>">
                                                    </div>
                                                </div>
                                                <div class="mb-3 row">
                                                    <label class="col-form-label col-md-4">Kode Merchant</label>
                                                    <div class="col-md-8">
                                                        <input type="text" class="form-control" autocomplete="off" name="tripay_merchant" value="<?= $tripay['merchant']; ?>">
                                                    </div>
                                                </div>
                                                <div class="text-end">
                                                    <button class="btn btn-secondary" type="reset">Batal</button>
                                                    <button class="btn btn-primary" type="submit" name="tombol_tripay" value="submit">Simpan</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                    
                                    <div class="card bg-coklat">
                                        <div class="card-body">
                                            <h5 class="card-title text-white">DigiFlazz</h5>
                                            <form action="" method="POST">
                                                <div class="mb-3 row">
                                                    <label class="col-form-label col-md-4">Username</label>
                                                    <div class="col-md-8">
                                                        <input type="text" class="form-control" autocomplete="off" name="digi_user" value="<?= $digi['user']; ?>">
                                                    </div>
                                                </div>
                                                <div class="mb-3 row">
                                                    <label class="col-form-label col-md-4">Production Key</label>
                                                    <div class="col-md-8">
                                                        <input type="text" class="form-control" autocomplete="off" name="digi_key" value="<?= $digi['key']; ?>">
                                                    </div>
                                                </div>
                                                <div class="text-end mb-3">
                                                    <button class="btn btn-secondary" type="reset">Batal</button>
                                                    <button class="btn btn-primary" type="submit" name="tombol_digi" value="submit">Simpan</button>
                                                </div>
                                         
                                            </form>
                                            
                                        </div>
                                    </div>
                            
                            
                            
                                
                           
                        </div>
                    </div>
                    <?php $this->endSection(); ?>

                    <?php $this->section('js'); ?>
                    
                    <?php $this->endSection(); ?>