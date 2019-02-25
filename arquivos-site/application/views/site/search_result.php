
<section class="search-title">
    <div class="container clearfix">
        <div class="col-12 title">
            <h1><p><strong><?= $this->lang->line('results_for') ?> "<?= $search ?>"</strong></p></h1>
        </div>
    </div>
</section>

<section class="search-results">
    <div class="container clearfix">
        <? foreach ($results as $item) { ?>
            <div class="col-12 search-result">
                <a href="<?=!empty($item['link']) ? $item['link'] : '#'?>" title="<?=$this->lang->line('view_result')?>">
                    <h3><?= str_replace($search, '<mark>'.$search.'</mark>', $item['title'])?></h3>
                    <p><?= str_replace($search, '<mark>'.$search.'</mark>', $item['description'])?></p>
                </a>
            </div>
        <? } ?>
    </div>
</section>
