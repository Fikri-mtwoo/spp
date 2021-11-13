<div class="page-heading">
    <div class="page-title">
        <div class="row">
            <div class="col-12 col-md-6 order-md-1 order-last">
                <h3>Tambah data siswa</h3>
                <p class="text-subtitle text-muted">Multiple form layout you can use</p>
            </div>
            <div class="col-12 col-md-6 order-md-2 order-first">
                <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="<?=base_url()?>">Dashboard</a></li>
                        <li class="breadcrumb-item"><a href="<?=base_url('siswa')?>">Siswa</a></li>
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
                                            <label>NISN Siswa</label>
                                        </div>
                                        <div class="col-md-8 form-group">
                                            <input type="number" class="form-control <?=(form_error('nisn')? 'is-invalid':'')?>" name="nisn" placeholder="xxxxxxxxxx" value="<?=set_value('nisn')?>">
                                            <?= form_error('nisn')?>
                                        </div>
                                        <div class="col-md-4">
                                            <label>NIS Siswa </label>
                                        </div>
                                        <div class="col-md-8 form-group">
                                            <input type="number" class="form-control <?=(form_error('nis')? 'is-invalid':'')?>" name="nis" placeholder="xxxxxxxxxx" value="<?=set_value('nis')?>">
                                            <?= form_error('nis')?>
                                        </div>
                                        <div class="col-md-4">
                                            <label>Nama Siswa</label>
                                        </div>
                                        <div class="col-md-8 form-group">
                                            <input type="text" class="form-control <?=(form_error('nama')? 'is-invalid':'')?>" name="nama" placeholder="Nama Siswa" value="<?=set_value('nama')?>">
                                            <?= form_error('nama')?>
                                        </div>
                                        <div class="col-md-4">
                                            <label>Jenis Kelamin</label>
                                        </div>
                                        <div class="col-md-8 form-group">
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input" type="radio" name="jk" value="laki-laki">
                                                <label class="form-check-label" >Laki-Laki</label>
                                            </div>
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input" type="radio" name="jk" value="perempuan">
                                                <label class="form-check-label">Perempuan</label>
                                            </div>
                                            <?= form_error('jk')?>
                                        </div>
                                        <div class="col-md-4">
                                            <label>Alamat Siswa</label>
                                        </div>
                                        <div class="col-md-8 form-group">
                                            <textarea class="form-control <?=(form_error('alamat')? 'is-invalid':'')?>" name="alamat" rows="3"><?=set_value('alamat')?></textarea>
                                            <?= form_error('alamat')?>
                                        </div>
                                        <div class="col-md-4">
                                            <label>Nomor Telepon/Hp</label>
                                        </div>
                                        <div class="col-md-8 form-group">
                                            <input type="number" class="form-control <?=(form_error('tlp')? 'is-invalid':'')?>" name="tlp" placeholder="08xxxxxxxxxx" value="<?=set_value('tlp')?>">
                                            <?= form_error('tlp')?>
                                        </div>
                                        <div class="col-md-4">
                                            <label>Tahun Angkatan</label>
                                        </div>
                                        <div class="col-md-8 form-group">
                                            <select class="form-select <?=(form_error('angkatan')? 'is-invalid':'')?>" name="angkatan">
                                                <option value="">Pilih tahun angkatan</option>
                                                    <?php foreach ($angkatan as $akt) :?>
                                                        <option value="<?=$akt['id_angkatan']?>"><?=$akt['tahun_angkatan']?></option>
                                                    <?php endforeach?>
                                            </select>
                                            <?= form_error('angkatan')?>
                                        </div>
                                        <div class="col-md-4">
                                            <label>Kelas Siswa</label>
                                        </div>
                                        <div class="col-md-8 form-group">
                                            <select class="form-select <?=(form_error('kelas')? 'is-invalid':'')?>" name="kelas">
                                                <option value="">Pilih kelas</option>
                                                    <?php foreach ($kelas as $kls) :?>
                                                        <option value="<?=$kls['id_kelas']?>"><?=$kls['nama_kelas']?></option>
                                                    <?php endforeach?>
                                            </select>
                                            <?= form_error('kelas')?>
                                        </div>
                                        <div class="col-md-4">
                                            <label>Jurusan Siswa</label>
                                        </div>
                                        <div class="col-md-8 form-group">
                                            <select class="form-select <?=(form_error('jurusan')? 'is-invalid':'')?>" name="jurusan">
                                                <option value="">Pilih jurusan</option>
                                                    <?php foreach ($jurusan as $jsn) :?>
                                                        <option value="<?=$jsn['id_jurusan']?>"><?=$jsn['nama_jurusan']."/".$jsn['urut_jurusan']?></option>
                                                    <?php endforeach?>
                                            </select>
                                            <?= form_error('jurusan')?>
                                        </div>
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