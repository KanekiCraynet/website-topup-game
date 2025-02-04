                    <?php $this->extend('template'); ?>

                    <?php $this->section('konten'); ?>
                    <div class="row justify-content-center">
                        <div class="col-md-10">
                            <div class="row">
                                <div class="col-md-6">
                                    <a href="<?= base_url(); ?>/admin/page/tutor" class="text-dark">
                                        <div class="card bg-coklat">
                                            <div class="card-body text-center text-white">
                                                <i class="mb-4" data-feather="bookmark"></i>
                                                <h5>Cara Membeli</h5>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                                <div class="col-md-6">
                                    <a href="<?= base_url(); ?>/admin/page/faq" class="text-dark">
                                        <div class="card bg-coklat">
                                            <div class="card-body text-center text-white">
                                                <i class="mb-4" data-feather="info"></i>
                                                <h5>Pertanyaan Umum</h5>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                                <div class="col-md-6">
                                    <a href="<?= base_url(); ?>/admin/page/terms" class="text-dark">
                                        <div class="card bg-coklat">
                                            <div class="card-body text-center text-white">
                                                <i class="mb-4" data-feather="tag"></i>
                                                <h5>Syarat & Ketentuan</h5>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                                <div class="col-md-6">
                                    <a href="<?= base_url(); ?>/admin/page/help" class="text-dark">
                                        <div class="card bg-coklat">
                                            <div class="card-body text-center text-white">
                                                <i class="mb-4" data-feather="phone"></i>
                                                <h5>Bantuan</h5>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php $this->endSection(); ?>

                    <?php $this->section('js'); ?>
                    <?php $this->endSection(); ?>