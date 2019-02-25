<section class="top-title architect-title">
    <img src="<?= base_url($architect->image) ?>" alt="<?= strip_tags($architect->title)?>" draggable="false">
    <div class="container">
        <h1><?= strpos($architect->title, '<p>') === FALSE ? "<p>$architect->title</p>" : $architect->title ?></h1>
    </div>
</section>
<? if (count($items)) { ?>
    <section class="architects">
        <div class="container clearfix">
            <div class="row clearfix">
                <div class="col-12 title">
                    <h1><p><?= $architect->advantage_title ?></p></h1>
                </div>

                <div class="col-12 advantages">
                    <? foreach ($items as $item) { ?>
                        <div class="col-3 advantage">
                            <div>
                                <img src="<?= base_url($item->image) ?>" alt="<?= $item->title ?>" draggable="false">
                                <strong><?= $item->title ?></strong>
                            </div>
                            <p><?= $item->description ?></p>
                        </div>
                    <? } ?>
                </div>
            </div>
        </div>
    </section>
<? } ?>
<section class="architect-topics">
    <div class="container clearfix">
        <div class="row clearfix">
            <div class="col-6 padding-right architect-topic">
                <h3><?= $architect->topic_title ?></h3>
                <img src="<?= base_url($architect->topic_image) ?>" alt="<?= $architect->topic_title ?>" draggable="false">
            </div>
            <div class="col-6 padding-left architect-topic">
                <? if (!empty($architect->video)) { ?>
                    <h3><?= $architect->video_title ?></h3>

                    <div class="tv-item_video">
                        <a href="https://www.youtube.com/watch?v=<?= $architect->video ?>&rel=0" class="video">
                            <? if (!empty($architect->video_cover)) { ?>
                                <img src="<?= base_url($architect->video_cover) ?>" alt="<?= $architect->video_title ?>" draggable="false">
                            <? } else { ?>
                                <img src="http://img.youtube.com/vi/<?= $architect->video ?>/maxresdefault.jpg" alt="<?= $architect->video_title ?>" draggable="false">
                            <? } ?>
                        </a>
                    </div>
                <? } ?>

                <div class="col-12 label">
                    <a href="<?= site_url($this->lang->line('url_contact')) ?>"><?= $this->lang->line('talk_architects') ?></a>
                </div>
            </div>
        </div>
    </div>
</section>
