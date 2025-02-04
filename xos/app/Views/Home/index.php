<?php $this->extend('template'); ?>
<?php $this->section('konten'); ?>

<!-- Section One -->
<div class="section-one">
    <div class="align-items-center justify-content-center">
        <img src="<?= $web['logo']; ?>" class="d-flex mx-auto" alt="" height="70">
        <div class="title text-center">
            <h3 class="fw-bold"><?= $web['author']; ?></h3>
            <p><?= $web['description']; ?></p>
        </div>
    </div>

    <div id="box-home">

        <?php if ($users == false): ?>

            <?php if (session('auth_error')): ?>
                <div class="alert alert-danger">
                    <?= session('auth_error'); ?>
                </div>
            <?php endif ?>

            <?php if (session('auth_success')): ?>
                <div class="alert alert-success">
                    <?= session('auth_success'); ?>
                </div>
            <?php endif ?>
            <?php if (session('reset_success')): ?>
                <div class="alert alert-success">
                    <?= session('reset_success'); ?>
                </div>
            <?php endif ?>
            <?php if (session('reset_error')): ?>
                <div class="alert alert-danger">
                    <?= session('reset_error'); ?>
                </div>
            <?php endif ?>
            <div class="text-center mb-4">
                <button type="button" onclick="sidebar_nav('masuk');" class="btn btn-primary">Masuk</button>
                <button type="button" onclick="sidebar_nav('daftar');" class="btn btn-light">Daftar</button>
            </div>
        <?php else : ?>
            <div class="text-center">
                <h3>Halo, <?= $users['username']; ?></h3>
            </div>
            <div class="row mt-3">
                <div class="col-md-3">
                    <div class="card bg-coklat">
                        <div class="card-body">
                            <div class="d-inline">
                                <div class="float-start">
                                    <p class="text-white mb-1">Sisa Saldo</p>
                                    <h4 class="text-white text-center mb-0">Rp <?= number_format($users['balance'], 0, ',', '.'); ?></h4>
                                </div>
                                <div class="float-end">
                                    <p class="text-white mb-1">Total Pembelian</p>
                                    <h4 class="text-white text-center mb-0"><?= number_format(count($orders), 0, ',', '.'); ?> x</h4>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        <?php endif ?>
    </div>

    <?php if ($users == false): ?>
        <div id="box-masuk" class="d-none mt-4 mx-auto" style="max-width:450px;">
            <div class="float-start me-3">
                <button onclick="sidebar_nav('home');" class="btn btn-primary">
                    <i data-feather="arrow-left"></i>
                </button>
            </div>
            <h4 class="text-primary mt-2 float-start">Masuk</h4>
            <div class="mb-4 clearfix"></div>
            <form action="<?= base_url(); ?>/" method="POST">
                <div class="mb-3">
                    <label class="mb-1">WhatsApp</label>
                   <input type="number" class="form-control" placeholder="Masukkan Nomor WhatsApp" autocomplete="off" required="required" name="whatsapp">
                </div>
                <div class="mb-4">
                    <label class="mb-1">Password</label>
                    <input type="password" class="form-control" placeholder="Masukkan Password" autocomplete="off" required="required" name="password">
                </div>
                <button type="submit" name="tombol" value="masuk" class="btn btn-primary w-100 mb-3">Masuk</button>
                <button type="button" onclick="sidebar_nav('reset');" class="btn btn-light float-end mb-4">Reset Password</button>
            </form>
        </div>

        <div id="box-daftar" class="d-none mt-4 mx-auto" style="max-width:450px;">
            <div class="float-start me-3">
                <button onclick="sidebar_nav('home');" class="btn btn-primary">
                    <i data-feather="arrow-left"></i>
                </button>
            </div>
            <h4 class="text-primary mt-2 float-start">Daftar</h4>
            <div class="mb-4 clearfix"></div>
            <form action="<?= base_url(); ?>/" method="POST">
                <div class="mb-3">
                    <label class="mb-1">Username</label>
                    <input type="text" class="form-control" placeholder="Masukkan Username" autocomplete="off" required="required" name="username">
                </div>
                <div class="mb-3">
                    <label class="mb-1">No WhatsApp</label>
                   <input type="number" class="form-control" placeholder="Masukkan Nomor WhatsApp" autocomplete="off" required="required" name="whatsapp">
                </div>
                <div class="mb-4">
                    <label class="mb-1">Password</label>
                    <input type="password" class="form-control" placeholder="Masukkan Password" autocomplete="off" required="required" name="password">
                </div>
                <button type="submit" name="tombol" value="daftar" class="btn btn-primary w-100">Daftar</button>
            </form>
        </div>
        
        <div id="box-reset" class="d-none mt-4 mx-auto" style="max-width:450px;">
            <div class="float-start me-3">
                <button onclick="sidebar_nav('home');" class="btn btn-primary">
                    <i data-feather="arrow-left"></i>
                </button>
            </div>
            <h4 class="text-primary mt-2 float-start">Reset Password</h4>
            <div class="mb-4 clearfix"></div>
            <form action="#" method="POST">
                <div class="mb-3">
                    <label class="mb-1">Nomor WhatsApp</label>
                   <input type="number" class="form-control" placeholder="Masukkan Nomor WhatsApp" autocomplete="off" required="required" name="whatsapp">
                </div>
                <button type="submit" name="tombol" value="reset" class="btn btn-primary w-100">Reset Password</button>
            </form>
        </div>
    <?php endif; ?>
</div>
</div>                    
                
<div class="mx-auto" style="max-width: 650px;">
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
    
<div class="overflow-auto">
  <ul class="nav nav-pills flex-nowrap mb-4" id="pills-tab" role="tablist">
    <?php foreach ($games as $key => $game): ?>
      <li class="nav-item" role="presentation">
        <button class="nav-link <?= $key === 0 ? 'active' : ''; ?>" id="<?= $game['name']; ?>-tab" data-bs-toggle="pill" data-bs-target="#<?= $game['name']; ?>" type="button" role="tab" aria-controls="<?= $game['name']; ?>" aria-selected="<?= $key === 0 ? 'true' : 'false'; ?>" style="border-radius: 30px; margin-right: 12px;">
          <?= $game['name']; ?>
        </button>
      </li>
    <?php endforeach ?>
  </ul>
</div>

<div class="tab-content mt-4" id="pills-tabContent">
  <?php foreach ($games as $key => $game): ?>
    <div class="tab-pane fade <?= $key === 0 ? 'show active' : ''; ?>" id="<?= $game['name']; ?>" role="tabpanel" aria-labelledby="<?= $game['name']; ?>-tab">
      <div class="text-center">
    <div class="row">
        <?php foreach ($game['games'] as $data_loop): ?>
            <div class="col-6 col-lg-4 col-xl-3">
                <a class="of-game" href="<?= base_url(); ?>/buy/games/<?= $data_loop['slug']; ?>">
                    <?php if (filter_var($data_loop['images'], FILTER_VALIDATE_URL)): ?>
                        <img src="<?= $data_loop['images']; ?>" alt="" class="w-100">
                    <?php else: ?>
                        <img src="<?= base_url(); ?>/assets/images/games/<?= $data_loop['images']; ?>" alt="" class="w-100">
                    <?php endif ?>
                    <div class="">
                        <div class="">
                            <p class="mb-0 mt-2 text-center text-white"><?= $data_loop['name']; ?></p>
                        </div>
                    </div>
                </a>
            </div>
        <?php endforeach; ?>
    </div>
</div>
    </div>
  <?php endforeach ?>
</div>

    
</div>
<?php $this->endSection(); ?>

<?php $this->section('js'); ?>
<?php $this->endSection(); ?>