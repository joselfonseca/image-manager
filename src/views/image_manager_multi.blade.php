<div class="row">
    <div class="col-md-12">
        <h4>{{trans('ImageManager::image-manager.multiple_image_manager')}}</h4>
    </div>
</div>
<div class="row">
    <div class="col-md-3">
        <button type="button" class="btn btn-primary btn-block fileManager" data-url="{{route('ImageManager')}}" data-multi="true">{{trans('ImageManager::image-manager.select_files')}}</button>
    </div>
</div>
<hr />
<div class="row" id="filesContainer">
    @foreach($params['default'] as $file)
        @if(!empty($file))
        <div class="col-md-3" id="file_{{$file->id}}">
            <div class="thumbnail">
                <img src="{{route('media', ['id' => $file->id, 'width' => 200, 'height' => 200, 'canvas' => 'canvas'])}}" alt="">
                <input type="hidden" name="{{$params['field_name']}}[]" value="{{$file->id}}" />
                <div class="caption">
                    <button type="button" class="btn btn-default btn-block" data-action="removeFromMultiImage" data-id="{{ $file->id }}"><i class="fa fa-trash-o"></i> {{trans('ImageManager::image-manager.delete_multi_title')}}</button>
                </div>
            </div>
        </div>
        @endif
    @endforeach
</div>
<script id="multi-image-template" type="text/x-handlebars-template">
    <div class="col-md-3" id="file_@{{id}}">
        <div class="thumbnail">
            <img src="{{url('image-manager/view')}}/@{{ id }}/200/200/canvas" alt="">
            <input type="hidden" name="{{$params['field_name']}}[]" value="@{{id}}" />
            <div class="caption">
                <button type="button" class="btn btn-default btn-block" data-action="removeFromMultiImage" data-id="@{{ id }}"><i class="fa fa-trash-o"></i> {{trans('ImageManager::image-manager.delete_multi_title')}}</button>
            </div>
        </div>
    </div>
</script>