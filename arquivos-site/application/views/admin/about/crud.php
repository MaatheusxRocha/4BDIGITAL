<div class="content-wrapper">
    <section class="content-header">
        <h1>
            <i class="fa fa-heart"></i> Sobre
        </h1>
        <ol class="breadcrumb">
            <li>
                <a href="<?= site_url('admin') ?>"><i class="fa fa-dashboard"></i> <?= PROJECT ?></a>
            </li>
            <li class="active">
                <i class="fa fa-heart"></i> Sobre
            </li>
        </ol>
    </section>
    <section class="content">
        <div class="row">
            <div class="col-xs-12">
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title">
                            <i class="fa fa-plus"></i> Cadastro
                        </h3>
                    </div>
                    <?= form_open_multipart("admin/about/save", 'class="form-validate" autocomplete="off"') ?>
                    <div class="box-body">
                        <? if (validation_errors()) { ?>
                            <div class="alert alert-danger">
                                <?= validation_errors(); ?>
                            </div>
                        <? } ?>
                        <div class="row">
                            <div class="form-group col-md-4 <?= form_error('text_brascloud') ? 'has-error' : '' ?>">
                                <label class="control-label" for="text_brascloud">Texto "A <?= PROJECT ?>"<em class="text-danger">*</em></label><br>
                                <?
                                $value = '';
                                if (set_value('text_brascloud')) {
                                    $value = set_value('text_brascloud');
                                } else if (isset($about)) {
                                    $value = $about->text_brascloud;
                                }
                                ?>
                                <textarea name="text_brascloud" id="text_brascloud" placeholder="Em um cenário cada vez mais competitivo..." class="editor" required><?= $value ?></textarea>
                            </div>
                            <div class="form-group col-md-6">
                                <div data-min_width="<?= BRASCLOUD_W ?>" data-min_height="<?= BRASCLOUD_H ?>" class="row cropper_container <?= form_error('image_brascloud') ? 'has-error' : '' ?>">
                                    <div class="col-md-10">
                                        <label class="control-label" for="image_brascloud">
                                            Imagem "A <?= PROJECT ?>" <i class="fa fa-info-circle title" title="Tipos permitidos: jpg, png, gif e jpeg! A imagem deve ser de <?= BRASCLOUD_W ?>px X <?= BRASCLOUD_H ?>px ou maior proporcionalmente"></i>
                                        </label><br>
                                        <label class="btn btn-primary">
                                            <input class="hide" id="image_brascloud" type="file" accept=".jpg, .png, .gif, .jpeg">
                                            Selecionar Imagem
                                        </label>
                                        <button class="btn btn-primary pull-right" type="button">Usar parte selecionada</button>
                                    </div>
                                    <div class="clearfix"></div>
                                    <div class="col-xs-12" style="padding: 5px;">
                                        <img src="" style="max-width: 100%">
                                    </div>
                                    <div class="col-xs-12">
                                        <textarea hidden name="image_brascloud"><?= set_value('image_brascloud') ?></textarea>
                                    </div>
                                </div>
                                <? $value = isset($about) ? $about->image_brascloud : '' ?>
                                <? if ($value) { ?>
                                    <div class="row">
                                        <div class="col-xs-12">
                                            <a href="<?= site_url($value) ?>" target="_blank">
                                                <img src="<?= base_url($value) ?>" style="max-width: 100%; margin-top: 5px">
                                            </a>
                                        </div>
                                    </div>
                                <? } ?>
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="form-group col-md-12 <?= form_error('text_box_red') ? 'has-error' : '' ?>">
                                <label class="control-label" for="text_box_red">Texto caixa vermelha<em class="text-danger">*</em></label><br>
                                <?
                                $value = '';
                                if (set_value('text_box_red')) {
                                    $value = set_value('text_box_red');
                                } else if (isset($about)) {
                                    $value = $about->text_box_red;
                                }
                                ?>
                                <textarea name="text_box_red" id="text_box_red" class="editor" placeholder="A Brascloud construiu seu próprio data center..." required><?= $value ?></textarea>
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-md-4">
                                <div class="row">
                                    <div class="form-group col-xs-12 <?= form_error('title_vision') ? 'has-error' : '' ?>">
                                        <label class="control-label" for="title_vision">Título "Nossa Visão"<em class="text-danger">*</em></label><br>
                                        <?
                                        $value = '';
                                        if (set_value('title_vision')) {
                                            $value = set_value('title_vision');
                                        } else if (isset($about)) {
                                            $value = $about->title_vision;
                                        }
                                        ?>
                                        <input type="text" name="title_vision" id="title_vision" class="form-control input-sm maxlength" maxlength="15" placeholder="Nossa visão" required value="<?= $value ?>">
                                    </div>
                                    <div class="form-group col-xs-12 <?= form_error('vision') ? 'has-error' : '' ?>">
                                        <label class="control-label" for="vision">Visão<em class="text-danger">*</em></label><br>
                                        <?
                                        $value = '';
                                        if (set_value('vision')) {
                                            $value = set_value('vision');
                                        } else if (isset($about)) {
                                            $value = $about->vision;
                                        }
                                        ?>
                                        <textarea name="vision" id="vision" rows="4" required class="form-control input-sm maxlength" maxlength="200" placeholder="Como visão, queremos ampliar..." required><?= $value ?></textarea>
                                    </div>
                                </div>
                                <hr>
                                <div class="row">
                                    <div class="form-group col-xs-12 <?= form_error('title_mission') ? 'has-error' : '' ?>">
                                        <label class="control-label" for="title_mission">Título "Nossa Missão"<em class="text-danger">*</em></label><br>
                                        <?
                                        $value = '';
                                        if (set_value('title_mission')) {
                                            $value = set_value('title_mission');
                                        } else if (isset($about)) {
                                            $value = $about->title_mission;
                                        }
                                        ?>
                                        <input type="text" name="title_mission" id="title_mission" class="form-control input-sm maxlength" maxlength="15" placeholder="Nossa missão" required value="<?= $value ?>">
                                    </div>
                                    <div class="form-group col-xs-12 <?= form_error('mission') ? 'has-error' : '' ?>">
                                        <label class="control-label" for="mission">Missão<em class="text-danger">*</em></label><br>
                                        <?
                                        $value = '';
                                        if (set_value('mission')) {
                                            $value = set_value('mission');
                                        } else if (isset($about)) {
                                            $value = $about->mission;
                                        }
                                        ?>
                                        <textarea name="mission" id="mission" rows="4" required class="form-control input-sm maxlength" maxlength="200" placeholder="Nossa missão é não oferecer..." required><?= $value ?></textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="row">
                                    <div class="form-group col-xs-12 <?= form_error('on_demand_title') ? 'has-error' : '' ?>">
                                        <label class="control-label" for="on_demand_title">Título "On-Demand"<em class="text-danger">*</em></label><br>
                                        <?
                                        $value = '';
                                        if (set_value('on_demand_title')) {
                                            $value = set_value('on_demand_title');
                                        } else if (isset($about)) {
                                            $value = $about->on_demand_title;
                                        }
                                        ?>
                                        <input type="text" name="on_demand_title" id="on_demand_title" class="form-control input-sm maxlength" maxlength="50" placeholder="Por que somos on-demand?" required value="<?= $value ?>">
                                    </div>
                                    <div class="form-group col-xs-12 <?= form_error('on_demand_text') ? 'has-error' : '' ?>">
                                        <label class="control-label" for="on_demand_text">Texto "On-Demand"<em class="text-danger">*</em></label><br>
                                        <?
                                        $value = '';
                                        if (set_value('on_demand_text')) {
                                            $value = set_value('on_demand_text');
                                        } else if (isset($about)) {
                                            $value = $about->on_demand_text;
                                        }
                                        ?>
                                        <textarea name="on_demand_text" id="on_demand_text" rows="4" required class="form-control input-sm maxlength" placeholder="Somo movidos pelos 4 pilares..." maxlength="140" required><?= $value ?></textarea>
                                    </div>
                                    <div class="form-group col-xs-12 <?= form_error('on_demand_image') ? 'has-error' : '' ?>">
                                        <label class="control-label" for="on_demand_image">Imagem "On-Demand"<em class="text-danger">*</em> <i class="fa fa-info-circle title" title="Tipos permitidos: jpg, png, gif e jpeg! A imagem deve ser de <?= DEMAND_W ?>px X <?= DEMAND_H ?>px ou maior proporcionalmente"></i></label><br>
                                        <?
                                        $value = '';
                                        if (set_value('on_demand_image')) {
                                            $value = set_value('on_demand_image');
                                        } else if (isset($about)) {
                                            $value = $about->on_demand_image;
                                        }
                                        ?>
                                        <label class="btn btn-sm btn-primary">
                                            <i class="fa fa-upload"></i> Selecionar imagem
                                            <input type="file" name="on_demand_image" id="on_demand_image" class="hidden" accept=".jpg,.png,.gif,.jpeg" onchange="$('#on_demand_image_name').html(get_name($(this).val()))" <?= !isset($about) ? 'required' : '' ?>>
                                        </label>
                                        <span id="on_demand_image_name"></span>
                                        <? if ($value) { ?>
                                            <img src="<?= base_url($value) ?>" style="max-width: 100%">
                                        <? } ?>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="row">
                                    <div class="form-group col-xs-12 <?= form_error('believe_title') ? 'has-error' : '' ?>">
                                        <label class="control-label" for="believe_title">Título "No que acreditamos"<em class="text-danger">*</em></label><br>
                                        <?
                                        $value = '';
                                        if (set_value('believe_title')) {
                                            $value = set_value('believe_title');
                                        } else if (isset($about)) {
                                            $value = $about->believe_title;
                                        }
                                        ?>
                                        <input type="text" name="believe_title" id="believe_title" class="form-control input-sm maxlength" placeholder="No que acreditamos?" maxlength="30" required value="<?= $value ?>">
                                    </div>
                                    <div class="form-group col-xs-12 <?= form_error('believe_text') ? 'has-error' : '' ?>">
                                        <label class="control-label" for="believe_text">Texto "No que acreditamos"<em class="text-danger">*</em></label><br>
                                        <?
                                        $value = '';
                                        if (set_value('believe_text')) {
                                            $value = set_value('believe_text');
                                        } else if (isset($about)) {
                                            $value = $about->believe_text;
                                        }
                                        ?>
                                        <textarea name="believe_text" id="believe_text" rows="10" required class="editor" placeholder="Tem muita empresa da área..." required><?= $value ?></textarea>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="form-group col-md-4">
                                <div data-min_width="<?= INFRASTRUCTURE_W ?>" data-min_height="<?= INFRASTRUCTURE_H ?>" class="row cropper_container <?= form_error('image_brascloud') ? 'has-error' : '' ?>">
                                    <div class="col-xs-12">
                                        <label class="control-label" for="infrastructure_image">
                                            Imagem "Infraestrutura"<em class="text-danger">*</em> <i class="fa fa-info-circle title" title="Tipos permitidos: jpg, png, gif e jpeg! A imagem deve ser de <?= INFRASTRUCTURE_W ?>px X <?= INFRASTRUCTURE_H ?>px ou maior proporcionalmente"></i>
                                        </label><br>
                                        <label class="btn btn-primary">
                                            <input class="hide" type="file" id="infrastructure_image" accept=".jpg, .png, .gif, .jpeg">
                                            Selecionar
                                        </label>
                                        <button class="btn btn-primary pull-right" type="button">Usar parte selecionada</button>
                                    </div>
                                    <div class="clearfix"></div>
                                    <div class="col-xs-12" style="padding: 5px;">
                                        <img src="" style="max-width: 100%">
                                    </div>
                                    <div class="col-xs-12">
                                        <textarea hidden name="infrastructure_image" <?= !isset($about) ? 'required' : '' ?>><?= set_value('infrastructure_image') ?></textarea>
                                    </div>
                                </div>
                                <? $value = isset($about) ? $about->infrastructure_image : '' ?>
                                <? if ($value) { ?>
                                    <div class="row">
                                        <div class="col-xs-12">
                                            <a href="<?= site_url($value) ?>" target="_blank">
                                                <img src="<?= base_url($value) ?>" style="max-width: 100%; margin-top: 5px">
                                            </a>
                                        </div>
                                    </div>
                                <? } ?>
                            </div>
                            <div class="col-md-8">
                                <div class="row">
                                    <div class="form-group col-xs-12 <?= form_error('infrastructure_title') ? 'has-error' : '' ?>">
                                        <label class="control-label" for="infrastructure_title">Título Infraestrutura<em class="text-danger">*</em></label><br>
                                        <?
                                        $value = '';
                                        if (set_value('infrastructure_title')) {
                                            $value = set_value('infrastructure_title');
                                        } else if (isset($about)) {
                                            $value = $about->infrastructure_title;
                                        }
                                        ?>
                                        <input name="infrastructure_title" id="infrastructure_title" type="text" value="<?= $value ?>" placeholder="Infraestrutura do nosso datacenter" class="form-control input-sm maxlength" maxlength="50" required>
                                    </div>
                                    <div class="form-group col-xs-12 <?= form_error('infrastructure_text') ? 'has-error' : '' ?>">
                                        <label class="control-label" for="infrastructure_text">Texto Infraestrutura<em class="text-danger">*</em></label><br>
                                        <?
                                        $value = '';
                                        if (set_value('infrastructure_text')) {
                                            $value = set_value('infrastructure_text');
                                        } else if (isset($about)) {
                                            $value = $about->infrastructure_text;
                                        }
                                        ?>
                                        <textarea name="infrastructure_text" id="infrastructure_text" rows="10" class="editor" placeholder="Utilizamos data center de 3° geração no padrão container..." required><?= $value ?></textarea>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-md-4">
                                <div class="row">
                                    <div class="form-group col-xs-12 <?= form_error('different_title') ? 'has-error' : '' ?>">
                                        <label class="control-label" for="different_title">Título "Diferenciais"<em class="text-danger">*</em></label><br>
                                        <?
                                        $value = '';
                                        if (set_value('different_title')) {
                                            $value = set_value('different_title');
                                        } else if (isset($about)) {
                                            $value = $about->different_title;
                                        }
                                        ?>
                                        <input name="different_title" id="different_title" type="text" value="<?= $value ?>" placeholder="O que a Brascloud tem de diferente?" class="form-control input-sm maxlength" maxlength="50" required>
                                    </div>
                                    <div class="form-group col-xs-12 <?= form_error('different_text') ? 'has-error' : '' ?>">
                                        <label class="control-label" for="different_text">Texto "Diferenciais"<em class="text-danger">*</em></label><br>
                                        <?
                                        $value = '';
                                        if (set_value('different_text')) {
                                            $value = set_value('different_text');
                                        } else if (isset($about)) {
                                            $value = $about->different_text;
                                        }
                                        ?>
                                        <textarea name="different_text" id="different_text" rows="10" class="editor" placeholder="Temos disponível para nossos clientes..." required><?= $value ?></textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group col-md-8">
                                <div data-min_width="<?= DIFFERENT_W ?>" data-min_height="<?= DIFFERENT_H ?>" class="row cropper_container <?= form_error('image_brascloud') ? 'has-error' : '' ?>">
                                    <div class="col-xs-12">
                                        <label class="control-label" for="different_image">
                                            Imagem "Diferenciais"<em class="text-danger">*</em> <i class="fa fa-info-circle title" title="Tipos permitidos: jpg, png, gif e jpeg! A imagem deve ser de <?= DIFFERENT_W ?>px X <?= DIFFERENT_H ?>px ou maior proporcionalmente"></i>
                                        </label><br>
                                        <label class="btn btn-primary">
                                            <input class="hide" type="file" id="different_image" accept=".jpg, .png, .gif, .jpeg">
                                            Selecionar
                                        </label>
                                        <button class="btn btn-primary pull-right" type="button">Usar parte selecionada</button>
                                    </div>
                                    <div class="clearfix"></div>
                                    <div class="col-xs-12" style="padding: 5px;">
                                        <img src="" style="max-width: 100%">
                                    </div>
                                    <div class="col-xs-12">
                                        <textarea hidden name="different_image" <?= !isset($about) ? 'required' : '' ?>><?= set_value('different_image') ?></textarea>
                                    </div>
                                </div>
                                <? $value = isset($about) ? $about->different_image : '' ?>
                                <? if ($value) { ?>
                                    <div class="row">
                                        <div class="col-xs-12">
                                            <a href="<?= site_url($value) ?>" target="_blank">
                                                <img src="<?= base_url($value) ?>" style="max-width: 100%; margin-top: 5px">
                                            </a>
                                        </div>
                                    </div>
                                <? } ?>
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-md-8">
                                <div class="row">
                                    <div class="form-group col-xs-12 <?= form_error('video_title') ? 'has-error' : '' ?>">
                                        <label class="control-label" for="video_title">Título do Vídeo</label><br>
                                        <?
                                        $value = '';
                                        if (set_value('video_title')) {
                                            $value = set_value('video_title');
                                        } else if (isset($about)) {
                                            $value = $about->video_title;
                                        }
                                        ?>
                                        <textarea name="video_title" id="video_title" placeholder="Assista ao nosso vídeo e conheça um pouco mais sobre a Brascloud" class="editor-small"><?= $value ?></textarea>
                                    </div>
                                    <div class="form-group col-md-6 <?= form_error('video') ? 'has-error' : '' ?>">
                                        <label class="control-label" for="video">Código do Vídeo</label><br>
                                        <?
                                        $value = set_value('video');
                                        if (!$value && isset($about)) {
                                            $value = $about->video;
                                        }
                                        ?>
                                        <div class="input-group">
                                            <span class="input-group-addon">https://youtube.com/watch?v=</span>
                                            <input name="video" id="video" type="text" title="O código é a parte final da URL" value="<?= $value ?>" placeholder="Complete o link" class="form-control input-sm title maxlength" maxlength="30" onchange="$('iframe').prop('src', 'https://youtube.com/embed/'+$(this).val()).show()">
                                        </div>
                                        <iframe style="width: 100%; height: 300px" frameborder="0" <?= isset($about) && $about->video ? "src=\"https://youtube.com/embed/$about->video\"" : 'hidden' ?>></iframe>
                                    </div>
                                    <div class="form-group col-md-6">
                                        <div data-min_width="<?= VIDEO_W ?>" data-min_height="<?= VIDEO_H ?>" class="row cropper_container <?= form_error('image_brascloud') ? 'has-error' : '' ?>">
                                            <div class="col-xs-12">
                                                <label class="control-label" for="video_cover">
                                                    Capa do Vídeo <i class="fa fa-info-circle title" title="Tipos permitidos: jpg, png, gif e jpeg! A imagem deve ser de <?= VIDEO_W ?>px X <?= VIDEO_H ?>px ou maior proporcionalmente"></i>
                                                </label><br>
                                                <label class="btn btn-primary">
                                                    <input class="hide" id="video_cover" type="file" accept=".jpg, .png, .gif, .jpeg">
                                                    Selecionar
                                                </label>
                                                <button class="btn btn-primary pull-right" type="button">Usar parte selecionada</button>
                                            </div>
                                            <div class="clearfix"></div>
                                            <div class="col-xs-12" style="padding: 5px;">
                                                <img src="" style="max-width: 100%">
                                            </div>
                                            <div class="col-xs-12">
                                                <textarea hidden name="video_cover"><?= set_value('video_cover') ?></textarea>
                                            </div>
                                        </div>
                                        <? $value = isset($about) ? $about->video_cover : '' ?>
                                        <? if ($value) { ?>
                                            <div class="row">
                                                <div class="col-xs-12">
                                                    <a href="<?= site_url($value) ?>" target="_blank">
                                                        <img src="<?= base_url($value) ?>" style="max-width: 100%; margin-top: 5px">
                                                    </a>
                                                </div>
                                            </div>
                                        <? } ?>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="row">
                                    <div class="form-group col-xs-12 <?= form_error('video_text_one') ? 'has-error' : '' ?>">
                                        <label class="control-label" for="video_text_one">Vídeo - Primeiro texto</label><br>
                                        <?
                                        $value = '';
                                        if (set_value('video_text_one')) {
                                            $value = set_value('video_text_one');
                                        } else if (isset($about)) {
                                            $value = $about->video_text_one;
                                        }
                                        ?>
                                        <textarea name="video_text_one" id="video_text_one" rows="5" class="form-control input-sm maxlength" placeholder="Converse diretamente com profissionais..." maxlength="100"><?= $value ?></textarea>
                                    </div>
                                    <div class="form-group col-xs-12 <?= form_error('video_text_two') ? 'has-error' : '' ?>">
                                        <label class="control-label" for="video_text_two">Vídeo - Segundo texto</label><br>
                                        <?
                                        $value = '';
                                        if (set_value('video_text_two')) {
                                            $value = set_value('video_text_two');
                                        } else if (isset($about)) {
                                            $value = $about->video_text_two;
                                        }
                                        ?>
                                        <textarea name="video_text_two" id="video_text_two" rows="5" class="form-control input-sm maxlength" maxlength="100" placeholder="Entenda o desempenho de sua aplicação..."><?= $value ?></textarea>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="form-group col-md-6 <?= form_error('vpc_image_left') ? 'has-error' : '' ?>">
                                <label class="control-label" for="vpc_image_left">Imagem Esquerda VPC <i class="fa fa-info-circle title" title="Tipos permitidos: jpg, png, gif e jpeg! A imagem deve ser de <?= VPC_LEFT_W ?>px X <?= VPC_LEFT_H ?>px ou maior proporcionalmente"></i></label><br>
                                <?
                                $value = '';
                                if (set_value('vpc_image_left')) {
                                    $value = set_value('vpc_image_left');
                                } else if (isset($about)) {
                                    $value = $about->vpc_image_left;
                                }
                                ?>
                                <label class="btn btn-sm btn-primary">
                                    <i class="fa fa-upload"></i> Selecionar imagem
                                    <input type="file" name="vpc_image_left" id="vpc_image_left" class="hidden" accept=".jpg,.png,.gif,.jpeg" onchange="$('#vpc_image_left_name').html(get_name($(this).val()))">
                                </label>
                                <span id="vpc_image_left_name"></span>
                            </div>
                            <div class="col-md-6">
                                <div class="row">
                                    <div class="form-group col-xs-12 <?= form_error('vpc_title') ? 'has-error' : '' ?>">
                                        <label class="control-label" for="vpc_title">Título VPC</label><br>
                                        <?
                                        $value = '';
                                        if (set_value('vpc_title')) {
                                            $value = set_value('vpc_title');
                                        } else if (isset($about)) {
                                            $value = $about->vpc_title;
                                        }
                                        ?>
                                        <input name="vpc_title" id="vpc_title" type="text" value="<?= $value ?>" placeholder="Exemplo de solução VPC Brascloud" class="form-control input-sm maxlength" maxlength="100">
                                    </div>
                                    <div class="form-group col-xs-12 <?= form_error('vpc_text') ? 'has-error' : '' ?>">
                                        <label class="control-label" for="vpc_text">Texto VPC</label><br>
                                        <?
                                        $value = '';
                                        if (set_value('vpc_text')) {
                                            $value = set_value('vpc_text');
                                        } else if (isset($about)) {
                                            $value = $about->vpc_text;
                                        }
                                        ?>
                                        <textarea name="vpc_text" id="vpc_text" class="editor" placeholder="A oferta de VPC Brascloud possibilita a implantação..."><?= $value ?></textarea>
                                    </div>
                                    <div class="form-group col-xs-12 <?= form_error('vpc_image_right') ? 'has-error' : '' ?>">
                                        <label class="control-label" for="vpc_image_right">Imagem Direita VPC <i class="fa fa-info-circle title" title="Tipos permitidos: jpg, png, gif e jpeg! A imagem deve ser de <?= VPC_RIGHT_W ?>px X <?= VPC_RIGHT_H ?>px ou maior proporcionalmente"></i></label><br>
                                        <?
                                        $value = '';
                                        if (set_value('vpc_image_right')) {
                                            $value = set_value('vpc_image_right');
                                        } else if (isset($about)) {
                                            $value = $about->vpc_image_right;
                                        }
                                        ?>
                                        <label class="btn btn-sm btn-primary">
                                            <i class="fa fa-upload"></i> Selecionar imagem
                                            <input type="file" name="vpc_image_right" id="vpc_image_right" class="hidden" accept=".jpg,.png,.gif,.jpeg" onchange="$('#vpc_image_right_name').html(get_name($(this).val()))">
                                        </label>
                                        <span id="vpc_image_right_name"></span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="form-group col-xs-6 col-xs-push-3 <?= form_error('title_partner') ? 'has-error' : '' ?>">
                                <label class="control-label" for="title_partner">Título "Parceiros"<em class="text-danger">*</em></label><br>
                                <?
                                $value = '';
                                if (set_value('title_partner')) {
                                    $value = set_value('title_partner');
                                } else if (isset($about)) {
                                    $value = $about->title_partner;
                                }
                                ?>
                                <input name="title_partner" id="title_partner" type="text" value="<?= $value ?>" placeholder="Parceiros de Tecnologia" class="form-control input-sm maxlength" maxlength="100" required>
                            </div>
                        </div>
                        <hr>
                        <div class="form-group">
                            <button type="submit" class="btn btn-success btn-sm">
                                <span class="glyphicon glyphicon-floppy-disk"></span> Salvar
                            </button>
                            <button type="reset" class="btn btn-warning btn-sm">
                                <span class="glyphicon glyphicon-refresh"></span> Limpar
                            </button>
                        </div>
                    </div>
                    <?= form_close() ?>
                </div>
            </div>
        </div>
    </section>
</div>
