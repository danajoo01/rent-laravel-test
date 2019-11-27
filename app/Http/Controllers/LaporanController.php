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
use Excel;
use PDF;
use RealRashid\SweetAlert\Facades\Alert;

class LaporanController extends Controller
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

    public function film()
    {
        return view('laporan.film');
    }

    public function filmPdf()
    {

        $datas = Film::all();
        $pdf = PDF::loadView('laporan.film_pdf', compact('datas'));
        return $pdf->download('laporan_film_'.date('Y-m-d_H-i-s').'.pdf');
    }

    public function filmExcel(Request $request)
    {
        $nama = 'laporan_film_'.date('Y-m-d_H-i-s');
        Excel::create($nama, function ($excel) use ($request) {
        $excel->sheet('Movie Data Report', function ($sheet) use ($request) {
        
        $sheet->mergeCells('A1:H1');

       // $sheet->setAllBorders('thin');
        $sheet->row(1, function ($row) {
            $row->setFontFamily('Calibri');
            $row->setFontSize(11);
            $row->setAlignment('center');
            $row->setFontWeight('bold');
        });

        $sheet->row(1, array('Movie Data Report'));

        $sheet->row(2, function ($row) {
            $row->setFontFamily('Calibri');
            $row->setFontSize(11);
            $row->setFontWeight('bold');
        });

        $datas = Film::all();

       // $sheet->appendRow(array_keys($datas[0]));
        $sheet->row($sheet->getHighestRow(), function ($row) {
            $row->setFontWeight('bold');
        });

         $datasheet = array();
         $datasheet[0]  =   array("NO", "TITLE", "ID MOVIE", "Film By",  "Studio","Date Realase","Stock", "Stack");
         $i=1;

        foreach ($datas as $data) {

           // $sheet->appendrow($data);
          $datasheet[$i] = array($i,
                        $data['judul'],
                        $data['movie_id'],
                        $data['filmby'],
                        $data['studio'],
                        $data['tahun'],
                        $data['stok'],
                        $data['lokasi']
                    );
          
          $i++;
        }

        $sheet->fromArray($datasheet);
    });

})->export('xls');

}


public function transaksi()
    {

        return view('laporan.transaksi');
    }


    public function transaksiPdf(Request $request)
    {
        $q = Transaksi::query();

        if($request->get('status')) 
        {
             if($request->get('status') == 'pinjam') {
                $q->where('status', 'pinjam');
            } else {
                $q->where('status', 'kembali');
            }
        }

        if(Auth::user()->level == 'user')
        {
            $q->where('anggota_id', Auth::user()->anggota->id);
        }

        $datas = $q->get();

       // return view('laporan.transaksi_pdf', compact('datas'));
       $pdf = PDF::loadView('laporan.transaksi_pdf', compact('datas'));
       return $pdf->download('laporan_transaksi_'.date('Y-m-d_H-i-s').'.pdf');
    }


public function transaksiExcel(Request $request)
    {
        $nama = 'laporan_transaksi_'.date('Y-m-d_H-i-s');
        Excel::create($nama, function ($excel) use ($request) {
        $excel->sheet('Transaction Data Report', function ($sheet) use ($request) {
        
        $sheet->mergeCells('A1:H1');

       // $sheet->setAllBorders('thin');
        $sheet->row(1, function ($row) {
            $row->setFontFamily('Calibri');
            $row->setFontSize(11);
            $row->setAlignment('center');
            $row->setFontWeight('bold');
        });

        $sheet->row(1, array('Transaction Data Report'));

        $sheet->row(2, function ($row) {
            $row->setFontFamily('Calibri');
            $row->setFontSize(11);
            $row->setFontWeight('bold');
        });

        $q = Transaksi::query();

        if($request->get('status')) 
        {
             if($request->get('status') == 'pinjam') {
                $q->where('status', 'pinjam');
            } else {
                $q->where('status', 'kembali');
            }
        }

        if(Auth::user()->level == 'user')
        {
            $q->where('anggota_id', Auth::user()->anggota->id);
        }

        $datas = $q->get();

       // $sheet->appendRow(array_keys($datas[0]));
        $sheet->row($sheet->getHighestRow(), function ($row) {
            $row->setFontWeight('bold');
        });

         $datasheet = array();
         $datasheet[0]  =   array("NO", "KODE TRANSAKSI", "TITLE", "Name",  "Arrival Date","Return Date","STATUS", "KET");
         $i=1;

        foreach ($datas as $data) {

           // $sheet->appendrow($data);
          $datasheet[$i] = array($i,
                        $data['kode_transaksi'],
                        $data->film->judul,
                        $data->anggota->nama,
                        date('d/m/y', strtotime($data['tgl_pinjam'])),
                        date('d/m/y', strtotime($data['tgl_kembali'])),
                        $data['status'],
                        $data['ket']
                    );
          
          $i++;
        }

        $sheet->fromArray($datasheet);
    });

})->export('xls');

}
}
