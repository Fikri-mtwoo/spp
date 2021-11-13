<div class="page-heading">
    <div class="page-title">
        <div class="row">
            <div class="col-12 col-md-6 order-md-1 order-last">
                <h3>Edit data siswa</h3>
                <p class="text-subtitle text-muted">Multiple form layout you can use</p>
            </div>
            <div class="col-12 col-md-6 order-md-2 order-first">
                <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="<?=base_url()?>">Dashboard</a></li>
                        <li class="breadcrumb-item"><a href="<?=base_url('siswa')?>">Siswa</a></li>
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
                                            <input type="number" class="form-control <?=(form_error('nis')? 'is-invalid':'')?>" name="nis" placeholder="xxxxxxxxxx" value="<?=$siswa->nis_siswa?>">
                                            <?= form_error('nis')?>
                                        </div>
                                        <div class="col-md-4">
                                            <label>Nama Siswa</label>
                                        </div>
                                        <div class="col-md-8 form-group">
                                            <input type="text" class="form-control <?=(form_error('nama')? 'is-invalid':'')?>" name="nama" placeholder="Nama Siswa" value="<?=$siswa->nama_siswa?>">
                                            <?= form_error('nama')?>
                                        </div>
                                        <div class="col-md-4">
                                            <label>Jenis Kelamin</label>
                                        </div>
                                        <div class="col-md-8 form-group">
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input" type="radio" name="jk" value="laki-laki" <?=($siswa->jenis_kelamin == 'laki-laki')? 'checked':''?>>
                                                <label class="form-check-label" >Laki-Laki</label>
                                            </div>
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input" type="radio" name="jk" value="perempuan" <?=($siswa->jenis_kelamin == 'perempuan')? 'checked':''?>>
                                                <label class="form-check-label">Perempuan</label>
                                            </div>
                                            <?= form_error('jk')?>
                                        </div>
                                        <div class="col-md-4">
                                            <label>Alamat Siswa</label>
                                        </div>
                                        <div class="col-md-8 form-group">
                                            <textarea class="form-control <?=(form_error('alamat')? 'is-invalid':'')?>" name="alamat" rows="3"><?=$siswa->alamat?></textarea>
                                            <?= form_error('alamat')?>
                                        </div>
                                        <div class="col-md-4">
                                            <label>Nomor Telepon/Hp</label>
                                        </div>
                                        <div class="col-md-8 form-group">
                                            <input type="number" class="form-control <?=(form_error('tlp')? 'is-invalid':'')?>" name="tlp" placeholder="08xxxxxxxxxx" value="<?=$siswa->no_telp?>">
                                            <?= form_error('tlp')?>
                                        </div>
                                        <div class="col-md-4">
                                            <label>Kelas Siswa</label>
                                        </div>
                                        <div class="col-md-8 form-group">
                                            <select class="form-select <?=(form_error('kelas')? 'is-invalid':'')?>" name="kelas" >
                                                <option value="">Pilih kelas</option>
                                                    <?php foreach ($kelas as $kls) :?>
                                                        <?php if($siswa->id_kelas == $kls['id_kelas']):?> 
                                                            <option value="<?=$kls['id_kelas']?>" selected><?=$kls['nama_kelas']?></option>
                                                        <?php else :?>
                                                                <option value="<?=$kls['id_kelas']?>" ><?=$kls['nama_kelas']?></option>
                                                        <?php endif?>
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
                                                        <?php if($siswa->id_jurusan == $jsn['id_jurusan']):?>
                                                            <option value="<?=$jsn['id_jurusan']?>" selected><?=$jsn['nama_jurusan']?></option>
                                                        <?php else :?>
                                                            <option value="<?=$jsn['id_jurusan']?>"><?=$jsn['nama_jurusan']?></option>
                                                        <?php endif?>
                                                    <?php endforeach?>
                                            </select>
                                            <?= form_error('jurusan')?>
                                        </div>
                                        <div class="col-md-4">
                                            <label>Status Siswa</label>
                                        </div>
                                        <div class="col-md-8 form-group">
                                            <select class="form-select <?=(form_error('status')? 'is-invalid':'')?>" name="status">
                                                <option value="">Pilih Status</option>
                                                <option value="aktif" <?=($siswa->status == 'aktif')? 'selected':''?>>Aktif</option>
                                                <option value="keluar" <?=($siswa->status == 'keluar')? 'selected':''?>>Keluar</option>
                                                <option value="pindah" <?=($siswa->status == 'pindah')? 'selected':''?>>Pindah</option>
                                                <option value="berhenti" <?=($siswa->status == 'berhenti')? 'selected':''?>>Berhenti</option>
                                            </select>
                                            <?= form_error('status')?>
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