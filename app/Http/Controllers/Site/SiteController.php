<?php

namespace App\Http\Controllers\Site;

use App\Mail\Contact as ContactMail;
use App\Models\Gallery;
use App\Models\News;
use App\Models\Member;
use App\Models\Product;
use App\Models\Video;
use App\Http\Controllers\Controller;
use App\Models\BusinessUnit;
use App\Models\CompanyProfile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

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
        $companyProfile = CompanyProfile::getByType(config('constants.COMPANY_PROFILE.PAGES.PERATURAN'));
        $content = $companyProfile != null ? $companyProfile->content : '';

        return view('site.organization.rule')->with([
            'content' => $content
        ]);
    }

    public function organizationReport()
    {
        $companyProfile = CompanyProfile::getByType(config('constants.COMPANY_PROFILE.PAGES.LAPORAN'));
        $content = $companyProfile != null ? $companyProfile->content : '';

        return view('site.organization.report')->with([
            'content' => $content
        ]);;
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

    public function videoDetail(Video $video)
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

        return view('site.gallery.gallery-detail')->with([
            'data' => $gallery
        ]);
    }

    public function businessUnit(BusinessUnit $businessUnit)
    {
        if($businessUnit == null){
            abort(404, "Data Unit Usaha tidak ditemukan");
        }

        return view('site.business_unit.business_unit')->with([
            'data' => $businessUnit
        ]);
    }

    /**
     * Functions
     */

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

}
