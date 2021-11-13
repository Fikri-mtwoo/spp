<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?=$judul?></title>
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@300;400;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="<?=base_url('')?>assets/css/bootstrap.css">
    <link rel="stylesheet" href="<?=base_url('')?>assets/vendors/bootstrap-icons/bootstrap-icons.css">
    <link rel="stylesheet" href="<?=base_url('')?>assets/css/app.css">
    <link rel="stylesheet" href="<?=base_url('')?>assets/css/pages/auth.css">
    <link rel="shortcut icon" href="<?=base_url()?>assets/images/favicon.svg" type="image/x-icon">
    <?php if($this->session->userdata('status')){redirect(base_url('dashboard'));}?>
</head>

<body>
    <div id="auth">

        <div class="row h-100">
            <div class="col-lg-5 col-12">
                <?php if($this->session->flashdata('type')) :?>
                            <div class="alert <?=$this->session->flashdata('type')?> alert-dismissible show fade">
                                <?=$this->session->flashdata('pesan')?>
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                        <?php endif?>
                <div id="auth-left">
                    <div class="auth-logo">
                        <a href="<?=base_url()?>"><spa class="auth-subtitle">SPP Sekolah</span></a>
                    </div>

                    <form action="" method="POST">
                        <div class="form-group position-relative has-icon-left mb-4">
                            <input type="text" name="username" class="form-control form-control-xl <?=(form_error('username')) ? 'is-invalid':''?>" placeholder="Username">
                            <div class="form-control-icon">
                                <i class="bi bi-person"></i>
                            </div>
                            <?=form_error('username')?>
                        </div>
                        <div class="form-group position-relative has-icon-left mb-4">
                            <input type="password" name="password" class="form-control form-control-xl <?=(form_error('password')) ? 'is-invalid':''?>" placeholder="Password">
                            <div class="form-control-icon">
                                <i class="bi bi-shield-lock"></i>
                            </div>
                            <?=form_error('password')?>
                        </div>
                        <button class="btn btn-primary btn-block btn-lg shadow-lg mt-5">Masuk</button>
                    </form>
                </div>
            </div>
            <div class="col-lg-7 d-none d-lg-block">
                <div id="auth-right">

                </div>
            </div>
        </div>

    </div>
    <script src="<?=base_url()?>assets/js/bootstrap.bundle.min.js"></script>
</body>

</html>