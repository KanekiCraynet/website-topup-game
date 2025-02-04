<?php $this->extend('template'); ?>

<?php $this->section('konten'); ?>
<div class="row">
    <div class="alert alert-primary">
        Menampilkan hasil pencarian : <?= $search; ?>
    </div>
    <?php foreach ($games as $data_loop): ?>
    <div class="col-6 col-md-3 col-lg-3">
        <div class="">
            <a class="of-game" href="<?= base_url(); ?>/buy/games/<?= $data_loop['slug']; ?>">
                <img src="<?= $data_loop['images']; ?>" alt="" class="w-100">
                <img src="/assets/images/games/<?= $data_loop['images']; ?>" alt="" class="w-100">
                <p class="mb-0 mt-2 text-center"><?= $data_loop['name']; ?></p>
            </a>
        </div>
    </div>
    <?php endforeach; ?>
</div>
<?php $this->endSection(); ?>

<?php $this->section('js'); ?>
<?php $this->endSection(); ?>