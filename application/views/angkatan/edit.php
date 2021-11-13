<div class="page-heading">
    <div class="page-title">
        <div class="row">
            <div class="col-12 col-md-6 order-md-1 order-last">
                <h3>Tambah data angkatan</h3>
                <p class="text-subtitle text-muted">Multiple form layout you can use</p>
            </div>
            <div class="col-12 col-md-6 order-md-2 order-first">
                <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="<?=base_url()?>">Dashboard</a></li>
                        <li class="breadcrumb-item"><a href="<?=base_url('angkatan')?>">Angkatan</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Tambah data</li>
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
                        <h4 class="card-title">Form tambah</h4>
                    </div>
                    <div class="card-content">
                        <div class="card-body">
                            <form class="form form-horizontal" method="post" action="">
                                <div class="form-body">
                                    <div class="row">
                                        <div class="col-md-4">
                                            <label>Tahun Angkatan</label>
                                        </div>
                                        <div class="col-md-8 form-group">
                                            <input type="text" class="form-control <?=(form_error('tahun_angkatan')? 'is-invalid':'')?>" name="tahun_angkatan" placeholder="2021" value="<?=$angkatan->tahun_angkatan?>">
                                            <?= form_error('tahun_angkatan')?>
                                        </div>
                                        <div class="col-md-4">
                                            <label>Nominal Pendaftaran</label>
                                        </div>
                                        <div class="col-md-8 form-group">
                                            <input type="text" class="form-control <?=(form_error('tahun_ajaran')? 'is-invalid':'')?>" name="tahun_ajaran" placeholder="2021-2022" value="<?=$angkatan->tahun_ajaran?>">
                                            <?= form_error('tahun_ajaran')?>
                                        </div>
                                        <div class="col-sm-12 d-flex justify-content-end">
                                            <button type="submit"class="btn btn-primary me-1 mb-1">Simpan</button>
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