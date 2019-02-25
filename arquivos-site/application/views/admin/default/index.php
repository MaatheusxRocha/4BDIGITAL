<div class="content-wrapper">
    <section class="content-header">
        <h1>Dashboard</h1>
        <ol class="breadcrumb">
            <li>
                <a href="<?= site_url('admin') ?>"><i class="fa fa-dashboard"></i> <?=PROJECT?></a>
            </li>
        </ol>
    </section>
    <section class="content">
        <div class="row">
            <div class="col-xs-12 col-md-6 col-lg-3">
                <div class="info-box">
                    <span class="info-box-icon bg-yellow">
                        <i class="fa fa-comments"></i>
                    </span>
                    <div class="info-box-content">
                        <span class="info-box-text">Fale conosco</span>
                        <span class="info-box-number"><?= $contact_us ?></span>
                        <span class="info-box-more" style="margin-top: 10px">
                            <a href="<?= site_url('admin/contact_us') ?>">Ver todos</a>
                        </span>
                    </div>
                </div>
            </div>
            <div class="col-xs-12 col-md-6 col-lg-3">
                <div class="info-box">
                    <span class="info-box-icon bg-blue-active">
                        <i class="fa fa-briefcase"></i>
                    </span>
                    <div class="info-box-content">
                        <span class="info-box-text">Trabalhe conosco</span>
                        <span class="info-box-number"><?= $join_us ?></span>
                        <span class="info-box-more" style="margin-top: 10px">
                            <a href="<?= site_url('admin/join_us') ?>">Ver todos</a>
                        </span>
                    </div>
                </div>
            </div>
            <div class="col-xs-12 col-md-6 col-lg-3">
                <div class="info-box">
                    <span class="info-box-icon bg-green-active">
                        <i class="fa fa-user-plus"></i>
                    </span>
                    <div class="info-box-content">
                        <span class="info-box-text">Parceiros</span>
                        <span class="info-box-number"><?= $partner_contact ?></span>
                        <span class="info-box-more" style="margin-top: 10px">
                            <a href="<?= site_url('admin/partner_contact') ?>">Ver todos</a>
                        </span>
                    </div>
                </div>
            </div>
            <div class="col-xs-12 col-md-6 col-lg-3">
                <div class="info-box">
                    <span class="info-box-icon bg-red-active">
                        <i class="fa fa-bolt"></i>
                    </span>
                    <div class="info-box-content">
                        <span class="info-box-text">Startups</span>
                        <span class="info-box-number"><?= $startup_contact ?></span>
                        <span class="info-box-more" style="margin-top: 10px">
                            <a href="<?= site_url('admin/startup_contact') ?>">Ver todos</a>
                        </span>
                    </div>
                </div>
            </div>
            <div class="col-xs-12 col-md-6 col-lg-3">
                <div class="info-box">
                    <span class="info-box-icon bg-blue">
                        <i class="fa fa-phone"></i>
                    </span>
                    <div class="info-box-content">
                        <span class="info-box-text">Ligue-me</span>
                        <span class="info-box-number"><?= $call ?></span>
                        <span class="info-box-more" style="margin-top: 10px">
                            <a href="<?= site_url('admin/call') ?>">Ver todos</a>
                        </span>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
