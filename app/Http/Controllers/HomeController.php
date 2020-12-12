<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Annance;
use App\Image;
use Auth;
use App\Voiture;
use App\Pieace;
use App\Catigorie;
use App\SousCategorie;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $listAnnance = Annance::all();
        $listVoiture = Voiture::all();
        $listPiece = Pieace::all();
        $listImage = Image::all();
        $listSousCatego = DB::table('souscategories')->get();
        $listCatego = Catigorie::all();




        return view('home', ['listSousCatego' => $listSousCatego, 'listCatego' => $listCatego, 'listAnnance' => $listAnnance, 'listVoiture' => $listVoiture, 'listPiece' => $listPiece, 'listImage' => $listImage]);
    }
}
