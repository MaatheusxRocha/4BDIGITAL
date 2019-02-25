<section class="services-title">
    <div class="container clearfix">
        <div class="row clearfix">
            <div class="col-12 title">
                <h1><p><?= $service->title_one ?> <strong><?= $service->title_two ?></strong></p></h1>
                <span><?= str_replace(array('<p>','</p>'), array('', ' '),$service->subtitle) ?></span>
            </div>

            <div class="col-12 padding-top padding-left services-image">
                <picture>
                    <source srcset="<?= base_url($service->image_mobile) ?>" media="(max-width: 1025px)">
                    <img src="<?= base_url($service->image) ?>" alt="<?= $service->title_one ?>" draggable="false">
                </picture>
            </div>
        </div>
    </div>
</section>
<? if (count($items)) { ?>
    <section class="services-list">
        <div class="container clearfix">
            <div class="row clearfix">
                <div class="col-12 services-holder">
                    <div class="service-item service-title">
                        <div class="service-name">
                            <?= $this->lang->line('service') ?>
                        </div>
                        <div class="service-description">
                            <?= $this->lang->line('description') ?>
                        </div>
                    </div>
                    <? foreach ($items as $item) { ?>
                        <div class="service-item">
                            <div class="service-name">
                                <?=$item->name?>
                            </div>
                            <div class="service-description">
                                <?=$item->description?>
                            </div>
                        </div>
                    <? } ?>
                </div>
            </div>
        </div>
    </section>
<? } ?>
