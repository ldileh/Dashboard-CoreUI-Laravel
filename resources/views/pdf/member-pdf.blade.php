<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Member - {{ $member->name }}</title>
</head>
<body>
    <table cellspacing="0" cellpadding="4" style="border: none;">
        <tr>
            <td width="150px">Nama</td>
            <td>:</td>
            <td>{{ $member->name }}</td>
        </tr>

        <tr>
            <td width="150px">Tempat Lahir</td>
            <td>:</td>
            <td>{{ $member->birth_place }}</td>
        </tr>

        <tr>
            <td width="150px">Tanggal Lahir</td>
            <td>:</td>
            <td>{{ $member->birth_date }}</td>
        </tr>

        <tr>
            <td width="150px">Jenis Kelamin</td>
            <td>:</td>
            <td>{{ $member->genderText() }}</td>
        </tr>

        <tr>
            <td width="150px">NIK</td>
            <td>:</td>
            <td>{{ $member->nik }}</td>
        </tr>

        <tr>
            <td width="150px">Pekerjaan</td>
            <td>:</td>
            <td>{{ $member->profession }}</td>
        </tr>

        <tr>
            <td width="150px">Komunitas Adat</td>
            <td>:</td>
            <td>{{ $member->komunitas_adat }}</td>
        </tr>

        <tr>
            <td width="150px">Alamat</td>
            <td>:</td>
            <td>{{ $member->address }}</td>
        </tr>

        <tr>
            <td width="150px">Nomor Telepon</td>
            <td>:</td>
            <td>{{ $member->phone_number }}</td>
        </tr>

        <tr>
            <td width="150px">Email</td>
            <td>:</td>
            <td>{{ $member->email }}</td>
        </tr>
    </table>

    <table cellspacing="0" cellpadding="4" style="border: none; margin-top: 16px;">
        <tr>
            <td>KTP</td>
            <td>
                <img src="{{ $file_ktp }}" alt="KTP-{{ $member->name }}" style="width: 350px">
            </td>
        </tr>

        <tr>
            <td>Pass Photo</td>
            <td>
                <img src="{{ $file_pass_photo }}" alt="passport-photo-{{ $member->name }}" style="width: 350px">
            </td>
        </tr>
    </table>
</body>
</html>
