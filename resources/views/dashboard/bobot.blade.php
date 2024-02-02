@extends('layouts.main')
@section('container')
    <h1>Input Bobot</h1>
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
    <div class="row justify-content-between">
        <div class="card mb-3 overflow-auto" style="width: 55rem; max-height: 40rem; height: auto">
            <h3 class="pt-3 text-primary">Daftar Bobot</h3>
            <div class="card-body">
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">No</th>
                            <th scope="col">Keterangan</th>
                            <th scope="col">Kriteria</th>
                            <th scope="col">Bobot</th>
                            <th scope="col">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                            $number = 0;
                        @endphp
                        @foreach ($bobotData as $bobot)
                            <tr>
                                <th scope="row">{{ $number += 1 }}</th>
                                <td>{{ $bobot['keterangan'] }}</td>
                                <td>{{ $bobot['kriteria'] }}</td>
                                <td>{{ $bobot['bobot'] }}</td>
                                <td>
                                    <!-- Button trigger modal -->
                                    <button type="button" class="btn btn-link text-warning" data-bs-toggle="modal"
                                        data-bs-target="#editData{{ $bobot->id }}"><i
                                            class="bi bi-pencil-fill"></i></button>

                                    <!-- Modal -->
                                    <div class="modal fade" id="editData{{ $bobot->id }}" tabindex="-1"
                                        data-bs-backdrop="static" data-bs-keyboard="false"
                                        aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLabel">Edit data
                                                    </h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                        aria-label="Close"></button>
                                                </div>
                                                <form method="post" action="{{ route('bobot.ubah', $bobot->id) }}">
                                                    @csrf
                                                    {{ method_field('GET') }}
                                                    <div class="modal-body">
                                                        <div class="input-group mb-3">
                                                            <span class="input-group-text"
                                                                id="basic-addon1">Keterangan</span>
                                                            <input type="text" class="form-control"
                                                                placeholder="Keterangan" name="keterangan" required
                                                                pattern="\S(.*\S)?" value="{{ $bobot->keterangan }}"
                                                                aria-label="kriteria"
                                                                oninvalid="this.setCustomValidity('Format karakter tidak benar.')">
                                                        </div>
                                                        <div class="input-group mb-3">
                                                            <span class="input-group-text" id="basic-addon1">Kriteria</span>
                                                            <select class="form-select" aria-label="Kriteria"
                                                                name="kriteria">
                                                                @foreach ($kriteriaData as $kriteriaList)
                                                                    <option value="{!! $kriteriaList['kriteria'] !!}"
                                                                        {{ $bobot->kriteria == $kriteriaList['kriteria'] ? 'selected' : '' }}>
                                                                        {{ $kriteriaList['kriteria'] }}</option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                        <label for="bobot" class="">Bobot&nbsp;&nbsp;&nbsp;</label>
                                                        <div class="form-check form-check-inline">
                                                            <input class="form-check-input" type="radio" name="bobot"
                                                                id="bobot" value="1"
                                                                {{ $bobot->bobot == 1 ? 'checked' : '' }}>
                                                            <label class="form-check-label" for="inlineRadio1">1</label>
                                                        </div>
                                                        <div class="form-check form-check-inline">
                                                            <input class="form-check-input" type="radio" name="bobot"
                                                                id="bobot" value="2"
                                                                {{ $bobot->bobot == 2 ? 'checked' : '' }}>
                                                            <label class="form-check-label" for="inlineRadio2">2</label>
                                                        </div>
                                                        <div class="form-check form-check-inline">
                                                            <input class="form-check-input" type="radio" name="bobot"
                                                                id="bobot" value="3"
                                                                {{ $bobot->bobot == 3 ? 'checked' : '' }}>
                                                            <label class="form-check-label" for="inlineRadio3">3</label>
                                                        </div>
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

                                    <!-- Button hapus -->
                                    <form method="get" action="{{ route('bobot.remove', $bobot->id) }}"
                                        style="display:inline">
                                        @csrf
                                        @method('delete')
                                        <button type="submit" class="btn btn-link text-danger"
                                            onclick="return confirm ('Apakah anda yakin ingin menghapus data ini?')"><i
                                                class="bi bi-trash-fill"></i></button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        <div class="card mb-3" style="width: 25rem; height: 22rem;">
            <h3 class="mt-3 text-primary">Input Bobot</h3>
            <div class="container">
                <form method="post" action="{{ route('bobot.tambah') }}">
                    @csrf
                    {{ method_field('GET') }}
                    <label for="title" class="mt-3">Keterangan</label>
                    <input type="text" class="form-control" placeholder="Masukkan Keterangan..."
                        aria-label="keterangan" id="keterangan" name="keterangan" required pattern="\S(.*\S)?"
                        oninvalid="this.setCustomValidity('Format karakter tidak benar.')">
                    <label for="title" class="mt-3">Kriteria</label>
                    <div class="input-group mb-3">
                        <select class="form-select" id="kriteria" name="kriteria">
                            @foreach ($kriteriaData as $kriteriaList)
                                <option value="{!! $kriteriaList['kriteria'] !!}">{{ $kriteriaList['kriteria'] }}</option>
                            @endforeach
                        </select>
                    </div>
                    <label for="bobot" class="">bobot&nbsp;&nbsp;&nbsp;</label>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="bobot" id="bobot" value="1"
                            checked>
                        <label class="form-check-label" for="inlineRadio1">1</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="bobot" id="bobot" value="2">
                        <label class="form-check-label" for="inlineRadio2">2</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="bobot" id="bobot" value="3">
                        <label class="form-check-label" for="inlineRadio3">3</label>
                    </div>
                    <button type="submit" class="btn btn-primary mt-3 mb-3 w-100">Simpan</button>
                </form>
            </div>
        </div>
    </div>
@endsection
