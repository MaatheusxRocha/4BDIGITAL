
<section class="community-title">
    <div class="container clearfix">
        <div class="row clearfix">
            <div class="col-12 title">
                <h1><p><?= $page->title_one ?> <strong><?= $page->title_two ?></strong></p></h1>
            </div>
            <div class="col-12 community-text">
                <p><?= $page->subtitle ?></p>
            </div>
        </div>
    </div>
</section>
<? if (!empty($page->video)) { ?>
    <section class="community-video">
        <div class="container clearfix">
            <div class="row clearfix">
                <div class="col-12 tv">
                    <div class="tv-item">
                        <div class="tv-item_text">
                            <img src="<?= base_url('assets/' . SCRIPTS_FOLDER . '/site/images/tv.png') ?>" alt="icon tv" draggable="false">

                            <div>
                                <h4><?= $this->lang->line('tv_brascloud') ?></h4>
                                <span><?= $page->video_text ?></span>
                                <? if (isset($configuration) && !empty($configuration->youtube)) { ?>
                                    <a href="<?= $configuration->youtube ?>" target="_blank"><?= $this->lang->line('instruction_video') ?></a>
                                <? } ?>
                            </div>
                        </div>
                    </div>

                    <div class="tv-item">
                        <div class="tv-item_video">
                            <a href="https://www.youtube.com/watch?v=<?= $page->video ?>&rel=0" class="video">
                                <? if (!empty($page->video_cover)) { ?>
                                    <img src="<?= base_url($page->video_cover) ?>" alt="<?= $page->video ?>" draggable="false">
                                <? } else { ?>
                                    <img src="http://img.youtube.com/vi/<?= $page->video ?>/maxresdefault.jpg" alt="<?= $page->video ?>" draggable="false">
                                <? } ?>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
<? } ?>
<? if (!empty($page->blog_text) || !empty($page->wiki_text)) { ?>
    <section class="community-blog">
        <div class="container clearfix">
            <div class="row clearfix">
                <? if (!empty($page->blog_text)) { ?>
                    <div class="blog-item">
                        <h3><?= $this->lang->line('blog') ?></h3>
                        <p><?= $page->blog_text ?></p>
                        <? if (isset($configuration) && $configuration->link_blog) { ?>
                            <div class="col-12 label">
                                <a href="<?= $configuration->link_blog ?>"><?= $this->lang->line('btn_blog') ?></a>
                            </div>
                        <? } ?>
                    </div>
                <? } ?>
                <? if (!empty($page->wiki_text)) { ?>
                    <div class="blog-item">
                        <h3><?= $this->lang->line('wiki') ?></h3>
                        <p><?= $page->wiki_text ?></p>
                        <? if (isset($configuration) && $configuration->link_wiki) { ?>
                            <div class="col-12 label">
                                <a href="<?= $configuration->link_wiki ?>"><?= $this->lang->line('btn_wiki') ?></a>
                            </div>
                        <? } ?>
                    </div>
                <? } ?>
            </div>
        </div>
    </section>
<? } ?>
