<?php

namespace App\Http\Controllers\Panel;

use App\Models\Member;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use DataTables;
use Markdown;
use Carbon;

class MemberController extends Controller
{
    // Views

    public function index()
    {
        return view('panel.member.member');
    }

    public function create()
    {
        return view('panel.member.member-create')->with([
            'gender' => $this->getListGender()
        ]);
    }

    public function edit($memberId)
    {
        // find record data
        $data = Member::find($memberId);
        if(!$data) return redirect()->back()->with([
            'error' => 'Data not found.'
        ]);

        return view('panel.member.member-edit')->with([
            'data' => $data,
            'gender' => $this->getListGender()
        ]);
    }

    // Functions

    public function getData(Request $request)
    {
        $model = Member::query();

    	return $this->_datatable($model);
    }

    public function destroy($memberId)
    {
        // find record data
        $data = Member::find($memberId);
        if(!$data) return response()->json([
            'code' => 400,
            'message' => 'Data not found.',
        ]);

        DB::beginTransaction();
        try {
            // get files
            $fileKtp = $data->file_ktp;
            $filePassportPhoto = $data->file_passport_photo;

            // do delete file
            if($data->delete()){
                // if delete record is success, do delete file
                $this->deleteFileKtp($fileKtp);
                $this->deleteFilePassPhoto($filePassportPhoto);
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
            'name' => 'required|string|max:225',
            'birth_place' => 'required|string|max:191',
            'birth_date' => 'required|date',
            'gender' => 'required',
            'nik' => 'required|string|max:30',
            'profession' => 'required|string|max:100',
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
                'address' => $request->address,
                'phone_number' => $request->phone_number,
                'email' => $request->email,
                'file_ktp' => $fileKtp,
                'file_passport_photo' => $filePassPhoto,
                'member_status_id' => config('constants.MEMBER.STATUS.APPROVE'),
            ]);

            DB::commit();
        } catch (\Throwable $th) {
            DB::rollback();

            $this->deleteFileKtp($fileKtp);
            $this->deleteFilePassPhoto($filePassPhoto);

            return redirect()->route('member')->with([
                'message' => 'Failed create data. Exception : ' . $th->getMessage(),
            ]);
        }

        return redirect()->route('member')->with([
            'message' => 'Success to create data.',
        ]);
    }

    public function update(Request $request, $memberId)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:225',
            'birth_place' => 'required|string|max:191',
            'birth_date' => 'required|date',
            'gender' => 'required',
            'nik' => 'required|string|max:30',
            'profession' => 'required|string|max:100',
            'address' => 'required|string|max:225',
            'phone_number' => 'required|string|max:25',
            'email' => 'required|string|max:125',
            'file_ktp' => 'image|mimes:jpeg,png,jpg',
            'file_pass_photo' => 'image|mimes:jpeg,png,jpg',
        ]);

        // find record data
        $data = Member::find($memberId);
        if(!$data) return redirect()->back()->withInput()->with([
            'error' => 'Data not found.'
        ]);

        if ($validator->fails()) {
            return redirect()
                        ->back()
                        ->withErrors($validator)
                        ->withInput();
        }

        $fileKtpNew = null;
        $fileKtpOld = null;
        $filePassPhotoNew = null;
        $filePassPhotoOld = null;

        DB::beginTransaction();
        try {
            // store new file name ktp
            if($request->file_ktp != null){
                $fileKtpNew = $this->generateFileName('ktp', $request->file_ktp->extension());;
            }

            // update file ktp
            if($fileKtpNew != null){
                $fileKtpOld = $data->file_ktp;

                // update banner file name with the new one
                $data->file_ktp = $fileKtpNew;
            }

            // store new file name pass photo
            if($request->file_pass_photo != null){
                $filePassPhotoNew = $this->generateFileName('photo', $request->file_pass_photo->extension());;
            }

            // update file pass photo
            if($filePassPhotoNew != null){
                $filePassPhotoOld = $data->file_pass_photo;

                // update banner file name with the new one
                $data->file_pass_photo = $filePassPhotoNew;
            }

            // do update data
            $data->name = $request->name;
            $data->birth_place = $request->birth_place;
            $data->birth_date = Carbon::parse($request->birth_date)->format(config('constants.DATE.INPUT_DATE'));
            $data->gender = $request->gender;
            $data->nik = $request->nik;
            $data->profession = $request->profession;
            $data->address = $request->address;
            $data->phone_number = $request->phone_number;
            $data->email = $request->email;
            $data->save();

            DB::commit();
        } catch (\Throwable $th) {
            DB::rollback();

            return redirect()->route('member')->with([
                'message' => 'Failed to update data. Exception: ' . $th->getMessage()
            ]);
        }

        // do update file ktp if transaction is success
        if($fileKtpNew != null || !empty($fileKtpNew)){
            // do store new file ktp
            $request->file_ktp->storeAs($this->getPathFileKtp(), $fileKtpNew, $this->getDiskConfig());

            // do delete previous file ktp if exist
            $this->deleteFileKtp($fileKtpOld);
        }

        // do update file pass photo if transaction is success
        if($filePassPhotoNew != null || !empty($filePassPhotoNew)){
            // do store new file pass photo
            $request->file_pass_photo->storeAs($this->getPathFilePassPhoto(), $filePassPhotoNew, $this->getDiskConfig());

            // do delete previous file pass photo if exist
            $this->deleteFilePassPhoto($filePassPhotoOld);
        }

        return redirect()->route('member')->with([
            'message' => 'Success to update data.'
        ]);
    }

    // Others

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
            'm' => 'Male',
            'f' => 'Female'
        ];
    }

    private function generateFileName($prefix, $fileExtension)
    {
        return time().'-'.$prefix.'.'.$fileExtension;
    }

    private function _datatable($model)
    {
    	return DataTables::eloquent($model)
        ->addIndexColumn()
        ->editColumn('created_at', function(Member $member) {
            return $member->created_at->format(config('constants.DATE.DEFAULT'));
        })
        ->addColumn('status', function(Member $query){
            return $query->memberStatus->name;
        })
        ->make(true);
    }
}
