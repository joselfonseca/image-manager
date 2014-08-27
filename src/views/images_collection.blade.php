<div class='row' id="images-container">
    @foreach($files as $f)
    <div class='col-lg-4' id="imageManager_{{$f->id}}">
        <div class="thumbnail">
            <img src="{{action('showthumb', $f->id)}}" alt="">
            <div class="caption">
                <button class="btn btn-default" data-file-id='{{$f->id}}' data-preview-url="{{action('showthumb', $f->id)}}" data-action="selected-file"><i class="fa fa-check-circle"></i> Use</button>
                <button class="btn btn-danger" data-file-id='{{$f->id}}' data-delete-url="{{action('ImageManagerDelete', $f->id)}}" data-action="delete-file"><i class="fa fa-trash-o"></i> Delete</button>
            </div>
        </div>
    </div>
    @endforeach
</div>
<div class="row">
    <div class="center-block images-paginator" style="text-align: center">
        {{$files->links()}}
    </div>
</div>