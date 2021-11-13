<div class="page-heading">
                <div class="page-title">
                    <div class="row">
                        <div class="col-12 col-md-6 order-md-1 order-last">
                            <h3>Pemasukan</h3>
                            <p class="text-subtitle text-muted">For user to check they list</p>
                            
                        </div>
                        <div class="col-12 col-md-6 order-md-2 order-first">
                            <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="<?=base_url()?>">Dashboard</a></li>
                                    <li class="breadcrumb-item active" aria-current="page">Pemasukan</li>
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
                            <form action="<?=base_url('pemasukan/export')?>" method="post">
                                <div class="row">
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
                                        <button type="submit" class="btn btn-info btn-block">Export</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <div class="card-body table-responsive">
                            <table class="table table-striped" id="tabelJurnalPemasukan">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Tanggal</th>
                                        <th>Keterangan</th>
                                        <th>Pemasukan</th>
                                        <th>Total</th>
                                    </tr>
                                </thead>
                            </table>
                        </div>
                    </div>
                </section>
            </div>