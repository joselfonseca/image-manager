<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Image Manager</title>
    </head>
    <body>
        <div class='container'>
            <h3>Image Manager</h3>
            <hr>
            <div class='row'>
                <div class='col-lg-3'>
                    <h4>Upload</h4>
                    <div id='container-upload'>
                        <button id="pickfiles" class="btn btn-primary">Select files</button>
                        <button id="uploadfiles" class="btn btn-primary">Upload files</button>
                        <div id="filelist"></div>
                    </div>
                </div>
                <div class='col-lg-9'>
                    <h4>Select from library</h4>
                    <div id="image-loader">

                    </div>
                </div>
            </div>
        </div>
        <script>
            window.ImageManagerData = {
                url: '{{action("ImageManagerUpload")}}',
                flash: '{{asset("/packages/joselfonseca/image-manager/vendors/plupload/Moxie.swf")}}',
                silverlight: '{{asset("/packages/joselfonseca/image-manager/vendors/plupload/Moxie.xap")}}',
                maxFileSize: '{{Config::get("image-manager::maxFileSize")}}',
                imagesUrl: '{{action("ImageManagerImages")}}'
            };
        </script>
    </body>
</html>
