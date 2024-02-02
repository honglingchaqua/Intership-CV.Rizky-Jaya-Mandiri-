@extends('layouts.main')
@section('container')
    {!! Session::get('dataDeleted')
        ? '<p class="fs-5 border border-success rounded-1 text-center bg-success bg-opacity-10 w-100 mb-3">' .
            Session::get('dataDeleted') .
            '</p>'
        : '' !!}
    {!! Session::get('dataEdited')
        ? '<p class="fs-5 border border-success rounded-1 text-center bg-success bg-opacity-10 w-100 mb-3">' .
            Session::get('dataEdited') .
            '</p>'
        : '' !!}
    {!! Session::get('dataError')
        ? '<p class="fs-5 border border-danger rounded-1 text-center bg-danger bg-opacity-10">' .
            Session::get('dataError') .
            '</p>'
        : '' !!}
    {!! Session::get('dataAdded')
        ? '<p class="fs-5 border border-success rounded-1 text-center bg-success bg-opacity-10">' .
            Session::get('dataAdded') .
            '</p>'
        : '' !!}
    <h1>Input Data Kayu</h1>
    <div class="row justify-content-between">
        <div class="card mb-3 overflow-auto" style="width: 55rem; max-height: 40rem; height: auto">
            <h3 class="pt-3 text-primary">Daftar Kayu</h3>
            <div class="card-body">
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">No</th>
                            @foreach ($kriteriaData as $kriteria)
                                <th scope="col">{{ $kriteria->kriteria }}</th>
                            @endforeach
                            <th scope="col">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                            $number = 0;
                        @endphp
                        @foreach ($kayuData as $kayu)
                            <tr>
                                <th scope="row">{{ $number += 1 }}</th>
                                <td>{{ $kayu->data1 }}</td>
                                <td>{{ $kayu->data2 }}</td>
                                <td>{{ $kayu->data3 }}</td>
                                <td>
                                    <!-- Button trigger modal -->
                                    <button type="button" class="btn btn-link text-warning" data-bs-toggle="modal"
                                        data-bs-target="#editData{{ $kayu->id }}"><i
                                            class="bi bi-pencil-fill"></i></button>

                                    <!-- Modal -->
                                    <div class="modal fade" id="editData{{ $kayu->id }}" data-bs-backdrop="static"
                                        data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel"
                                        aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="staticBackdropLabel">Edit data</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                        aria-label="Close"></button>
                                                </div>

                                                @php
                                                    $nomorA = 0;
                                                    $nomorB = 0;
                                                @endphp
                                                <form method="post" action="{{ route('kayu.ubah', $kayu->id) }}">
                                                    @csrf
                                                    {{ method_field('GET') }}
                                                    <div class="modal-body">
                                                        @foreach ($kriteriaData as $kriteria)
                                                            @php
                                                                $_temp = $kriteria->kriteria;
                                                            @endphp
                                                            <div class="input-group mb-3">
                                                                <span class="input-group-text" id="basic-addon1">Kriteria
                                                                    {{ $nomorA += 1 }}</span>
                                                                <select class="form-select"
                                                                    aria-label="{{ $_temp }}"
                                                                    name="data{{ $nomorB += 1 }}">
                                                                    @foreach ($bobotData->where('kriteria', $_temp) as $bobot)
                                                                        <option value="{{ $bobot->keterangan }}"
                                                                            {{ $bobot->keterangan == $kayu->{'data' . $nomorB} ? 'selected' : '' }}>
                                                                            {{ $bobot->keterangan }}</option>
                                                                    @endforeach
                                                                </select>
                                                            </div>
                                                        @endforeach
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary"
                                                            data-bs-dismiss="modal">Tutup</button>
                                                        <button type="submit" class="btn btn-primary">Simpan</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Button delete -->
                                    <form method="get" action="{{ route('kayu.remove', $kayu->id) }}"
                                        style="display:inline">
                                        @csrf
                                        @method('delete')
                                        <button type="submit" class="btn btn-link text-danger"
                                            onclick="return confirm ('Apakah anda yakin ingin menghapus data ini?')">
                                            <i class="bi bi-trash-fill"></i>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        <div class="card mb-3" style="width: 25rem; height: 25rem;">
            <h3 class="pt-3 text-primary">Input Kayu</h3>
            <div class="container">
                <form method="post" action="{{ route('kayu.tambah') }}">
                    @csrf
                    {{ method_field('GET') }}
                    @php
                        $nomor = 1;
                    @endphp
                    @foreach ($kriteriaData as $kriteria)
                        <label for="title" class="mt-3">{{ $kriteria->kriteria }}</label>
                        <div class="input-group">
                            <select class="form-select" id="data{{ $nomor }}" name="data{{ $nomor++ }}">
                                @foreach ($bobotData->where('kriteria', $kriteria->kriteria) as $bobot)
                                    <option value="{{ $bobot->keterangan }}">
                                        {{ $bobot->keterangan }}</option>
                                @endforeach
                            </select>
                        </div>
                    @endforeach
                    <button type="submit" class="btn btn-primary mt-3 mb-3 w-100">Simpan</button>
                </form>
            </div>
        </div>
    </div>
@endsection
