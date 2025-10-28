@extends('layouts.app')
@section('judulpage','Data Teman') 

@section('konten')
<div class="container">
    <h3>Data Teman</h3>

    @if(empty($dt))
        <p>Tidak ada Data</p>
    @else
    <table class="table table-hover">
    <thead>
    <tr>
        <th>ID Buku</th>
        <th>Nama Teman</th>
        <th></th>
    </tr>
    </thead>
    <tbody>
    @foreach($dt as $d)
    <tr>
        <td>{{ $d['idbuku'] }}</td>
        <td>{{ $d['namateman'] }}</td>
        <td><a class="btn btn-warning btn-sm" href="{{ route('dtteman.detail',$d['idbuku']) }}"> detail </a></td>
    </tr>
    @endforeach
    </tbody>
    </table>
    @endif

</div>
@endsection