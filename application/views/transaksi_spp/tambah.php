<div class="page-heading">
    <div class="page-title">
        <div class="row">
            <div class="col-12 col-md-6 order-md-1 order-last">
                <h3>Transaksi spp</h3>
                <p class="text-subtitle text-muted">Multiple form layout you can use</p>
            </div>
            <div class="col-12 col-md-6 order-md-2 order-first">
                <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="<?=base_url()?>">Dashboard</a></li>
                        <li class="breadcrumb-item"><a href="<?=base_url('transaksispp')?>">Transaksi Spp</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Form bayar transaksi</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>

    <section id="basic-horizontal-layouts">
        <div class="row match-height justify-content-center">
            <div class="col-md-4 col-12">
                <div class="alert alert-danger alert-dismissible show fade d-none alert-tagihan-spp">
                    <p>Data tidak ditemukan</p>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Form pencarian siswa</h4>
                    </div>
                    <div class="card-content">
                        <div class="card-body">
                            <form class="form form-horizontal">
                                <div class="form-body">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <input type="text" name="nisn" class="form-control" placeholder="masukan NISN Siswa">
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <select class="form-select " name="kelas">
                                                    <option value="" selected>Kelas</option>
                                                    <?php foreach ($kelas as $kls) :?>
                                                        <option value="<?=$kls['id_kelas']?>"><?=$kls['nama_kelas']?></option>
                                                    <?php endforeach?>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-sm-12 d-flex justify-content-end">
                                            <button type="button"class="btn btn-block btn-primary me-1 mb-1 transaksi-spp">Cari</button>
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
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <select class="form-select bulan" name="tagihan-spp">
                                                </select>
                                            </div>
                                            <div class="form-group">
                                                <input type="text" name="sisa_bayar" class="form-control" placeholder="Rp 100.000" readonly>
                                                <input type="hidden" name="id" >
                                                <input type="hidden" name="nisn" >
                                            </div>
                                        </div>
                                        <div class="col-md-8">
                                            <div class="row">
                                                <div class="col-md-6 form-group">
                                                    <input type="text" name="keterangan" class="form-control" placeholder="Keterangan transaksi spp" readonly>
                                                </div>
                                                <div class="col-md-6 form-group">
                                                    <input type="number" name="jumlah_bayar" class="form-control" readonly>
                                                </div>
                                                <div class="col-sm-12 d-flex justify-content-end">
                                                    <button type="button"class="btn btn-block btn-success me-1 mb-1 bayar-spp" >Bayar</button>
                                                </div>
                                            </div>
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
                            <form action="<?=base_url('transaksispp/export')?>" method="post">
                                <div class="row">
                                    <div class="col-md-2">
                                        <input type="hidden" name="nisn">
                                        <input type="hidden" name="kelas">
                                        <button type="submit" class="btn btn-info btn-block">export</button>
                                    </div>
                                </div>
                            </form>
                            <div class="card-body table-responsive">
                                <table class="table table-striped table-bordered" >
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Bulan / Tahun SPP</th>
                                            <th>Keterangan</th>
                                            <th>Tanggal Bayar</th>
                                            <th>Jumlah</th>
                                            <th>Nama Petugas</th>
                                        </tr>
                                    </thead>
                                    <tbody id="tabelHistoriTransaksiSpp"></tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
        </div>
    </section>
</div>