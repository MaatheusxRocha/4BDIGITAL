<section class="top-title startup-title">
    <picture>
        <source srcset="<?= base_url($page->image_mobile) ?>" media="(max-width: 1025px)">
        <img src="<?= base_url($page->image) ?>" alt="<?= strip_tags($page->title)?>" draggable="false">
    </picture>
    <div class="container">
        <h1><?= strpos($page->title, '<p>') === FALSE ? "<p>$page->title</p>" : $page->title ?></h1>
    </div>
    <div class="col-4 startup-coupons startup-coupons_responsive">
        <div class="coupon">
            <div>
                <?= $this->lang->line('coupon_text_1') ?> <span><a href="<?= site_url($this->lang->line('url_startup_signup')) ?>"><?= $this->lang->line('coupon_link') ?></a></span> <?= $this->lang->line('coupon_text_2') ?>
            </div>
        </div>
    </div>
</section>
<? if (count($sliders)) { ?>
    <section class="startup-slides">
        <div class="container clearfix">
            <div class="startup-slider">
                <? foreach ($sliders as $s) { ?>
                    <div class="startup-slide">
                        <?= $s->text ?>
                        <a href="<?= $s->link ?>"><?= $s->button ?></a>
                    </div>  
                <? } ?>
            </div>
        </div>
    </section>
<? } ?>
<section class="startup-coupon">
    <div class="container clearfix">
        <div class="row clearfix">
            <div class="col-12 coupon-title">
                <h2><?= $page->title_offer ?></h2>
            </div>

            <div class="col-12">
                <div class="col-4 startup-coupons">
                    <div class="coupon">
                        <div>
                            <?= $this->lang->line('coupon_text_1') ?> <span><a href="<?= site_url($this->lang->line('url_startup_signup')) ?>"><?= $this->lang->line('coupon_link') ?></a></span> <?= $this->lang->line('coupon_text_2') ?>
                        </div>
                    </div>
                </div>
                <div class="col-8 startup-benefits">
                    <div class="col-12 advantages">
                        <? foreach ($items as $item) { ?>
                            <div class="col-4 advantage">
                                <img src="<?= base_url($item->image) ?>" alt="<?= $item->text ?>" draggable="false">
                                <p><?= $item->text ?></p>
                            </div>
                        <? } ?>
                        <div class="col-12 startup-signup_link label">
                            <a href="<?= site_url($this->lang->line('url_startup_signup')) ?>"><?=$this->lang->line('btn_register')?></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
