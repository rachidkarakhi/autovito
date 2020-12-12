<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Ville;
use App\Annance;
use App\Image;
use Auth;
use App\Voiture;
use App\Pieace;
use App\Catigorie;
use App\SousCategorie;
use Session;

class AnnanceController extends Controller
{

    public function __construct()
    {
















$this->middleware('auth', ['except' => ['getscat','getAnnonce','getpiece','getModule','getid','getidc','index', 'indexbycat', 'getpiecef','getscategorie','getmotorisationf','getmodulef','filtrer','getfac','getAnnonceindex','show','getMot','getidville']]);
 }


public function getAnnonceD($num){
  return view('dashboard.edit',compact('num'));

}

public function getannonceForEdite($num){
  $annances =   DB::table('annances')
   ->select(['annances.numAnnance','annances.prix','annances.nom','annances.commentaire','annances.user_id','annances.telephone','voitures.marque','voitures.idVoiture','voitures.module','voitures.motorisation','pieaces.desPieace','pieaces.idPieace','souscategories.desSousCat','catigories.desCat','annances.approve','annances.updated_at','annances.created_at'])
   ->join('pieaces', 'pieaces.idPieace', '=', 'annances.pieace_idPieace')
   ->join('voitures', 'voitures.idVoiture', '=', 'annances.voiture_idVoiture')
   ->join('souscategories', 'souscategories.idSousCat', '=', 'pieaces.sousCategorie_idSousCat')
   ->join('catigories', 'catigories.idCat', '=', 'souscategories.catigorie_idCat')

   ->where('numAnnance', $num)
   ->first();
   $listImage = Image::select()->where('annance_numAnnance', $num)->get();

  return Response()->json(['annances'=>$annances,'image'=>$listImage]);

}




    public function index()
    {


        $listAnnance = Annance::all();
        $listVoiture = Voiture::all();
        $listPiece = Pieace::all();
        $listImage = Image::all();
        $listSousCatego = DB::table('souscategories')->get();
        $listCatego = Catigorie::all();
        $car_list = DB::table('voitures')
            ->groupBy('marque')
            ->get();
        $cat_list = DB::table('catigories')
            ->groupBy('desCat')
            ->get();



        return view('annance.index', ['car_list' => $car_list, 'cat_list' => $cat_list, 'listSousCatego' => $listSousCatego, 'listCatego' => $listCatego, 'listAnnance' => $listAnnance, 'listVoiture' => $listVoiture, 'listPiece' => $listPiece, 'listImage' => $listImage]);
    }
    public function indexbycat($cat,$scat)
    {


        $listAnnance = Annance::all();
        $listVoiture = Voiture::all();
        $listPiece = Pieace::all();
        $listImage = Image::all();
        $listSousCatego = DB::table('souscategories')->get();
        $listCatego = Catigorie::all();
        $car_list = DB::table('voitures')
            ->groupBy('marque')
            ->get();
        $cat_list = DB::table('catigories')
            ->groupBy('desCat')
            ->get();



        return view('annance.indexbycat',compact('scat'),compact('cat'), ['car_list' => $car_list, 'cat_list' => $cat_list, 'listSousCatego' => $listSousCatego, 'listCatego' => $listCatego, 'listAnnance' => $listAnnance, 'listVoiture' => $listVoiture, 'listPiece' => $listPiece, 'listImage' => $listImage]);
    }


    public function create()
    {


        $car_list = DB::table('voitures')
            ->groupBy('marque')
            ->get();
        $cat_list = DB::table('catigories')
            ->groupBy('desCat')
            ->get();


        // return view('annance.create')->with('car_list', $car_list);
        return view('annance.create', ['car_list' => $car_list, 'cat_list' => $cat_list]);
    }





public function store(Request $request)
{
    // "marque":"Alfa romeo","modu le":"146  04.99 jusqu'en 10.2001","motorisation":"1.4" ,"cate gorie":"9"," sous Categories":"55", "piece":"1092 ","prix ":"12", "Desc ription":"sa", "imag ":["201 9-01-27 (1).png","2019 -01-27 (2).png","2019 -01-27 (3).png"]}
    $annance = new Annance();
    $photo = new Image();
    $annance->commentaire = $request->input('Description');
    $annance->prix = $request->input('prix');
    $annance->nom = $request->input('Nom');
    $annance->telephone = $request->input('Téléphone');
    $annance->pieace_idPieace = $request->input('id_piece');
    $annance->user_id   = Auth::user()->id;
    $annance->voiture_idVoiture = $request->input('id_car');
    $annance->ville_idVille = $request->input('id_ville');


    $annance->save();
    $maxID = DB::table('annances')->max('numAnnance');


    foreach ($request->images as $file) {
        $photo = new Image();

        $photo->nameImage = $file->store('images', ['disk' => 'public']);
        $photo->annance_numAnnance = $maxID;
        $photo->save();
    }

    Session::flash('message', 'Votre annonce a été bien publié');

    return redirect('annonces/create');
}




    public function edit($id){




      $annonce = Annance::where('numAnnance', $id)->first();

    $this->authorize('update',$annonce);

      $listImage = Image::select()->where('annance_numAnnance', $id)->get();
      return view('annance.edit',compact('id'),['listImage' => $listImage]);
    }
    public function updateAnnonce(Request $request){
    $id=$request->numAnnance;
    $annonce = Annance::where('numAnnance', $id);
      $annonce->update(['commentaire' => $request->commentaire, 'nom' => $request->nom, 'pieace_idPieace' => $request->idPieace, 'prix' => $request->prix, 'telephone' => $request->telephone, 'voiture_idVoiture' => $request->idVoiture]);

 return Response()->json(['etat'=>true]);
    }

    public function  getidc($id,$id2,$id3){
      $annances =   DB::table('voitures')
      ->where([
         ['marque', '=', $id],['module', '=', $id2],  ['motorisation', '=', $id3]
         ])
      ->get();



  return $annances;
    }
    public function getAnnonce($id){

      $annances =   DB::table('annances')
       ->select(['annances.numAnnance','annances.prix','annances.nom','annances.commentaire','annances.user_id','annances.telephone','voitures.marque','voitures.idVoiture','voitures.module','voitures.motorisation','pieaces.desPieace','pieaces.idPieace','souscategories.desSousCat','catigories.desCat'])
       ->join('pieaces', 'pieaces.idPieace', '=', 'annances.pieace_idPieace')
       ->join('voitures', 'voitures.idVoiture', '=', 'annances.voiture_idVoiture')
       ->join('souscategories', 'souscategories.idSousCat', '=', 'pieaces.sousCategorie_idSousCat')
       ->join('catigories', 'catigories.idCat', '=', 'souscategories.catigorie_idCat')

       ->where('numAnnance', $id)
       ->get();

       $listVoiture = DB::table('voitures')->groupBy('marque')->get();



       $listImage = Image::select()->where('annance_numAnnance', $id)->get();
       $listSousCatego = DB::table('souscategories')->get();
       $listCatego = Catigorie::all();

      return Response()->json(['annances'=>$annances,'listVoiture'=>$listVoiture,'listCatego'=>$listCatego]);
    }
    public function  getscat($id){


      $scat =  DB::table('catigories')
       ->select(['souscategories.desSousCat'])
       ->join('souscategories',  'souscategories.catigorie_idCat', '=','catigories.idCat')
       ->where('desCat', $id)
       ->get();

  return $scat;
    }
    public function  getpiece($id){
      $scat =  DB::table('souscategories')
       ->select(['pieaces.desPieace','pieaces.idPieace'])
       ->join('pieaces',  'pieaces.sousCategorie_idSousCat', '=','souscategories.idSousCat')
       ->where('desSousCat', $id)
       ->get();

  return $scat;

    }


  public function  getModule($id){
    $listVoiture = DB::table('voitures')->select(['module'])
    ->where('marque', $id)->groupBy('module')->get();

return $listVoiture;
  }
  public function  getid($id){
    $idp = DB::table('pieaces')->select(['idPieace'])
    ->where('desPieace', $id)->get();

return $idp;
  }
  public function  getidville($id){
    $idv = DB::table('villes')->select(['idVille'])
    ->where('nomVille', $id)->get();

return $idv;
  }
  public function  getMot($id){
    $listVoiture = DB::table('voitures')->select(['motorisation','idVoiture'])
    ->where('module', $id)->groupBy('motorisation')->get();

return $listVoiture;
  }


     public function update(annanceRequest $request,$id){

       $this->authorize('update',$Annance);

       $annance=Annance::find($id);
       // $cv->titre=$request->input('titre');
       // $cv->presentation=$request->input('presentation');
       $annance->save();
       return redirect('annances');
     }




   public function destroy(Request $request,$id){
     $this->authorize('destroy',$Annance);
     $annance=Annance::find($id);
     $annance->delete();
     return redirect('annances');
   }

    public function show($id)
    {

        $selectAnnance = Annance::select()->where('numAnnance', $id)->get();
        $listVoiture = Voiture::all();
        $listPiece = Pieace::all();
        $listImage = Image::select()->where('annance_numAnnance', $id)->get();
        $listSousCatego = DB::table('souscategories')->get();
        $listCatego = Catigorie::all();


        return view('annance.show', ['id' => $id, 'listSousCatego' => $listSousCatego, 'listCatego' => $listCatego, 'selectAnnance' => $selectAnnance, 'listVoiture' => $listVoiture, 'listPiece' => $listPiece, 'listImage' => $listImage]);

    }

    public function getAnnonceindex(){

      $annances =   DB::table('annances')
       ->select(['*'])
       ->join('pieaces', 'pieaces.idPieace', '=', 'annances.pieace_idPieace')
       ->join('voitures', 'voitures.idVoiture', '=', 'annances.voiture_idVoiture')
       ->join('souscategories', 'souscategories.idSousCat', '=', 'pieaces.sousCategorie_idSousCat')
       ->get();
       $listImage = Image::select()->groupBy('annance_numAnnance')->get();
       $villes = Ville::all();


      $marque =   DB::table('voitures')
       ->select(['marque'])
       ->distinct()
       ->get();
       $categorie =   DB::table('catigories')
        ->select(['desCat'])
        ->get();



        if($user = Auth::user())
        {
            $ida=Auth::user()->id;
          $whishs =   DB::table('whishs')
           ->select(['*'])
           ->where('user_id','=',$ida)
           ->get();
        }else {
          $whishs = array();
        }


          return Response()->json(['whishs'=>$whishs,'villes'=>$villes,'annances'=>$annances,'marque'=>$marque,'listImage'=>$listImage,'categorie'=>$categorie]);
    }
    public function getfac(){

       $listImage = Image::select()->groupBy('annance_numAnnance')->get();
       $villes = Ville::all();


      $marque =   DB::table('voitures')
       ->select(['marque'])
       ->distinct()
       ->get();
       $categorie =   DB::table('catigories')
        ->select(['desCat'])
        ->get();



        if($user = Auth::user())
        {
            $ida=Auth::user()->id;
          $whishs =   DB::table('whishs')
           ->select(['*'])
           ->where('user_id','=',$ida)
           ->get();
        }else {
          $whishs = array();
        }


          return Response()->json(['whishs'=>$whishs,'villes'=>$villes,'marque'=>$marque,'listImage'=>$listImage,'categorie'=>$categorie]);
    }
    public function filtrer($mar,$mod,$mot,$cat,$scat,$pc,$ville)
    {
      if ($ville!="ville") {
        $idville = DB::table('villes')
          ->where('nomVille','=',$ville)
          ->orderBy('idVille','desc')
          ->value('idVille');
      }
      if ($mot!="motorisation") {
              if ($pc!="piece") {
                    if ($ville!="ville") {



                      $annances =   DB::table('annances')
                       ->select(['*'])
                       ->join('pieaces', 'pieaces.idPieace', '=', 'annances.pieace_idPieace')
                       ->join('voitures', 'voitures.idVoiture', '=', 'annances.voiture_idVoiture')
                       ->join('souscategories', 'souscategories.idSousCat', '=', 'pieaces.sousCategorie_idSousCat')
                       ->join('catigories', 'catigories.idCat', '=', 'souscategories.catigorie_idCat')
                       ->where('motorisation', '=', $mot)
                       ->where('desPieace', '=', $pc)
                       ->where('ville_idVille', '=', $idville)

                       ->get();
                    }else {
                      $annances =   DB::table('annances')
                       ->select(['*'])
                       ->join('pieaces', 'pieaces.idPieace', '=', 'annances.pieace_idPieace')
                       ->join('voitures', 'voitures.idVoiture', '=', 'annances.voiture_idVoiture')
                       ->join('souscategories', 'souscategories.idSousCat', '=', 'pieaces.sousCategorie_idSousCat')
                       ->join('catigories', 'catigories.idCat', '=', 'souscategories.catigorie_idCat')
                       ->where('motorisation', '=', $mot)
                       ->where('desPieace', '=', $pc)
                       ->get();
                    }


              }elseif ($scat!="sous categorie") {
                          if ($ville!="ville") {
                            $annances =   DB::table('annances')
                             ->select(['*'])
                             ->join('pieaces', 'pieaces.idPieace', '=', 'annances.pieace_idPieace')
                             ->join('voitures', 'voitures.idVoiture', '=', 'annances.voiture_idVoiture')
                             ->join('souscategories', 'souscategories.idSousCat', '=', 'pieaces.sousCategorie_idSousCat')
                             ->join('catigories', 'catigories.idCat', '=', 'souscategories.catigorie_idCat')
                             ->where('motorisation', '=', $mot)
                             ->where('desSousCat', '=', $scat)
                             ->where('ville_idVille', '=', $idville)
                             ->get();
                          }else {
                            $annances =   DB::table('annances')
                             ->select(['*'])
                             ->join('pieaces', 'pieaces.idPieace', '=', 'annances.pieace_idPieace')
                             ->join('voitures', 'voitures.idVoiture', '=', 'annances.voiture_idVoiture')
                             ->join('souscategories', 'souscategories.idSousCat', '=', 'pieaces.sousCategorie_idSousCat')
                             ->join('catigories', 'catigories.idCat', '=', 'souscategories.catigorie_idCat')
                             ->where('motorisation', '=', $mot)
                             ->where('desSousCat', '=', $scat)
                             ->get();
                          }

              }elseif ($cat!='categorie') {
                if ($ville!="ville") {
                  $annances =   DB::table('annances')
                   ->select(['*'])
                   ->join('pieaces', 'pieaces.idPieace', '=', 'annances.pieace_idPieace')
                   ->join('voitures', 'voitures.idVoiture', '=', 'annances.voiture_idVoiture')
                   ->join('souscategories', 'souscategories.idSousCat', '=', 'pieaces.sousCategorie_idSousCat')
                   ->join('catigories', 'catigories.idCat', '=', 'souscategories.catigorie_idCat')
                   ->where('motorisation', '=', $mot)
                   ->where('desCat', '=', $cat)
                   ->where('ville_idVille', '=', $idville)
                   ->get();
                }else {
                  $annances =   DB::table('annances')
                   ->select(['*'])
                   ->join('pieaces', 'pieaces.idPieace', '=', 'annances.pieace_idPieace')
                   ->join('voitures', 'voitures.idVoiture', '=', 'annances.voiture_idVoiture')
                   ->join('souscategories', 'souscategories.idSousCat', '=', 'pieaces.sousCategorie_idSousCat')
                   ->join('catigories', 'catigories.idCat', '=', 'souscategories.catigorie_idCat')
                   ->where('motorisation', '=', $mot)
                   ->where('desCat', '=', $cat)
                   ->get();
                }

              }else {
                if ($ville!="ville") {
                  $annances =   DB::table('annances')
                   ->select(['*'])
                   ->join('pieaces', 'pieaces.idPieace', '=', 'annances.pieace_idPieace')
                   ->join('voitures', 'voitures.idVoiture', '=', 'annances.voiture_idVoiture')
                   ->join('souscategories', 'souscategories.idSousCat', '=', 'pieaces.sousCategorie_idSousCat')
                   ->join('catigories', 'catigories.idCat', '=', 'souscategories.catigorie_idCat')
                   ->where('motorisation', '=', $mot)
                   ->where('ville_idVille', '=', $idville)
                   ->get();
                }else {
                  $annances =   DB::table('annances')
                   ->select(['*'])
                   ->join('pieaces', 'pieaces.idPieace', '=', 'annances.pieace_idPieace')
                   ->join('voitures', 'voitures.idVoiture', '=', 'annances.voiture_idVoiture')
                   ->join('souscategories', 'souscategories.idSousCat', '=', 'pieaces.sousCategorie_idSousCat')
                   ->join('catigories', 'catigories.idCat', '=', 'souscategories.catigorie_idCat')
                   ->where('motorisation', '=', $mot)
                   ->get();
                }

              }
      }elseif ($mod!="module") {
        if ($pc!="piece") {
          if ($ville!="ville") {
            $annances =   DB::table('annances')
             ->select(['*'])
             ->join('pieaces', 'pieaces.idPieace', '=', 'annances.pieace_idPieace')
             ->join('voitures', 'voitures.idVoiture', '=', 'annances.voiture_idVoiture')
             ->join('souscategories', 'souscategories.idSousCat', '=', 'pieaces.sousCategorie_idSousCat')
             ->join('catigories', 'catigories.idCat', '=', 'souscategories.catigorie_idCat')
             ->where('module', '=', $mod)
             ->where('desPieace', '=', $pc)
             ->where('ville_idVille', '=', $idville)
             ->get();
          }else {
            $annances =   DB::table('annances')
             ->select(['*'])
             ->join('pieaces', 'pieaces.idPieace', '=', 'annances.pieace_idPieace')
             ->join('voitures', 'voitures.idVoiture', '=', 'annances.voiture_idVoiture')
             ->join('souscategories', 'souscategories.idSousCat', '=', 'pieaces.sousCategorie_idSousCat')
             ->join('catigories', 'catigories.idCat', '=', 'souscategories.catigorie_idCat')
             ->where('module', '=', $mod)
             ->where('desPieace', '=', $pc)
             ->get();
          }

        }elseif ($scat!="sous categorie") {
          if ($ville!="ville") {
            $annances =   DB::table('annances')
             ->select(['*'])
             ->join('pieaces', 'pieaces.idPieace', '=', 'annances.pieace_idPieace')
             ->join('voitures', 'voitures.idVoiture', '=', 'annances.voiture_idVoiture')
             ->join('souscategories', 'souscategories.idSousCat', '=', 'pieaces.sousCategorie_idSousCat')
             ->join('catigories', 'catigories.idCat', '=', 'souscategories.catigorie_idCat')
             ->where('module', '=', $mod)
             ->where('desSousCat', '=', $scat)
             ->where('ville_idVille', '=', $idville)
             ->get();
          }else {
            $annances =   DB::table('annances')
             ->select(['*'])
             ->join('pieaces', 'pieaces.idPieace', '=', 'annances.pieace_idPieace')
             ->join('voitures', 'voitures.idVoiture', '=', 'annances.voiture_idVoiture')
             ->join('souscategories', 'souscategories.idSousCat', '=', 'pieaces.sousCategorie_idSousCat')
             ->join('catigories', 'catigories.idCat', '=', 'souscategories.catigorie_idCat')
             ->where('module', '=', $mod)
             ->where('desSousCat', '=', $scat)
             ->get();
          }

        }elseif ($cat!="categorie") {
          if ($ville!="ville") {
            $annances =   DB::table('annances')
             ->select(['*'])
             ->join('pieaces', 'pieaces.idPieace', '=', 'annances.pieace_idPieace')
             ->join('voitures', 'voitures.idVoiture', '=', 'annances.voiture_idVoiture')
             ->join('souscategories', 'souscategories.idSousCat', '=', 'pieaces.sousCategorie_idSousCat')
             ->join('catigories', 'catigories.idCat', '=', 'souscategories.catigorie_idCat')
             ->where('module', '=', $mod)
             ->where('desCat', '=', $cat)
             ->where('ville_idVille', '=', $idville)
             ->get();
          }else {
            $annances =   DB::table('annances')
             ->select(['*'])
             ->join('pieaces', 'pieaces.idPieace', '=', 'annances.pieace_idPieace')
             ->join('voitures', 'voitures.idVoiture', '=', 'annances.voiture_idVoiture')
             ->join('souscategories', 'souscategories.idSousCat', '=', 'pieaces.sousCategorie_idSousCat')
             ->join('catigories', 'catigories.idCat', '=', 'souscategories.catigorie_idCat')
             ->where('module', '=', $mod)
             ->where('desCat', '=', $cat)
             ->get();
          }

        }else {
          if ($ville!="ville") {
            $annances =   DB::table('annances')
             ->select(['*'])
             ->join('pieaces', 'pieaces.idPieace', '=', 'annances.pieace_idPieace')
             ->join('voitures', 'voitures.idVoiture', '=', 'annances.voiture_idVoiture')
             ->join('souscategories', 'souscategories.idSousCat', '=', 'pieaces.sousCategorie_idSousCat')
             ->join('catigories', 'catigories.idCat', '=', 'souscategories.catigorie_idCat')
             ->where('module', '=', $mod)
             ->where('ville_idVille', '=', $idville)
             ->get();
          }else {
            $annances =   DB::table('annances')
             ->select(['*'])
             ->join('pieaces', 'pieaces.idPieace', '=', 'annances.pieace_idPieace')
             ->join('voitures', 'voitures.idVoiture', '=', 'annances.voiture_idVoiture')
             ->join('souscategories', 'souscategories.idSousCat', '=', 'pieaces.sousCategorie_idSousCat')
             ->join('catigories', 'catigories.idCat', '=', 'souscategories.catigorie_idCat')
             ->where('module', '=', $mod)
             ->get();
          }

        }

      }elseif ($mar!="marque") {

        if ($pc!="piece") {
          if ($ville!="ville") {
            $annances =   DB::table('annances')
             ->select(['*'])
             ->join('pieaces', 'pieaces.idPieace', '=', 'annances.pieace_idPieace')
             ->join('voitures', 'voitures.idVoiture', '=', 'annances.voiture_idVoiture')
             ->join('souscategories', 'souscategories.idSousCat', '=', 'pieaces.sousCategorie_idSousCat')
             ->join('catigories', 'catigories.idCat', '=', 'souscategories.catigorie_idCat')
             ->where('marque', '=', $mar)
             ->where('desPieace', '=', $pc)
             ->where('ville_idVille', '=', $idville)
             ->get();
          }else {
            $annances =   DB::table('annances')
             ->select(['*'])
             ->join('pieaces', 'pieaces.idPieace', '=', 'annances.pieace_idPieace')
             ->join('voitures', 'voitures.idVoiture', '=', 'annances.voiture_idVoiture')
             ->join('souscategories', 'souscategories.idSousCat', '=', 'pieaces.sousCategorie_idSousCat')
             ->join('catigories', 'catigories.idCat', '=', 'souscategories.catigorie_idCat')
             ->where('marque', '=', $mar)
             ->where('desPieace', '=', $pc)
             ->get();
          }

        }elseif ($scat!="sous categorie") {
          if ($ville!="ville") {
            $annances =   DB::table('annances')
             ->select(['*'])
             ->join('pieaces', 'pieaces.idPieace', '=', 'annances.pieace_idPieace')
             ->join('voitures', 'voitures.idVoiture', '=', 'annances.voiture_idVoiture')
             ->join('souscategories', 'souscategories.idSousCat', '=', 'pieaces.sousCategorie_idSousCat')
             ->join('catigories', 'catigories.idCat', '=', 'souscategories.catigorie_idCat')
             ->where('marque', '=', $mar)
             ->where('desSousCat', '=', $scat)
             ->where('ville_idVille', '=', $idville)
             ->get();
          }else {
            $annances =   DB::table('annances')
             ->select(['*'])
             ->join('pieaces', 'pieaces.idPieace', '=', 'annances.pieace_idPieace')
             ->join('voitures', 'voitures.idVoiture', '=', 'annances.voiture_idVoiture')
             ->join('souscategories', 'souscategories.idSousCat', '=', 'pieaces.sousCategorie_idSousCat')
             ->join('catigories', 'catigories.idCat', '=', 'souscategories.catigorie_idCat')
             ->where('marque', '=', $mar)
             ->where('desSousCat', '=', $scat)
             ->get();
          }

        }elseif ($cat!="categorie") {
          if ($ville!="ville") {
            $annances =   DB::table('annances')
             ->select(['*'])
             ->join('pieaces', 'pieaces.idPieace', '=', 'annances.pieace_idPieace')
             ->join('voitures', 'voitures.idVoiture', '=', 'annances.voiture_idVoiture')
             ->join('souscategories', 'souscategories.idSousCat', '=', 'pieaces.sousCategorie_idSousCat')
              ->join('catigories', 'catigories.idCat', '=', 'souscategories.catigorie_idCat')
              ->join('catigories', 'catigories.idCat', '=', 'souscategories.catigorie_idCat')
             ->where('marque', '=', $mar)
             ->where('desCat', '=', $cat)
             ->where('ville_idVille', '=', $idville)
             ->get();
          }else {
            $annances =   DB::table('annances')
             ->select(['*'])
             ->join('pieaces', 'pieaces.idPieace', '=', 'annances.pieace_idPieace')
             ->join('voitures', 'voitures.idVoiture', '=', 'annances.voiture_idVoiture')
             ->join('souscategories', 'souscategories.idSousCat', '=', 'pieaces.sousCategorie_idSousCat')
              ->join('catigories', 'catigories.idCat', '=', 'souscategories.catigorie_idCat')
              ->join('catigories', 'catigories.idCat', '=', 'souscategories.catigorie_idCat')
             ->where('marque', '=', $mar)
             ->where('desCat', '=', $cat)
             ->get();
          }

        }else {
          if ($ville!="ville") {
            $annances =   DB::table('annances')
             ->select(['*'])
             ->join('pieaces', 'pieaces.idPieace', '=', 'annances.pieace_idPieace')
             ->join('voitures', 'voitures.idVoiture', '=', 'annances.voiture_idVoiture')
             ->join('souscategories', 'souscategories.idSousCat', '=', 'pieaces.sousCategorie_idSousCat')
              ->join('catigories', 'catigories.idCat', '=', 'souscategories.catigorie_idCat')
             ->where('marque', '=', $mar)
             ->where('ville_idVille', '=', $idville)
             ->get();
          }else {
            $annances =   DB::table('annances')
             ->select(['*'])
             ->join('pieaces', 'pieaces.idPieace', '=', 'annances.pieace_idPieace')
             ->join('voitures', 'voitures.idVoiture', '=', 'annances.voiture_idVoiture')
             ->join('souscategories', 'souscategories.idSousCat', '=', 'pieaces.sousCategorie_idSousCat')
              ->join('catigories', 'catigories.idCat', '=', 'souscategories.catigorie_idCat')
             ->where('marque', '=', $mar)
             ->get();
          }

        }
      }else {
        if ($pc!="piece") {
          if ($ville!="ville") {
            $annances =   DB::table('annances')
             ->select(['*'])
             ->join('pieaces', 'pieaces.idPieace', '=', 'annances.pieace_idPieace')
             ->join('voitures', 'voitures.idVoiture', '=', 'annances.voiture_idVoiture')
             ->join('souscategories', 'souscategories.idSousCat', '=', 'pieaces.sousCategorie_idSousCat')
             ->join('catigories', 'catigories.idCat', '=', 'souscategories.catigorie_idCat')
             ->where('ville_idVille', '=', $idville)
             ->where('desPieace', '=', $pc)
             ->get();
          }else {
            $annances =   DB::table('annances')
             ->select(['*'])
             ->join('pieaces', 'pieaces.idPieace', '=', 'annances.pieace_idPieace')
             ->join('voitures', 'voitures.idVoiture', '=', 'annances.voiture_idVoiture')
             ->join('souscategories', 'souscategories.idSousCat', '=', 'pieaces.sousCategorie_idSousCat')
             ->join('catigories', 'catigories.idCat', '=', 'souscategories.catigorie_idCat')

             ->where('desPieace', '=', $pc)
             ->get();
          }

        }elseif ($scat!="sous categorie") {
          if ($ville!="ville") {
            $annances =   DB::table('annances')
             ->select(['*'])
             ->join('pieaces', 'pieaces.idPieace', '=', 'annances.pieace_idPieace')
             ->join('voitures', 'voitures.idVoiture', '=', 'annances.voiture_idVoiture')
             ->join('souscategories', 'souscategories.idSousCat', '=', 'pieaces.sousCategorie_idSousCat')
             ->join('catigories', 'catigories.idCat', '=', 'souscategories.catigorie_idCat')
             ->where('ville_idVille', '=', $idville)
             ->where('desSousCat', '=', $scat)
             ->get();
          }else {
            $annances =   DB::table('annances')
             ->select(['*'])
             ->join('pieaces', 'pieaces.idPieace', '=', 'annances.pieace_idPieace')
             ->join('voitures', 'voitures.idVoiture', '=', 'annances.voiture_idVoiture')
             ->join('souscategories', 'souscategories.idSousCat', '=', 'pieaces.sousCategorie_idSousCat')
             ->join('catigories', 'catigories.idCat', '=', 'souscategories.catigorie_idCat')

             ->where('desSousCat', '=', $scat)
             ->get();
          }

        }elseif ($cat!="categorie") {
          if ($ville!="ville") {
            $annances =   DB::table('annances')
             ->select(['*'])
             ->join('pieaces', 'pieaces.idPieace', '=', 'annances.pieace_idPieace')
             ->join('voitures', 'voitures.idVoiture', '=', 'annances.voiture_idVoiture')
             ->join('souscategories', 'souscategories.idSousCat', '=', 'pieaces.sousCategorie_idSousCat')
              ->join('catigories', 'catigories.idCat', '=', 'souscategories.catigorie_idCat')
               ->where('desCat', '=', $cat)
               ->where('ville_idVille', '=', $idville)
             ->get();
          }else {
            $annances =   DB::table('annances')
             ->select(['*'])
             ->join('pieaces', 'pieaces.idPieace', '=', 'annances.pieace_idPieace')
             ->join('voitures', 'voitures.idVoiture', '=', 'annances.voiture_idVoiture')
             ->join('souscategories', 'souscategories.idSousCat', '=', 'pieaces.sousCategorie_idSousCat')
              ->join('catigories', 'catigories.idCat', '=', 'souscategories.catigorie_idCat')
               ->where('desCat', '=', $cat)
             ->get();
          }

        }else {
          $annances =   DB::table('annances')
           ->select(['*'])
           ->join('pieaces', 'pieaces.idPieace', '=', 'annances.pieace_idPieace')
           ->join('voitures', 'voitures.idVoiture', '=', 'annances.voiture_idVoiture')
           ->join('souscategories', 'souscategories.idSousCat', '=', 'pieaces.sousCategorie_idSousCat')
            ->join('catigories', 'catigories.idCat', '=', 'souscategories.catigorie_idCat')
             ->where('ville_idVille', '=', $idville)
           ->get();
        }
      }

      return Response()->json(['annances'=>$annances,'mar'=>$mar,'mod'=>$mod,'mot'=>$mot,'cat'=>$cat,'scat'=>$scat,'pc'=>$pc]);

    }
    public function getmodulef($mar)
    {

      $module =   DB::table('voitures')
       ->select(['module'])
       ->where('marque', '=', $mar)
       ->distinct()
       ->get();

      return Response()->json(['module'=>$module]);

    }
    public function getmotorisationf($mad,$mar)
    {

      $motorisation =   DB::table('voitures')
       ->select(['motorisation'])
       ->where('module', '=', $mad)
       ->where('marque', '=', $mar)
       ->distinct()
       ->get();

      return Response()->json(['motorisation'=>$motorisation]);

    }
    public function getscategorie($cat)
    {

      $scat =   DB::table('souscategories')
       ->select(['desSousCat'])
       ->join('catigories', 'catigories.idCat', '=', 'souscategories.catigorie_idCat')
       ->where('desCat', '=', $cat)
       ->get();

      return Response()->json(['scat'=>$scat]);

    }
    public function getpiecef($scat)
    {

      $piece=   DB::table('pieaces')
       ->select(['desPieace'])
       ->join('souscategories', 'souscategories.idSousCat', '=', 'pieaces.sousCategorie_idSousCat')
       ->where('desSousCat', '=', $scat)
       ->get();

      return Response()->json(['piece'=>$piece]);

    }




}
