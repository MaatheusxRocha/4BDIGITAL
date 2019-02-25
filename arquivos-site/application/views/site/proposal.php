<section class="proposal">
    <div class="container clearfix">
        <div class="row clearfix">
            <div class="col-12">
                <div class="col-6 proposal-title">
                    <h2><?= $proposal->title ?></h2>
                </div>
                <div class="col-6 proposal-logo">
                    <img src="<?= base_url('assets/' . SCRIPTS_FOLDER . '/site/images/logo.png') ?>" alt="logo" width="174" height="62" draggable="false">
                    <!-- width: 174px;
                    height: 62px; -->
                </div>
            </div>

            <div class="col-12 proposal-table">
                <h3><?= $proposal->subtitle ?></h3>

                <table>
                    <tr>
                        <td><?= $this->lang->line('operational_system') ?></td>
                        <td><?= $operational->name ?></td>
                    </tr>
                    <tr>
                        <td><?= $processing->name ?></td>
                        <td><?= $processing_value ?> VCPU</td>
                    </tr>
                    <tr>
                        <td><?= $speed->name ?></td>
                        <td><?= $speed->frequency ?> GHz</td>
                    </tr>
                    <tr>
                        <td><?= $memory->name ?></td>
                        <td><?= $memory_value ?> GB</td>
                    </tr>
                    <tr>
                        <td><?= $storage->name ?></td>
                        <td><?= $storage_value ?> GB</td>
                    </tr>
                    <? if (isset($text_home)) { ?>
                        <tr>
                            <td><?= $this->lang->line('transfer') ?></td>
                            <td><?= $text_home->transfer ?></td>
                        </tr>
                    <? } ?>
                </table>
            </div>

            <div class="col-12 proposal-text">
                <?= $proposal->description ?>
            </div>

            <div class="col-6 proposal-value">
              <h2><?=$this->lang->line('values')?></h2>
              <div class="proposal-value_price">
                  <p>
                      <strong><?=$this->lang->line('total_estimated')?></strong>
                      <span>R$<?= number_format($value_month,2,',','.')?> <?=$this->lang->line('month')?></span>
                      <span>R$<?= number_format($value_hour,2,',','.')?> <?=$this->lang->line('hour')?></span>
                  </p>
                  <img src="<?= base_url('assets/'.SCRIPTS_FOLDER.'/site/images/calc.png')?>" alt="Icon calculator" draggable="false">
              </div>

          </div>

          <div class="col-6 proposal-signature">
                <p><?= $this->lang->line('brazil') ?>, <?= date('d') ?> de <?= month(date('m')) ?> de <?= date('Y') ?>.</p>
                <img src="<?= base_url($proposal->image_signature) ?>" alt="<?=$proposal->name?>">
                <p><strong><?= $proposal->name ?></strong></p>
                <p><?= $proposal->job ?></p>
            </div>

            <div class="col-12 proposal-footer">
                <img src="<?= base_url('assets/' . SCRIPTS_FOLDER . '/site/images/leaf.png') ?>" alt="Icon leaf">
                <p><strong><?= site_url() ?></strong></p>
                <p><?= $this->lang->line('email') ?>: <?= $configuration->email ?> | <?= $this->lang->line('comercial_phone') ?>: +55 <?= str_replace(array(')'),array(') '),$configuration->phone) ?></p>
            </div>

            <div class="col-12 proposal-print margin-top-big">
                <div class="col-4">
                    &nbsp;
                </div>
                <div class="col-4">
                    <div class="label">
                        <button type="button" name="button" onclick="javascript:window.print()"><?= $this->lang->line('print_proposal') ?></button>
                    </div>
                </div>
                <div class="col-4">
                    &nbsp;
                </div>
            </div>
        </div>
    </div>
</section>
