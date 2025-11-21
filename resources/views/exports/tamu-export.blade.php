<table>
    <thead>
        <tr>
            <th>No</th>
            <th>Tanggal</th>
            <th>Nama</th>
            <th>No Telp</th>
            <th>Tujuan</th>
            <th>Sub Tujuan</th>
        </tr>
    </thead>
    <tbody>
        @foreach($tamus as $tamu)
        <tr>
            <td>{{ $loop->iteration }}</td>
            <td>{{ $tamu->tanggal_berkunjung }}</td>
            <td>{{ $tamu->nama }}</td>
            <td>{{ $tamu->no_telp }}</td>
            <td>{{ $tamu->tujuan }}</td>
            <td>{{ $tamu->sub_tujuan }}</td>
        </tr>
        @endforeach
    </tbody>
</table>
