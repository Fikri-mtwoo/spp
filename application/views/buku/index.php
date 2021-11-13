<div class="page-heading">
                <div class="page-title">
                    <div class="row">
                        <div class="col-12 col-md-6 order-md-1 order-last">
                            <h3>Buku</h3>
                            <p class="text-subtitle text-muted">For user to check they list</p>
                            
                        </div>
                        <div class="col-12 col-md-6 order-md-2 order-first">
                            <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="<?=base_url()?>">Dashboard</a></li>
                                    <li class="breadcrumb-item active" aria-current="page">Buku</li>
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
                            <a href="<?=base_url('buku/tambah')?>"><button type="button" class="btn btn-success">Tambah data</button></a>
                        </div>
                        <div class="card-body">
                            <table class="table table-striped" id="tabelBuku">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Nama Buku</th>
                                        <th>Harga Buku</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                            </table>
                        </div>
                    </div>
                </section>
                <!-- <div class='modal fade text-left' id='hapus-buku' tabindex='-1'role='dialog' aria-labelledby='myModalLabel160'aria-hidden='true'>
                    <div class='modal-dialog modal-dialog-scrollable'role='document'>
                            <div class='modal-content'>
                                <div class='modal-body text-center'>
                                    Yakin ingin menghapus data ini?
                                </div>
                                <div class='modal-footer'>
                                    <button type='button' class='btn btn-light-secondary' data-bs-dismiss='modal'>
                                        <i class='bx bx-x d-block d-sm-none'></i>
                                        <span class='d-none d-sm-block'>Batal</span>
                                    </button>
                                    <a href="<?=base_url('buku/hapus?id=')."".$this->input->get('id')?>"><button type='button' class='btn btn-danger ml-1'>
                                        <i class='bx bx-check d-block d-sm-none'></i>
                                        <span class='d-none d-sm-block'>Hapus</span>
                                    </button></a>
                                </div>
                            </div>
                    </div>
                </div> -->
            </div>