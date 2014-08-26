(function($) {

    var ImageManager = {
        init: function() {
            $(document).on('click', '.fileManager', function() {
                var $this = $(this);
                $.colorbox({
                    href: $this.data('url'),
                    width: '100%',
                    heigth: '100%'
                });
            });
        },
        initPlupload: function(data) {
            var uploader = new plupload.Uploader({
                runtimes: 'html5,flash',
                browse_button: 'pickfiles',
                container: document.getElementById('container-upload'),
                url: data.url,
                flash_swf_url: data.flash,
                silverlight_xap_url: data.silverlight,
                filters: {
                    max_file_size: data.maxFileSize,
                    mime_types: [
                        {title: "Image files", extensions: "jpg,gif,png,jpeg"}
                    ]
                },
                init: {
                    PostInit: function() {
                        document.getElementById('filelist').innerHTML = '';
                        document.getElementById('uploadfiles').onclick = function() {
                            uploader.start();
                            return false;
                        };
                    },
                    FilesAdded: function(up, files) {
                        plupload.each(files, function(file) {
                            document.getElementById('filelist').innerHTML += '<div id="' + file.id + '">' + file.name + ' (' + plupload.formatSize(file.size) + ') <b></b></div>';
                        });
                    },
                    UploadProgress: function(up, file) {
                        document.getElementById(file.id).getElementsByTagName('b')[0].innerHTML = '<span>' + file.percent + "%</span>";
                    },
                    Error: function(up, err) {
                        document.getElementById('console').innerHTML += "\nError #" + err.code + ": " + err.message;
                    }
                }
            });
            uploader.init();
        }
    };

    $(function() {
        ImageManager.init();
    });



})($);
