<?php

namespace App\Http\Controllers\Panel;

use App\Models\Gallery;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class GalleryController extends Controller
{
    // Views

    public function index()
    {
        return view('panel.gallery.gallery');
    }

    // Functions

    public function getData()
    {
        return response()->json(Gallery::all(), 200);
    }

    public function store(Request $request)
    {
        return response()->json([
            'code' => 200,
            'message' => 'Success store image gallery',
        ]);
    }

    public function delete($galleryId)
    {
        return response()->json([
            'code' => 200,
            'message' => 'Success delete image gallery',
        ]);
    }

    public function edit($galleryId)
    {
        return response()->json([
            'code' => 200,
            'message' => 'Success edit image gallery',
        ]);
    }


    // Others

    private function getStorage()
    {
        return config('constants.STORAGE.DISK.DEFAULT');
    }

    private function getDiskConfig()
    {
        return ['disk' => $this->getStorage()];
    }

    private function getPathBanner($fileName = null)
    {
        $path = config('constants.STORAGE.PATH.GALLERY');

        return $fileName != null ? $path . '/' . $fileName : $path;
    }
}
