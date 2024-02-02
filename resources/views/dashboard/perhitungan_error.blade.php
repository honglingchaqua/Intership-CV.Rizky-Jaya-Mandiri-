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

    @php
    $nomorA = 0;
    $nomorB = 0;
    $nomorC = 0;
    $nomorD = 0;
    $nomorE = 0;
    $nomorF = 1;

    $nC1 = [];
    $nC2 = [];
    $nC3 = [];
    $nilai = [];
    $index = 0;
    $index2 = 0;
    $ranking = [];

    @endphp

    <h2 class="text-center">Perhitungan</h2>
    <div class="position-relative">
        <div class="text-center mx-auto" style="width: auto; max-width: 35rem">

            <h5 class="card-title pt-3 fw-bold">Kriteria Bobot</h5>
            <table class="table table-bordered table-hover">
                <thead>
                    <tr class="table-secondary">
                        <th scope="col">Kriteria</th>
                        <th scope="col">Bobot</th>
                        <th scope="col"></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($kriteriaData as $kriteria)
                        <tr>
                            <td class="{{ $kriteria->tipe == 'cost' ? 'table-warning' : 'table-success' }}"><b>
                                    {{ $kriteria->kriteria . ' (C' . ($nomorB += 1) . ')' }}</b></td>
                            <td class="{{ $kriteria->tipe == 'cost' ? 'table-warning' : 'table-success' }}">
                                {{ $kriteria->bobot }}</td>
                            <td class="{{ $kriteria->tipe == 'cost' ? 'table-warning' : 'table-success' }}">
                                <b>{{ $kriteria->tipe }}</b>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

            <h5 class="card-title pt-3 fw-bold">Matrik Awal</h5>
            <table class="table table-bordered table-hover">
                <thead>
                    <tr class="table-secondary">
                        <th scope="col">No</th>
                        <th scope="col">C1</th>
                        <th scope="col">C2</th>
                        <th scope="col">C3</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($kayuData as $kayu)
                        <tr>
                            <th scope="row">{{ $nomorA += 1 }}</th>
                            <td
                                class="{{ $kriteriaData->where('kriteria', $bobotData->where('keterangan', $kayu->data1)->value('kriteria'))->value('tipe') == 'cost' ? 'table-warning' : '' }}">
                                {{ $kayu->bobot1 }}</td>
                            <td
                                class="{{ $kriteriaData->where('kriteria', $bobotData->where('keterangan', $kayu->data2)->value('kriteria'))->value('tipe') == 'cost' ? 'table-warning' : '' }}">
                                {{ $kayu->bobot2 }}</td>
                            <td
                                class="{{ $kriteriaData->where('kriteria', $bobotData->where('keterangan', $kayu->data3)->value('kriteria'))->value('tipe') == 'cost' ? 'table-warning' : '' }}">
                                {{ $kayu->bobot3 }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

            <h5 class="card-title pt-3 fw-bold">Matrik Normalisasi</h5>
            <table class="table table-bordered table-hover">
                <thead>
                    <tr class="table-secondary">
                        <th scope="col">No</th>
                        <th scope="col">C1</th>
                        <th scope="col">C2</th>
                        <th scope="col">C3</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($nC1 as $data)
                        <tr>
                            <td><b>{{ $nomorF++ }}<b></td>
                            <td>{{ $nC1[$nomorC] }}</td>
                            <td>{{ $nC2[$nomorC] }}</td>
                            <td>{{ $nC3[$nomorC++] }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

            <h5 class="card-title pt-3 fw-bold">Perhitungan Akhir</h5>
            <table class="table table-bordered table-hover">
                <thead>
                    <tr class="table-secondary">
                        <th scope="col">No</th>
                        <th scope="col">Nilai</th>
                        <th scope="col">Ranking</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($nilai as $data)
                        <tr>
                            <th scope="row" class="{{ $ranking[$nomorE] == 1 ? 'table-success' : '' }}">
                                {{ $nomorD += 1 }}</th>
                            <td class="{{ $ranking[$nomorE] == 1 ? 'table-success' : '' }}">{{ $data }}</td>
                            <td class="{{ $ranking[$nomorE] == 1 ? 'table-success' : '' }}">{{ $ranking[$nomorE++] }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
