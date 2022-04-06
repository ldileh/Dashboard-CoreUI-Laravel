@extends('layouts.site.site-app')

@section('content')
<div class="container">

    <div class="contact-form">
        <div class="title">
            <h3>Formulir Pendaftaran Anggota </h3>
            <p>Saya yang bertandatangan dibawah ini:</p>
        </div>

        <div class="row">
            <div class="col-sm-12">
                @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            </div>
        </div>

        <form id="formRegisterAman" novalidate="true" action="{{ route('site.member.register.data') }}" enctype="multipart/form-data" method="post">
            @csrf

            <div class="row">
                <div class="col-lg-12">
                    <div class="form-group">
                        <label>Nama</label>
                        <input name="name" type="text" class="form-control" required="required" placeholder="Input Nama" value="{{ old('name') }}">
                    </div>
                </div>
                <div class="col-lg-12">
                    <div class="form-group ">
                        <label>Tempat Lahir</label>
                        <input name="birth_place" type="text" class="form-control" required="required" placeholder="Input Tempat Lahir" value="{{ old('birth_place') }}">
                    </div>
                </div>
                <div class="col-lg-12">
                    <div class="form-group ">
                        <label>Tanggal Lahir</label>
                        <input name="birth_date" type="date" class="form-control" required="required" placeholder="Input Tanggal Lahir" value="{{ old('birth_date') }}">
                    </div>
                </div>
                <div class="col-lg-12">
                    <div class="form-group ">
                        <label>Jenis Kelamin</label>
                        @foreach ($gender as $key => $value)
                        <div class="form-check">
                            <input class="form-check-input" type="radio" value="{{ $key }}" name="gender" id="gender_{{ $key }}" @if (old('gender') == $key) checked @endif>
                            <label class="form-check-label" for="gender_{{ $key }}">
                                {{ $value }}
                            </label>
                        </div>
                        @endforeach
                    </div>
                </div>
                <div class="col-lg-12">
                    <div class="form-group ">
                        <label>NIK</label>
                        <input name="nik" type="text" class="form-control" required="required" placeholder="Input NIK" value="{{ old('nik') }}">
                    </div>
                </div>
                <div class="col-lg-12">
                    <div class="form-group ">
                        <label>Pekerjaan</label>
                        <input name="profession" type="text" class="form-control" required="required" placeholder="Input Pekerjaan" value="{{ old('profession') }}">
                    </div>
                </div>
                <div class="col-lg-12">
                    <div class="form-group ">
                        <label>Komunitas Adat</label>
                        <input name="komunitas_adat" type="text" class="form-control" required="required" placeholder="Input Komunitas Adat" value="{{ old('komunitas_adat') }}">
                    </div>
                </div>
                <div class="col-lg-12">
                    <div class="form-group ">
                        <label>Alamat</label>
                        <textarea class="form-control" id="exampleFormControlTextarea1" name="address" rows="3">{{ old('address') }}</textarea>
                    </div>
                </div>
                <div class="col-lg-12">
                    <div class="form-group ">
                        <label>Nomor Telepon</label>
                        <input name="phone_number" type="tel" class="form-control" required="required" placeholder="Input Nomor HP" value="{{ old('phone_number') }}">
                    </div>
                </div>
                <div class="col-lg-12">
                    <div class="form-group ">
                        <label>Email</label>
                        <input name="email" type="email" class="form-control" required="required" placeholder="Input Email" value="{{ old('email') }}">
                    </div>
                </div>
                <div class="col-lg-12">
                    <label for="formFile" class="form-label">Foto Copy KTP</label>
                    <input class="form-control" name="file_ktp" type="file" id="formFile">
                </div>
                <div class="col-lg-12">
                    <label for="formFile" class="form-label">Pas Foto</label>
                    <input class="form-control" name="file_pass_photo" type="file" id="formFile">
                </div>
            </div>
            <br />
            <div class="col-lg-12">
                <div class="form-group">
                    <span>Bermaksud untuk menjadi anggota Koperasi</span><br/>
                    <span>Dan sebagai anggoat koperasi saya bersedia untuk menjalakna segala aturan yang tertuang dalam Anggaran Dasar, Anggaran Rumah Tangga <strong
                            style="font-style: italic;">Koperasi Produsen AMAN Mandiri</strong> dan peraturan lain yang terkait</span>
                    <br/>
                    <br/>
                    <div class="row">
                        <div class="col-xs-1">
                            <strong>NB</strong>
                        </div>
                        <div class="col-xs-11">
                            <ol>
                                <li>Lampirkan Foto Copy KTP yang masih berlaku dan Pas Photo 4x6 sebanyak 1
                                    lembar.
                                </li>
                                <li>Membayar Simpanan Pokok Rp. 200.000 dan Simpanan Wajib Rp. 25.000/bulan.</li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-12">
                <button type="submit" class="btn btn-primary">Registrasi</button>
            </div>
        </form>
    </div>
</div>
@endsection

{{-- do open new page to download  --}}
@if (session('download_pdf_member_url'))
@push('script')
<script type="text/javascript">
    $(function(){

        window.open("{{ session('download_pdf_member_url') }}", '_blank');
    });
</script>
@endpush
@endif
