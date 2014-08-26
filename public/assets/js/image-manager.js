(function($, window) {

    window.ImageManager = {
        uploader: null,
        init: function() {
            window.ImageManager.uploader = null;
            $(document).on('click', '.fileManager', function() {
                var $this = $(this);
                $.colorbox({
                    href: $this.data('url'),
                    width: '100%',
                    height: '100%'
                });
            });
        },
        initPlupload: function(data) {
            window.ImageManager.uploader = new plupload.Uploader({
                runtimes: 'html5,flash',
                browse_button: 'pickfiles',
                container: document.getElementById('container-upload'),
                url: data.url,
                flash_swf_url: data.flash,
                silverlight_xap_url: data.silverlight,
                filters: {
                    max_file_size: data.maxFileSize,
                    mime_types: [
                        {
                            title: "Image files",
                            extensions: "jpg,gif,png,jpeg"
                        }
                    ]
                },
                resize:{
                    quality: 85
                },
                init: {
                    PostInit: function() {
                        document.getElementById('filelist').innerHTML = '';
                        document.getElementById('uploadfiles').onclick = function() {
                            window.ImageManager.uploader.start();
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
                    FileUploaded: function(up, file, response){
                        var $response = $.parseJSON(response);
                        console.log($response);
                    }
                }
            });
            window.ImageManager.uploader.init();
        }
    };

    $(function() {
        if($('.fileManager').length > 0){
            window.ImageManager.init();
        }
    });



})($, window);
