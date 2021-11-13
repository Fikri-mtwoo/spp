<div class="page-heading">
    <div class="page-title">
        <div class="row">
            <div class="col-12 col-md-6 order-md-1 order-last">
                <h3>Edit data kelas</h3>
                <p class="text-subtitle text-muted">Multiple form layout you can use</p>
            </div>
            <div class="col-12 col-md-6 order-md-2 order-first">
                <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="<?=base_url()?>">Dashboard</a></li>
                        <li class="breadcrumb-item"><a href="<?=base_url('kelas')?>">Kelas</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Edit data</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>

    <section id="basic-horizontal-layouts">
        <div class="row match-height justify-content-center">
            <div class="col-md-9 col-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Form edit</h4>
                    </div>
                    <div class="card-content">
                        <div class="card-body">
                            <form class="form form-horizontal" method="post" action="">
                                <div class="form-body">
                                    <div class="row">
                                        <div class="col-md-4">
                                            <label>Nama Kelas</label>
                                        </div>
                                        <div class="col-md-8 form-group">
                                            <input type="number" class="form-control <?=(form_error('nama_kelas')? 'is-invalid':'')?>" name="nama_kelas" placeholder="10" value="<?=$kelas->nama_kelas?>">
                                            <input type="hidden" name="id" value="<?=$kelas->id_kelas?>">
                                            <?= form_error('nama_kelas')?>
                                        </div>
                                        <div class="col-md-4">
                                            <label>Romawi Kelas</label>
                                        </div>
                                        <div class="col-md-8 form-group">
                                            <input type="text" class="form-control <?=(form_error('romawi')? 'is-invalid':'')?>" name="romawi" placeholder="X" value="<?=$kelas->romawi_kelas?>">
                                            <?= form_error('romawi')?>
                                        </div>
                                        <!-- <div class="col-md-4">
                                            <label>Urutan Jurusan</label>
                                        </div>
                                        <div class="col-md-8 form-group">
                                            <input type="text" class="form-control <?=(form_error('urut')? 'is-invalid':'')?>" name="urut" placeholder="A">
                                            <?= form_error('urut')?>
                                        </div> -->
                                        <!-- <div class="col-md-4">
                                            <label>Nominal SPP</label>
                                        </div>
                                        <div class="col-md-8 form-group">
                                            <input type="number" class="form-control <?=(form_error('spp')? 'is-invalid':'')?>" name="spp" placeholder="50000">
                                            <?= form_error('spp')?>
                                        </div> -->
                                        <div class="col-sm-12 d-flex justify-content-end">
                                            <button type="submit"class="btn btn-primary me-1 mb-1">Kirim</button>
                                            <button type="reset"class="btn btn-light-secondary me-1 mb-1">Batal</button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>