<div class='row' id="images-container">
    @foreach($files as $f)
    <div class='col-lg-4'>
        <a href="javascript:void(0)" data-file-id='{{$f->id}}' data-preview-url="{{action('showthumb', $f->id)}}" data-action="selected-file" class="thumbnail">
            <img src="{{action('showthumb', $f->id)}}" alt="">
        </a>
    </div>
    @endforeach
</div>
<div class="row">
    <div class="center-block images-paginator" style="text-align: center">
        {{$files->links()}}
    </div>
</div>