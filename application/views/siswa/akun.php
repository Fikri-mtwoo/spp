<div class="page-heading">
    <div class="page-title">
        <div class="row">
            <div class="col-12 col-md-6 order-md-1 order-last">
                <h3>Edit akun siswa</h3>
                <p class="text-subtitle text-muted">Multiple form layout you can use</p>
            </div>
            <div class="col-12 col-md-6 order-md-2 order-first">
                <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="<?=base_url()?>">Dashboard</a></li>
                        <li class="breadcrumb-item"><a href="<?=base_url('siswa')?>">Siswa</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Edit akun</li>
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
                            <form class="form form-horizontal" method="post" action="" enctype="multipart/form-data">
                                <div class="form-body">
                                    <div class="row">
                                        <div class="col-md-4">
                                            <label>NISN Siswa</label>
                                        </div>
                                        <div class="col-md-8 form-group">
                                            <input type="number" class="form-control <?=(form_error('nisn')? 'is-invalid':'')?>" name="nisn" placeholder="xxxxxxxxxx" value="<?=$siswa->nisn_siswa?>" readonly>
                                            <?= form_error('nisn')?>
                                        </div>
                                        <div class="col-md-4">
                                            <label>NIS Siswa </label>
                                        </div>
                                        <div class="col-md-8 form-group">
                                            <input type="number" class="form-control <?=(form_error('nis')? 'is-invalid':'')?>" name="nis" placeholder="xxxxxxxxxx" value="<?=$siswa->nis_siswa?>" readonly>
                                            <?= form_error('nis')?>
                                        </div>
                                        <div class="col-md-4">
                                            <label>Nama Siswa</label>
                                        </div>
                                        <div class="col-md-8 form-group">
                                            <input type="text" class="form-control <?=(form_error('nama')? 'is-invalid':'')?>" name="nama" placeholder="Nama Siswa" value="<?=$siswa->nama_siswa?>" readonly>
                                            <?= form_error('nama')?>
                                        </div>
                                        <div class="col-md-4">
                                            <label>Profile Siswa</label>
                                        </div>
                                        <div class="col-md-2 form-group">
                                            <?php if(empty($siswa->profile)):?>
                                                <img src="<?=base_url('assets/images/avatar.jpg')?>" width="50%">
                                            <?php else :?>
                                                <img src="<?=base_url('assets/images/').''.$siswa->profile?>" width="50%">
                                            <?php endif?>
                                        </div>
                                        <div class="col-md-6 form-group">
                                            <input type="file" class="form-control-file" name="profile">
                                            <input type="hidden" name="profile_lama" value="<?=$siswa->profile?>">
                                            <?php if(!empty($error)) :?>
                                                <small class="form-text text-danger"><?=$error?></small>
                                            <?php endif?>
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