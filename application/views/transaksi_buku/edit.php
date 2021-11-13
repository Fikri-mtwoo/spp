<div class="page-heading">
    <div class="page-title">
        <div class="row">
            <div class="col-12 col-md-6 order-md-1 order-last">
                <h3>Transaksi buku</h3>
                <p class="text-subtitle text-muted">Multiple form layout you can use</p>
            </div>
            <div class="col-12 col-md-6 order-md-2 order-first">
                <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="<?=base_url()?>">Dashboard</a></li>
                        <li class="breadcrumb-item"><a href="<?=base_url('transaksibuku')?>">Transaksi Gedung</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Edit bayar transaksi</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>

    <section id="basic-horizontal-layouts">
        <div class="row match-height justify-content-center">
            <div class="col-md-4 col-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Edit pembayaran</h4>
                    </div>
                    <div class="card-content">
                        <div class="card-body">
                            <form class="form form-horizontal" action="<?=base_url('transaksibuku/proses_edit')?>" method="POST">
                                <div class="form-body">
                                    <div class="row">
                                        <div class="col-md-12 form-group">
                                            <input type="text" name="kelas" class="form-control" value="Kelas <?=$transaksi->nama_kelas?>" readonly>
                                        </div>
                                        <div class="col-md-12 form-group">
                                            <input type="text" name="keterangan" class="form-control" value="<?=$transaksi->keterangan?>" >
                                            <input type="hidden" name="id" value="<?=$transaksi->id_transaksi_buku?>">
                                        </div>
                                        <div class="col-md-12 form-group">
                                            <input type="number" name="jumlah_bayar" class="form-control" value="<?=$transaksi->jumlah_bayar?>">
                                        </div>
                                        <div class="col-sm-12 d-flex justify-content-end">
                                            <button type="submit"class="btn btn-block btn-primary me-1 mb-1">Simpan</button>
                                        </div>
                                    </div>
                                </div>
                            </form>     
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-8 col-12">
                <div class="card">
                    <div class="card-content">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-5">
                                    <img src="<?=base_url('assets/images/avatar.jpg')?>" class="img-thumbnail foto" width="75%">
                                </div>
                                <div class="col-md-7">
                                    <div class="row">
                                        <div class="col-md-12 mb-1">
                                            <input type="text" name="nama" readonly class="form-control form-control-sm" value="<?=$transaksi->nama_siswa?>">
                                        </div>
                                        <div class="col-md-12 mb-1">
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input laki-laki" type="radio" <?=($transaksi->jenis_kelamin == 'laki-laki') ? 'checked':''?> disabled>
                                                <label class="form-check-label" >Laki-laki</label>
                                            </div>
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input perempuan" type="radio" <?=($transaksi->jenis_kelamin == 'perempuan') ? 'checked':''?> disabled>
                                                <label class="form-check-label" >Perempuan</label>
                                            </div>
                                        </div>
                                        <div class="col-md-12 mb-1">
                                            <input type="text" name="no_tlp" readonly class="form-control form-control-sm" value="<?=$transaksi->no_telp?>">
                                        </div>
                                        <div class="col-md-12 mb-1">
                                            <textarea name="alamat"  class="form-control form-control-sm" readonly><?=$transaksi->alamat?></textarea>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <form class="form form-horizontal">
                                <div class="row">
                                    <div class="col-md-12">
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-check"></div>
                                        <div class="col-sm-12 d-flex justify-content-end notif"></div>
                                    </div>
                                    <div class="col-12 label-buku"></div>
                                    <div class="col-md-12">
                                        <div class="col-sm-12 d-flex justify-content-end notif-buku"></div>
                                        <ul class="list-unstyled mb-0 list-buku"></ul>
                                    </div>
                                    <div class="col-sm-12 d-flex justify-content-end">
                                        <input type="hidden" name="kelas">
                                        <button type="sumbit" class="btn btn-block btn-success me-1 mb-1 d-none tambah">Tambah</button>
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