<section class="faq">
    <div class="container clearfix">
        <div class="row clearfix">
            <div class="col-12 title">
                <h1><p><?= $texts->title_one ?> <strong><?= $texts->title_two ?></strong></p></h1>
            </div>

            <div class="col-2">
                <div class="col-6 padding-left faq-menu">
                    <? foreach ($categories as $c) { ?>
                        <a href="#" onclick="show_faq('<?= $c->id ?>')" title="<?= $c->name ?>"><?= $c->name ?></a>
                    <? } ?>
                </div>
            </div>

            <div class="col-10 faq-content padding-right">
                <div class="col-12 faq-form">
                    <h3><?= $texts->title_three ?></h3>
                    <?= form_open($this->lang->line('url_faq'), 'method="GET"') ?>
                    <input type="text" name="search" value="<?= isset($search) ? $search : '' ?>" placeholder="<?= $this->lang->line('placeholder_faq') ?>">
                    <button type="submit"><img src="<?= base_url('assets/' . SCRIPTS_FOLDER . '/site/images/lupa.svg') ?>" alt="icon lupa"></button>
                    <?= form_close() ?>
                </div>
                <? foreach ($categories as $index => $category) { ?>
                    <div class="col-12 questions" id="questions-<?= $category->id ?>" <?= $index != 0 ? 'style="display:none"' : '' ?>>
                        <h2><?= $category->name ?></h2>
                        <? foreach ($category->questions as $question) { ?>
                            <div class="col-12 question">
                                <h3><?= $question->question ?></h3>
                                <?= strpos($question->answer, '<p>') === FALSE ? "<p>$question->answer</p>" : $question->answer ?>
                            </div>
                        <? } ?>
                    </div>
                <? } ?>
                <? if (isset($configuration)) { ?>
                    <div class="faq-links">
                        <? if (!empty($configuration->link_wiki)) { ?>
                            <a href="<?= $configuration->link_wiki ?>" target="_blank" title="<?= $this->lang->line('wiki') ?>"><?= $this->lang->line('wiki') ?></a>
                        <? } ?>
                        <? if (!empty($configuration->link_blog)) { ?>
                            <a href="<?= $configuration->link_blog ?>" target="_blank" title="<?= $this->lang->line('blog') ?>"><?= $this->lang->line('blog') ?></a>
                        <? } ?>
                        <? if (!empty($configuration->youtube)) { ?>
                            <a href="<?= $configuration->youtube ?>" target="_blank" title="<?= $this->lang->line('tv_brascloud') ?>"><?= $this->lang->line('tv_brascloud') ?></a>
                        <? } ?>
                        <? if (!empty($configuration->link_portal)) { ?>
                            <a href="<?= $configuration->link_portal ?>" target="_blank" title="<?= $this->lang->line('call_portal') ?>"><?= $this->lang->line('call_portal') ?></a>
                        <? } ?>
                    </div>
                <? } ?>
            </div>
        </div>
    </div>
</section>

<section class="faq-contact">
    <div class="container clearfix">
        <div class="row clearfix">
            <div class="faq-contact_text">
                <?= $texts->text_contact_us ?>
            </div>
            <div class="faq-contact_link">
                <a href="<?=  site_url($this->lang->line('url_contact'))?>"><?=$this->lang->line('menu_contact')?></a>
            </div>
        </div>
    </div>
</section>
