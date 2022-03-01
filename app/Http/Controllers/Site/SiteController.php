<?php

namespace App\Http\Controllers\Site;

use App\Mail\Contact as ContactMail;
use App\Models\Gallery;
use App\Models\News;
use App\Models\Member;
use App\Models\Product;
use App\Models\Video;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Carbon;

class SiteController extends Controller
{
    private $maxNumberPost = 5;
    private $minNumberPost = 3;
    private $paginationNumber = 10;

    /**
     * Views
     */

    public function index()
    {
        // Get Query News
        $newsBanner = News::select('id', 'title', 'banner', 'created_at', 'user_id', 'slug')
        ->take($this->maxNumberPost)
        ->get();

        $newsBannerSideRight = News::select('id', 'title', 'banner', 'created_at', 'user_id', 'slug')
        ->take(2)
        ->get();

        $newsIdsSideRight = $newsBannerSideRight->map(function($item){
            return $item->id;
        })->toArray();

        $newsBannerSideLeft = News::select('id', 'title', 'banner', 'created_at', 'user_id', 'slug')
        ->whereNotIn('id', $newsIdsSideRight)
        ->take(3)
        ->get();

        // get query product
        $productBanner = Product::take($this->maxNumberPost)->get();
        $productTop3 = Product::take($this->minNumberPost)->get();

        // get query videos
        $videos = Video::take($this->maxNumberPost)->get();

        // get query gallery
        $galleryTop5 = Gallery::take($this->maxNumberPost)->get();

        return view('site.index')->with([
            'newsBanner' => $newsBanner,
            'newsSideRight' => $newsBannerSideRight,
            'newsSideLeft' => $newsBannerSideLeft,
            'galleryTop5' => $galleryTop5,
            'productBanner' => $productBanner,
            'productTop3' => $productTop3,
            'videos' => $videos,
        ]);
    }

    public function news(Request $request)
    {
        $news = null;
        if($request->has('search')){
            $news = News::where('title', 'like', '%'.$request->get('search').'%')->simplePaginate($this->paginationNumber);
        }else{
            $news = News::simplePaginate($this->paginationNumber);
        }

        return view('site.news.news')->with([
            'news' => $news
        ]);
    }

    public function newsDetail(News $news)
    {
        if($news == null){
            // return page not found
            abort(404, "Data berita tidak ditemukan");
        }

        $anotherNews = News::select('id', 'title', 'banner', 'created_at', 'user_id', 'slug')->where('id', '!=', $news->id)->get();

        return view('site.news.news-detail')->with([
            'data' => $news,
            'anotherNews' => $anotherNews,
        ]);
    }

    public function organizationProfile()
    {
        return view('site.organization.profile');
    }

    public function organizationRule()
    {
        return view('site.organization.rule');
    }

    public function organizationReport()
    {
        return view('site.organization.report');
    }

    public function memberList()
    {
        $data = Member::membersApproved();

        return view('site.member.list')->with([
            'data' => $data
        ]);
    }

    public function memberRegister()
    {
        return view('site.member.register')->with([
            'gender' => $this->getListGender()
        ]);
    }

    public function memberConstribution()
    {
        return view('site.member.constribution');
    }

    public function contact()
    {
        return view('site.contact');
    }

    public function product()
    {
        $data = Product::simplePaginate($this->paginationNumber);

        return view('site.product.product')->with([
            'data' => $data
        ]);
    }

    public function productDetail(Product $product)
    {
        if($product == null)
            abort(404, "Data Product is not found");

        $anotherProduct = Product::where('id', '!=', $product->id)->take($this->maxNumberPost)->get();

        return view('site.product.product-detail')->with([
            'data' => $product,
            'anotherProduct' => $anotherProduct,
        ]);
    }

    public function video()
    {
        $data = Video::simplePaginate($this->paginationNumber);

        return view('site.video.video')->with([
            'data' => $data,
        ]);
    }

    public function videDetail(Video $video)
    {
        if($video == null)
            abort(404, "Data video is not found");

        $anotherVideo = Video::where('id', '!=', $video->id)->take($this->maxNumberPost)->get();

        return view('site.video.video-detail')->with([
            'data' => $video,
            'anotherVideo' => $anotherVideo
        ]);
    }

    public function galleries()
    {
        $data = Gallery::simplePaginate($this->paginationNumber);

        return view('site.gallery.gallery')->with([
            'data' => $data
        ]);
    }

    public function galleryDetail(Gallery $gallery)
    {
        if($gallery == null){
            abort(404, "Data gallery tidak ditemukan");
        }

        $anotherGallery = Gallery::where('id', '!=', $gallery->id)->take($this->maxNumberPost)->get();

        return view('site.gallery.gallery-detail')->with([
            'data' => $gallery,
            'anotherGallery' => $anotherGallery,
        ]);
    }

    /**
     * Functions
     */

    public function saveDataMember(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:225',
            'birth_place' => 'required|string|max:191',
            'birth_date' => 'required|date',
            'gender' => 'required',
            'nik' => 'required|string|max:30',
            'profession' => 'required|string|max:100',
            'komunitas_adat' => 'required|string|max:225',
            'address' => 'required|string|max:225',
            'phone_number' => 'required|string|max:25',
            'email' => 'required|string|max:125',
            'file_ktp' => 'required|image|mimes:jpeg,png,jpg',
            'file_pass_photo' => 'required|image|mimes:jpeg,png,jpg',
        ]);

        // save image on storage
        $fileKtp = null;
        if($request->file_ktp != null){
            $fileKtp = $this->generateFileName('ktp', $request->file_ktp->extension());
            $request->file_ktp->storeAs($this->getPathFileKtp(), $fileKtp, $this->getDiskConfig());
        }

        $filePassPhoto = null;
        if($request->file_pass_photo != null){
            $filePassPhoto = $this->generateFileName('photo', $request->file_pass_photo->extension());
            $request->file_pass_photo->storeAs($this->getPathFilePassPhoto(), $filePassPhoto, $this->getDiskConfig());
        }

        DB::beginTransaction();
        try {
            // create record
            Member::create([
                'name' => $request->name,
                'birth_place' => $request->birth_place,
                'birth_date' => Carbon::parse($request->birth_date)->format(config('constants.DATE.INPUT_DATE')),
                'gender' => $request->gender,
                'nik' => $request->nik,
                'profession' => $request->profession,
                'komunitas_adat' => $request->komunitas_adat,
                'address' => $request->address,
                'phone_number' => $request->phone_number,
                'email' => $request->email,
                'file_ktp' => $fileKtp,
                'file_passport_photo' => $filePassPhoto
            ]);

            DB::commit();
        } catch (\Throwable $th) {
            DB::rollback();

            $this->deleteFileKtp($fileKtp);
            $this->deleteFilePassPhoto($filePassPhoto);

            return redirect()->route('site.member.register')->with([
                'error' => 'Failed create data. Exception : ' . $th->getMessage(),
            ]);
        }

        return redirect()->route('site.member.register')->with([
            'success' => 'Success to create data.',
        ]);
    }

    public function sendMail(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:225',
            'email' => 'required|string|max:191',
            'message' => 'required|string|max:225',
        ]);

        Mail::to(config('constants.EMAIL'))
        ->send(new ContactMail([
            'name' => $request->name,
            'email' => $request->email,
            'msg' => $request->message,
        ]));

        return redirect()->route('site.contact');
    }

    /**
     * Others
     */

    private function getStorage()
    {
        return config('constants.STORAGE.DISK.PRIVATE');
    }

    private function getDiskConfig()
    {
        return ['disk' => $this->getStorage()];
    }

    private function getPathFileKtp($fileName = null)
    {
        return $this->getPathFiles(null, config('constants.FILE.MEMBER.KTP'));
    }

    private function getPathFilePassPhoto($fileName = null)
    {
        return $this->getPathFiles(null, config('constants.FILE.MEMBER.PASS_PHOTO'));
    }

    private function getPathFiles($fileName = null, $type)
    {
        $path = '';
        if($type == config('constants.FILE.MEMBER.KTP')){
            $path = config('constants.STORAGE.PATH.MEMBER.KTP');
        }else if($type == config('constants.FILE.MEMBER.PASS_PHOTO')){
            $path = config('constants.STORAGE.PATH.MEMBER.PASS_PHOTO');
        }else{
            $path = config('constants.STORAGE.PATH.MEMBER.DEFAULT');
        }

        return $fileName != null ? $path . '/' . $fileName : $path;
    }

    private function deleteFile($fileName, $type)
    {
        if($fileName != null || !empty($fileName)){
            Storage::disk($this->getStorage())->delete($this->getPathFiles($fileName, $type));
        }
    }

    private function deleteFileKtp($fileName)
    {
        $this->deleteFile($fileName, config('constants.FILE.MEMBER.KTP'));
    }

    private function deleteFilePassPhoto($fileName)
    {
        $this->deleteFile($fileName, config('constants.FILE.MEMBER.PASS_PHOTO'));
    }

    private function getListGender()
    {
        return [
            'm' => 'Laki-laki',
            'f' => 'Perempuan'
        ];
    }

    private function generateFileName($prefix, $fileExtension)
    {
        return time().'-'.$prefix.'.'.$fileExtension;
    }
}
