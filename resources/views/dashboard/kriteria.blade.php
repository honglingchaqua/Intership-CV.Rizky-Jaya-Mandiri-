@extends('layouts.main')
@section('container')
    <h1>Kriteria</h1>
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
            <h3 class="pt-3 text-primary">Daftar Kriteria</h3>
            <div class="card-body">
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">No</th>
                            <th scope="col">Kriteria</th>
                            <th scope="col">Tipe</th>
                            <th scope="col">Bobot</th>
                            <th scope="col">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                            $number = 0;
                        @endphp
                        @foreach ($data as $kriteria)
                            <tr>
                                <th scope="row">{{ $number += 1 }}</th>
                                <td>{{ $kriteria->kriteria }}</td>
                                <td>{{ $kriteria->tipe }}</td>
                                <td>{{ $kriteria->bobot }}</td>
                                <td>
                                    <!-- Button trigger modal -->
                                    <button type="button" class="btn btn-link text-warning" data-bs-toggle="modal"
                                        data-bs-target="#editData{{ $kriteria->id }}"><i
                                            class="bi bi-pencil-fill"></i></button>

                                    <!-- Modal -->
                                    <div class="modal fade" id="editData{{ $kriteria->id }}" tabindex="-1"
                                        data-bs-backdrop="static" data-bs-keyboard="false"
                                        aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLabel">Edit kriteria
                                                        <b>{{ $kriteria->kriteria }}</b>
                                                    </h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                        aria-label="Close"></button>
                                                </div>
                                                <form method="post" action="{{ route('kriteria.ubah', $kriteria->id) }}">
                                                    @csrf
                                                    {{ method_field('GET') }}
                                                    <div class="modal-body">
                                                        <div class="input-group mb-3">
                                                            <span class="input-group-text" id="basic-addon1">Nama
                                                                Kriteria</span>
                                                            <input type="text" class="form-control"
                                                                placeholder="Kriteria" name="kriteria" required
                                                                pattern="\S(.*\S)?" value="{{ $kriteria->kriteria }}"
                                                                aria-label="kriteria"
                                                                oninvalid="this.setCustomValidity('Format karakter tidak benar.')">
                                                            {{ Request::input('kriteria') }}
                                                        </div>
                                                        <div class="input-group mb-3">
                                                            <span class="input-group-text" id="basic-addon1">Tipe</span>
                                                            <select class="form-select" aria-label="tipe" name="tipe">
                                                                <option value="benefit"
                                                                    {{ $kriteria->tipe == 'benefit' ? 'selected' : '' }}>
                                                                    benefit
                                                                </option>
                                                                <option value="cost"
                                                                    {{ $kriteria->tipe == 'cost' ? 'selected' : '' }}>cost
                                                                </option>
                                                            </select>
                                                        </div>
                                                        <label for="bobot" class="">Bobot&nbsp;&nbsp;&nbsp;</label>
                                                        <div class="form-check form-check-inline">
                                                            <input class="form-check-input" type="radio" name="bobot"
                                                                id="bobot" value="1"
                                                                {{ $kriteria->bobot == 1 ? 'checked' : '' }}>
                                                            <label class="form-check-label" for="inlineRadio1">1</label>
                                                        </div>
                                                        <div class="form-check form-check-inline">
                                                            <input class="form-check-input" type="radio" name="bobot"
                                                                id="bobot" value="2"
                                                                {{ $kriteria->bobot == 2 ? 'checked' : '' }}>
                                                            <label class="form-check-label" for="inlineRadio2">2</label>
                                                        </div>
                                                        <div class="form-check form-check-inline">
                                                            <input class="form-check-input" type="radio" name="bobot"
                                                                id="bobot" value="3"
                                                                {{ $kriteria->bobot == 3 ? 'checked' : '' }}>
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
                                    <form method="post" action="{{ route('kriteria.destroy', $kriteria->id) }}"
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
        <div class="card mb-3" style="width: 25rem; height: 21rem;">
            <h3 class="mt-3 text-primary">Input Kriteria</h3>
            <div class="container">
                <form method="post" action="{{ route('kriteria.tambah', $kriteria) }}">
                    @csrf
                    {{ method_field('GET') }}
                    <label for="title" class="mt-3">Nama Kriteria</label>
                    <input type="text" class="form-control" placeholder="Masukkan Nama..." aria-label="kriteria"
                        id="kriteria" name="kriteria" required pattern="\S(.*\S)?"
                        oninvalid="this.setCustomValidity('Format karakter tidak benar.')">
                    <label for="title" class="mt-3">Tipe</label>
                    <div class="input-group">
                        <select class="form-select" id="tipe" name="tipe">
                            <option value="benefit" selected>benefit</option>
                            <option value="cost">cost</option>
                        </select>
                    </div>
                    <label for="bobot" class="mt-3">bobot&nbsp;&nbsp;&nbsp;</label>
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
                    <button type="submit" class="btn btn-primary mt-3 mb-3 w-100"
                        {{ $kriteria->count() >= 3 ? 'disabled' : '' }}>Simpan</button>
                </form>
            </div>
        </div>
    </div>
@endsection
