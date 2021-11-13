
<div class="page-heading">
    <div class="page-title">
        <div class="row">
            <div class="col-12 col-md-6 order-md-1 order-last">
                <h3>Tambah tagihan spp siswa</h3>
                <p class="text-subtitle text-muted">Multiple form layout you can use</p>
            </div>
            <div class="col-12 col-md-6 order-md-2 order-first">
                <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="<?=base_url()?>">Dashboard</a></li>
                        <li class="breadcrumb-item"><a href="<?=base_url('tagihanspp')?>">Tagihan SPP</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Tambah tagihan spp siswa</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>

    <section id="basic-horizontal-layouts">
        <div class="row match-height justify-content-center">
            <div class="col-md-6 col-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Form tambah</h4>
                    </div>
                    <div class="card-content">
                        <div class="card-body">
                            <!-- <div class="row"> -->
                                <!-- <div class="col-md"> -->
                                    <form class="form form-horizontal">
                                        <div class="form-body">
                                            <div class="row">
                                                <div class="col-md-4">
                                                    <label>Kelas Siswa</label>
                                                </div>
                                                <div class="col-md-8 form-group">
                                                    <select class="form-select" name="kelas">
                                                        <option value="">Pilih kelas</option>
                                                            <?php foreach ($kelas as $kls) :?>
                                                                <option value="<?=$kls['id_kelas']?>"><?=$kls['nama_kelas']?></option>
                                                            <?php endforeach?>
                                                    </select>
                                                </div>
                                                <div class="col-md-4">
                                                    <label>Jurusan Siswa</label>
                                                </div>
                                                <div class="col-md-8 form-group">
                                                    <select class="form-select" name="jurusan">
                                                        <option value="">Pilih jurusan</option>
                                                            <?php foreach ($jurusan as $jsn) :?>
                                                                <option value="<?=$jsn['id_jurusan']?>"><?=$jsn['nama_jurusan']."/".$jsn['urut_jurusan']?></option>
                                                            <?php endforeach?>
                                                    </select>
                                                </div>
                                                <div class="col-md-4">
                                                    <label>Tahun Angkatan</label>
                                                </div>
                                                <div class="col-md-8 form-group">
                                                    <select class="form-select" name="angkatan">
                                                        <option value="">Pilih jurusan</option>
                                                            <?php foreach ($angkatan as $akt) :?>
                                                                <option value="<?=$akt['id_angkatan']?>"><?=$akt['tahun_angkatan']?></option>
                                                            <?php endforeach?>
                                                    </select>
                                                </div>
                                                <div class="col-sm-12 d-flex justify-content-end">
                                                    <button type="button"class="btn btn-block btn-primary me-1 mb-1 cari">Cari</button>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                <!-- </div> -->
                                <!-- <div class="col-md"> -->
                                    <form class="form form-horizontal" method="post" action="<?=base_url('tagihanspp/proses_tambah')?>">
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="form-check">
                                                </div>
                                                <div class="col-sm-12 d-flex justify-content-end notif">
                                                </div>
                                                <div class="col-sm-12 d-flex justify-content-end">
                                                    <input type="hidden" name="angkatan">
                                                    <input type="hidden" name="kelas">
                                                    <button type="sumbit" class="btn btn-block btn-success me-1 mb-1 d-none tambah">Tambah</button>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                <!-- </div> -->
                            <!-- </div> -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>