<?php

namespace App\Http\Controllers\Panel;

use App\Models\Product;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use DataTables;
use Markdown;
use Carbon;

class ProductController extends Controller
{
    // Views

    public function index()
    {
        return view('panel.product.product');
    }

    public function create()
    {
        return view('panel.product.product-create');
    }

    public function edit($productId)
    {
        // find record data
        $data = Product::find($productId);
        if(!$data) return redirect()->back()->with([
            'error' => 'Data not found.'
        ]);

        // example using markdown
        //Markdown::convertToHtml($data->content);

        return view('panel.product.product-edit')->with([
            'data' => $data
        ]);
    }

    // Functions

    public function getData(Request $request)
    {
        $model = Product::query();

    	return $this->_datatable($model);
    }

    public function destroy($productId)
    {
        // find record data
        $data = Product::find($productId);
        if(!$data) return response()->json([
            'code' => 400,
            'message' => 'Data not found.',
        ]);

        DB::beginTransaction();
        try {
            // get banner file name
            $imageName = $data->image;

            // do delete file
            if($data->delete()){
                // if delete record is success, do delete file
                $this->deleteImage($imageName);
            }

            DB::commit();
        } catch (\Throwable $th) {
            DB::rollback();

            return response()->json([
                'code' => 500,
                'message' => 'Failed to delete data. Exception : ' . $th->getMessage(),
            ]);
        }

        return response()->json([
            'code' => 200,
            'message' => 'Success to delete data.',
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'image' => 'image|mimes:jpeg,png,jpg',
            'title' => 'required|string|max:191',
            'description' => 'required|string|max:191',
        ]);

        // save image on storage
        $imageName = null;
        if($request->image != null){
            $imageName = time().'.'.$request->image->extension();
            $request->image->storeAs($this->getPathImage(), $imageName, $this->getDiskConfig());
        }

        DB::beginTransaction();
        try {
            // create record
            Product::create([
                'title' => $request->title,
                'description' => $request->description,
                'image' => $imageName,
                'slug' => Str::slug($request->title),
            ]);

            DB::commit();
        } catch (\Throwable $th) {
            DB::rollback();

            $this->deleteImage($imageName);

            return redirect()->route('product')->with([
                'message' => 'Failed create data. Exception : ' . $th->getMessage(),
            ]);
        }

        return redirect()->route('product')->with([
            'message' => 'Success to create data.',
        ]);
    }

    public function update(Request $request, $productId)
    {
        $validator = Validator::make($request->all(), [
            'image' => 'image|mimes:jpeg,png,jpg',
            'title' => 'required|string|max:191',
            'description' => 'required|string|max:191'
        ]);

        // find record data
        $data = Product::find($productId);
        if(!$data) return redirect()->back()->withInput()->with([
            'error' => 'Data not found.'
        ]);

        if ($validator->fails()) {
            return redirect()
                        ->back()
                        ->withErrors($validator)
                        ->withInput();
        }

        $imageNew = null;
        $imageOld = null;

        DB::beginTransaction();
        try {
            // store new file name banner
            if($request->image != null){
                $imageNew = time().'.'.$request->image->extension();
            }

            // update file banner
            if($imageNew != null){
                $imageOld = $data->image;

                // update banner file name with the new one
                $data->image = $imageNew;
            }

            // do update data
            $data->title = $request->title;
            $data->description = $request->description;
            $data->slug = Str::slug($request->title);
            $data->save();

            DB::commit();
        } catch (\Throwable $th) {
            DB::rollback();

            return redirect()->route('product')->with([
                'message' => 'Failed to update data. Exception: ' . $th->getMessage()
            ]);
        }

        // do update file banner if transaction is success
        if($imageNew != null || !empty($imageNew)){
            // do store new file banner
            $request->image->storeAs($this->getPathImage(), $imageNew, $this->getDiskConfig());

            // do delete previous file banner if exist
            $this->deleteImage($imageOld);
        }

        return redirect()->route('product')->with([
            'message' => 'Success to update data.'
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

    private function getPathImage($fileName = null)
    {
        $path = config('constants.STORAGE.PATH.PRODUCT');

        return $fileName != null ? $path . '/' . $fileName : $path;
    }

    private function deleteImage($fileName)
    {
        if($fileName != null || !empty($fileName)){
            Storage::disk($this->getStorage())->delete($this->getPathImage($fileName));
        }
    }

    private function _datatable($model)
    {
    	return DataTables::eloquent($model)
        ->addIndexColumn()
        ->editColumn('created_at', function(Product $data) {
            return $data->created_at->format(config('constants.DATE.DEFAULT'));
        })
        ->make(true);
    }
}
