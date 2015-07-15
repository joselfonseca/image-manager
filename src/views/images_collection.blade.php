<div class='row' id="images-container">
    @foreach($files as $f)
    <div class='col-lg-3' id="imageManager_{{$f->id}}">
        <div class="thumbnail">
            <img src="{{route('media', ['id' => $f->id, 'width' => 200, 'height' => 200, 'canvas' => 'canvas'])}}" alt="">
            <div class="caption">
                <button class="btn btn-default" data-file-id='{{$f->id}}' data-preview-url="{{route('media', ['id' => $f->id, 'width' => 200, 'height' => 200, 'canvas' => 'canvas'])}}" data-action="selected-file"><i class="fa fa-check-circle"></i> {{trans('ImageManager::image-manager.use')}}</button>
                <button type="button" class="btn btn-default popover-dismiss" data-container="body" data-toggle="popover" data-placement="top" data-content='{{trans('ImageManager::image-manager.delete_message')}}<br /><button class="btn btn-danger" data-file-id="{{$f->id}}" data-delete-url="{{route('ImageManagerDelete', $f->id)}}" data-action="delete-file"><i class="fa fa-trash-o"></i> {{trans('ImageManager::image-manager.delete_title')}}</button>'>
                    {{trans('ImageManager::image-manager.delete_file')}}
                </button>
            </div>
        </div>
    </div>
    @endforeach
</div>
<div class="row">
    <div class="center-block images-paginator" style="text-align: center">
        {!! $files->render() !!}
    </div>
</div>
