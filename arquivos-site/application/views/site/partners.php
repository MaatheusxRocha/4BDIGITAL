<section class="top-title partners-top-title">
    <img src="<?= base_url($page->image_top) ?>" alt="<?= strip_tags($page->title)?>" draggable="false">
    <div class="container">
        <h1><?= strpos($page->title, '<p>') === FALSE ? "<p>$page->title</p>" : $page->title ?></h1>
    </div>
</section>

<section class="partners-texts">
    <div class="container clearfix">
        <div class="row clearfix">
            <div class="col-12 partners-text">
                <?= $page->description ?>
            </div>
            <div class="col-12 partners-image">
                <picture>
                    <source srcset="<?= base_url($page->image_mobile) ?>" media="(max-width: 1025px)">
                    <img src="<?= base_url($page->image) ?>" alt="partners-image" draggable="false">
                </picture>
            </div>

            <div class="col-12 commercial">
                <div class="commercial-image">
                    <picture>
                        <source srcset="<?= base_url($page->commercial_image_mobile) ?>" media="(max-width: 1025px)">
                        <img src="<?= base_url($page->commercial_image) ?>" alt="commercial-image" draggable="false">
                    </picture>
                </div>
                <div class="commercial-text">
                    <p><?= $page->commercial_description_one ?> <strong><?= $page->commercial_description_two ?></strong></p>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="partners-advantages">
    <div class="container clearfix">
        <div class="row clearfix">
            <div class="col-12 partners-advantages_title">
                <h2><span><?= $page->advantage_title ?></span> <a href="<?= site_url($this->lang->line('url_partner_register')) ?>"><?= $this->lang->line('btn_register') ?></a></h2>
            </div>

            <div class="col-12 advantages">
                <? foreach ($items as $item) { ?>
                    <div class="col-3 advantage">
                        <img src="<?= base_url($item->image) ?>" alt="<?= $item->name ?>" draggable="false">
                        <strong><?= $item->name ?></strong>
                        <p><?= $item->description ?></p>
                    </div>
                <? } ?>
                <div class="col-12 partner-signup_link label">
                    <a href="<?= site_url($this->lang->line('url_partner_register')) ?>"><?= $this->lang->line('btn_register') ?></a>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="partners-steps">
    <div class="container clearfix">
        <div class="row clearfix">
            <div class="col-12 partners-steps_title">
                <h2><?= $page->easy_title ?></h2>
            </div>

            <div class="col-12 partners-steps_image">
                <picture>
                    <source srcset="<?= base_url($page->easy_image_mobile) ?>" media="(max-width: 1025px)">
                    <img src="<?= base_url($page->easy_image) ?>" alt="<?= $page->easy_title ?>" draggable="false">
                </picture>
            </div>
        </div>
    </div>
</section>