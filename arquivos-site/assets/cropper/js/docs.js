$(function () {
    $('.cropper_container').each(function() {
       set_cropper($(this));
    });
});

function set_cropper(container) {
    var min_width = container.data('min_width');
    var min_height = container.data('min_height');
    var ratio = parseInt(min_width)/parseInt(min_height);

    var img_element = container.find('img');
    var input_element = container.find('input');
    var output_element = container.find('textarea');
    var finish_button = container.find('button');

    var $image = img_element,
            $dataX = $("#dataX"),
            $dataY = $("#dataY"),
            $dataHeight = $("#dataHeight"),
            $dataWidth = $("#dataWidth"),
            cropper;

    $image.cropper({
        aspectRatio: ratio,
        data: {
            x: 10,
            y: 10
        },
        preview: '.preview',
        zoomable: false,
        rotatable: false,
        checkImageOrigin: false,
        minWidth: min_width,
        minHeight: min_height,
        done: function (data) {
            if (data.height < min_height) {
            }
            $dataX.val(data.x);
            $dataY.val(data.y);
            $dataHeight.val(data.height);
            $dataWidth.val(data.width);
        }
    });

    cropper = $image.data("cropper");
    var $inputImage = input_element;
    if (window.FileReader) {
        $inputImage.change(function () {
            var fileReader = new FileReader(),
                    files = this.files,
                    file;

            if (!files.length) {
                return;
            }

            file = files[0];

            if (/^image\/\w+$/.test(file.type)) {
                fileReader.readAsDataURL(file);
                fileReader.onload = function () {
                    $image.cropper("reset").cropper("replace", this.result);
                    $inputImage.val("");
                };
            } else {
                alert("Formato não suportado. Selecione uma imagem!");
            }
        });
    } else {
        $inputImage.addClass("hide");
    }

    finish_button.on('click', function () {
        var data = $image.cropper("getDataURL", "image/jpeg");
        output_element.text(data);
        container.find('.result-image').remove();
        output_element.after('<img src="' + data + '" style="max-width: 100%" class="result-image">');
    });
}
