<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;
use App\Models\Member;
use Carbon;

class MemberSiteController extends Controller
{

    /**
     * Views
     */

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