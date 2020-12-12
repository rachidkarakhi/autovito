<?php

namespace App\Providers;
use Auth;
use DB;
use App\Voiture;
use App\Pieace;
use App\Catigorie;
use App\SousCategorie;
use View;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
      //dzd

        View::composer('layouts.app', function ($view) {
           $Cwhishs=0;
          if ($user = Auth::user()) {

             $whishs =   DB::table('annances')
              ->select(['annances.numAnnance','annances.prix','annances.created_at','voitures.marque','pieaces.desPieace','whishs.id'])
              ->join('pieaces', 'pieaces.idPieace', '=', 'annances.pieace_idPieace')
              ->join('voitures', 'voitures.idVoiture', '=', 'annances.voiture_idVoiture')
              ->join('whishs', 'whishs.annance_numAnnance', '=', 'annances.numAnnance')
              ->where('whishs.user_id', Auth::user()->id)
              ->offset(0)
                ->limit(2)
              ->get();

             $Cwhishs= DB::table('whishs')->where('whishs.user_id', Auth::user()->id)->count();
          }else {
            $whishs = array();
          }


            $listSousCatego = DB::table('souscategories')->get();
            $listCatego = Catigorie::all();

            $direction = DB::table('souscategories')
                ->where('catigorie_idCat', 2)->get();

            $frienage = DB::table('souscategories')
                ->where('catigorie_idCat', 1)->get();

            $pmoteur = DB::table('souscategories')
                ->where('catigorie_idCat', 5)->get();

            $visibilite = DB::table('souscategories')
                ->where('catigorie_idCat', 9)->get();

            $view->with(['Cwhishs' =>$Cwhishs,'whishs' =>$whishs,'cats' =>$listCatego,'scats' =>$listSousCatego,'direction_list' => $direction, 'frienage_list' => $frienage, 'pmoteur_list' => $pmoteur, 'visibilite_list' => $visibilite]);
        });
    }
}
