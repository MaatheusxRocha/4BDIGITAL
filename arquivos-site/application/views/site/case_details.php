<section class="cases-details">
    <div class="container clearfix">
        <div class="row clearfix">
            <div class="col-6 case-text">
                <h3><?= $details->name ?></h3>
                <?= $details->description ?>

                <div class="col-12 label">
                    <a href="<?= site_url($this->lang->line('url_contact')) ?>"><?= $this->lang->line('btn_next_case') ?></a>
                </div>
            </div>

            <div class="col-6 case-images">
                <? if (!empty($details->image_enterprise)) { ?>
                    <div class="col-12 case-images_company">
                        <img src="<?=base_url($details->image_enterprise)?>" alt="<?=$details->name?>" draggable="false">
                    </div>
                <? } ?>
                <? if (!empty($details->image_person)) { ?>
                <div class="col-6 case-images_person">
                    <img src="<?=base_url($details->image_person)?>" alt="<?=$details->name?>" draggable="false">
                </div>
                <?}?>
                <div class="col-6 case-images_logo">
                    <img src="<?=base_url($details->image_logo)?>" alt="Logo <?=$details->name?>" draggable="false">
                </div>

                <div class="col-12 label">
                    <a href="<?=  site_url($this->lang->line('url_cases'))?>"><?=$this->lang->line('view_all_cases')?></a>
                </div>
            </div>
        </div>
    </div>
</section>
