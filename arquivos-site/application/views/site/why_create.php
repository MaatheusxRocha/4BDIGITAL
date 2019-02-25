
<section class="create">
    <div class="container clearfix">
        <div class="row clearfix">
            <div class="col-12 title">
                <h1><p><?= $page->title_one ?> <strong><?= $page->title_two ?></strong></p></h1>
            </div>

            <div class="create-title">
                <h3><?= $page->title_left ?></h3>
                <?= $page->description ?>
            </div>
        </div>
    </div>
</section>
<? if (count($items)) { ?>
    <section class="motives-holder">
        <div class="container clearfix">
            <div class="row clearfix">
                <div class="col-12 motives">
                    <? foreach ($items as $item) { ?>
                        <div class="col-twenty motive">
                            <img src="<?=  base_url($item->image)?>" alt="<?=$item->title?>" draggable="false">
                            <strong><?=$item->title?></strong>
                            <p><?=$item->description?></p>
                        </div>
                    <? } ?>
                </div>
            </div>
        </div>
    </section>
<? } ?>
<section class="demand">
    <div class="container clearfix">
        <div class="row clearfix">
            <div class="col-12">
                <div class="demand-title">
                    <h3><?= $page->on_demand_left ?></h3>
                    <?= $page->on_demand_right ?>
                </div>
            </div>
            <div class="col-12 demand-image">
                <pitcure>
                    <source srcset="<?= base_url($page->on_demand_image_mobile) ?>" media="(max-width: 1025px)">
                    <img src="<?= base_url($page->on_demand_image) ?>" alt="<?= $page->on_demand_left ?>" draggable="false">
                </pitcure>
            </div>
            <? if (isset($configuration) && $configuration->link_new_account) { ?>
                <div class="col-4">
                    &nbsp;
                </div>
                <div class="col-4 demand-account">
                    <div class="label">
                        <a href="<?= $configuration->link_new_account ?>"><?= $this->lang->line('create_account') ?></a>
                    </div>
                </div>
                <div class="col-4">
                    &nbsp;
                </div>
            <? } ?>
        </div>
    </div>
</section>
