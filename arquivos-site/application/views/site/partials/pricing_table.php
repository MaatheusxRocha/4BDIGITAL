<div class="col-12 pricing-holder">
    <table class="pricing-table">
        <thead>
            <tr>
                <th><?= $this->lang->line('plan') ?></th>
                <? foreach ($configs as $c) { ?>
                    <th><?= $c->name ?></th>
                <? } ?>
                <th><?= $this->lang->line('disk') ?></th>
                <th><?= $this->lang->line('price') ?>/<span class="price-hour"><?= $this->lang->line('hour') ?></span><span class="price-month" style="display: none"><?= $this->lang->line('month') ?></span></th>
            </tr>
        </thead>

        <tbody>
            <? foreach ($plans as $plan) { ?>
                <tr>
                    <td><?= $plan->name ?></td>
                    <? foreach ($plan->configs as $p_c) { ?>
                        <td><?= $p_c ?></td>
                    <? } ?>
                    <td><?= $plan->storage ?> GB</td>
                    <td>
                        <span class="price-hour">R$<?= number_format($plan->price_hour, 2, ',', '.') ?></span>
                        <span class="price-month" style="display: none">R$<?= number_format($plan->price_month, 2, ',', '.') ?></span>
                    </td>
                </tr>
            <? } ?>
        </tbody>
    </table>
</div>

<div class="col-12 pricing-responsive">
    <table class="pricing-table-responsive">
        <tbody>
            <? foreach ($plans as $plan) { ?>
                <tr>
                    <th colspan="<?= count($plan->configs) + 2 ?>"><?= $plan->name ?></th>
                </tr>
                <tr>
                    <? foreach ($plan->configs as $index => $p_c) { ?>
                        <td><span><?= $plan->config_name[$index] ?></span> <?= $p_c ?></td>
                    <? } ?>
                    <td><span><?= $this->lang->line('disk') ?></span> <?= $plan->storage ?> GB</td>
                    <td>
                        <span><?= $this->lang->line('price') ?>/<span class="price-hour"><?= $this->lang->line('hour') ?></span>
                            <span class="price-month" style="display: none"><?= $this->lang->line('month') ?></span>
                        </span>
                        <span class="price-hour">R$<?= number_format($plan->price_hour, 2, ',', '.') ?></span>
                        <span class="price-month" style="display: none">R$<?= number_format($plan->price_month, 2, ',', '.') ?></span>
                    </td>
                </tr>
            <? } ?>
        </tbody>
    </table>
</div>