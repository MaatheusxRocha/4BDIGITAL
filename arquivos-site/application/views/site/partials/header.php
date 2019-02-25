<!DOCTYPE html>
<html>
    <head>
<!-- Google Tag Manager -->
<script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
})(window,document,'script','dataLayer','GTM-TSSMWVF');</script>
<!-- End Google Tag Manager -->
        <meta charset="utf-8">
        <meta name="theme-color" content="#ffffff">
        <meta name="msapplication-TileColor" content="#ffffff">
        <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1">
        <meta name="msapplication-TileImage" content="images/favicon/ms-icon-144x144.png">

        <meta name="description" content="BRASCLOUD - A Sua Cloud no Brasil | Somos uma Cloud Brasileira que oferta uma cloud econômica, sendo uma opção viável para pequenos negócios. Somos uma opção que fala português, fatura em reais com impostos inclusos e ainda ajudamos os profissionais de TI a arquitetar o comportamento das soluções.">
        <meta name="keywords" content="cloud no Brasil, brascloud, cloud nacional, brascloud nuvem, cloud, nuvem, hospedagem, servidores, billing, por hora, suporte portugues, cloud gerenciada, data center proprio, iaas, backup, disaster recovery, site backup, cloud server, public cloud, cloud iaas, baixa latencia, ix sp, ix br, backbone, data center, open source, open compute project, dupla abordagem, suporte cloud, suporte">
        <meta name="author" content="Trend Mobile | trendmobile.com.br">
        <meta name="reply-to" content="atendimento@trendmobile.net.br">

        <link href="<?= base_url('assets/' . SCRIPTS_FOLDER . '/site/images/favicon/apple/apple-icon-57x57.png') ?>" rel="apple-touch-icon" sizes="57x57">
        <link href="<?= base_url('assets/' . SCRIPTS_FOLDER . '/site/images/favicon/apple/apple-icon-60x60.png') ?>" rel="apple-touch-icon" sizes="60x60">
        <link href="<?= base_url('assets/' . SCRIPTS_FOLDER . '/site/images/favicon/apple/apple-icon-72x72.png') ?>" rel="apple-touch-icon" sizes="72x72">
        <link href="<?= base_url('assets/' . SCRIPTS_FOLDER . '/site/images/favicon/apple/apple-icon-76x76.png') ?>" rel="apple-touch-icon" sizes="76x76">
        <link href="<?= base_url('assets/' . SCRIPTS_FOLDER . '/site/images/favicon/apple/apple-icon-114x114.png') ?>" rel="apple-touch-icon" sizes="114x114">
        <link href="<?= base_url('assets/' . SCRIPTS_FOLDER . '/site/images/favicon/apple/apple-icon-120x120.png') ?>" rel="apple-touch-icon" sizes="120x120">
        <link href="<?= base_url('assets/' . SCRIPTS_FOLDER . '/site/images/favicon/apple/apple-icon-144x144.png') ?>" rel="apple-touch-icon" sizes="144x144">
        <link href="<?= base_url('assets/' . SCRIPTS_FOLDER . '/site/images/favicon/apple/apple-icon-152x152.png') ?>" rel="apple-touch-icon" sizes="152x152">
        <link href="<?= base_url('assets/' . SCRIPTS_FOLDER . '/site/images/favicon/apple/apple-icon-180x180.png') ?>" rel="apple-touch-icon" sizes="180x180">
        <link href="<?= base_url('assets/' . SCRIPTS_FOLDER . '/site/images/favicon/android/android-icon-192x192.png') ?>" rel="icon" type="image/png" sizes="192x192">
        <link href="<?= base_url('assets/' . SCRIPTS_FOLDER . '/site/images/favicon/favicon-32x32.png') ?>" rel="icon" type="image/png" sizes="32x32">
        <link href="<?= base_url('assets/' . SCRIPTS_FOLDER . '/site/images/favicon/favicon-96x96.png') ?>" rel="icon" type="image/png" sizes="96x96">
        <link href="<?= base_url('assets/' . SCRIPTS_FOLDER . '/site/images/favicon/favicon-16x16.png') ?>" rel="icon" type="image/png" sizes="16x16">
        <link href="<?= base_url('assets/' . SCRIPTS_FOLDER . '/site/images/favicon/manifest.json') ?>" rel="manifest">

        <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700,800" rel="stylesheet">
        <link href="<?= base_url('assets/' . SCRIPTS_FOLDER . '/site/stylesheets/stylesheet.css?=' . VERSION) ?>" rel="stylesheet">

        <!--[if lt IE 9]>
          <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
          <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
        <![endif]-->

        <? if (isset($og_properties) && !empty($og_properties)) { ?>
            <!--facebook--> 
            <meta property="og:url" content="<?= current_url() ?>" /> 
            <meta property="og:type" content="website" /> 
            <meta property="og:title" content="<?= $og_properties['title'] ?>" /> 
            <meta property="og:description" content="<?= $og_properties['description'] ?>" /> 
            <? if (isset($og_properties['image']) && !empty($og_properties['image'])) { ?>
                <meta property="og:image" content="<?= $og_properties['image'] ?>" />
            <? } ?>
        <? } ?>

        <title><?= isset($title) ? $title : 'BRASCLOUD | Nós somos a única empresa na américa latina a ofertar uma nuvem publica econômica de baixa latência. Com datacenter próprio e tecnologia hiperconvergente, construída com o mesmo padrão das gigantes mundiais, capaz de democratizar o acesso a nuvem de micro e pequenos empreendedores.' ?></title>
		
		<!-- Global Site Tag (gtag.js) - Google Analytics -->
<script async src="https://www.googletagmanager.com/gtag/js?id=UA-81748810-1"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments)};
  gtag('js', new Date());

  gtag('config', 'UA-81748810-1');
  gtag('config', 'AW-1016246385');
</script>


<!-- Facebook Pixel Code -->
<script>
  !function(f,b,e,v,n,t,s)
  {if(f.fbq)return;n=f.fbq=function(){n.callMethod?
  n.callMethod.apply(n,arguments):n.queue.push(arguments)};
  if(!f._fbq)f._fbq=n;n.push=n;n.loaded=!0;n.version='2.0';
  n.queue=[];t=b.createElement(e);t.async=!0;
  t.src=v;s=b.getElementsByTagName(e)[0];
  s.parentNode.insertBefore(t,s)}(window, document,'script',
  'https://connect.facebook.net/en_US/fbevents.js');
  fbq('init', '1839498886121148');
  fbq('track', 'PageView');
</script>
<noscript><img height="1" width="1" style="display:none"
  src="https://www.facebook.com/tr?id=1839498886121148&ev=PageView&noscript=1"
/></noscript>
<!-- End Facebook Pixel Code -->


<meta name="google-site-verification" content="6F8t55ukXeVzqVnBmE2thudto8uxw0sub_7AVIVyBU8" />




<!--Start of Tawk.to Script-->
<script type="text/javascript">
var Tawk_API=Tawk_API||{}, Tawk_LoadStart=new Date();
(function(){
var s1=document.createElement("script"),s0=document.getElementsByTagName("script")[0];
s1.async=true;
s1.src='https://embed.tawk.to/5b6983eddf040c3e9e0c5d8e/default';
s1.charset='UTF-8';
s1.setAttribute('crossorigin','*');
s0.parentNode.insertBefore(s1,s0);
})();
</script>
<!--End of Tawk.to Script-->



<script>
  window.fbAsyncInit = function() {
    FB.init({
      appId      : '{your-app-id}',
      cookie     : true,
      xfbml      : true,
      version    : '{api-version}'
    });
      
    FB.AppEvents.logPageView();   
      
  };

  (function(d, s, id){
     var js, fjs = d.getElementsByTagName(s)[0];
     if (d.getElementById(id)) {return;}
     js = d.createElement(s); js.id = id;
     js.src = "https://connect.facebook.net/en_US/sdk.js";
     fjs.parentNode.insertBefore(js, fjs);
   }(document, 'script', 'facebook-jssdk'));
</script>







    </head>



<script type="text/javascript">
_linkedin_partner_id = "382956";
window._linkedin_data_partner_ids = window._linkedin_data_partner_ids || [];
window._linkedin_data_partner_ids.push(_linkedin_partner_id);
</script><script type="text/javascript">
(function(){var s = document.getElementsByTagName("script")[0];
var b = document.createElement("script");
b.type = "text/javascript";b.async = true;
b.src = "https://snap.licdn.com/li.lms-analytics/insight.min.js";
s.parentNode.insertBefore(b, s);})();
</script>
<noscript>
<img height="1" width="1" style="display:none;" alt="" src="https://dc.ads.linkedin.com/collect/?pid=382956&fmt=gif" />
</noscript>



    <body>
<!-- Google Tag Manager (noscript) -->
<noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-TSSMWVF"
height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
<!-- End Google Tag Manager (noscript) -->
        <div id="wrapper">

            <header class="top" id="top">
                <div class="container clearfix">
                    <div class="top-logo">
                        <h1>
                            <a href="<?= site_url() ?>" title="BRASCLOUD">
                                <img src="<?= base_url('assets/' . SCRIPTS_FOLDER . '/site/images/logo.png') ?>" alt="BRASCLOUD" draggable="false">
                            </a>
                        </h1>
                    </div>
                    <? $uri = uri_string(); ?>
                    <div class="top-menus">
                        <div class="top-actions">
                            <div class="top-actions_links">
                                <? if (isset($configuration)) { ?>
                                    <a href="<?= $configuration->link_entry ?>" class="active"><?= $this->lang->line('btn_entry') ?></a>
                                <? } ?>
                                <a <?= $uri == $this->lang->line('url_contact') ? 'class="active-link"' : '' ?> href="<?= site_url($this->lang->line('url_contact')) ?>"><?= $this->lang->line('btn_help') ?></a>
                            </div>
                            <div class="top-actions_search">
                                <?= form_open('/', 'method="GET"') ?>
                                <label for="search">
                                    <svg version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
                                         viewBox="0 0 20 20" style="enable-background:new 0 0 20 20;" xml:space="preserve">
                                    <g id="LUPA">
                                    <path class="st0" d="M6.7,2.8c-2.2,0-4,1.8-4,4c0,0.2,0.2,0.4,0.4,0.4c0.2,0,0.4-0.2,0.4-0.4C3.5,5,5,3.5,6.7,3.5
                                          c0.2,0,0.4-0.2,0.4-0.4C7.1,2.9,6.9,2.8,6.7,2.8L6.7,2.8z M6.7,2.8"/>
                                    <path class="st0" d="M13.8,11.4c-0.1-0.1-0.4-0.1-0.5,0l-0.7,0.7l-0.9-0.9c1.1-1.2,1.7-2.8,1.7-4.5
                                          c0-3.7-3-6.7-6.7-6.7C3,0,0,3,0,6.7c0,3.7,3,6.7,6.7,6.7c1.7,0,3.3-0.7,4.5-1.7l0.9,0.9l-0.7,0.7c-0.1,0.1-0.1,0.2-0.1,0.3
                                          c0,0.1,0,0.2,0.1,0.3l5.8,5.8c0.2,0.2,0.5,0.4,0.9,0.4c0.3,0,0.6-0.1,0.9-0.4l0.6-0.6c0.2-0.2,0.4-0.5,0.4-0.9s-0.1-0.6-0.4-0.9
                                          L13.8,11.4z M0.7,6.7c0-3.3,2.7-6,6-6c3.3,0,6,2.7,6,6c0,3.3-2.7,6-6,6C3.4,12.7,0.7,10,0.7,6.7L0.7,6.7z M19.1,18.5l-0.6,0.6
                                          c-0.1,0.1-0.2,0.1-0.3,0.1c-0.1,0-0.2,0-0.3-0.1l-5.6-5.6l1.3-1.3l5.6,5.6c0.1,0.1,0.1,0.2,0.1,0.3C19.3,18.3,19.2,18.4,19.1,18.5
                                          L19.1,18.5z M19.1,18.5"/>
                                    </g>
                                    </svg>
                                    <?= strtoupper($this->lang->line('search')) ?>
                                </label>
                                <input type="text" name="search" value="" placeholder="<?= $this->lang->line('search') ?>" id="search">
                                <button type="submit">
                                    <svg version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
                                         viewBox="0 0 20 20" style="enable-background:new 0 0 20 20;" xml:space="preserve">
                                    <g id="LUPA">
                                    <path class="st0" d="M6.7,2.8c-2.2,0-4,1.8-4,4c0,0.2,0.2,0.4,0.4,0.4c0.2,0,0.4-0.2,0.4-0.4C3.5,5,5,3.5,6.7,3.5
                                          c0.2,0,0.4-0.2,0.4-0.4C7.1,2.9,6.9,2.8,6.7,2.8L6.7,2.8z M6.7,2.8"/>
                                    <path class="st0" d="M13.8,11.4c-0.1-0.1-0.4-0.1-0.5,0l-0.7,0.7l-0.9-0.9c1.1-1.2,1.7-2.8,1.7-4.5
                                          c0-3.7-3-6.7-6.7-6.7C3,0,0,3,0,6.7c0,3.7,3,6.7,6.7,6.7c1.7,0,3.3-0.7,4.5-1.7l0.9,0.9l-0.7,0.7c-0.1,0.1-0.1,0.2-0.1,0.3
                                          c0,0.1,0,0.2,0.1,0.3l5.8,5.8c0.2,0.2,0.5,0.4,0.9,0.4c0.3,0,0.6-0.1,0.9-0.4l0.6-0.6c0.2-0.2,0.4-0.5,0.4-0.9s-0.1-0.6-0.4-0.9
                                          L13.8,11.4z M0.7,6.7c0-3.3,2.7-6,6-6c3.3,0,6,2.7,6,6c0,3.3-2.7,6-6,6C3.4,12.7,0.7,10,0.7,6.7L0.7,6.7z M19.1,18.5l-0.6,0.6
                                          c-0.1,0.1-0.2,0.1-0.3,0.1c-0.1,0-0.2,0-0.3-0.1l-5.6-5.6l1.3-1.3l5.6,5.6c0.1,0.1,0.1,0.2,0.1,0.3C19.3,18.3,19.2,18.4,19.1,18.5
                                          L19.1,18.5z M19.1,18.5"/>
                                    </g>
                                    </svg>
                                </button>
                                <?= form_close() ?>
                            </div>
                            <div class="top-actions_language">
                                <?
                                foreach ($languages as $lang) {
                                    if ($lang->id == $current_language) {
                                        continue;
                                    }
                                    ?>
                                    <a href="<?= site_url('home/toggle_language/' . $lang->id) ?>" title="<?= $lang->name ?>"><?= $lang->name ?></a>
                                <? } ?>
                            </div>
                        </div>
                        <div class="top-menu">
                            <nav>
                                <ul>
                                    <li><a <?= $uri == $this->lang->line('url_prices') ? 'class="active"' : '' ?> href="<?= site_url($this->lang->line('url_prices')) ?>" title="<?= $this->lang->line('menu_prices') ?>"><?= $this->lang->line('menu_prices') ?></a></li>
                                    <li><a <?= $uri == $this->lang->line('url_partners') || $uri == $this->lang->line('url_partner_register') ? 'class="active"' : '' ?> href="<?= site_url($this->lang->line('url_partners')) ?>" title="<?= $this->lang->line('menu_partners') ?>"><?= $this->lang->line('menu_partners') ?></a></li>
                                    <li><a <?= $uri == $this->lang->line('url_startup') || $uri == $this->lang->line('url_startup_signup') ? 'class="active"' : '' ?> href="<?= site_url($this->lang->line('url_startup')) ?>" title="<?= $this->lang->line('menu_startup') ?>"><?= $this->lang->line('menu_startup') ?></a></li>
                                    <li><a <?= $uri == $this->lang->line('url_architects') ? 'class="active"' : '' ?> href="<?= site_url($this->lang->line('url_architects')) ?>"><?= $this->lang->line('menu_architects') ?></a></li>
                                    <li><a <?= $uri == $this->lang->line('url_faq') ? 'class="active"' : '' ?> href="<?= site_url($this->lang->line('url_faq')) ?>" title="<?= $this->lang->line('menu_faq') ?>"><?= $this->lang->line('menu_faq') ?></a></li>
                                </ul>
                            </nav>
                        </div>
                        <div class="top-menu_responsive">
                            <nav>
                                <ul>
                                    <li class="responsive-search-holder">
                                        <?= form_open('/', 'method="GET" class="responsive-search"') ?>
                                        <input type="text" name="search" value="" placeholder="<?= $this->lang->line('search') ?>" id="search">
                                        <button type="submit">
                                            <svg version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
                                                 viewBox="0 0 20 20" style="enable-background:new 0 0 20 20;" xml:space="preserve">
                                            <g id="LUPA">
                                            <path class="st0" d="M6.7,2.8c-2.2,0-4,1.8-4,4c0,0.2,0.2,0.4,0.4,0.4c0.2,0,0.4-0.2,0.4-0.4C3.5,5,5,3.5,6.7,3.5
                                                  c0.2,0,0.4-0.2,0.4-0.4C7.1,2.9,6.9,2.8,6.7,2.8L6.7,2.8z M6.7,2.8"/>
                                            <path class="st0" d="M13.8,11.4c-0.1-0.1-0.4-0.1-0.5,0l-0.7,0.7l-0.9-0.9c1.1-1.2,1.7-2.8,1.7-4.5
                                                  c0-3.7-3-6.7-6.7-6.7C3,0,0,3,0,6.7c0,3.7,3,6.7,6.7,6.7c1.7,0,3.3-0.7,4.5-1.7l0.9,0.9l-0.7,0.7c-0.1,0.1-0.1,0.2-0.1,0.3
                                                  c0,0.1,0,0.2,0.1,0.3l5.8,5.8c0.2,0.2,0.5,0.4,0.9,0.4c0.3,0,0.6-0.1,0.9-0.4l0.6-0.6c0.2-0.2,0.4-0.5,0.4-0.9s-0.1-0.6-0.4-0.9
                                                  L13.8,11.4z M0.7,6.7c0-3.3,2.7-6,6-6c3.3,0,6,2.7,6,6c0,3.3-2.7,6-6,6C3.4,12.7,0.7,10,0.7,6.7L0.7,6.7z M19.1,18.5l-0.6,0.6
                                                  c-0.1,0.1-0.2,0.1-0.3,0.1c-0.1,0-0.2,0-0.3-0.1l-5.6-5.6l1.3-1.3l5.6,5.6c0.1,0.1,0.1,0.2,0.1,0.3C19.3,18.3,19.2,18.4,19.1,18.5
                                                  L19.1,18.5z M19.1,18.5"/>
                                            </g>
                                            </svg>
                                        </button>
                                        <?= form_close() ?>
                                    </li>
                                    <li><a href="<?= site_url($this->lang->line('url_prices_table')) ?>" title="<?= $this->lang->line('menu_prices') ?>"><?= $this->lang->line('menu_prices') ?></a></li>
                                    <li><a href="<?= site_url($this->lang->line('url_about')) ?>"><?= $this->lang->line('menu_about') ?></a></li>
									<li><a href="<?= site_url($this->lang->line('url_cases')) ?>"><?= $this->lang->line('menu_cases') ?></a></li>
                                    <li><a href="<?= site_url($this->lang->line('url_architects')) ?>"><?= $this->lang->line('menu_architects') ?></a></li>
                                    <li><a href="<?= site_url($this->lang->line('url_partners')) ?>"><?= $this->lang->line('menu_partners') ?></a></li>
                                    <li><a href="<?= site_url($this->lang->line('url_why_create')) ?>"><?= $this->lang->line('menu_why_create') ?></a></li>
                                    <li><a href="<?= site_url($this->lang->line('url_services')) ?>"><?= $this->lang->line('menu_services') ?></a></li>
                                    <li><a href="<?= site_url($this->lang->line('url_startup')) ?>"><?= $this->lang->line('menu_startup') ?></a></li>
                                    <? if (isset($configuration) && !empty($configuration->link_new_account)) { ?>
                                        <li><a href="<?= $configuration->link_new_account ?>" title="<?=$this->lang->line('create_your_account')?>"><?=$this->lang->line('create_your_account')?></a></li>
                                    <? } ?>
                                </ul>
                            </nav>
                        </div>
                    </div>
                    
                    <div class="menu-toggle">
                        <span class="menu-bar top"></span>
                        <span class="menu-bar center"></span>
                        <span class="menu-bar bottom"></span>
                    </div>
                </div>
            </header>
