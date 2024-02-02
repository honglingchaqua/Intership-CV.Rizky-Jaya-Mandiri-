@extends('layouts.main')
@section('container')
@php
    $no = 1;
@endphp
<h2 class="text-center">Laporan</h2>
<div class="position-relative">
<div class="card mx-auto" style="width: auto; height: auto; max-width: 20rem">
    <div class="card-body justify-content-between">
        <div class="input-group mb-3">
        <span class="input-group-text" id="basic-addon1">Data Kayu</span>
        <select class="form-select" aria-label="Data Kayu" id="kayu">
            @foreach ($kayuData as $kayu)
            <option value="{{ $kayu->id }}">{{ $no++ }} | {{ $kayu->data1 }}</option>
            @endforeach
        </select>
        </div>

        @foreach ($kayuData as $kayu)
        <div class="modal fade" id="staticBackdrop{{ $kayu->id }}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title" id="staticBackdropLabel">Laporan</h5>
                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="input-group mb-3">
                        <span class="input-group-text" id="basic-addon1"><b>{{ $bobotData->where('keterangan', $kayu->data1)->value('kriteria') }}</b></span>
                        <input type="text" class="form-control" placeholder="Username" aria-label="Username" aria-describedby="basic-addon1" disabled value="{{ $kayu->data1 }}">
                      </div>
                      <div class="input-group mb-3">
                        <span class="input-group-text" id="basic-addon1"><b>{{ $bobotData->where('keterangan', $kayu->data2)->value('kriteria') }}</b></span>
                        <input type="text" class="form-control" placeholder="Username" aria-label="Username" aria-describedby="basic-addon1" disabled value="{{ $kayu->data2 }}">
                      </div>
                      <div class="input-group mb-3">
                        <span class="input-group-text" id="basic-addon1"><b>{{ $bobotData->where('keterangan', $kayu->data3)->value('kriteria') }}</b></span>
                        <input type="text" class="form-control" placeholder="Username" aria-label="Username" aria-describedby="basic-addon1" disabled value="{{ $kayu->data3 }}">
                      </div>
                      <div class="input-group mb-3">
                        <span class="input-group-text" id="basic-addon1"><b>Jumlah Nilai</b></span>
                        <input type="text" class="form-control" placeholder="Username" aria-label="Username" aria-describedby="basic-addon1" disabled value="{{ $kayu->nilai }}">
                      </div>
                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                </div>
              </div>
            </div>
          </div>
        @endforeach
        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#staticBackdrop" style="width: 18rem">
            Tampilkan
          </button>
      </div>
    </div>
  <script>
    var e = document.getElementById("kayu");
    var a = document.querySelector('[data-bs-target="#staticBackdrop"]');

    function onChange() {
    var value = e.value;
    a.dataset.bsTarget = `#staticBackdrop${value}`;
    }
    e.onchange = onChange;
    onChange();
</script>
</div>
@endsection
