<div class="page-heading">
    <div class="page-title">
        <div class="row">
            <div class="col-12 col-md-6 order-md-1 order-last">
                <h3>Edit data jurusan</h3>
                <p class="text-subtitle text-muted">Multiple form layout you can use</p>
            </div>
            <div class="col-12 col-md-6 order-md-2 order-first">
                <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="<?=base_url()?>">Dashboard</a></li>
                        <li class="breadcrumb-item"><a href="<?=base_url('jurusan')?>">Jurusan</a></li>
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
                                            <label>Nama Jurusan</label>
                                        </div>
                                        <div class="col-md-8 form-group">
                                            <input type="text" class="form-control <?=(form_error('nama_jurusan')? 'is-invalid':'')?>" name="nama_jurusan" placeholder="Teknik Komputer dan Jaringan" value="<?=$jurusan->nama_jurusan?>">
                                            <input type="hidden" name="id" value="<?=$jurusan->id_jurusan?>">
                                            <?= form_error('nama_jurusan')?>
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