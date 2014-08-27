(function($, window) {

    window.ImageManager = {
        uploader: null,
        caller: null,
        SelectedFile: null,
        colorbox: null,
        init: function() {
            $(document).on('click', '.fileManager', function() {
                var $this = $(this);
                window.ImageManagerCaller = $this;
                $.colorbox({
                    href: $this.data('url'),
                    open: true,
                    width: '100%',
                    height: '100%',
                    onComplete: function() {
                        window.ImageManager.initPopUp();
                    }
                });
            });
        },
        initPlupload: function() {
            if (typeof (window.Uploader) !== "undefined") {
                window.Uploader.destroy();
            }
            window.Uploader = new plupload.Uploader({
                runtimes: 'html5,flash',
                browse_button: 'pickfiles',
                container: document.getElementById('container-upload'),
                url: window.ImageManagerData.url,
                flash_swf_url: window.ImageManagerData.flash,
                silverlight_xap_url: window.ImageManagerData.silverlight,
                filters: {
                    max_file_size: window.ImageManagerData.maxFileSize,
                    mime_types: [
                        {
                            title: "Image files",
                            extensions: "jpg,gif,png,jpeg"
                        }
                    ]
                },
                resize: {
                    quality: 85
                },
                init: {
                    PostInit: function() {
                        document.getElementById('filelist').innerHTML = '';
                        document.getElementById('uploadfiles').onclick = function() {
                            window.Uploader.start();
                            return false;
                        };
                    },
                    FilesAdded: function(up, files) {
                        plupload.each(files, function(file) {
                            document.getElementById('filelist').innerHTML += '<div style="margin-top: 10px" id="' + file.id + '">' + file.name + ' (' + plupload.formatSize(file.size) + ') <b></b></div>';
                        });
                    },
                    UploadProgress: function(up, file) {
                        document.getElementById(file.id).getElementsByTagName('b')[0].innerHTML = '<span>' + file.percent + "%</span>";
                    },
                    Error: function(up, err) {

                    },
                    FileUploaded: function(up, file, response) {
                        var $response = $.parseJSON(response.response);
                        window.ImageManager.getImages({imagesUrl: $response.file.urlAll});
                    }
                }
            });
            window.Uploader.init();
        },
        initPopUp: function() {
            if ($('#image-loader').length > 0) {
                window.ImageManager.getImages({
                    imagesUrl: window.ImageManagerData.imagesUrl
                });
            }
            if ($('#pickfiles').length > 0) {
                window.ImageManager.initPlupload();
            }
        },
        renderFile: function($file) {
            $('#images-container').prepend($file.html);
        },
        getImages: function(data) {
            $.get(data.imagesUrl, function(html) {
                $('#image-loader').html(html);
            });
        },
        afterSelect: function() {
            var $caller = window.ImageManagerCaller;
            window.ImageManagerCaller = null;
            $input = $caller.parents('.ImageManager').find('.inputFile');
            $preview = $caller.parents('.ImageManager').find('.imageManagerImage');
            $input.val(window.ImageManager.SelectedFile.id);
            $preview.attr('src', window.ImageManager.SelectedFile.url).show();
            window.ImageManager.SelectedFile = null;
        }
    };

    $(function() {
        if ($('.fileManager').length > 0) {
            window.ImageManager.init();
        }
    });

    $(document).on('click', '[data-action="selected-file"]', function() {
        var $this = $(this);
        window.ImageManager.SelectedFile = {id: $this.data('file-id'), url: $this.data('preview-url')};
        $.colorbox.close();
        window.ImageManager.afterSelect();
    });

    $(document).on('click', '.images-paginator>.pagination>li>a', function() {
        var $this = $(this);
        window.ImageManager.getImages({
            imagesUrl: $this.attr('href')
        });
        return false;
    });

})($, window);
