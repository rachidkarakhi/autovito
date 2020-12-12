<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use DB;

use App\Imagec;
use App\Annoncec;
use App\Ville;
use App\Annance;
use App\Image;
use Auth;
use App\Voiture;
use App\Pieace;
use App\Catigorie;
use App\SousCategorie;
use Session;

class AnnoncecController extends Controller
{
  public function store(Request $request)
  {













      $annance = new Annoncec();

      $annance->descMin = $request->input('descMin');
      $annance->descMax = $request->input('descMax');
      $annance->prix = $request->input('prix');
      $annance->telephone = $request->input('Téléphone');
      $annance->nom = $request->input('Nom');
      $annance->user_id   = Auth::user()->id;
      $annance->ville_idVille = $request->input('idville');
      $annance->voiture_idVoiture = 1;


      $annance->save();
      $maxID = DB::table('annoncecs')->max('id');


      foreach ($request->imamges as $file) {
          $photo = new Imagec();

          $photo->nameImage = $file->store('images', ['disk' => 'public']);
          $photo->annoncecs_id = $maxID;
          $photo->save();
      }

      Session::flash('message', 'Votre annonce a été bien publié');

      return redirect('annonces/create');
  }

}
