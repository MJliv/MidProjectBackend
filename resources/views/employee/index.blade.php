@extends('layout.template')
@section('konten')
<!-- START DATA -->
<div class="my-3 p-3 bg-body rounded shadow-sm">
    <!-- TOMBOL TAMBAH DATA -->
    <div class="pb-3">
        <a href='{{ url('employee/create') }}' class="btn btn-primary">+ Tambah Data</a>
    </div>

    <table class="table table-striped">
        <thead>
            <tr>
                <th class="col-md-1">No</th>
                <th class="col-md-2">Nama</th>
                <th class="col-md-1">Umur</th>
                <th class="col-md-3">Alamat</th>
                <th class="col-md-2">Nomor Telepon</th>
                <th class="col-md-2">Aksi</th>
            </tr>
        </thead>
        <tbody>
            @php($i=0)
            @foreach ($data as $item)
                <tr>
                    <td>{{ ++$i }}</td>
                    <td>{{ $item->nama }}</td>
                    <td>{{ $item->umur }}</td>
                    <td>{{ $item->alamat }}</td>
                    <td>{{ $item->mobile }}</td>
                    <td>
                        <a href='{{ url('employee/'.$item->nama.'/edit') }}' class="btn btn-warning btn-sm">Edit</a>
                        <form onsubmit="return confirm('Yakin akan menghapus data?')" class="d-inline" action="{{ url('employee/'.$item->nama) }}" method="post">
                            @csrf
                            @method('DELETE')
                            <button type="submit" name="submit" class="btn btn-danger btn-sm">
                                Del
                            </button>
                        </form>
                    </td>

                </tr>
            @endforeach
        </tbody>
    </table>
    <div class="d-flex justify-content-center">
        {{ $data->links() }}
    </div>
</div>
<!-- AKHIR DATA -->
@endsection

