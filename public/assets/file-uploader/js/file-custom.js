$(document).ready(function () {
    $('input[name="file1"]').fileuploader({
        limit: 1,
        maxSize: 3,
        extensions: $('input[name="file1"]').length > 0 ? JSON.parse($('input[name="file1"]').attr("file-accept")) : null,
        enableApi: true,
        addMore: false,
        dragDrop: {
            container: '.fileuploader-thumbnails-input'
        },
        upload: {
            url: $('input[name="file1"]').attr("data-url"),
            data: { "_token": $('meta[name="csrf-token"]').attr('content'), 'accept': $('input[name="file1"]').length > 0 ? JSON.parse($('input[name="file1"]').attr("file-accept")) : null },
            type: 'POST',
            enctype: 'multipart/form-data',
            start: true,
            synchron: true,
            beforeSend: null,
            onSuccess: function (data, item) {
                var filename = JSON.parse(data);
                item.html.find('.fileuploader-action-remove').addClass('fileuploader-action-success');
                setTimeout(function () {
                    item.html.find('.progress-holder').hide();
                    item.renderThumbnail();
                    item.html.find('.fileuploader-action-popup, .fileuploader-item-image').show();
                    item.html.find('.fileuploader-action-remove').before('<button type="button" class="fileuploader-action fileuploader-action-sort" title="Sort"><i class="fileuploader-icon-sort"></i></button>');
                }, 400);
                var attr_name = (item.input.attr("data-attr-name")) ? item.input.attr("data-attr-name") : 'file-saver';
                $('.' + attr_name).val(filename.filename);
                $('.submit').removeAttr("disabled");
            },
            onError: function (data, item) {
                var extensions = JSON.parse($('input[name="file1"]').attr("file-accept"));
                if (!extensions.includes(data.extension)) {
                    alert('Only ' + extensions.join(', ') + ' file types are allowed!');
                    $('.fileuploader-action-remove').trigger("click");
                } else if (data.size > (3 * (1024 * 1024))) {
                    alert('The maximum file size allowed 3 MB');
                    $('.fileuploader-action-remove').trigger("click");
                } else {
                    alert('Failed to upload File!!!');
                    $('.fileuploader-action-remove').trigger("click");
                }
                $('.submit').removeAttr("disabled");
            },
            onProgress: function (data, item) {
                $('.submit').attr("disabled", "disabled");
                var progressBar = item.html.find('.progress-holder');
                if (progressBar.length > 0) {
                    progressBar.show();
                    progressBar.find('.fileuploader-progressbar .bar').width(data.percentage + "%");
                }
                item.html.find('.fileuploader-action-popup, .fileuploader-item-image').hide();
            }
        },
        onRemove: function (list, listEl, parentEl, newInputEl, inputEl) {
            $('.submit').attr("disabled", "disabled");
            var attr_name = (inputEl.attr("data-attr-name")) ? inputEl.attr("data-attr-name") : 'file-saver';
            $.post(inputEl[0].dataset.id, {
                file: $('.' + attr_name).val(),
                "_token": $('meta[name="csrf-token"]').attr('content'),
            });
            $('.' + attr_name).val("");
            $('.submit').removeAttr("disabled");
        }
    });

    $('input[name="file2"]').fileuploader({
        limit: 1,
        maxSize: 3,
        extensions: $('input[name="file2"]').length > 0 ? JSON.parse($('input[name="file2"]').attr("file-accept")) : null,
        enableApi: true,
        addMore: false,
        dragDrop: {
            container: '.fileuploader-thumbnails-input'
        },
        upload: {
            url: $('input[name="file2"]').attr("data-url"),
            data: { "_token": $('meta[name="csrf-token"]').attr('content'), 'accept': $('input[name="file2"]').length > 0 ? JSON.parse($('input[name="file2"]').attr("file-accept")) : null },
            type: 'POST',
            enctype: 'multipart/form-data',
            start: true,
            synchron: true,
            beforeSend: null,
            onSuccess: function (data, item) {
                var filename = JSON.parse(data);
                item.html.find('.fileuploader-action-remove').addClass('fileuploader-action-success');
                setTimeout(function () {
                    item.html.find('.progress-holder').hide();
                    item.renderThumbnail();
                    item.html.find('.fileuploader-action-popup, .fileuploader-item-image').show();
                    item.html.find('.fileuploader-action-remove').before('<button type="button" class="fileuploader-action fileuploader-action-sort" title="Sort"><i class="fileuploader-icon-sort"></i></button>');
                }, 400);
                var attr_name = (item.input.attr("data-attr-name")) ? item.input.attr("data-attr-name") : 'file-saver';console.log(attr_name)
                $('.' + attr_name).val(filename.filename);
                $('.submit').removeAttr("disabled");
            },
            onError: function (data, item) {
                var extensions = JSON.parse($('input[name="file2"]').attr("file-accept"));
                if (!extensions.includes(data.extension)) {
                    alert('Only ' + extensions.join(', ') + ' file types are allowed!');
                    $('.fileuploader-action-remove').trigger("click");
                } else if (data.size > (3 * (1024 * 1024))) {
                    alert('The maximum file size allowed 3 MB');
                    $('.fileuploader-action-remove').trigger("click");
                } else {
                    alert('Failed to upload File!!!');
                    $('.fileuploader-action-remove').trigger("click");
                }
                $('.submit').removeAttr("disabled");
            },
            onProgress: function (data, item) {
                $('.submit').attr("disabled", "disabled");
                var progressBar = item.html.find('.progress-holder');
                if (progressBar.length > 0) {
                    progressBar.show();
                    progressBar.find('.fileuploader-progressbar .bar').width(data.percentage + "%");
                }
                item.html.find('.fileuploader-action-popup, .fileuploader-item-image').hide();
            }
        },
        onRemove: function (list, listEl, parentEl, newInputEl, inputEl) {
            $('.submit').attr("disabled", "disabled");
            var attr_name = (inputEl.attr("data-attr-name")) ? inputEl.attr("data-attr-name") : 'file-saver';
            $.post(inputEl[0].dataset.id, {
                file: $('.' + attr_name).val(),
                "_token": $('meta[name="csrf-token"]').attr('content'),
            });
            $('.' + attr_name).val("");
            $('.submit').removeAttr("disabled");
        }
    });
});
