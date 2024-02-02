@extends('layouts.main')
@section('container')
    @php
    try {
        $nomorA = 0;
        $nomorB = 0;
        $nomorC = 0;
        $nomorD = 0;
        $nomorE = 0;
        $nomorF = 1;

        $_bobot = [];
        $_maxC1 = $kayuData->max('bobot1');
        $_maxC2 = $kayuData->max('bobot2');
        $_maxC3 = $kayuData->max('bobot3');

        $_minC1 = $kayuData->min('bobot1');
        $_minC2 = $kayuData->min('bobot2');
        $_minC3 = $kayuData->min('bobot3');

        //normalisasi
        $nC1 = [];
        $nC2 = [];
        $nC3 = [];

        //perhitungan normalisasi
        foreach ($kayuData as $kayu) {
            if ($kriteriaData->where('kriteria', $bobotData->where('keterangan', $kayu->data1)->value('kriteria'))->value('tipe') == 'cost') {
                $_temp = $_minC1 / $kayu->bobot1;
                array_push($nC1, round($_temp, 3));
            }
            if ($kriteriaData->where('kriteria', $bobotData->where('keterangan', $kayu->data1)->value('kriteria'))->value('tipe') == 'benefit') {
                $_temp = $kayu->bobot1 / $_maxC1;
                array_push($nC1, round($_temp, 3));
            }

            if ($kriteriaData->where('kriteria', $bobotData->where('keterangan', $kayu->data2)->value('kriteria'))->value('tipe') == 'cost') {
                $_temp = $_minC2 / $kayu->bobot2;
                array_push($nC2, round($_temp, 3));
            }
            if ($kriteriaData->where('kriteria', $bobotData->where('keterangan', $kayu->data2)->value('kriteria'))->value('tipe') == 'benefit') {
                $_temp = $kayu->bobot2 / $_maxC2;
                array_push($nC2, round($_temp, 3));
            }

            if ($kriteriaData->where('kriteria', $bobotData->where('keterangan', $kayu->data3)->value('kriteria'))->value('tipe') == 'cost') {
                $_temp = $_minC3 / $kayu->bobot3;
                array_push($nC3, round($_temp, 3));
            }
            if ($kriteriaData->where('kriteria', $bobotData->where('keterangan', $kayu->data3)->value('kriteria'))->value('tipe') == 'benefit') {
                $_temp = $kayu->bobot3 / $_maxC3;
                array_push($nC3, round($_temp, 3));
            }
        }

        foreach ($kriteriaData as $kriteria) {
            array_push($_bobot, $kriteria->bobot);
        }

        //perhitungan nilai
        $nilai = [];
        $index = 0;
        $index2 = 0;
        $ranking = [];
        foreach ($kayuData as $kayu) {
            $_temp = $nC1[$index] * $_bobot[0] + $nC2[$index] * $_bobot[1] + $nC3[$index] * $_bobot[2];
            array_push($nilai, round($_temp, 2));
            $index++;
        }

        $ordered_values = $nilai;
        rsort($ordered_values);
        foreach ($nilai as $key => $value) {
            foreach ($ordered_values as $ordered_key => $ordered_value) {
                if ($value === $ordered_value) {
                    $key = $ordered_key;
                    break;
                }
            }
            array_push($ranking, (int) $key + 1);
        }

        foreach ($kayuData as $kayu) {
            $kayu->update(['nilai' => $nilai[$index2++]]);
        }
    } catch (Throwable $e) {
        return @dd('Data Kriteria belum lengkap atau data kayu dan data bobot tidak sesuai, silahkan mengkoreksi data tersebut');
    }
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
