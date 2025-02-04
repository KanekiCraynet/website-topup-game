                    <?php $this->extend('template'); ?>

                    <?php $this->section('konten'); ?>
                    <div class="row justify-content-center">
                        <div class="col-md-10">
                            <div class="card bg-coklat">
                                <div class="card-body">
                                    <h5 class="card-title text-white">
                                        <a href="<?= base_url(); ?>/admin/page"><i class="me-1" data-feather="arrow-left"></i></a>
                                        Pertanyaan Umum
                                    </h5>
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
                                    <button type="button" class="btn btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#exampleModal">Tambah</button>
                                    <div class="table-responsive">
                                        <table class="table border table-dark">
                                            <tr>
                                                <th>Judul</th>
                                                <th>Konten</th>
                                                <th>Action</th>
                                            </tr>
                                            <?php foreach ($faqs as $faq): ?>
                                            <tr>
                                                <td><?= $faq['title']; ?></td>
                                                <td><?= $faq['content']; ?></td>
                                                <td style="width: 10;white-space: nowrap;">
                                                    <button onclick="edit('<?= $faq['id']; ?>');" class="btn btn-sm btn-primary border-0">Edit</button>
                                                    <button onclick="hapus('<?= base_url(); ?>/admin/page/faq/delete/<?= $faq['id']; ?>');" class="btn btn-sm btn-danger border-0">Hapus</button>
                                                </td>
                                            </tr>
                                            <?php endforeach ?>
                                            <?php if (count($faqs) == 0): ?>
                                            <tr>
                                                <td colspan="3" align="center">Tidak ada data</td>
                                            </tr>
                                            <?php endif ?>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php $this->endSection(); ?>

                    <?php $this->section('js'); ?>
                    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content bg-coklat">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Tambah</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <form action="" method="POST">
                                    <div class="modal-body">
                                        <div class="mb-3">
                                            <label class="mb-1">Judul</label>
                                            <input type="text" class="form-control" autocomplete="off" name="title">
                                        </div>
                                        <div class="mb-3">
                                            <label class="mb-1">Konten</label>
                                            <textarea name="content" cols="30" rows="4" class="form-control"></textarea>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary border-0" data-bs-dismiss="modal">Batal</button>
                                        <button type="submit" class="btn btn-primary border-0" name="tombol" value="submit">Tambah</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>

                    <div class="modal fade" id="modal-edit" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content bg-coklat">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Edit</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <form action="" method="POST">
                                    <div class="modal-body">
                                        <div class="mb-3">
                                            <label class="mb-1">Judul</label>
                                            <input type="hidden" name="id" id="input-id">
                                            <input type="text" class="form-control" autocomplete="off" name="title" id="input-title">
                                        </div>
                                        <div class="mb-3">
                                            <label class="mb-1">Konten</label>
                                            <textarea name="content" cols="30" rows="4" class="form-control" id="input-content"></textarea>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary border-0" data-bs-dismiss="modal">Batal</button>
                                        <button type="submit" class="btn btn-primary border-0" name="edit" value="submit">Simpan</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>

                    <script>

                        var modal_edit = new bootstrap.Modal(document.getElementById('modal-edit'));

                        function edit(id) {
                            $.ajax({
                                url: '<?= base_url(); ?>/admin/page/faq/get-data/' + id,
                                type: 'Get',
                                datType: 'JSON',
                                success: function(result) {

                                    var faq = result.split('##000###');

                                    $("#input-id").val(id);
                                    $("#input-title").val(faq[0]);
                                    $("#input-content").val(faq[1]);

                                    modal_edit.show();
                                }
                            });
                        }
                    </script>
                    <?php $this->endSection(); ?>