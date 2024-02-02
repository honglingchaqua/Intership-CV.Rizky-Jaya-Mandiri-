<?php

namespace App\Http\Controllers;

use App\Models\Bobot;
use App\Models\Kriteria;
use App\Http\Requests\StoreBobotRequest;
use App\Http\Requests\UpdateBobotRequest;

class BobotController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('dashboard.bobot', [
            'bobotData' => Bobot::all(),
            'kriteriaData' => Kriteria::all(),
            'title' => 'Input Bobot'
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
     * @param  \App\Http\Requests\StoreBobotRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreBobotRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Bobot  $bobot
     * @return \Illuminate\Http\Response
     */
    public function show(Bobot $bobot)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Bobot  $bobot
     * @return \Illuminate\Http\Response
     */
    public function edit($id, StoreBobotRequest $request)
    {
        $data = Bobot::find($id);
        $bobot = new Bobot;
        if (Bobot::where('keterangan', $request['keterangan'])->count() >= 1 && Bobot::where('keterangan', $request['keterangan'])->value('id') != $id) return back()->with('dataError', 'Data bobot sudah ada di database');

        if (Bobot::where('keterangan', $request['keterangan'])->where('bobot', $request['bobot'])->where('kriteria', $request['kriteria'])->count() >= 1 && Bobot::where('keterangan', $request['keterangan'])->where('bobot', $request['bobot'])->where('kriteria', $request['kriteria'])->value('id') != $id) return back()->with('dataError', 'Data bobot sudah ada di database');

        $data->update(['keterangan' => $request['keterangan'], 'bobot' => $request['bobot'], 'kriteria' => $request['kriteria']]);
        return back()->with('dataEdited', 'Data berhasil diedit');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateBobotRequest  $request
     * @param  \App\Models\Bobot  $bobot
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateBobotRequest $request, Bobot $bobot)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Bobot  $bobot
     * @return \Illuminate\Http\Response
     */

    public function tambah(StoreBobotRequest $request)
    {
        $bobot = new Bobot;
        if ($request['kriteria'] == null) return back()->with('dataError', 'Kriteria belum ada, silahkan tambah kriteria terlebih dahulu');
        if ($bobot->where('keterangan', $request['keterangan'])->count() >= 1) return back()->with('dataError', 'Data bobot sudah ada di database');
        $bobot->keterangan = $request['keterangan'];
        $bobot->kriteria = $request['kriteria'];
        $bobot->bobot = $request['bobot'];
        $bobot->save();

        return back()->with('dataAdded', 'data bobot berhasil ditambah');
    }

    public function destroy($id)
    {
        $data = Bobot::find($id);
        $data->delete();
        return back()->with('dataDeleted', 'data bobot berhasil dihapus');
    }
}
