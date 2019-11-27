<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Film;
use App\Anggota;
use App\Transaksi;
use Carbon\Carbon;
use Session;
use Illuminate\Support\Facades\Redirect;
use Auth;
use DB;
use RealRashid\SweetAlert\Facades\Alert;

class TransaksiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        if(Auth::user()->level == 'user')
        {
            $datas = Transaksi::where('anggota_id', Auth::user()->anggota->id)
                                ->get();
        } else {
            $datas = Transaksi::get();
        }
        return view('transaksi.index', compact('datas'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        
        $getRow = Transaksi::orderBy('id', 'DESC')->get();
        $rowCount = $getRow->count();
        
        $lastId = $getRow->first();

        $kode = "TR00001";
        
        if ($rowCount > 0) {
            if ($lastId->id < 9) {
                    $kode = "TR0000".''.($lastId->id + 1);
            } else if ($lastId->id < 99) {
                    $kode = "TR000".''.($lastId->id + 1);
            } else if ($lastId->id < 999) {
                    $kode = "TR00".''.($lastId->id + 1);
            } else if ($lastId->id < 9999) {
                    $kode = "TR0".''.($lastId->id + 1);
            } else {
                    $kode = "TR".''.($lastId->id + 1);
            }
        }

        $films = Film::where('stok', '>', 0)->get();
        $anggotas = Anggota::get();
        return view('transaksi.create', compact('films', 'kode', 'anggotas'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'kode_transaksi' => 'required|string|max:255',
            'tgl_pinjam' => 'required',
            'tgl_kembali' => 'required',
            'film_id' => 'required',
            'anggota_id' => 'required',

        ]);

        $transaksi = Transaksi::create([
                'kode_transaksi' => $request->get('kode_transaksi'),
                'tgl_pinjam' => $request->get('tgl_pinjam'),
                'tgl_kembali' => $request->get('tgl_kembali'),
                'film_id' => $request->get('film_id'),
                'anggota_id' => $request->get('anggota_id'),
                'ket' => $request->get('ket'),
                'status' => 'pinjam'
            ]);

        $transaksi->film->where('id', $transaksi->film_id)
                        ->update([
                            'stok' => ($transaksi->film->stok - 1),
                            ]);

        alert()->success('successful.','Data added!');
        return redirect()->route('transaksi.index');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

        $data = Transaksi::findOrFail($id);


        if((Auth::user()->level == 'user') && (Auth::user()->anggota->id != $data->anggota_id)) {
                Alert::info('Oopss..', 'You are prohibited from entering this area.');
                return redirect()->to('/');
        }


        return view('transaksi.show', compact('data'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {   
        $data = Transaksi::findOrFail($id);

        if((Auth::user()->level == 'user') && (Auth::user()->anggota->id != $data->anggota_id)) {
                Alert::info('Oopss..', 'You are prohibited from entering this area.');
                return redirect()->to('/');
        }

        return view('film.edit', compact('data'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $transaksi = Transaksi::find($id);

        $transaksi->update([
                'status' => 'kembali'
                ]);

        $transaksi->film->where('id', $transaksi->film->id)
                        ->update([
                            'stok' => ($transaksi->film->stok + 1),
                            ]);

        alert()->success('successful.','Data has been changed!');
        return redirect()->route('transaksi.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Transaksi::find($id)->delete();
        alert()->success('successful.','Data has been deleted!');
        return redirect()->route('transaksi.index');
    }
}
