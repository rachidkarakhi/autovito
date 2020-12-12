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

class WelcomeController extends Controller
{
  public function index()
  {
//anonce
///selection deux payé
$listAnnance =   DB::table('annances')
 ->select(['annances.*'])
 ->take(5)
 ->get();

// $listAnnance = Annance::all();

$listImage = Image::all();
///end selection deux payé
$car_list = Voiture::all();


$cat_list = DB::table('catigories')
    ->groupBy('desCat')
    ->get();
    $listPiece = Pieace::all();
    $listImage = Image::all();


// return view('annance.create')->with('car_list', $car_list);
return view('welcome', ['listPiece' => $listPiece,'listImage' => $listImage,'car_list' => $car_list, 'cat_list' => $cat_list,'listImage' => $listImage,'listAnnance' => $listAnnance]);
  }



}
