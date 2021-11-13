<?php 
    // foreach ($buku as $key => $bk) {
    //     foreach ($detail_buku as $dk) {
    //         if($bk['id_buku'] == $dk['id_buku']){
    //             echo $bk['nama_buku'];
    //             unset($buku[$key]);
    //         }
    //     }
    //     // var_dump($bk);
    // }
    // foreach ($buku as $bku) {
    //     echo $bku['nama_buku'];
    // }
?>
<div class="page-heading">
    <div class="page-title">
        <div class="row">
            <div class="col-12 col-md-6 order-md-1 order-last">
                <h3>Edit tagihan buku</h3>
                <p class="text-subtitle text-muted">Multiple form layout you can use</p>
            </div>
            <div class="col-12 col-md-6 order-md-2 order-first">
                <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="<?=base_url()?>">Dashboard</a></li>
                        <li class="breadcrumb-item"><a href="<?=base_url('tagihanbuku')?>">Tagihan Buku</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Edit tagihan buku</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>

    <section id="basic-horizontal-layouts">
        <div class="row match-height justify-content-center">
            <div class="col-md-8 col-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Form edit</h4>
                    </div>
                    <div class="card-content">
                        <div class="card-body">
                                    <form class="form form-horizontal" action="<?=base_url('tagihanbuku/proses_edit')?>" method="post">
                                        <div class="form-body">
                                            <div class="row">
                                                <div class="col-md-4">
                                                    <label>Nama Siswa</label>
                                                </div>
                                                <div class="col-md-8 form-group">
                                                    <input type="text" name="nama" class="form-control" readonly value="<?=$tagihan_buku->nama_siswa?>">
                                                    <input type="hidden" name="id" value="<?=$tagihan_buku->id_tagihan_buku?>">
                                                </div>
                                                <div class="col-md-4">
                                                    <label>Kelas / Jurusan</label>
                                                </div>
                                                <div class="col-md-8 form-group">
                                                    <input type="text" name="kelas" class="form-control" readonly value="<?=$tagihan_buku->nama_kelas." / ".$tagihan_buku->nama_jurusan?>">
                                                </div>
                                                <div class="col-md-4">
                                                    <label>Total Harga</label>
                                                </div>
                                                <div class="col-md-8 form-group">
                                                    <input type="text" name="toal_harga" class="form-control" readonly value="Rp. <?=number_format($tagihan_buku->total_nominal_buku)?>">
                                                </div>
                                                <div class="col-md-12">
                                                    <p>Daftar buku yang tersedia</p>
                                                    <ul class="list-unstyled mb-0 list-buku">
                                                        <?php foreach ($buku as $key => $bk) :?>
                                                            <?php foreach ($detail_buku as $dk) :?>
                                                                <?php if($bk['id_buku'] == $dk['id_buku']):?>
                                                                    <li class="d-inline-block me-2 mb-1">
                                                                        <div class="form-check">
                                                                            <div class="custom-control custom-checkbox">
                                                                                <input type="checkbox"class="form-check-input form-check-success" checked name="buku[][nama]" value="<?=$bk['id_buku'].'/'.$bk['harga_buku']?>">
                                                                                <label class="form-check-label"><?=$bk['nama_buku']?></label>
                                                                            </div>
                                                                        </div>
                                                                    </li>
                                                                    <?php unset($buku[$key]); ?>
                                                                <?php endif?>
                                                            <?php endforeach?>
                                                        <?php endforeach?>
                                                        <?php foreach ($buku as $bku) :?>
                                                            <li class="d-inline-block me-2 mb-1">
                                                                <div class="form-check">
                                                                    <div class="custom-control custom-checkbox">
                                                                        <input type="checkbox"class="form-check-input form-check-success" name="buku[][nama]" value="<?=$bku['id_buku'].'/'.$bku['harga_buku']?>">
                                                                        <label class="form-check-label"><?=$bku['nama_buku']?></label>
                                                                    </div>
                                                                </div>
                                                            </li>
                                                        <?php endforeach?>
                                                    </ul>
                                                </div>
                                                <!-- <div class="col-md-4">
                                                    <label>Daftar Buku</label>
                                                </div>
                                                <div class="col-md-8 form-group">
                                                    <select class="selectpicker form-select" size="auto" multiple title="Daftar buku" name="buku[][nama]">
                                                        <?php foreach ($buku as $key => $bk) :?>
                                                            <?php foreach ($detail_buku as $dk) :?>
                                                                <?php if($bk['id_buku'] == $dk['id_buku']):?>
                                                                    <option value="<?=$bk['id_buku'].'/'.$bk['harga_buku']?>" selected><?=$bk['nama_buku']?></option>
                                                                    <?php unset($buku[$key]); ?>
                                                                <?php endif?>
                                                            <?php endforeach?>
                                                        <?php endforeach?>
                                                        <?php foreach ($buku as $bku) :?>
                                                            <option value="<?=$bku['id_buku'].'/'.$bku['harga_buku']?>"><?=$bku['nama_buku']?></option>
                                                        <?php endforeach?>
                                                        </select>
                                                </div> -->

                                                <div class="col-sm-12 d-flex justify-content-end">
                                                    <button type="sumbit"class="btn btn-primary me-1 mb-1">Simpan</button>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                    <!-- <form class="form form-horizontal" method="post" action="<?=base_url('tagihanbuku/proses_tambah')?>">
                                        <div class="row">
                                            <div class="col-12 label-siswa"> 
                                            </div>
                                            <div class="col-md-12">
                                                <div class="form-check">
                                                </div>
                                                <div class="col-sm-12 d-flex justify-content-end notif">
                                                </div>
                                            </div>
                                            <div class="col-12 label-buku">
                                            </div>
                                            <div class="col-md-12">
                                                <div class="col-sm-12 d-flex justify-content-end notif-buku">
                                                </div>
                                                <ul class="list-unstyled mb-0 list-buku">
                                                </ul>
                                            </div>
                                            <div class="col-sm-12 d-flex justify-content-end">
                                                <input type="hidden" name="kelas">
                                                <button type="sumbit" class="btn btn-block btn-success me-1 mb-1 d-none tambah">Tambah</button>
                                            </div>
                                        </div>
                                    </form> -->
                                </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>