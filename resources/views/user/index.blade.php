<h2>Data Users</h2>
<table border="1">
  <tr>
    <th>Nama Lengkap</th>
    <th>Email</th>
    <th>Alamat</th>
    <th>Aksi</th>
  </tr>
  @foreach($users as $user)
  <tr>
    <td>{{ $user->fullname }}</td>
    <td>{{ $user->email }}</td>
    <td>{{ $user->address }}</td>
    <td>
      <form method="POST" action="{{ url('/user/delete/'.$user->id) }}">
        @csrf
        @method('DELETE')
        <button type="submit">Hapus</button>
      </form>
    </td>
  </tr>
  @endforeach
</table>
