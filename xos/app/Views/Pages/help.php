                    <?php $this->extend('template'); ?>

                    <?php $this->section('konten'); ?>
                    <div class="row justify-content-center">
                        <div class="col-xl-6 col-lg-8 col-md-10">
                            <div class="card bg-coklat">
                                <div class="card-body">
                                    <h5 class="card-title text-white">Bantuan</h5>
                                    <p>Silahkan hubungi kami melalui kontak berikut, atau kirim pesan melalui form dibawah</p>
                                    <div class="row mb-5 mt-5">
                                        <div class="col-md-6 text-center">
                                            <i data-feather="mail"></i>
                                            <h6 class="mt-3">Email</h6>
                                            <p><?= $help['email']; ?></p>
                                        </div>
                                        <div class="col-md-6 text-center">
                                            <i data-feather="phone-call"></i>
                                            <h6 class="mt-3">WhatsApp</h6>
                                            <p><?= $help['telpon']; ?></p>
                                        </div>
                                    </div>
                                    
                                    
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php $this->endSection(); ?>

                    <?php $this->section('js'); ?>
                    <?php $this->endSection(); ?>