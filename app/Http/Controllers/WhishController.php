<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Whish;
use App\Annance;
use Auth;
class WhishController extends Controller
{
  public function addwish(Request $request)  {
    if($user = Auth::user())
    {
                $Cwhishs= DB::table('whishs')->where('whishs.user_id', Auth::user()->id)
                ->where('whishs.annance_numAnnance', $request->numAnnance)
                ->count();
              if ($Cwhishs==0) {
                    DB::table('whishs')->insert(
                    ['user_id' => Auth::user()->id, 'annance_numAnnance' => $request->numAnnance]
                );
              }
              $etat=true;

    }else {
      $etat=false;
    }


     return Response()->json(['etat'=>$etat]);
  }

  public function getwish(){

    $whishs =   DB::table('annances')
     ->select(['annances.numAnnance','annances.prix','annances.created_at','voitures.marque','pieaces.desPieace','whishs.id'])
     ->join('pieaces', 'pieaces.idPieace', '=', 'annances.pieace_idPieace')
     ->join('voitures', 'voitures.idVoiture', '=', 'annances.voiture_idVoiture')
     ->join('whishs', 'whishs.annance_numAnnance', '=', 'annances.numAnnance')
     ->where('whishs.user_id', Auth::user()->id)
     ->get();



     // $whishs =   DB::table('whishs')
     //  ->select(['annances.numAnnance','annances.prix','annances.created_at','voitures.marque','pieaces.desPieace','whishs.id'])
     //  ->join('pieaces', 'pieaces.idPieace', '=', 'annances.pieace_idPieace')
     //  ->join('voitures', 'voitures.idVoiture', '=', 'annances.voiture_idVoiture')
     //  ->join('annances', 'annances.numAnnance', '=', 'annances.numAnnance')
     //  ->where('whishs.user_id', Auth::user()->id)
     //  ->get();

    return Response()->json(['whishs'=>$whishs]);
  }
  public function deletewish($id){



    DB::table('whishs')->where('id', '=', $id)->delete();


   return Response()->json(['etat'=>true,"id"=>$id]);
  }

}
