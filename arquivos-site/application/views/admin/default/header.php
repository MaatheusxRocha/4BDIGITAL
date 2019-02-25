<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
        <title><?= PROJECT ?> | Administrativo</title>

        <link rel="stylesheet" href="<?= base_url('assets/admin-lte/bootstrap/css/bootstrap.min.css') ?>">
        <link rel="stylesheet" href="<?= base_url('assets/font-awesome-4.6.3/css/font-awesome.min.css') ?>">
        <link rel="stylesheet" href="<?= base_url('assets/admin-lte/dist/css/AdminLTE.min.css') ?>">
        <link rel="stylesheet" href="<?= base_url('assets/admin-lte/dist/css/skins/skin-blue.min.css') ?>">
        <link rel="stylesheet" href="<?= base_url('assets/admin-lte/plugins/iCheck/square/blue.css') ?>">
        <link rel="stylesheet" href="<?= base_url('assets/admin-lte/plugins/datatables/dataTables.bootstrap.css') ?>">
        <link href="<?= base_url('assets/admin-lte/plugins/datepicker/datepicker3.min.css') ?>" rel="stylesheet">
        <link href="<?= base_url('assets/admin-lte/plugins/colorpicker/bootstrap-colorpicker.min.css') ?>" rel="stylesheet">
        <link href="<?= base_url('assets/' . SCRIPTS_FOLDER . '/css/main.css') ?>" rel="stylesheet">
        <link href="<?= base_url('assets/bootstrap3-editable/css/bootstrap-editable.css') ?>" rel="stylesheet">
        <link href="<?= base_url('assets/trumbowyg/ui/trumbowyg.min.css') ?>" rel="stylesheet">
        <link href="<?= base_url('assets/fileUpload/uploadfile.css') ?>" rel="stylesheet">
        <link href="<?= base_url('assets/cropper/src/cropper.css') ?>" rel="stylesheet">
        <script src="<?= base_url('assets/admin-lte/plugins/jQuery/jQuery-2.1.4.min.js') ?>"></script>
        <? /* HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries */ ?>
        <? /* WARNING: Respond.js doesn't work if you view the page via file:// */ ?>
        <!--[if lt IE 9]>
            <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
            <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
        <![endif]-->
    </head>
    <body class="hold-transition skin-blue sidebar-mini">
        <div class="wrapper">
            <header class="main-header">
                <a href="<?= site_url('admin') ?>" class="logo">
                    <span class="logo-mini"><b>BR</b></span>
                    <span class="logo-lg">BRAS<b>CLOUD</b></span>
                </a>
                <nav class="navbar navbar-static-top" role="navigation">
                    <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
                        <span class="sr-only">Toggle navigation</span>
                    </a>
                    <div class="navbar-custom-menu">
                        <ul class="nav navbar-nav">
                            <li class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown"><?= $current_language->name ?> <span class="caret"></span></a>
                                <ul class="dropdown-menu" role="menu">
                                    <? foreach ($languages as $lang) { ?>
                                        <li class="inline"><a href="<?= site_url('admin/home/change_language/' . $lang->id) ?>"> <?= $lang->name ?> </a></li>
                                    <? } ?>
                                </ul>
                            </li>
                        </ul>
                        <ul class="nav navbar-nav">
                            <li class="dropdown user user-menu">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                    <img src="<?= base_url('assets/admin-lte/dist/img/avatar5.png') ?>" class="user-image" alt="Imagem do Usuário">
                                    <span class="hidden-xs"><?= $current_user->name ?></span>
                                </a>
                                <ul class="dropdown-menu">
                                    <li class="user-header">
                                        <img src="<?= base_url('assets/admin-lte/dist/img/avatar5.png') ?>" class="img-circle" alt="Imagem do Usuário">
                                        <p>
                                            <?= $current_user->name ?>
                                        </p>
                                    </li>
                                    <li class="user-footer">
                                        <div class="pull-left">
                                            <a href="<?= site_url('admin/user/edit/' . $current_user->id) ?>" class="btn btn-default btn-flat">Editar</a>
                                        </div>
                                        <div class="pull-right">
                                            <a href="<?= site_url('admin/login/logout') ?>" class="btn btn-default btn-flat">Sair</a>
                                        </div>
                                    </li>
                                </ul>
                            </li>
                        </ul>
                    </div>
                </nav>
            </header>
            <aside class="main-sidebar">
                <section class="sidebar">
                    <div class="user-panel">
                        <div class="pull-left image">
                            <img src="<?= base_url('assets/admin-lte/dist/img/avatar5.png') ?>" class="img-circle" alt="User Image">
                        </div>
                        <div class="pull-left info">
                            <p><?= $current_user->name ?></p>
                        </div>
                    </div>
                    <ul class="sidebar-menu">
                        <? $uri = uri_string() ?>
                        <li class="header">Menu</li>
                        <? if ($this->permission_model->get_permission_user('configuration')) { ?>
                            <li class="treeview <?= strposa($uri, array('admin/configuration', 'admin/user', 'admin/language')) !== FALSE ? 'active' : '' ?>">
                                <a href="#">
                                    <i class="fa fa-fw fa-cogs"></i> <span>Configurações Gerais</span> <i class="fa fa-angle-left pull-right"></i>
                                </a>
                                <ul class="treeview-menu">
                                    <li class="<?= strpos($uri, 'admin/configuration') !== FALSE ? 'active' : '' ?>">
                                        <a href="<?= site_url('admin/configuration') ?>">
                                            <i class="fa fa-fw fa-cog"></i> <span>Configurações</span>
                                        </a>
                                    </li>
                                    <li class="<?= strpos($uri, 'admin/user') !== FALSE ? 'active' : '' ?>">
                                        <a href="<?= site_url('admin/user') ?>">
                                            <i class="fa fa-fw fa-user"></i> <span>Usuários</span>
                                        </a>
                                    </li>
                                    <li class="<?= strpos($uri, 'admin/language') !== FALSE ? 'active' : '' ?>">
                                        <a href="<?= site_url('admin/language') ?>">
                                            <i class="fa fa-fw fa-language"></i> <span>Linguagem</span>
                                        </a>
                                    </li>
                                </ul>
                            </li>
                        <? } ?>
                        <? if ($this->permission_model->get_permission_user('home')) { ?>
                            <li class="treeview <?= strposa($uri, array('admin/text_home', 'admin/banner', 'admin/why_choose', 'admin/messaging')) !== FALSE ? 'active' : '' ?>">
                                <a href="#">
                                    <i class="fa fa-fw fa-home"></i> <span>Home</span> <i class="fa fa-angle-left pull-right"></i>
                                </a>
                                <ul class="treeview-menu">
                                    <li class="<?= strpos($uri, 'admin/text_home') !== FALSE ? 'active' : '' ?>">
                                        <a href="<?= site_url('admin/text_home') ?>">
                                            <i class="fa fa-fw fa-font"></i> <span>Textos</span>
                                        </a>
                                    </li>
                                    <li class="<?= strpos($uri, 'admin/banner') !== FALSE ? 'active' : '' ?>">
                                        <a href="<?= site_url('admin/banner') ?>">
                                            <i class="fa fa-fw fa-photo"></i> <span>Banners</span>
                                        </a>
                                    </li>
                                    <li class="<?= strpos($uri, 'admin/why_choose') !== FALSE ? 'active' : '' ?>">
                                        <a href="<?= site_url('admin/why_choose') ?>">
                                            <i class="fa fa-fw fa-question"></i> <span>Por que a Brascloud?</span>
                                        </a>
                                    </li>
                                    <li class="<?= strpos($uri, 'admin/messaging') !== FALSE ? 'active' : '' ?>">
                                        <a href="<?= site_url('admin/messaging') ?>">
                                            <i class="fa fa-fw fa-comment"></i> <span>Mensageria</span>
                                        </a>
                                    </li>
                                </ul>
                            </li>
                        <? } ?>
                        <? if ($this->permission_model->get_permission_user('about')) { ?>
                            <li class="treeview <?= strposa($uri, array('admin/about', 'admin/partner')) !== FALSE && strpos($uri, 'admin/partner_contact') === FALSE && strposa($uri, array('admin/partner_page', 'admin/partner_item')) === FALSE ? 'active' : '' ?>">
                                <a href="#">
                                    <i class="fa fa-fw fa-heart"></i> <span>Sobre a Brascloud</span> <i class="fa fa-angle-left pull-right"></i>
                                </a>
                                <ul class="treeview-menu">
                                    <li class="<?= strpos($uri, 'admin/about') !== FALSE ? 'active' : '' ?>">
                                        <a href="<?= site_url('admin/about') ?>">
                                            <i class="fa fa-fw fa-heart"></i> <span>Página Sobre</span>
                                        </a>
                                    </li>
                                    <li class="<?= strpos($uri, 'admin/partner') !== FALSE && strposa($uri, array('admin/partner_page', 'admin/partner_item')) === FALSE ? 'active' : '' ?>">
                                        <a href="<?= site_url('admin/partner') ?>">
                                            <i class="fa fa-fw fa-users"></i> <span>Parceiros de Tecnologia</span>
                                        </a>
                                    </li>
                                </ul>
                            </li>
                        <? } ?>
                        <? if ($this->permission_model->get_permission_user('cases')) { ?>
                            <li class="treeview <?= strposa($uri, array('admin/text_case', 'admin/cases')) !== FALSE ? 'active' : '' ?>">
                                <a href="#">
                                    <i class="fa fa-fw fa-bookmark"></i> <span>Cases</span> <i class="fa fa-angle-left pull-right"></i>
                                </a>
                                <ul class="treeview-menu">
                                    <li class="<?= strpos($uri, 'admin/text_case') !== FALSE ? 'active' : '' ?>">
                                        <a href="<?= site_url('admin/text_case') ?>">
                                            <i class="fa fa-fw fa-font"></i> <span>Textos</span>
                                        </a>
                                    </li>
                                    <li class="<?= strpos($uri, 'admin/cases') !== FALSE ? 'active' : '' ?>">
                                        <a href="<?= site_url('admin/cases') ?>">
                                            <i class="fa fa-fw fa-bookmark"></i> <span>Cases</span>
                                        </a>
                                    </li>
                                </ul>
                            </li>
                        <? } ?>
                        <? if ($this->permission_model->get_permission_user('architect')) { ?>
                            <li class="treeview <?= strposa($uri, array('admin/architect', 'admin/architect_item')) !== FALSE ? 'active' : '' ?>">
                                <a href="#">
                                    <i class="fa fa-fw fa-male"></i> <span>Arquiteto</span> <i class="fa fa-angle-left pull-right"></i>
                                </a>
                                <ul class="treeview-menu">
                                    <li class="<?= strpos($uri, 'admin/architect') !== FALSE && strpos($uri, 'admin/architect_item') === FALSE ? 'active' : '' ?>">
                                        <a href="<?= site_url('admin/architect') ?>">
                                            <i class="fa fa-fw fa-male"></i> <span>Página arquiteto</span>
                                        </a>
                                    </li>
                                    <li class="<?= strpos($uri, 'admin/architect_item') !== FALSE ? 'active' : '' ?>">
                                        <a href="<?= site_url('admin/architect_item') ?>">
                                            <i class="fa fa-fw fa-list"></i> <span>Arquiteto - Item</span>
                                        </a>
                                    </li>
                                </ul>
                            </li>
                        <? } ?>
                        <? if ($this->permission_model->get_permission_user('community')) { ?>
                            <li class="<?= strpos($uri, 'admin/community') !== FALSE ? 'active' : NULL ?>">
                                <a href="<?= site_url('admin/community') ?>">
                                    <i class="fa fa-fw fa-users"></i> <span>Comunidade</span>
                                </a>
                            </li>
                        <? } ?>
                        <? if ($this->permission_model->get_permission_user('partners')) { ?>
                            <li class="treeview <?= strposa($uri, array('admin/partner_page', 'admin/partner_item')) !== FALSE ? 'active' : '' ?>">
                                <a href="#">
                                    <i class="fa fa-fw fa-star"></i> <span>Parceiros</span> <i class="fa fa-angle-left pull-right"></i>
                                </a>
                                <ul class="treeview-menu">
                                    <li class="<?= strpos($uri, 'admin/partner_page') !== FALSE ? 'active' : '' ?>">
                                        <a href="<?= site_url('admin/partner_page') ?>">
                                            <i class="fa fa-fw fa-star"></i> <span>Página Parceiros</span>
                                        </a>
                                    </li>
                                    <li class="<?= strpos($uri, 'admin/partner_item') !== FALSE ? 'active' : '' ?>">
                                        <a href="<?= site_url('admin/partner_item') ?>">
                                            <i class="fa fa-fw fa-list"></i> <span>Parceiros - Item</span>
                                        </a>
                                    </li>
                                </ul>
                            </li>
                        <? } ?>
                        <? if ($this->permission_model->get_permission_user('startup')) { ?>
                            <li class="treeview <?= strposa($uri, array('admin/startup', 'admin/startup_slider', 'admin/startup_item', 'admin/recipe')) !== FALSE && strpos($uri, 'admin/startup_contact') === FALSE ? 'active' : '' ?>">
                                <a href="#">
                                    <i class="fa fa-fw fa-bolt"></i> <span>Startup</span> <i class="fa fa-angle-left pull-right"></i>
                                </a>
                                <ul class="treeview-menu">
                                    <li class="<?= strpos($uri, 'admin/startup') !== FALSE && strposa($uri, array('admin/startup_slider', 'admin/startup_item', 'admin/startup_contact')) === FALSE ? 'active' : '' ?>">
                                        <a href="<?= site_url('admin/startup') ?>">
                                            <i class="fa fa-fw fa-bolt"></i> <span>Página Startup</span>
                                        </a>
                                    </li>
                                    <li class="<?= strpos($uri, 'admin/startup_slider') !== FALSE ? 'active' : '' ?>">
                                        <a href="<?= site_url('admin/startup_slider') ?>">
                                            <i class="fa fa-fw fa-sliders"></i> <span>Startup - Slider</span>
                                        </a>
                                    </li>
                                    <li class="<?= strpos($uri, 'admin/startup_item') !== FALSE ? 'active' : '' ?>">
                                        <a href="<?= site_url('admin/startup_item') ?>">
                                            <i class="fa fa-fw fa-list"></i> <span>Startup - Item</span>
                                        </a>
                                    </li>
                                    <li class="<?= strpos($uri, 'admin/recipe') !== FALSE ? 'active' : '' ?>">
                                        <a href="<?= site_url('admin/recipe') ?>">
                                            <i class="fa fa-fw fa-money"></i> <span>Modelos de receita</span>
                                        </a>
                                    </li>
                                </ul>
                            </li>
                        <? } ?>
                        <? if ($this->permission_model->get_permission_user('why_create')) { ?>
                            <li class="treeview <?= strposa($uri, array('admin/account_create', 'admin/account_item')) !== FALSE ? 'active' : '' ?>">
                                <a href="#">
                                    <i class="fa fa-fw fa-user-plus"></i> <span>Por que Criar uma conta?</span> <i class="fa fa-angle-left pull-right"></i>
                                </a>
                                <ul class="treeview-menu">
                                    <li class="<?= strpos($uri, 'admin/account_create') !== FALSE ? 'active' : '' ?>">
                                        <a href="<?= site_url('admin/account_create') ?>">
                                            <i class="fa fa-fw fa-user-plus"></i> <span>Página Por que Criar?</span>
                                        </a>
                                    </li>
                                    <li class="<?= strpos($uri, 'admin/account_item') !== FALSE ? 'active' : '' ?>">
                                        <a href="<?= site_url('admin/account_item') ?>">
                                            <i class="fa fa-fw fa-list"></i> <span>Por que criar - Item</span>
                                        </a>
                                    </li>
                                </ul>
                            </li>
                        <? } ?>
                        <? if ($this->permission_model->get_permission_user('services')) { ?>
                            <li class="treeview <?= strposa($uri, array('admin/service', 'admin/service_item')) !== FALSE ? 'active' : '' ?>">
                                <a href="#">
                                    <i class="fa fa-fw fa-wrench"></i> <span>Serviços</span> <i class="fa fa-angle-left pull-right"></i>
                                </a>
                                <ul class="treeview-menu">
                                    <li class="<?= strpos($uri, 'admin/service') !== FALSE && strpos($uri, 'admin/service_item') === FALSE ? 'active' : '' ?>">
                                        <a href="<?= site_url('admin/service') ?>">
                                            <i class="fa fa-fw fa-wrench"></i> <span>Página Serviços</span>
                                        </a>
                                    </li>
                                    <li class="<?= strpos($uri, 'admin/service_item') !== FALSE ? 'active' : '' ?>">
                                        <a href="<?= site_url('admin/service_item') ?>">
                                            <i class="fa fa-fw fa-list"></i> <span>Serviços - Item</span>
                                        </a>
                                    </li>
                                </ul>
                            </li>
                        <? } ?>
                        <? if ($this->permission_model->get_permission_user('terms')) { ?>
                            <li class="<?= strpos($uri, 'admin/terms') !== FALSE ? 'active' : NULL ?>">
                                <a href="<?= site_url('admin/terms') ?>">
                                    <i class="fa fa-fw fa-legal"></i> <span>Termos Legais</span>
                                </a>
                            </li>
                        <? } ?>
                        <? if ($this->permission_model->get_permission_user('faq')) { ?>
                            <li class="treeview <?= strposa($uri, array('admin/text_faq', 'admin/faq_category')) !== FALSE ? 'active' : '' ?>">
                                <a href="#">
                                    <i class="fa fa-fw fa-question"></i> <span>Tenho Dúvida</span> <i class="fa fa-angle-left pull-right"></i>
                                </a>
                                <ul class="treeview-menu">
                                    <li class="<?= strpos($uri, 'admin/text_faq') !== FALSE ? 'active' : '' ?>">
                                        <a href="<?= site_url('admin/text_faq') ?>">
                                            <i class="fa fa-fw fa-font"></i> <span>Textos</span>
                                        </a>
                                    </li>
                                    <li class="<?= strpos($uri, 'admin/faq_category') !== FALSE ? 'active' : '' ?>">
                                        <a href="<?= site_url('admin/faq_category') ?>">
                                            <i class="fa fa-fw fa-list"></i> <span>Categoria - Item</span>
                                        </a>
                                    </li>
                                </ul>
                            </li>
                        <? } ?>
                        <? if ($this->permission_model->get_permission_user('prices')) { ?>
                            <li class="treeview <?= strposa($uri, array('admin/text_plan', 'admin/proposal', 'admin/config', 'admin/plan', 'admin/package', 'admin/performance', 'admin/storage', 'admin/memory', 'admin/processing', 'admin/speed', 'admin/operational')) !== FALSE && strposa($uri, array('admin/configuration')) === FALSE? 'active' : '' ?>">
                                <a href="#">
                                    <i class="fa fa-fw fa-usd"></i> <span>Preços</span> <i class="fa fa-angle-left pull-right"></i>
                                </a>
                                <ul class="treeview-menu">
                                    <li class="<?= strpos($uri, 'admin/text_plan') !== FALSE ? 'active' : '' ?>">
                                        <a href="<?= site_url('admin/text_plan') ?>">
                                            <i class="fa fa-fw fa-font"></i> <span>Textos</span>
                                        </a>
                                    </li>
                                    <li class="<?= strpos($uri, 'admin/performance') !== FALSE ? 'active' : '' ?>">
                                        <a href="<?= site_url('admin/performance') ?>">
                                            <i class="fa fa-fw fa-tachometer"></i> <span>Performance</span>
                                        </a>
                                    </li>
                                    <li class="<?= strpos($uri, 'admin/proposal') !== FALSE ? 'active' : '' ?>">
                                        <a href="<?= site_url('admin/proposal') ?>">
                                            <i class="fa fa-fw fa-font"></i> <span>Textos Proposta</span>
                                        </a>
                                    </li>
                                    <li class="<?= strpos($uri, 'admin/operational') !== FALSE ? 'active' : '' ?>">
                                        <a href="<?= site_url('admin/operational') ?>">
                                            <i class="fa fa-fw fa-windows"></i> <span>Sistema Operacional</span>
                                        </a>
                                    </li>
                                    <li class="treeview <?= strposa($uri, array('admin/storage', 'admin/memory', 'admin/processing', 'admin/speed')) !== FALSE ? 'active' : '' ?>">
                                        <a href="#">
                                            <i class="fa fa-fw fa-bar-chart"></i> <span>Barras</span> <i class="fa fa-angle-left pull-right"></i>
                                        </a>
                                        <ul class="treeview-menu">
                                            <li class="<?= strpos($uri, 'admin/storage') !== FALSE ? 'active' : '' ?>">
                                                <a href="<?= site_url('admin/storage') ?>">
                                                    <i class="fa fa-fw fa-hdd-o"></i> <span>Armazenamento</span>
                                                </a>
                                            </li>
                                            <li class="<?= strpos($uri, 'admin/memory') !== FALSE ? 'active' : '' ?>">
                                                <a href="<?= site_url('admin/memory') ?>">
                                                    <i class="fa fa-fw fa-laptop"></i> <span>Memória</span>
                                                </a>
                                            </li>
                                            <li class="<?= strpos($uri, 'admin/processing') !== FALSE ? 'active' : '' ?>">
                                                <a href="<?= site_url('admin/processing') ?>">
                                                    <i class="fa fa-fw fa-microchip"></i> <span>Processamento</span>
                                                </a>
                                            </li>
                                            <li class="<?= strpos($uri, 'admin/speed') !== FALSE ? 'active' : '' ?>">
                                                <a href="<?= site_url('admin/speed') ?>">
                                                    <i class="fa fa-fw fa-tachometer"></i> <span>Velocidade</span>
                                                </a>
                                            </li>
                                        </ul>
                                    </li>
                                    <li class="treeview <?= strposa($uri, array('admin/plan', 'admin/config')) !== FALSE && strpos($uri, 'admin/configuration') === FALSE ? 'active' : '' ?>">
                                        <a href="#">
                                            <i class="fa fa-fw fa-th-large"></i> <span>Planos</span> <i class="fa fa-angle-left pull-right"></i>
                                        </a>
                                        <ul class="treeview-menu">
                                            <li class="<?= strpos($uri, 'admin/config') !== FALSE ? 'active' : '' ?>">
                                                <a href="<?= site_url('admin/config') ?>">
                                                    <i class="fa fa-fw fa-cogs"></i> <span>Itens de Configuração</span>
                                                </a>
                                            </li>

                                            <li class="<?= strpos($uri, 'admin/plan') !== FALSE ? 'active' : '' ?>">
                                                <a href="<?= site_url('admin/plan') ?>">
                                                    <i class="fa fa-fw fa-th-large"></i> <span>Cadastro Planos</span>
                                                </a>
                                            </li>
                                        </ul>
                                    </li>
                                </ul>
                            </li>
                        <? } ?>
                        <? if ($this->permission_model->get_permission_user('contact')) { ?>
                            <li class="treeview <?= strposa($uri, array('admin/text_contact_us', 'admin/department', 'admin/contact_us', 'admin/call', 'admin/join_us', 'admin/partner_contact', 'admin/startup_contact')) !== FALSE ? 'active' : '' ?>">
                                <a href="#">
                                    <i class="fa fa-fw fa-comment"></i> <span>Contato</span> <i class="fa fa-angle-left pull-right"></i>
                                </a>
                                <ul class="treeview-menu">
                                    <li class="<?= strpos($uri, 'admin/text_contact_us') !== FALSE ? 'active' : '' ?>">
                                        <a href="<?= site_url('admin/text_contact_us') ?>">
                                            <i class="fa fa-fw fa-font"></i> <span>Contato - Textos</span>
                                        </a>
                                    </li>
                                    <li class="<?= strpos($uri, 'admin/department') !== FALSE ? 'active' : '' ?>">
                                        <a href="<?= site_url('admin/department') ?>">
                                            <i class="fa fa-fw fa-th-large"></i> <span>Contato - Departamentos</span>
                                        </a>
                                    </li>
                                    <li class="<?= strpos($uri, 'admin/contact_us') !== FALSE ? 'active' : '' ?>">
                                        <a href="<?= site_url('admin/contact_us') ?>">
                                            <i class="fa fa-fw fa-comments"></i> <span>Fale Conosco</span>
                                        </a>
                                    </li>
                                    <li class="<?= strpos($uri, 'admin/call') !== FALSE ? 'active' : '' ?>">
                                        <a href="<?= site_url('admin/call') ?>">
                                            <i class="fa fa-fw fa-phone"></i> <span>Ligue-me</span>
                                        </a>
                                    </li>
                                    <li class="<?= strpos($uri, 'admin/join_us') !== FALSE ? 'active' : '' ?>">
                                        <a href="<?= site_url('admin/join_us') ?>">
                                            <i class="fa fa-fw fa-briefcase"></i> <span>Trabalhe Conosco</span>
                                        </a>
                                    </li>
                                    <li class="<?= strpos($uri, 'admin/partner_contact') !== FALSE ? 'active' : '' ?>">
                                        <a href="<?= site_url('admin/partner_contact') ?>">
                                            <i class="fa fa-fw fa-user-plus"></i> <span>Seja um Parceiro</span>
                                        </a>
                                    </li>
                                    <li class="<?= strpos($uri, 'admin/startup_contact') !== FALSE ? 'active' : '' ?>">
                                        <a href="<?= site_url('admin/startup_contact') ?>">
                                            <i class="fa fa-fw fa-bolt"></i> <span>Startup's</span>
                                        </a>
                                    </li>
                                </ul>
                            </li>
                        <? } ?>
                        <? if ($this->permission_model->get_permission_user('log_modification')) { ?>
                            <li class="<?= strpos($uri, 'admin/log_modification') !== FALSE ? 'active' : NULL ?>">
                                <a href="<?= site_url('admin/log_modification') ?>">
                                    <i class="fa fa-fw fa-history"></i> <span>Histórico de Modificações</span>
                                </a>
                            </li>
                        <? } ?>
                    </ul>
                </section>
            </aside>
