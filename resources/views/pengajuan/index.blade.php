<h2>Data Pengajuan</h2>
<table border="1">
  <tr>
    <th>NID</th>
    <th>Nama</th>
    <th>Email</th>
    <th>Nominal</th>
    <th>Status</th>
  </tr>
  @foreach($pengajuan as $item)
  <tr>
    <td>{{ $item->nid }}</td>
    <td>{{ $item->nama }}</td>
    <td>{{ $item->email }}</td>
    <td>Rp {{ number_format($item->nominal, 0, ',', '.') }}</td>
    <td>{{ $item->status }}</td>
  </tr>
  @endforeach
</table>
