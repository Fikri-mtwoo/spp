<div class="page-heading">
    <div class="page-title">
        <div class="row">
            <div class="col-12 col-md-6 order-md-1 order-last">
                <h3>Tambah data spp</h3>
                <p class="text-subtitle text-muted">Multiple form layout you can use</p>
            </div>
            <div class="col-12 col-md-6 order-md-2 order-first">
                <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="<?=base_url()?>">Dashboard</a></li>
                        <li class="breadcrumb-item"><a href="<?=base_url('spp')?>">SPP</a></li>
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
                                            <select class="form-select " name="tahun_angkatan">
                                                <option value="">Angkatan</option>
                                                <?php foreach ($angkatan as $akt) :?>
                                                    <option value="<?=$akt['id_angkatan']?>"><?=$akt['tahun_angkatan']?></option>
                                                <?php endforeach?>
                                            </select>
                                            <?= form_error('tahun_angkatan')?>
                                        </div>
                                        <div class="col-md-4">
                                            <label>Nominal Pendaftaran</label>
                                        </div>
                                        <div class="col-md-8 form-group">
                                            <input type="number" class="form-control <?=(form_error('pendaftaran')? 'is-invalid':'')?>" name="pendaftaran" placeholder="100000">
                                            <?= form_error('pendaftaran')?>
                                        </div>
                                        <div class="col-md-4">
                                            <label>Nominal Gedung</label>
                                        </div>
                                        <div class="col-md-8 form-group">
                                            <input type="number" class="form-control <?=(form_error('gedung')? 'is-invalid':'')?>" name="gedung" placeholder="1000000">
                                            <?= form_error('gedung')?>
                                        </div>
                                        <div class="col-md-4">
                                            <label>Nominal SPP</label>
                                        </div>
                                        <div class="col-md-8 form-group">
                                            <input type="number" class="form-control <?=(form_error('spp')? 'is-invalid':'')?>" name="spp" placeholder="50000">
                                            <?= form_error('spp')?>
                                        </div>
                                        <div class="col-sm-12 d-flex justify-content-end">
                                            <button type="submit"class="btn btn-primary me-1 mb-1">Submit</button>
                                            <button type="reset"class="btn btn-light-secondary me-1 mb-1">Reset</button>
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