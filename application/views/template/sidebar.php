<body>
    <div id="app">
        <div id="sidebar" class="active">
            <div class="sidebar-wrapper active">
                <div class="sidebar-header">
                    <div class="d-flex justify-content-between">
                        <div class="logo">
                            <a href="<?=base_url()?>"><span>SPP Sekolah</span></a>
                        </div>
                        <div class="toggler">
                            <a href="#" class="sidebar-hide d-xl-none d-block"><i class="bi bi-x bi-middle"></i></a>
                        </div>
                    </div>
                </div>
                <div class="sidebar-menu">
                    <ul class="menu">
                        <li class="sidebar-title">Menu</li>
                        <?php 
                        $master = array('angkatan', 'buku', 'jurusan', 'kelas', 'petugas', 'siswa'); 
                        $tagihan = array('tagihanbuku', 'tagihanspp');
                        $transaksi = array('transaksibuku', 'transaksispp', 'transaksigedung', 'transaksipendaftaran');
                        $jurnal = array('jurnal', 'pemasukan', 'pengeluaran');
                        ?>
                        <li class="sidebar-item <?=($this->uri->segment(1) == '')?'active':''?> ">
                            <a href="<?=base_url('dashboard')?>" class='sidebar-link'>
                                <i class="bi bi-grid-fill"></i>
                                <span>Dashboard</span>
                            </a>
                        </li>

                        <li class="sidebar-item  has-sub <?=(in_array($this->uri->segment(1), $master))?'active':''?> ">
                            <a href="#" class='sidebar-link'>
                                <i class="bi bi-stack"></i>
                                <span>Master</span>
                            </a>
                            <ul class="submenu ">
                                <li class="submenu-item ">
                                    <a href="<?=base_url('angkatan')?>">Angkatan</a>
                                </li>
                                <li class="submenu-item ">
                                    <a href="<?=base_url('buku')?>">Buku</a>
                                </li>
                                <li class="submenu-item ">
                                    <a href="<?=base_url('jurusan')?>">Jurusan</a>
                                </li>
                                <li class="submenu-item ">
                                    <a href="<?=base_url('kelas')?>">Kelas</a>
                                </li>
                                <li class="submenu-item ">
                                    <a href="<?=base_url('petugas')?>">Petugas</a>
                                </li>
                                <li class="submenu-item ">
                                    <a href="<?=base_url('siswa')?>">Siswa</a>
                                </li>
                                <li class="submenu-item ">
                                    <a href="<?=base_url('spp')?>">Spp</a>
                                </li>
                            </ul>
                        </li>

                        <li class="sidebar-item  has-sub <?=(in_array($this->uri->segment(1), $tagihan))?'active':''?> ">
                            <a href="#" class='sidebar-link'>
                                <i class="bi bi-collection-fill"></i>
                                <span>Tagihan</span>
                            </a>
                            <ul class="submenu ">
                                <li class="submenu-item ">
                                    <a href="<?=base_url('tagihanbuku')?>">Buku</a>
                                </li>
                                <li class="submenu-item ">
                                    <a href="<?=base_url('tagihanspp')?>">SPP</a>
                                </li>
                            </ul>
                        </li>

                        <li class="sidebar-item  has-sub <?=(in_array($this->uri->segment(1), $jurnal))?'active':''?>">
                            <a href="#" class='sidebar-link'>
                                <i class="fas fa-sticky-note"></i>
                                <span>Jurnal</span>
                            </a>
                            <ul class="submenu ">
                                <li class="submenu-item ">
                                    <a href="<?=base_url('jurnal')?>">Jurnal Umum</a>
                                </li>
                                <li class="submenu-item ">
                                    <a href="<?=base_url('pemasukan')?>">Pemasukan</a>
                                </li>
                                <li class="submenu-item ">
                                    <a href="<?=base_url('pengeluaran')?>">Penggeluaran</a>
                                </li>
                            </ul>
                        </li>
                        <li class="sidebar-item  has-sub <?=(in_array($this->uri->segment(1), $transaksi))?'active':''?> ">
                            <a href="#" class='sidebar-link'>
                                <i class="fas fa-hand-holding-usd"></i>
                                <span>Transaksi</span>
                            </a>
                            <ul class="submenu ">
                                <li class="submenu-item ">
                                    <a href="<?=base_url('transaksibuku')?>">Buku</a>
                                </li>
                                <li class="submenu-item ">
                                    <a href="<?=base_url('transaksigedung')?>">Gedung</a>
                                </li>
                                <li class="submenu-item ">
                                    <a href="<?=base_url('transaksipendaftaran')?>">Pendaftaran</a>
                                </li>
                                <li class="submenu-item ">
                                    <a href="<?=base_url('transaksispp')?>">SPP</a>
                                </li>
                            </ul>
                        </li>

                        <li class="sidebar-item ">
                            <a href="<?=base_url('auth/logout')?>" class='sidebar-link'>
                                <i class="fas fa-sign-out-alt"></i>
                                <span>Logout</span>
                            </a>
                        </li>

                    </ul>
                </div>
                <button class="sidebar-toggler btn x"><i data-feather="x"></i></button>
            </div>
        </div>
        <div id="main">
            <header class="mb-3">
                <a href="#" class="burger-btn d-block d-xl-none">
                    <i class="bi bi-justify fs-3"></i>
                </a>
            </header>