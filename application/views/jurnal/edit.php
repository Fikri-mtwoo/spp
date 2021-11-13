<div class="page-heading">
    <div class="page-title">
        <div class="row">
            <div class="col-12 col-md-6 order-md-1 order-last">
                <h3>Tambah data jurnal</h3>
                <p class="text-subtitle text-muted">Multiple form layout you can use</p>
            </div>
            <div class="col-12 col-md-6 order-md-2 order-first">
                <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="<?=base_url()?>">Dashboard</a></li>
                        <li class="breadcrumb-item"><a href="<?=base_url('jurnal')?>">Jurnal Umum</a></li>
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
                                            <label>Keterangan</label>
                                        </div>
                                        <div class="col-md-8 form-group">
                                            <input type="text" class="form-control <?=(form_error('keterangan')? 'is-invalid':'')?>" name="keterangan" placeholder="Keterangan transaksi masuk / keluar" value="<?=$jurnal->keterangan_jurnal?>" readonly>
                                            <?= form_error('keterangan')?>
                                            <input type="hidden" name="id" value="<?=$jurnal->id_jurnal?>">
                                        </div>
                                        <div class="col-md-4">
                                            <label>Tanggal Transaksi</label>
                                        </div>
                                        <div class="col-md-8 form-group">
                                            <input type="date" class="form-control <?=(form_error('tgl_transaksi')? 'is-invalid':'')?>" name="tgl_transaksi" value="<?=$jurnal->tgl_transaksi?>" readonly>
                                            <?= form_error('tgl_transaksi')?>
                                        </div>
                                        <div class="col-md-4">
                                            <label>Jenis Transaksi</label>
                                        </div>
                                        <div class="col-md-8 form-group">
                                            <select name="jenis_saldo" class="form-select <?=(form_error('jenis_saldo')? 'is-invalid':'')?>" >
                                                <option value="" selected>Pilih jenis transaksi</option>
                                                <option value="masuk" <?=($jurnal->jenis_saldo == 'masuk')?'selected':''?>>Pemasukan</option>
                                                <option value="keluar"  <?=($jurnal->jenis_saldo == 'keluar')?'selected':''?>>Pengeluaran</option>
                                            </select>
                                            <?= form_error('jenis_saldo')?>
                                        </div>
                                        <div class="col-md-4">
                                            <label>Saldo</label>
                                        </div>
                                        <div class="col-md-8 form-group">
                                            <input type="number" class="form-control <?=(form_error('saldo')? 'is-invalid':'')?>" name="saldo" placeholder="50000" value="<?=$jurnal->saldo?>" >
                                            <?= form_error('saldo')?>
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