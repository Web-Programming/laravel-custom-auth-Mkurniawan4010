@extends('layout.master')
@section('title', 'Halaman Prodi')

@section('content')
<div class="row pt-4">
    <div class="col">

<h2>Prodi</h2>
<div class="d-md-flax justify-content-md-end">
    <a href="{{route('prodi.create')}}" class="btn btn-primary">Tambah</a>
</div>
<table class="table table-striped table-hover">
    <thead>
        <tr>
            <th>Nama</th><th>Aksi</th>
        </tr>
        </thead>
        <tbody>
    @foreach ($allmahasiswaprodi as $item)
          <tr>
            <td>{{$item->npm}}</td><td>{{$item->nama_mahasiswa}}</td><td>{{$item->nama_prodi}}
            </td>
          </tr>
    @endforeach
          </tbody>
</table>
    </div>
</div>
@endforeach
