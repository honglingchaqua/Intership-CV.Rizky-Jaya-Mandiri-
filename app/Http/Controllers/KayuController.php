<?php

namespace App\Http\Controllers;

use App\Models\Bobot;
use App\Models\Kayu;
use App\Models\Kriteria;
use App\Http\Requests\StoreKayuRequest;
use App\Http\Requests\UpdateKayuRequest;

class KayuController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('dashboard.kayu', [
            'bobotData' => Bobot::all(),
            'kayuData' => Kayu::all(),
            'kriteriaData' => Kriteria::all(),
            'title' => 'Input Kayu'
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreKayuRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreKayuRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Kayu  $kayu
     * @return \Illuminate\Http\Response
     */
    public function show(Kayu $kayu)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Kayu  $kayu
     * @return \Illuminate\Http\Response
     */
    public function edit($id, StoreKayuRequest $request)
    {
        $data = Kayu::find($id);
        if (Kayu::where('data1', $request['data1'])->where('data2', $request['data2'])->where('data3', $request['data3'])->count() >= 1 && Kayu::where('data1', $request['data1'])->where('data2', $request['data2'])->where('data3', $request['data3'])->value('id') != $id) return back()->with('dataError', 'Data yang sama sudah ada di database');;
        $bobot = new Bobot();
        $getBobot1 = $bobot->where('keterangan', $request['data1'])->value('bobot');
        $getBobot2 = $bobot->where('keterangan', $request['data2'])->value('bobot');
        $getBobot3 = $bobot->where('keterangan', $request['data3'])->value('bobot');
        $data->update(['data1' => $request['data1'], 'data2' => $request['data2'], 'data3' => $request['data3'], 'bobot1' => $getBobot1, 'bobot2' => $getBobot2, 'bobot3' => $getBobot3]);
        return back()->with('dataEdited', 'Data kayu berhasil diedit');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateKayuRequest  $request
     * @param  \App\Models\Kayu  $kayu
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateKayuRequest $request, Kayu $kayu)
    {
        //
    }

    public function tambah(StoreKayuRequest $request)
    {
        $requestData = $request->all();
        $requestCount = count($requestData) - 2;

        if ($request['data1'] == null || $request['data2'] == null || $request['data3'] == null) return back()->with('dataError', 'Data kayu belum lengkap, silahkan tambah data melalui menu input bobot');
        if (Kayu::where('data1', $request['data1'])->where('data2', $request['data2'])->where('data3', $request['data3'])->count() >= 1) return back()->with('dataError', 'Data sudah ada di database');

        $bobot = new Bobot();
        $getBobot1 = $bobot->where('keterangan', $request['data1'])->value('bobot');
        $getBobot2 = $bobot->where('keterangan', $request['data2'])->value('bobot');
        $getBobot3 = $bobot->where('keterangan', $request['data3'])->value('bobot');

        $kayu = new Kayu();
        $kayu->bobot1 = $getBobot1;
        $kayu->bobot2 = $getBobot2;
        $kayu->bobot3 = $getBobot3;
        for ($i = 1; $i <= $requestCount; $i++) {
            $kayu->{'data' . $i} = $request['data' . $i];
        }
        $kayu->save();

        return back()->with('dataAdded', 'Data kayu berhasil ditambah');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Kayu  $kayu
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $data = Kayu::find($id);
        $data->delete();
        return back()->with('dataDeleted', 'Data kayu berhasil dihapus');
    }
}
