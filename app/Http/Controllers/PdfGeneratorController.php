<?php

namespace App\Http\Controllers;

use App\Models\Member;
use Illuminate\Support\Facades\Storage;
use PDF;

class PdfGeneratorController extends Controller
{
    // Functions

    public function generateMembers()
    {
        $data = Member::where('member_status_id', config('constants.MEMBER.STATUS.APPROVE'))->get();

        if($data.isEmpty()){
            abort(500, "Tidak ada data member");
        }

        $pdf = PDF::loadView('members-pdf', $data);

        return $pdf->download('members-' . time() . '.pdf');
    }

    public function generateMember(Member $member)
    {
        if($member == null){
            abort(404, "Data member tidak ditemukan");
        }

        $fileKtp = !empty($member->file_ktp) ? Storage::get('files/member/ktp/' . $member->file_ktp) : null;
        $filePassPhoto = !empty($member->file_passport_photo) ? Storage::get('files/member/pass_photo/' . $member->file_passport_photo) : null;

        $pdf = PDF::loadView('pdf.member-pdf', [
            'member' => $member,
            'file_ktp' => $this->createBase64Image($fileKtp),
            'file_pass_photo' => $this->createBase64Image($filePassPhoto),
        ]);

        return $pdf->download('member-' . time() . '.pdf');
    }

    private function createBase64Image($imgContent)
    {
        if($imgContent == null) return '';

        return 'data:image/jpeg;base64,' . base64_encode($imgContent);
    }
}
