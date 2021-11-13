<div class="page-heading">
    <div class="page-title">
        <div class="row">
            <div class="col-12 col-md-6 order-md-1 order-last">
                <h3>Tambah data buku</h3>
                <p class="text-subtitle text-muted">Multiple form layout you can use</p>
            </div>
            <div class="col-12 col-md-6 order-md-2 order-first">
                <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="<?=base_url()?>">Dashboard</a></li>
                        <li class="breadcrumb-item"><a href="<?=base_url('buku')?>">Buku</a></li>
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
                                            <label>Nama Buku</label>
                                        </div>
                                        <div class="col-md-8 form-group">
                                            <input type="text" class="form-control <?=(form_error('nama_buku')? 'is-invalid':'')?>" name="nama_buku" placeholder="Buku LKS Seni Budaya">
                                            <?= form_error('nama_buku')?>
                                        </div>
                                        <div class="col-md-4">
                                            <label>Harga Buku</label>
                                        </div>
                                        <div class="col-md-8 form-group">
                                            <input type="number" class="form-control <?=(form_error('harga')? 'is-invalid':'')?>" name="harga" placeholder="100000">
                                            <?= form_error('harga')?>
                                        </div>
                                        <!-- <div class="col-md-4">
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