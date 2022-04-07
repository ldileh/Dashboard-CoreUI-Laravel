<html>
    <head>
        <title>Mebers import</title>

        <style>
            table, th, td {
              border: 1px solid black;
              border-collapse: collapse;
            }

            h2, h3{
              margin: 0;
            }

            .box-header{
              display: inline-flex;
              border-bottom: 0.5px solid black;
              margin-bottom: 16px;
              width: 100%;
            }

            .box-header img {
              height: 80px;
              position: relative;
            }

            .box-header .box-title{
              display: -webkit-inline-flex;
              -webkit-box-orient: vertical;
              -webkit-box-direction: normal;
              -webkit-flex-direction: column;
              -webkit-box-pack: center;
              -webkit-flex-pack: center;
              -webkit-justify-content: center;
              -webkit-flex-align: center;
              vertical-align: top;
              margin-left: 8px;
            }
          </style>
    </head>

    <body>
        <div class="box-header">
            {{-- <img src="{{ asset('img/icon.png') }}" alt="Logo"> --}}

            <div class="box-title">
              <h2>KOPERASI PRODUSEN AMAN MANDIRI (KPAM)</h2>
              <h3>DATA MEMBER</h3>
            </div>
          </div>

        <table cellspacing="0" cellpadding="8" style="width: 100%;">
            <thead>
                <tr>
                    <th width="10px">No.</th>
                    <th width="150px">Nama</th>
                    <th width="150px">Tempat Lahir</th>
                    <th width="150px">Tanggal Lahir</th>
                    <th width="100px">Jenis Kelamin</th>
                    <th>NIK</th>
                    <th>Profesi</th>
                    <th>Komunitas Adat</th>
                    <th width="150px">Alamat</th>
                    <th>Nomor Telepon</th>
                    <th>Email</th>
                </tr>
            </thead>

            <tbody>
                @for ($i = 0; $i < $data->count(); $i++)
                @php
                    $item = $data[$i];
                @endphp
                <tr>
                    <th>{{ $i + 1 }}</th>
                    <th>{{ $item->name }}</th>
                    <th>{{ $item->birth_place }}</th>
                    <th>{{ \Carbon\Carbon::parse($item->birth_date)->format(config('constants.DATE.DATE_FORMAL')) }}</th>
                    <th>{{ $item->gender == 'm' ? 'Laki-laki' : 'Perempuan' }}</th>
                    <th>{{ $item->nik }}</th>
                    <th>{{ $item->profession }}</th>
                    <th>{{ $item->komunitas_adat }}</th>
                    <th>{{ $item->address }}</th>
                    <th>{{ $item->phone_number }}</th>
                    <th>{{ $item->email }}</th>
                </tr>
                @endfor
            </tbody>
        </table>
    </body>
</html>
