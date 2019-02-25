<section class="cases">
    <div class="container clearfix">
        <div class="row clearfix">
            <? if (isset($page)) { ?>
                <div class="col-12 title">
                    <h1><p><?= $page->title_one ?> <strong><?= $page->title_two ?></strong></p></h1>
                    <span><?= $page->subtitle ?></span>
                </div>
            <? } ?>

            <div class="col-12 cases-list">
                <? foreach ($cases as $case) { ?>
                    <div class="col-3 case">
                        <a href="<?= site_url($this->lang->line('url_case_details') . '/' . $case->id . '/' . simple_url($case->name)) ?>">
                            <img src="<?= base_url($case->image_logo) ?>" alt="<?= $case->name ?>">
                            <span><?= $this->lang->line('more_details_case') ?></span>
                        </a>
                    </div>
                <? } ?>
            </div>

            <div class="col-12 label">
                <a href="<?=  site_url($this->lang->line('url_contact'))?>"><?=$this->lang->line('btn_next_case')?></a>
            </div>
        </div>
    </div>
</section>
