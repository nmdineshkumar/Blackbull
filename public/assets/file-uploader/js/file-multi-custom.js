function page_loader() {
    $(".preloader-activate").addClass("preloader-active");
    $(".preloader-activate").removeClass("loaded");
}


function close_loader() {
    $(".open_tm_preloader").addClass("loaded");
    $(".open_tm_preloader").removeClass("preloader-active");
}

$(document).ready(function () {
    $('input[name="files1"]').fileuploader({
        limit: 25,
        maxSize: 100,
        fileMaxSize: 100,
        extensions: $('input[name="files1"]').length > 0 ? JSON.parse($('input[name="files1"]').attr("file-accept")) : null,
        changeInput: ' ',
        theme: 'gallery',
        enableApi: true,
        thumbnails: {
            box: '<div class="fileuploader-items">' +
                '<ul class="fileuploader-items-list">' +
                '<li class="fileuploader-input"><button type="button" class="fileuploader-input-inner"><i class="fileuploader-icon-main"></i> <span>${captions.feedback}</span></button></li>' +
                '</ul>' +
                '</div>',
            item: '<li class="fileuploader-item">' +
                '<div class="fileuploader-item-inner">' +
                '<div class="actions-holder">' +
                '<button type="button" class="fileuploader-action fileuploader-action-sort is-hidden" title="${captions.sort}"><i class="fileuploader-icon-sort"></i></button>' +
                '<button type="button" class="fileuploader-action fileuploader-action-remove" title="${captions.remove}"><i class="fileuploader-icon-remove"></i></button>' +
                '</div>' +
                '<div class="thumbnail-holder">' +
                '${image}' +
                '<span class="fileuploader-action-popup"></span>' +
                '<div class="progress-holder"><span></span>${progressBar}</div>' +
                '</div>' +
                '<div class="main text-center mt-1 text-white font-bold px-2"></div>' +
                '<div class="content-holder"><h5 title="${name}">${name}</h5><span>${size2}</span></div>' +
                '<div class="type-holder">${icon}</div>' +
                '</div>' +
                '</li>',
            item2: '<li class="fileuploader-item file-main-${data.isMain}">' +
                '<div class="fileuploader-item-inner">' +
                '<div class="actions-holder">' +
                '<button type="button" class="fileuploader-action fileuploader-action-sort" title="${captions.sort}"><i class="fileuploader-icon-sort"></i></button>' +
                '<button type="button" class="fileuploader-action fileuploader-action-remove" title="${captions.remove}"><i class="fileuploader-icon-remove"></i></button>' +
                '</div>' +
                '<div class="thumbnail-holder">' +
                '${image}' +
                '<span class="fileuploader-action-popup"></span>' +
                '</div>' +
                '<div class="main  text-center mt-1 text-white font-bold"></div>' +
                '<div class="content-holder"><h5 title="${name}">${name}</h5><span>${size2}</span></div>' +
                '<div class="type-holder">${icon}</div>' +
                '</div>' +
                '</li>',
            itemPrepend: false,
            startImageRenderer: true,
            canvasImage: false,
            onItemShow: function (item, listEl, parentEl, newInputEl, inputEl) {

                var api = $.fileuploader.getInstance(inputEl),
                    color = api.assets.textToColor(item.format),
                    $plusInput = listEl.find('.fileuploader-input'),
                    $progressBar = item.html.find('.progress-holder');

                // put input first in the list
                $plusInput.prependTo(listEl)


                // color the icon and the progressbar with the format color
                item.html.find('.type-holder .fileuploader-item-icon')[api.assets.isBrightColor(color) ? 'addClass' : 'removeClass']('is-bright-color').css('backgroundColor', color);
            },
            onImageLoaded: function (item, listEl, parentEl, newInputEl, inputEl) {
                var api = $.fileuploader.getInstance(inputEl);

                // add icon
                item.image.find('.fileuploader-item-icon i').html('')
                    .addClass('fileuploader-icon-' + (['image', 'video', 'audio'].indexOf(item.format) > -1 ? item.format : 'file'));

                // check the image size
                if (item.format == 'image' && item.upload && !item.imU) {
                    if (item.reader.node && (item.reader.width < 50 || item.reader.height < 50)) {
                        alert(api.assets.textParse(api.getOptions().captions.imageSizeError, item));
                        return item.remove();
                    }

                    item.image.hide();
                    item.reader.done = true;
                    item.upload.send();
                }
                if (item.index == 0) {
                    item.html.addClass('file-main-1');
                    item.data.isMain = true;
                    item.html.find('.fileuploader-item-inner .main').html('')
                }

            },
            onItemRemove: function (html) {
                html.fadeOut(250);
            }
        },
        dragDrop: {
            container: '.fileuploader-theme-gallery .fileuploader-input'
        },
        upload: {
            url: $('input[name="files1"]').attr("data-url"),
            data: { "_token": $('meta[name="csrf-token"]').attr('content'), 'accept': $('input[name="files1"]').length > 0 ? JSON.parse($('input[name="files1"]').attr("file-accept")) : null },
            type: 'POST',
            enctype: 'multipart/form-data',
            start: true,
            synchron: true,
            beforeSend: null,
            beforeSend: function (item) {
                // check the image size first (onImageLoaded)
                if (item.format == 'image' && !item.reader.done)
                    return false;

                // add editor to upload data after editing
                if (item.editor && (typeof item.editor.rotation != "undefined" || item.editor.crop)) {
                    item.imU = true;
                    item.upload.data.name = item.name;
                    item.upload.data.id = item.data.listProps.id;
                    item.upload.data._editorr = JSON.stringify(item.editor);
                }

                item.html.find('.fileuploader-action-success').removeClass('fileuploader-action-success');
            },
            onSuccess: function (result, item) {

                var data = {};

                try {
                    data = JSON.parse(result);
                } catch (e) {
                    data.hasWarnings = true;
                }
                var files_array = $('.file-saver').val();
                if (files_array !== "") {
                    files_array += "~" + data.filename;
                }
                else {
                    files_array = data.filename;
                }
                $('.file-saver').val(files_array);
                item.name = data.filename;
                // if success update the information
                if (data.isSuccess && data.files.length) {
                    if (!item.data.listProps)
                        item.data.listProps = {};
                    item.title = data.files[0].title;

                    item.size = data.files[0].size;
                    item.size2 = data.files[0].size2;
                    item.data.url = data.files[0].url;
                    item.data.listProps.id = data.files[0].id;

                    item.html.find('.content-holder h5').attr('title', item.name).text(item.name);
                    item.html.find('.content-holder span').text(item.size2);
                    item.html.find('.gallery-item-dropdown [download]').attr('href', item.data.url);

                }

                // if warnings
                if (data.hasWarnings) {
                    for (var warning in data.warnings) {
                        alert(data.warnings[warning]);
                    }

                    item.html.removeClass('upload-successful').addClass('upload-failed');
                    return this.onError ? this.onError(item) : null;
                }

                delete item.imU;
                item.html.find('.fileuploader-action-remove').addClass('fileuploader-action-success');

                setTimeout(function () {
                    item.html.find('.progress-holder').hide();

                    item.html.find('.fileuploader-action-popup, .fileuploader-item-image').show();
                    item.html.find('.fileuploader-action-sort').removeClass('is-hidden');
                    item.html.find('.fileuploader-action-settings').removeClass('is-hidden');
                    if ($(".progress-holder:visible").length == 0) {
                        $(".image-add").removeAttr("disabled");
                    }
                }, 400);

            },
            onError: function (item) {
                item.html.find('.progress-holder, .fileuploader-action-popup, .fileuploader-item-image').hide();

                // add retry button
                item.upload.status != 'cancelled' && !item.imU && !item.html.find('.fileuploader-action-retry').length ? item.html.find('.actions-holder').prepend(
                    '<button type="button" class="fileuploader-action fileuploader-action-retry" title="Retry"><i class="fileuploader-icon-retry"></i></button>'
                ) : null;
            },
            onProgress: function (data, item) {
                $(".image-add").attr("disabled", "disabled")
                var $progressBar = item.html.find('.progress-holder');

                if ($progressBar.length) {
                    $progressBar.show();
                    $progressBar.find('span').text(data.percentage >= 99 ? 'Uploading...' : data.percentage + '%');
                    $progressBar.find('.fileuploader-progressbar .bar').height(data.percentage + '%');
                }

                item.html.find('.fileuploader-action-popup, .fileuploader-item-image').hide();
            }
        },
        sorter: {
            selectorExclude: null,
            placeholder: null,
            scrollContainer: window,
            onSort: function (list, listEl, parentEl, newInputEl, inputEl) {
                var api = $.fileuploader.getInstance(inputEl.get(0)),
                    fileList = api.getFileList(),
                    _list = [];
                var files_array = "";
                $.each(fileList, function (i, item) {
                    _list.push({
                        name: item.name,
                        index: item.index
                    });
                    if (i == 0) {
                        item.html.addClass('file-main-1');
                        item.data.isMain = true;
                        item.html.find('.fileuploader-item-inner .main').html('')
                    }
                    else {
                        item.html.removeClass('file-main-1');
                        item.data.isMain = false;
                        item.html.find('.fileuploader-item-inner .main').html('')
                    }
                    if (files_array !== "") {
                        files_array += "~" + item.name;
                    } else {
                        files_array = item.name;
                    }
                });
                $(".file-saver").val(files_array);
            }
        },
        onRemove: function (list, listEl, parentEl, newInputEl, inputEl) {
            $.post(inputEl[0].dataset.id, {
                file: list.name,
                "_token": $('meta[name="csrf-token"]').attr('content')
            });
            var files_array = $('.file-saver').val();
            files_array.replace(list.name);
            $('.file-saver').val(files_array)
        },
        afterRender: function (listEl, parentEl, newInputEl, inputEl) {
            var api = $.fileuploader.getInstance(inputEl),
                $plusInput = listEl.find('.fileuploader-input');

            // bind input click
            $plusInput.on('click', function () {
                api.open();
            });

            // set drop container
            api.getOptions().dragDrop.container = $plusInput;
        },
        captions: $.extend(true, {}, $.fn.fileuploader.languages['en'], {
            feedback: 'Drag & Drop',
            setting_asMain: 'Use as main',
            setting_download: 'Download',
            setting_edit: 'Edit',
            setting_open: 'Open',
            setting_rename: 'Rename',
            rename: 'Enter the new file name:',
            renameError: 'Please enter another name.',
            imageSizeError: 'The image ${name} is too small.',
        })
    });
    $('input[name="files2"]').fileuploader({
        limit: 25,
        maxSize: 100,
        fileMaxSize: 100,
        extensions: $('input[name="files2"]').length > 0 ? JSON.parse($('input[name="files2"]').attr("file-accept")) : null,
        changeInput: ' ',
        theme: 'gallery',
        enableApi: true,
        thumbnails: {
            box: '<div class="fileuploader-items">' +
                '<ul class="fileuploader-items-list">' +
                '<li class="fileuploader-input"><button type="button" class="fileuploader-input-inner"><i class="fileuploader-icon-main"></i> <span>${captions.feedback}</span></button></li>' +
                '</ul>' +
                '</div>',
            item: '<li class="fileuploader-item">' +
                '<div class="fileuploader-item-inner">' +
                '<div class="actions-holder">' +
                '<button type="button" class="fileuploader-action fileuploader-action-sort is-hidden" title="${captions.sort}"><i class="fileuploader-icon-sort"></i></button>' +
                '<button type="button" class="fileuploader-action fileuploader-action-remove" title="${captions.remove}"><i class="fileuploader-icon-remove"></i></button>' +
                '</div>' +
                '<div class="thumbnail-holder">' +
                '${image}' +
                '<span class="fileuploader-action-popup"></span>' +
                '<div class="progress-holder"><span></span>${progressBar}</div>' +
                '</div>' +
                '<div class="main text-center mt-1 text-white font-bold px-2"></div>' +
                '<div class="content-holder"><h5 title="${name}">${name}</h5><span>${size2}</span></div>' +
                '<div class="type-holder">${icon}</div>' +
                '</div>' +
                '</li>',
            item2: '<li class="fileuploader-item file-main-${data.isMain}">' +
                '<div class="fileuploader-item-inner">' +
                '<div class="actions-holder">' +
                '<button type="button" class="fileuploader-action fileuploader-action-sort" title="${captions.sort}"><i class="fileuploader-icon-sort"></i></button>' +
                '<button type="button" class="fileuploader-action fileuploader-action-remove" title="${captions.remove}"><i class="fileuploader-icon-remove"></i></button>' +
                '</div>' +
                '<div class="thumbnail-holder">' +
                '${image}' +
                '<span class="fileuploader-action-popup"></span>' +
                '</div>' +
                '<div class="main  text-center mt-1 text-white font-bold"></div>' +
                '<div class="content-holder"><h5 title="${name}">${name}</h5><span>${size2}</span></div>' +
                '<div class="type-holder">${icon}</div>' +
                '</div>' +
                '</li>',
            itemPrepend: false,
            startImageRenderer: true,
            canvasImage: false,
            onItemShow: function (item, listEl, parentEl, newInputEl, inputEl) {

                var api = $.fileuploader.getInstance(inputEl),
                    color = api.assets.textToColor(item.format),
                    $plusInput = listEl.find('.fileuploader-input'),
                    $progressBar = item.html.find('.progress-holder');

                // put input first in the list
                $plusInput.prependTo(listEl)


                // color the icon and the progressbar with the format color
                item.html.find('.type-holder .fileuploader-item-icon')[api.assets.isBrightColor(color) ? 'addClass' : 'removeClass']('is-bright-color').css('backgroundColor', color);
            },
            onImageLoaded: function (item, listEl, parentEl, newInputEl, inputEl) {
                var api = $.fileuploader.getInstance(inputEl);

                // add icon
                item.image.find('.fileuploader-item-icon i').html('')
                    .addClass('fileuploader-icon-' + (['image', 'video', 'audio'].indexOf(item.format) > -1 ? item.format : 'file'));

                // check the image size
                if (item.format == 'image' && item.upload && !item.imU) {
                    if (item.reader.node && (item.reader.width < 50 || item.reader.height < 50)) {
                        alert(api.assets.textParse(api.getOptions().captions.imageSizeError, item));
                        return item.remove();
                    }

                    item.image.hide();
                    item.reader.done = true;
                    item.upload.send();
                }
                if (item.index == 0) {
                    item.html.addClass('file-main-1');
                    item.data.isMain = true;
                    item.html.find('.fileuploader-item-inner .main').html('')
                }

            },
            onItemRemove: function (html) {
                html.fadeOut(250);
            }
        },
        dragDrop: {
            container: '.fileuploader-theme-gallery .fileuploader-input'
        },
        upload: {
            url: $('input[name="files2"]').attr("data-url"),
            data: { "_token": $('meta[name="csrf-token"]').attr('content'), 'accept': $('input[name="files2"]').length > 0 ? JSON.parse($('input[name="files2"]').attr("file-accept")) : null },
            type: 'POST',
            enctype: 'multipart/form-data',
            start: true,
            synchron: true,
            beforeSend: null,
            beforeSend: function (item) {
                // check the image size first (onImageLoaded)
                if (item.format == 'image' && !item.reader.done)
                    return false;

                // add editor to upload data after editing
                if (item.editor && (typeof item.editor.rotation != "undefined" || item.editor.crop)) {
                    item.imU = true;
                    item.upload.data.name = item.name;
                    item.upload.data.id = item.data.listProps.id;
                    item.upload.data._editorr = JSON.stringify(item.editor);
                }

                item.html.find('.fileuploader-action-success').removeClass('fileuploader-action-success');
            },
            onSuccess: function (result, item) {

                var data = {};

                try {
                    data = JSON.parse(result);
                } catch (e) {
                    data.hasWarnings = true;
                }
                var files_array = $('.gallery-file-saver').val();
                if (files_array !== "") {
                    files_array += "~" + data.filename;
                }
                else {
                    files_array = data.filename;
                }
                $('.gallery-file-saver').val(files_array);
                item.name = data.filename;
                // if success update the information
                if (data.isSuccess && data.files.length) {
                    if (!item.data.listProps)
                        item.data.listProps = {};
                    item.title = data.files[0].title;

                    item.size = data.files[0].size;
                    item.size2 = data.files[0].size2;
                    item.data.url = data.files[0].url;
                    item.data.listProps.id = data.files[0].id;

                    item.html.find('.content-holder h5').attr('title', item.name).text(item.name);
                    item.html.find('.content-holder span').text(item.size2);
                    item.html.find('.gallery-item-dropdown [download]').attr('href', item.data.url);

                }

                // if warnings
                if (data.hasWarnings) {
                    for (var warning in data.warnings) {
                        alert(data.warnings[warning]);
                    }

                    item.html.removeClass('upload-successful').addClass('upload-failed');
                    return this.onError ? this.onError(item) : null;
                }

                delete item.imU;
                item.html.find('.fileuploader-action-remove').addClass('fileuploader-action-success');

                setTimeout(function () {
                    item.html.find('.progress-holder').hide();

                    item.html.find('.fileuploader-action-popup, .fileuploader-item-image').show();
                    item.html.find('.fileuploader-action-sort').removeClass('is-hidden');
                    item.html.find('.fileuploader-action-settings').removeClass('is-hidden');
                    if ($(".progress-holder:visible").length == 0) {
                        $(".image-add").removeAttr("disabled");
                    }
                }, 400);

            },
            onError: function (item) {
                item.html.find('.progress-holder, .fileuploader-action-popup, .fileuploader-item-image').hide();

                // add retry button
                item.upload.status != 'cancelled' && !item.imU && !item.html.find('.fileuploader-action-retry').length ? item.html.find('.actions-holder').prepend(
                    '<button type="button" class="fileuploader-action fileuploader-action-retry" title="Retry"><i class="fileuploader-icon-retry"></i></button>'
                ) : null;
            },
            onProgress: function (data, item) {
                $(".image-add").attr("disabled", "disabled")
                var $progressBar = item.html.find('.progress-holder');

                if ($progressBar.length) {
                    $progressBar.show();
                    $progressBar.find('span').text(data.percentage >= 99 ? 'Uploading...' : data.percentage + '%');
                    $progressBar.find('.fileuploader-progressbar .bar').height(data.percentage + '%');
                }

                item.html.find('.fileuploader-action-popup, .fileuploader-item-image').hide();
            }
        },
        sorter: {
            selectorExclude: null,
            placeholder: null,
            scrollContainer: window,
            onSort: function (list, listEl, parentEl, newInputEl, inputEl) {
                var api = $.fileuploader.getInstance(inputEl.get(0)),
                    fileList = api.getFileList(),
                    _list = [];
                var files_array = "";
                $.each(fileList, function (i, item) {
                    _list.push({
                        name: item.name,
                        index: item.index
                    });
                    if (i == 0) {
                        item.html.addClass('file-main-1');
                        item.data.isMain = true;
                        item.html.find('.fileuploader-item-inner .main').html('')
                    }
                    else {
                        item.html.removeClass('file-main-1');
                        item.data.isMain = false;
                        item.html.find('.fileuploader-item-inner .main').html('')
                    }
                    if (files_array !== "") {
                        files_array += "~" + item.name;
                    } else {
                        files_array = item.name;
                    }
                });
                $(".gallery-file-saver").val(files_array);
            }
        },
        onRemove: function (list, listEl, parentEl, newInputEl, inputEl) {
            $.post(inputEl[0].dataset.id, {
                file: list.name,
                "_token": $('meta[name="csrf-token"]').attr('content')
            });
            var files_array = $('.gallery-file-saver').val();
            files_array.replace(list.name);
            $('.gallery-file-saver').val(files_array)
        },
        afterRender: function (listEl, parentEl, newInputEl, inputEl) {
            var api = $.fileuploader.getInstance(inputEl),
                $plusInput = listEl.find('.fileuploader-input');

            // bind input click
            $plusInput.on('click', function () {
                api.open();
            });

            // set drop container
            api.getOptions().dragDrop.container = $plusInput;
        },
        captions: $.extend(true, {}, $.fn.fileuploader.languages['en'], {
            feedback: 'Drag & Drop',
            setting_asMain: 'Use as main',
            setting_download: 'Download',
            setting_edit: 'Edit',
            setting_open: 'Open',
            setting_rename: 'Rename',
            rename: 'Enter the new file name:',
            renameError: 'Please enter another name.',
            imageSizeError: 'The image ${name} is too small.',
        })
    });
});

