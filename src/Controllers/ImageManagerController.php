<?php

namespace Joselfonseca\ImageManager\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Storage;
use Joselfonseca\ImageManager\ImageRender;
use Illuminate\Validation\ValidationException;
use Joselfonseca\ImageManager\Models\ImageManagerFiles;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Database\Eloquent\ModelNotFoundException;

/**
 * Description of ImageManagerController
 *
 * @author jfonseca
 */
class ImageManagerController extends Controller
{
    use ValidatesRequests;

    protected $model;

    protected $renderService;

    public function __construct(ImageManagerFiles $model, ImageRender $renderService)
    {
        $this->model = $model;
        $this->renderService = $renderService;
    }

    public function index()
    {
        return view('image-manager::image_manager');
    }

    public function getImages()
    {
        $files = $this->model->orderBy('created_at', 'desc')->where('from_manager', 1)->paginate(12);

        return view('image-manager::images_collection')->with('files', $files);
    }

    public function thumb($id)
    {
        try {
            $image = $this->model->findOrFail($id);
            return $this->renderService->render($image->path, 250, 250, true);
        } catch (ModelNotFoundException $e) {
            return $this->renderService->renderDefault(250, 250);
        }
    }

    public function full($id, $width = 1600, $height = null, $canvas = false)
    {
        try {
            $image = $this->model->findOrFail($id);
            return $this->renderService->render($image->path, $width, $height, (bool) $canvas);
        } catch (ModelNotFoundException $e) {
            return $this->renderService->renderDefault($width, $height);
        }
    }

    public function store(Request $request)
    {
        try {
            $this->validate($request, [
                'file' => "image|required|between:1,".config('image-manager.maxFileSize'),
            ]);
            $path = $request->file->store('local');
            $file = $this->model->create([
                'name' => $path,
                'originalName' => $request->file('file')->getClientOriginalName(),
                'type' => $request->file('file')->getClientMimeType(),
                'path' => $path,
                'size' => $request->file('file')->getClientSize(),
                'from_manager' => $request->get('from_manager', '1'),
            ]);
        } catch (ValidationException $e) {
            return response()->json(['errorCode' => 'ValidationError', 'messages' => $e->errors()], 400);
        }
        return response()->json(['file' => $file->getFileInfo()]);
    }

    public function delete($id)
    {
        try {
            $image = $this->model->find($id);
            if(Storage::has($image->path)) {
                Storage::delete($image->path);
            }
            $image->delete();
        } catch (ModelNotFoundException $e) {
            $return = ['errorCode' => 'ModelNotFound', 'message' => 'The file does not exsist.'];
            return response()->json($return, 404);
        }
        return response()->json(['status' => true]);
    }
}
