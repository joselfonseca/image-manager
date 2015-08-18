<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Image Manager</title>
    </head>
    <body>
        <div class='container'>
            <h3>{{trans('ImageManager::image-manager.title')}}</h3>
            <hr>
            <div class='row'>
                <div class='col-lg-3'>
                    <h4>{{trans('ImageManager::image-manager.upload')}}</h4>
                    <div id='container-upload'>
                        <button id="pickfiles" class="btn btn-primary">{{trans('ImageManager::image-manager.select_files')}}</button>
                        <button id="uploadfiles" class="btn btn-primary">{{trans('ImageManager::image-manager.upload_files')}}</button>
                        <div id="filelist"></div>
                    </div>
                </div>
                <div class='col-lg-9'>
                    <h4>{{trans('ImageManager::image-manager.select_from_library')}}</h4>
                    <div id="image-loader">

                    </div>
                </div>
            </div>
        </div>
        <script>
            window.ImageManagerData = {
                url: '{{url("upload-image")}}',
                flash: '{{asset("/vendor/image-manager/vendors/plupload/Moxie.swf")}}',
                silverlight: '{{asset("/vendor/image-manager/vendors/plupload/Moxie.xap")}}',
                maxFileSize: '{{config("image-manager.maxFileSize")}}',
                imagesUrl: '{{url("image-manager-images")}}',
                csfr: '{{csrf_token()}}'
            };
        </script>
    </body>
</html>
