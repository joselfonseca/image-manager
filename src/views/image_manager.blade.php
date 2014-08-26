<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Image Manager</title>
        <link href="//maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css" rel="stylesheet">
        
    </head>
    <body>
        <div class='container'>
            <h3>Image Manager</h3>
            <hr>
            <div class='row'>
                <div class='col-lg-3'>
                    <h4>Upload</h4>
                    <div id='container-upload'>
                        
                    </div>
                </div>
                <div class='col-lg-9'>
                    <h4>Select from library</h4>
                    <div class='row'>
                        @foreach($files as $f)
                        <div class='col-lg-4'>
                            <a href="javascript:void(0)" data-file-id='{{$f->id}}' class="thumbnail">
                                <img src="{{action('showthumb', $f->id)}}" alt="">
                            </a>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
        <script src="//maxcdn.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>
        <script type="text/javascript" src="/packages/joselfonseca/image-manager/assets/js/libs/plupload/js/plupload.full.min.js"></script>
    </body>
</html>
