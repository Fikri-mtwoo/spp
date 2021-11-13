<div class="page-heading">
                <div class="page-title">
                    <div class="row">
                        <div class="col-12 col-md-6 order-md-1 order-last">
                            <h3>Jurnal Umum</h3>
                            <p class="text-subtitle text-muted">For user to check they list</p>
                            
                        </div>
                        <div class="col-12 col-md-6 order-md-2 order-first">
                            <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="<?=base_url()?>">Dashboard</a></li>
                                    <li class="breadcrumb-item active" aria-current="page">Jurnal Umum</li>
                                </ol>
                            </nav>
                        </div>
                        <?php if($this->session->flashdata('type')) :?>
                            <div class="alert <?=$this->session->flashdata('type')?> alert-dismissible show fade">
                                <?=$this->session->flashdata('pesan')?>
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                        <?php endif?>
                    </div>
                </div>
                <section class="section">
                    <div class="card">
                        <div class="card-header">
                            <form action="<?=base_url('jurnal/export')?>" method="post">
                            <div class="row">
                                    <div class="col-md-2">
                                        <a href="<?=base_url('jurnal/tambah')?>"><button type="button" class="btn btn-success btn-block">Tambah</button></a>
                                    </div>
                                    <div class="col-md-2">
                                        <select name="bulan" class="form-select bulan">
                                            <option value="" selected>Pilih Bulan</option>
                                            <?php foreach ($bulan as $bln) :?>
                                                <option value="<?=$bln?>" ><?=$bln?></option>
                                            <?php endforeach?>
                                        </select>
                                    </div>
                                    <div class="col-md-2">
                                        <select name="tahun" class="form-select tahun">
                                            <option value="" selected>Pilih Tahun</option>
                                            <?php foreach ($tahun as $thn) :?>
                                                <option value="<?=$thn?>" ><?=$thn?></option>
                                            <?php endforeach?>
                                        </select>
                                    </div>
                                    <div class="col-md-2">
                                    <!-- <a href="<?=base_url('jurnal/export')?>"><button type="button" class="btn btn-info btn-block export">Export</button></a> -->
                                    <button type="submit" class="btn btn-info btn-block export">Export</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <div class="card-body table-responsive">
                            <table class="table table-striped" id="tabelJurnal">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Tanggal</th>
                                        <th>Keterangan</th>
                                        <th>Pemasukan</th>
                                        <th>Pengeluaran</th>
                                        <th>Total</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                            </table>
                        </div>
                    </div>
                </section>
            </div>