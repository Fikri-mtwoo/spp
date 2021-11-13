<div class="page-heading">
                <div class="page-title">
                    <div class="row">
                        <div class="col-12 col-md-6 order-md-1 order-last">
                            <h3>Kelas</h3>
                            <p class="text-subtitle text-muted">For user to check they list</p>
                            
                        </div>
                        <div class="col-12 col-md-6 order-md-2 order-first">
                            <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="<?=base_url()?>">Dashboard</a></li>
                                    <li class="breadcrumb-item active" aria-current="page">Kelas</li>
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
                            <a href="<?=base_url('kelas/tambah')?>"><button type="button" class="btn btn-success">Tambah data</button></a>
                        </div>
                        <div class="card-body">
                            <table class="table table-striped" id="tabelKelas">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Nama Kelas</th>
                                        <th>Romawi Kelas</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                            </table>
                        </div>
                    </div>
                </section>
            </div>