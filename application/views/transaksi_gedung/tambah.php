<div class="page-heading">
    <div class="page-title">
        <div class="row">
            <div class="col-12 col-md-6 order-md-1 order-last">
                <h3>Transaksi gedung</h3>
                <p class="text-subtitle text-muted">Multiple form layout you can use</p>
            </div>
            <div class="col-12 col-md-6 order-md-2 order-first">
                <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="<?=base_url()?>">Dashboard</a></li>
                        <li class="breadcrumb-item"><a href="<?=base_url('transaksigedung')?>">Transaksi Gedung</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Form bayar transaksi</li>
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
                        <h4 class="card-title">Form pencarian siswa</h4>
                    </div>
                    <div class="card-content">
                        <div class="card-body">
                            <form class="form form-horizontal">
                                <div class="form-body">
                                    <div class="row">
                                        <div class="col-md-12 form-group">
                                            <input type="text" name="nisn" class="form-control" placeholder="masukan NISN Siswa">
                                        </div>
                                        <div class="col-sm-12 d-flex justify-content-end">
                                            <button type="button"class="btn btn-block btn-primary me-1 mb-1 transaksi-gedung">Cari</button>
                                        </div>
                                    </div>
                                </div>
                            </form>     
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-8 col-12 d-none biodata">
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
                                            <input type="text" name="nama" readonly class="form-control form-control-sm" value="Nama Siswa">
                                        </div>
                                        <div class="col-md-12 mb-1">
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input laki-laki" type="radio"  disabled>
                                                <label class="form-check-label" >Laki-laki</label>
                                            </div>
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input perempuan" type="radio"  disabled>
                                                <label class="form-check-label" >Perempuan</label>
                                            </div>
                                        </div>
                                        <div class="col-md-12 mb-1">
                                            <input type="text" name="no_tlp" readonly class="form-control form-control-sm" value="Nomor Telepon">
                                        </div>
                                        <div class="col-md-12 mb-1">
                                            <textarea name="alamat"  class="form-control form-control-sm" readonly>Alamat</textarea>
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
    <section id="basic-horizontal-layouts " class="bayar d-none">
        <div class="row match-height justify-content-center">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Form Pembayaran</h4>
                    </div>
                    <div class="card-content">
                        <div class="card-body">
                            <form class="form form-horizontal">
                                <div class="form-body">
                                    <div class="row">
                                        <div class="col-md-4 form-group">
                                            <input type="text" name="sisa_bayar" class="form-control" placeholder="Rp 100.000" readonly>
                                            <input type="hidden" name="id" >
                                            <input type="hidden" name="nisn" >
                                        </div>
                                        <div class="col-md-4 form-group">
                                            <input type="text" name="keterangan" class="form-control" placeholder="Keterangan transaksi gedung">
                                        </div>
                                        <div class="col-md-4 form-group">
                                            <input type="number" name="jumlah_bayar" class="form-control">
                                        </div>
                                        <div class="col-sm-12 d-flex justify-content-end">
                                            <button type="button"class="btn btn-block btn-success me-1 mb-1 bayar-gedung" >Bayar</button>
                                        </div>
                                    </div>
                                </div>
                            </form>     
                        </div>
                    </div>
                </div>
        </div>
    </section>
    <section id="basic-horizontal-layouts " class="history d-none">
        <div class="row match-height justify-content-center">
                <div class="card">
                    <div class="card-content">
                        <div class="card-body">
                            <form action="<?=base_url('transaksigedung/export')?>" method="post">
                                <div class="row">
                                    <div class="col-md-2">
                                        <input type="hidden" name="nisn">
                                        <button type="submit" class="btn btn-info btn-block">export</button>
                                    </div>
                                </div>
                            </form>
                            <div class="card-body table-responsive">
                                <table class="table table-striped table-bordered" >
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Keterangan</th>
                                            <th>Tanggal Bayar</th>
                                            <th>Jumlah</th>
                                            <th>Nama Petugas</th>
                                        </tr>
                                    </thead>
                                    <tbody id="tabelHistoriTransaksiGedung"></tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
        </div>
    </section>
</div>