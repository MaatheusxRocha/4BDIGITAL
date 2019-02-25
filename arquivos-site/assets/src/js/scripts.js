var base_url = '/';
$(function () {
    $('.editor').parent().addClass('trumbowyg-medium');
    $('.editor').trumbowyg({
        lang: 'pt',
        autogrow: true,
        btns: [
            ['viewHTML'],
            ['formatting'],
            'btnGrp-semantic',
            ['link'],
            ['unorderedList']
        ]
    });

    $('.editor-small').parent().addClass('trumbowyg-small');
    $('.editor-small').trumbowyg({
        lang: 'pt',
        btns: [
            ['viewHTML'],
            'btnGrp-semantic',
            ['link']
        ]
    });

    $('.editable').editable({
        emptytext: 'Não informado'
    });
    $('.editable-required').editable({
        validate: function (value) {
            if ($.trim(value) == '') {
                return 'Este campo é obrigatório';
            }
        }
    });

    $('[data-tooltip="tooltip"]').tooltip();

    $('input').iCheck({
        checkboxClass: 'icheckbox_square-blue',
        radioClass: 'iradio_square-blue',
        increaseArea: '20%' // optional
    });

    $('#ck_all_images').on('ifClicked', function () {
        if ($(this).is(':checked')) {
            $(".ck_images").each(function () {
                $(this).iCheck('uncheck');
            });
        } else {
            $(".ck_images").each(function () {
                $(this).iCheck('check');
            });
        }
    });

    $('#ck_all_registers').on('ifChecked', function (event) {
        $('.ck_registers').iCheck('check');
    });
    $('#ck_all_registers').on('ifUnchecked', function (event) {
        $('.ck_registers').iCheck('uncheck');
    });

    if ($(".ck-forms").length) {
        $('.ck-forms').on('ifClicked', function () {
            var value_ck = this.id;
            $('.ck-forms').each(function () {
                var ck_id = this.id;
                if (value_ck != ck_id && $(this).is(':checked')) {
                    $(this).iCheck('uncheck');
                }
            });
        });
    }

    $('.frequency').inputmask('9,9', {"clearIncomplete": true});
    $('.value-config').inputmask('[9][9][9][9][9]9,99', {"clearIncomplete": true,greedy: false});
    $('.config-value').inputmask('99,99', {"clearIncomplete": true});
    $('.cep').inputmask('99.999-999', {"clearIncomplete": true});
    $('.cnpj').inputmask('99.999.999/9999-99', {"clearIncomplete": true});
    $('.cpf').inputmask('999.999.999-99', {"clearIncomplete": true});
    $('.cellphone').inputmask('(99)99999-9999', {"clearIncomplete": true});
    $('.phone').inputmask('(99)9999-9999', {"clearIncomplete": true});
    $('.date').inputmask('dd/mm/yyyy', {"clearIncomplete": true, 'placeholder': 'dd/mm/aaaa'});
    $('.datepicker').inputmask('dd/mm/yyyy', {"clearIncomplete": true, 'placeholder': 'dd/mm/aaaa'});
    $('.datepicker-today').inputmask('dd/mm/yyyy', {"clearIncomplete": true, 'placeholder': 'dd/mm/aaaa'});
    $('.month').inputmask('mm/yyyy', {"clearIncomplete": true, 'placeholder': 'mm/aaaa'});
    $('.money').maskMoney({prefix: 'R$ ', allowNegative: false, thousands: '.', decimal: ',', affixesStay: false});
    $('.datepicker').datepicker({
        language: 'pt-BR',
        format: 'dd/mm/yyyy'
    });

    $('.datepicker-today').datepicker({
        language: 'pt-BR',
        format: 'dd/mm/yyyy',
        startDate: '0'
    });

    $('.title').tooltip({html: true});
    $.validator.setDefaults({
        ignore: []
    });

    $(".form-validate").each(function (index, el) {
        $(el).validate({
            submitHandler: function (form) {
                form.submit();
                $('button').prop("disabled", true);
                $('input').prop("readonly", true);
                $('textarea').prop("readonly", true);
                return false;
            },
            invalidHandler: function () {
                $('button').prop("disabled", false);
                $('input:not([data-readonly])').prop("readonly", false);
                $('textarea:not([data-readonly])').prop("readonly", false);
            },
            highlight: function (element) {
                $(element).closest('.form-group').addClass('has-error');
                $(element).closest('.input-group').addClass('has-error');
            },
            unhighlight: function (element) {
                $(element).closest('.form-group').removeClass('has-error');
                $(element).closest('.input-group').removeClass('has-error');
            },
            rules: {
                password: {
                    required: true,
                    minlength: 5
                },
                re_password: {
                    equalTo: "#password",
                    minlength: 5
                }
            },
            errorElement: 'span',
            errorClass: 'text-danger',
            errorPlacement: function (error, element) {
                if (element.prop('type') == 'file') {
                    error.appendTo(element.parent().parent().last('span'));
                } else if (element.hasClass('customer-group')) {
                    error.insertAfter(element.parent().parent());
                } else if (element.parent('.input-group').length) {
                    error.insertAfter(element.parent());
                } else if (element.prop('type') == 'radio' || element.prop('type') == 'checkbox') {
                    error.insertAfter(element.parent().parent('label').parent('.radio-group'));
                    /*
                     * Para o erro ser colocado no lugar certo, use a estrutura:
                     *  <div class="form-group">
                     *      <label>Radios</label>
                     *      <div class="radio-group">
                     *          <label>
                     *              <input type="radio" name="radio"> Radio 1
                     *          </label>
                     *          <label>
                     *              <input type="radio" name="radio"> Radio 2
                     *          </label>
                     *      </div>
                     *  </div>
                     */
                } else {
                    error.insertAfter(element);
                }
            }
        });
    });
    $('.maxlength').maxlength({
        alwaysShow: true,
        placement: 'bottom'
    });

    $('.modal').on('shown.bs.modal', function (e) {
        $(this).find('[autofocus]').focus();
    });
    $('.modal-show').modal('show');
});


function generate_message(type, text, layout, time) {
    layout = 'topRight';
    time = 5000;
    var n = noty({
        layout: layout,
        text: text,
        type: type,
        theme: 'relax',
        timeout: time,
//        animation: {
//            open: 'animated pulse', // Animate.css class names
//            close: 'animated flipOutX', // Animate.css class names
//            easing: 'swing', // unavailable - no need
//            speed: 500 // unavailable - no need
//        }
    });
}
function confirm_dialog(url, text) {
    var layout = 'center';
    var n = noty({
        text: text,
        type: 'information',
        dismissQueue: true,
        layout: layout,
        theme: 'relax',
        modal: true,
        buttons: [
            {addClass: 'btn btn-primary', text: 'Ok', onClick: function ($noty) {
                    $noty.close();
                    $(location).attr('href', url);
                }
            },
            {addClass: 'btn btn-danger', text: 'Cancelar', onClick: function ($noty) {
                    $noty.close();
                }
            }
        ]
    });
}

function ordenation(id, position, controller, method) {
    if (method == '' || method == undefined) {
        method = 'update_ordenation';
    }
    $.ajax({
        type: 'post',
        data: {'id': id, 'position': position},
        url: base_url + 'admin/' + controller + '/' + method,
        success: function (data, textStatus, jqXHR) {
        }
    });
}

function validate_form(form) {
    var form_validate = $("#" + form);
    form_validate.validate({
        highlight: function (element) {
            $(element).closest('.form-group').addClass('has-error');
            $(element).closest('.input-group').addClass('has-error');
        },
        unhighlight: function (element) {
            $(element).closest('.form-group').removeClass('has-error');
            $(element).closest('.input-group').addClass('has-error');
        },
        errorElement: 'span',
        errorClass: 'text-danger',
        errorPlacement: function (error, element) {
            if (element.parent('.input-group').length) {
                error.insertAfter(element.parent());
            } else {
                error.insertAfter(element);
            }
        }
    });
    return form_validate;
}

function get_name(url) {
    invert = url.split('').reverse().join('');
    cut = invert.slice(0, invert.indexOf('\\'));
    return cut.split('').reverse().join('');
}

function load_cities(city_id) {
    $.ajax({
        type: 'get',
        url: base_url + 'admin/ajax/get_cities/' + $('#state_id').val(),
        success: function (data) {
            $('#city_id').html(data);
            if (city_id !== undefined) {
                $('#city_id').val(city_id);
            }
        },
        error: function () {
            generate_message('error', 'Não foi possível carregar as cidades. Recarregue a página e tente novamente!');
        }
    });
}

function calcule_value_hour() {
    var value_month = $("#price_month").maskMoney('unmasked')[0];
    var value_hour = 0;
    if (value_month > 0) {
        value_hour = value_month / 720;
    }
    $("#price_hour").val(value_hour.toFixed(6));
}
function calcule_value_hour_so(id, promotion) {
    var value_hour = 0;
    if (promotion == 'promotion') {
        var value_month = $("#price_month_promotion_" + id).maskMoney('unmasked')[0];
        if (value_month > 0) {
            value_hour = value_month / 720;
        }
        $("#price_hour_promotion_" + id).val(value_hour.toFixed(6));
    } else {
        var value_month = $("#price_month_" + id).maskMoney('unmasked')[0];
        if (value_month > 0) {
            value_hour = value_month / 720;
        }
        $("#price_hour_" + id).val(value_hour.toFixed(6));
    }

}
