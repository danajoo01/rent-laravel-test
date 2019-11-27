<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Film;
use Carbon\Carbon;
use Session;
use Illuminate\Support\Facades\Redirect;
use Auth;
use DB;
use Excel;
use RealRashid\SweetAlert\Facades\Alert;

class FilmController extends Controller
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
        if(Auth::user()->level == 'user') {
            Alert::info('Oopss..', 'You are prohibited from entering this area.');
            return redirect()->to('/');
        }

        $datas = Film::get();
        return view('film.index', compact('datas'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if(Auth::user()->level == 'user') {
            Alert::info('Oopss..', 'You are prohibited from entering this area.');
            return redirect()->to('/');
        }

        return view('film.create');
    }

    public function format()
    {
        $data = [['judul' => null, 'movie_id' => null, 'filmby' => null, 'studio' => null, 'tahun' => null, 'stok' => null, 'deskripsi' => null, 'lokasi' => 'rak1/rak2/rak3']];
            $fileName = 'format-film';
            

        $export = Excel::create($fileName.date('Y-m-d_H-i-s'), function($excel) use($data){
            $excel->sheet('film', function($sheet) use($data) {
                $sheet->fromArray($data);
            });
        });

        return $export->download('xlsx');
    }

    public function import(Request $request)
    {
        $this->validate($request, [
            'importFilm' => 'required'
        ]);

        if ($request->hasFile('importFilm')) {
            $path = $request->file('importFilm')->getRealPath();

            $data = Excel::load($path, function($reader){})->get();
            $a = collect($data);

            if (!empty($a) && $a->count()) {
                foreach ($a as $key => $value) {
                    $insert[] = [
                            'judul' => $value->judul, 
                            'movie_id' => $value->movie_id, 
                            'filmby' => $value->filmby, 
                            'studio' => $value->studio,
                            'tahun' => $value->tahun, 
                            'stok' => $value->stok, 
                            'deskripsi' => $value->deskripsi, 
                            'lokasi' => $value->lokasi,
                            'cover' => NULL];

                    Film::create($insert[$key]);
                        
                    }
                  
            };
        }
        alert()->success('successful.','Data has been imported!');
        return back();
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
            'judul' => 'required|string|max:255',
            'movie_id' => 'required|string'
        ]);

        if($request->file('cover')) {
            $file = $request->file('cover');
            $dt = Carbon::now();
            $acak  = $file->getClientOriginalExtension();
            $fileName = rand(11111,99999).'-'.$dt->format('Y-m-d-H-i-s').'.'.$acak; 
            $request->file('cover')->move("images/film", $fileName);
            $cover = $fileName;
        } else {
            $cover = NULL;
        }

        Film::create([
                'judul' => $request->get('judul'),
                'movie_id' => $request->get('movie_id'),
                'filmby' => $request->get('filmby'),
                'studio' => $request->get('studio'),
                'tahun' => $request->get('tahun'),
                'stok' => $request->get('stok'),
                'deskripsi' => $request->get('deskripsi'),
                'lokasi' => $request->get('lokasi'),
                'cover' => $cover
            ]);

        alert()->success('successful.','Data added!');

        return redirect()->route('film.index');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if(Auth::user()->level == 'user') {
                Alert::info('Oopss..', 'You are prohibited from entering this area.');
                return redirect()->to('/');
        }

        $data = Film::findOrFail($id);

        return view('film.show', compact('data'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {   
        if(Auth::user()->level == 'user') {
                Alert::info('Oopss..', 'You are prohibited from entering this area.');
                return redirect()->to('/');
        }

        $data = Film::findOrFail($id);
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
        if($request->file('cover')) {
            $file = $request->file('cover');
            $dt = Carbon::now();
            $acak  = $file->getClientOriginalExtension();
            $fileName = rand(11111,99999).'-'.$dt->format('Y-m-d-H-i-s').'.'.$acak; 
            $request->file('cover')->move("images/film", $fileName);
            $cover = $fileName;
        } else {
            $cover = NULL;
        }

        Film::find($id)->update([
             'judul' => $request->get('judul'),
                'movie_id' => $request->get('movie_id'),
                'filmby' => $request->get('filmby'),
                'studio' => $request->get('studio'),
                'tahun' => $request->get('tahun'),
                'stok' => $request->get('stok'),
                'deskripsi' => $request->get('deskripsi'),
                'lokasi' => $request->get('lokasi'),
                'cover' => $cover
                ]);

        alert()->success('successful.','Data has been changed!');
        return redirect()->route('film.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Film::find($id)->delete();
        alert()->success('successful.','Data has been deleted!');
        return redirect()->route('film.index');
    }
}
