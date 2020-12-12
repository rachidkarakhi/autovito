<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

use Illuminate\Support\Facades\Hash;

use DB;

use App\Ville;
use App\Annance;
use App\Image;
use Auth;
use App\Voiture;
use App\Pieace;
use App\Catigorie;
use App\SousCategorie;

class UserController extends Controller
{

  public function __construct()
    {
        $this->middleware('auth');
    }
    public function storePass(Request $req,$id){
        $us=Auth::user();
        $us->password=$req->input('pass1');
        $us->save();
        session()->flash("message","the password has been saved");

        return redirect('/profil');

    }
    public function indexd()
    {
      $villes = Ville::all();



        return view('dashboard.index', ['villes' => $villes]);
    }

    public function index()
    {
      $villes = Ville::all();


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
            $listAnnance = Annance::select()->where('user_id', Auth::user()->id)->get();

            $userl = Auth::user();



        return view('profil.index', ['villes' => $villes,'luser' => $userl,'car_list' => $car_list, 'cat_list' => $cat_list, 'listSousCatego' => $listSousCatego, 'listCatego' => $listCatego, 'listAnnance' => $listAnnance, 'listVoiture' => $listVoiture, 'listPiece' => $listPiece, 'listImage' => $listImage]);
    }
    public function Contact()
    {


        return view('annance.Contact');
    }

  public function updateUser(Request $request){
    $userl = Auth::user();
     $userl->name=$request->name;
      $userl->tele=$request->tele;
     $userl->ville_idVille=$request->idVille;
      $userl->email=$request->email;
    $userl->save();

    return Response()->json(['etat'=>true]);

  }
  public function updatePasse(Request $request){
    ///////////////hna tebda //////
  $current_password = Auth::User()->password;
  if(Hash::check($request->actuel, $current_password))
   {

     $request->user()->fill([
                'password' => Hash::make($request->Nouveau)
            ])->save();

    return Response()->json(['etat'=>true]);
   }
   else
   {

return Response()->json(['etat'=>false]);   }



  }

  public function getAnnonce(){
      //$annances = Annance::select()->where('user_id', Auth::user()->id)->get();
    $annances =   DB::table('annances')
     ->select(['annances.numAnnance','annances.prix','annances.created_at','voitures.marque','pieaces.desPieace'])
     ->join('pieaces', 'pieaces.idPieace', '=', 'annances.pieace_idPieace')
     ->join('voitures', 'voitures.idVoiture', '=', 'annances.voiture_idVoiture')
     ->where('user_id', Auth::user()->id)
     ->get();

     $user =   DB::table('users')
      ->select(['users.name','users.tele','users.email','villes.nomVille','villes.idVille','users.id'])
      ->join('villes', 'villes.idVille', '=', 'users.ville_idVille')
      ->where('id', Auth::user()->id)
      ->get();



  // return $annances;

        return Response()->json(['annances'=>$annances,'user'=>$user]);
  }
  public function getannonceForD(){
      //$annances = Annance::select()->where('user_id', Auth::user()->id)->get();
    $annances =   DB::table('annances')
     ->select(['annances.numAnnance','annances.prix','annances.created_at','voitures.marque','pieaces.desPieace','annances.nom','annances.approve'])
     ->join('pieaces', 'pieaces.idPieace', '=', 'annances.pieace_idPieace')
     ->join('voitures', 'voitures.idVoiture', '=', 'annances.voiture_idVoiture')
     ->orderBy('annances.numAnnance', 'desc')
     ->get();

     $annancenon = DB::table('annances')->where('approve','non')->count();
     $annance = DB::table('annances')->count();
     $users = DB::table('users')->count();

        return Response()->json(['annances'=>$annances,'annance'=>$annance,'users'=>$users,'annancenon'=>$annancenon]);
  }
  public function getnonapprouve(){
      //$annances = Annance::select()->where('user_id', Auth::user()->id)->get();
    $annances =   DB::table('annances')
     ->select(['annances.numAnnance','annances.prix','annances.created_at','voitures.marque','pieaces.desPieace','annances.nom','annances.approve'])
     ->join('pieaces', 'pieaces.idPieace', '=', 'annances.pieace_idPieace')
     ->join('voitures', 'voitures.idVoiture', '=', 'annances.voiture_idVoiture')
     ->orderBy('annances.numAnnance', 'desc')
     ->where('approve','non')
     ->get();



        return Response()->json(['annances'=>$annances]);
  }



  public function deletAnnonce($id){

    $tst=false;
    $listAnnance = Annance::where('numAnnance',$id);
    $listImage = Image::where('annance_numAnnance',$id);

    $listAnnance->delete();
    $listImage->delete();

   return Response()->json(['etat'=>true,"id"=>$id]);
  }

  public function getUsers(){
      //$annances = Annance::select()->where('user_id', Auth::user()->id)->get();
    $users =   DB::table('users')
      ->select(['users.created_at','users.email','users.id','users.name','users.tele','villes.nomVille'])
       ->join('villes', 'villes.idVille', '=', 'users.ville_idVille')
     ->orderBy('id', 'asc')
     ->get();






        return Response()->json(['users'=>$users]);
  }






}
