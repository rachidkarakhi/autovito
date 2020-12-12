@extends('layouts.app')



@section('content')
    @auth

    @endauth
    <style media="screen">
      .error{
        color: red;
      }
    </style>
    <div class="container" id="a">
        <div  >
          <div class="">
            @if(session()->has('succes'))
            <div class="alert alert-success" role="alert">{{session()->get('succes')}}</div>
            @endif
            @if(Session::has('message'))
            <p class="alert alert-info">{{ Session::get('message') }}</p>
            @endif
              <div class="product_info_button">
                  <ul class="nav" role="tablist">
                      <li >
                          <a class="active" data-toggle="tab" href="#info" role="tab" aria-controls="info" aria-selected="false">Piece spécifique</a>
                      </li>
                      <li>
                           <a data-toggle="tab" href="#sheet" role="tab" aria-controls="sheet" aria-selected="false">Annonce libre</a>
                      </li>

                  </ul>
              </div>
              <div class="tab-content">
                  <div class="tab-pane fade show active" id="info" role="tabpanel" >
                      <div class="product_info_content">
                        <div class="">

                            <h3>Déposer votre annonce gratuite </h3>


                            <form action="{{url('annances')}}" method="POST" enctype="multipart/form-data"   @submit="checkForm" novalidate="true">

                                {{ csrf_field() }}

                            <div class="form-group">


                  <div class="row">


                    <div class="col-lg-4 col-md-4">






                                <label for="tele">Votre nom:</label>
                                <input type="text"    class="form-control" name="Nom" v-model="annonce.nom">
                    </div>
                    <div class="col-lg-4 col-md-4">
                                <label for="tele">Téléphone :</label>
                                <input type="text"   class="form-control"  name="Téléphone" v-model="annonce.tele">

                    </div>
                    <div class="col-lg-4 col-md-4">
                     <label class="label">Ville</label>
                     <select   @change="getidville();"   name="ville" id="ville" class="form-control" v-model="ville">
                              <option disabled>ville</option>
                              <option v-for="ville in villes">@{{ville.nomVille}}</option>
                     </select>


                    </div>

              </div>
              </div>
                                <div class="form-group">
                                <div class="row">
                                <div class="col-lg-4 col-md-4">
                                    <label class="label">Marque</label>
                                    <select @change="getmodule();"   v-model="selected_marque" name="Marque"  class="form-control">

                                      <option v-for="marque in marques"  >@{{marque.marque}}</option>

                                    </select>
                                    </div>
                                    <div class="col-lg-4 col-md-4">
                                     <label class="label">Module</label>
                                     <select v-if="display_module"    @change=" getMotorisation();" name="module" id="module" class="form-control" v-model="selected_module" >
                                         <option v-for="module in modules"  >@{{module.module}}</option>
                                     </select>

                                       <select v-else class="form-control notd" v-model="selected_module" >

                                     </select>
                                    </div>
                                    <div class="col-lg-4 col-md-4">
                                     <label class="label">Motorisation</label>
                                     <select v-if="display_motorisation"   @change="getcarid();" name="motorisation" id="motorisation" class="form-control"  v-model="selected_motorisation">

                                              <option v-for="motorisation in motorisations"  >@{{motorisation.motorisation}}</option>
                                     </select>

                                     <select v-else class="form-control notd"   v-model="selected_motorisation" >

                                     </select>

                                   </div>

                                </div>

                                 <hr>

                                  <div class="form-group">
                                  <div class="row">
                                <div class="col-lg-4 col-md-4">
                                    <label class="label">Catégorie</label>
                                    <select @change="getscategorie();"   name="categorie"  id="catigorie_idCat" class="form-control" v-model="selected_categorie">



                                          <option v-for="categorie in categories"  >@{{categorie.desCat}}</option>



                                    </select>
                                </div>
                                <div class="col-lg-4 col-md-4">
                                     <label class="label">Sous Catégorie</label>
                                     <select v-if="display_scategorie"   @change="getpiece();" name="sousCategorie" id="sousCategories" class="form-control"  v-model="selected_scategorie">


                                         <option v-for="scategorie in scategories">@{{scategorie.desSousCat}}</option>
                                     </select>
                                     <select v-else class="form-control notd"   v-model="selected_scategorie">

                                     </select>
                                    </div>
                                    <div class="col-lg-4 col-md-4">
                                     <label class="label">pièce</label>
                                     <select v-if="display_piece"    @change="getid();"   name="piece" id="piece" class="form-control" v-model="annonce.piece">
                                              <option v-for="piece in pieces">@{{piece.desPieace}}</option>
                                     </select>

                                     <select v-else  v-model="annonce.piece"   class="form-control notd"  >

                                     </select>
                                    </div>
                                   </div>

                                </div>
                                </div>


                                        <div class="row">

                                          <div class="col-md-12">
                                            <label for="comment">Description:</label>
                                            <textarea class="form-control"    v-model="annonce.Description" rows="5" id="comment" name="Description"></textarea>
                                          </div>

                                        </div>





                                            <input type="hidden" name="id_car" v-model="id_car" >
                                            <input type="hidden"  name="id_piece" v-model="id_piece">
                                              <input type="hidden"  name="id_ville" v-model="annonce.idville">



                                      <div class="form-group">
                                          <label for="comment">selectionner les images:</label>
                                      <div class="custom-upload centered">
                                            <input type="file" id="images"   class="form-control" name="images[]" multiple accept="image/*">
                                          {{-- <div class="images">
                                                  <div class="pic">
                                                 Ajouter
                                                  </div>
                                              </div> --}}
                                              </div>
                                      </div>
                                 <div class="form-group">
                                   <div class="row">
                                     <div class="col-md-12">
                                                 <label for="tele">Prix:</label>
                                                 <input  type="number"  class="form-control"  name="prix" v-model="annonce.prix">

                                     </div>
                                   </div>


                                 </div>
                                 <div class="form-group">


                                      <p   v-if="errors.length">
                                        <b>Veuillez corriger les erreurs suivants:</b>

                                        <ul class="alert alert-danger" v-if="errors.length">
                                          <li v-for="er in errors">@{{ er }}</li>
                                        </ul>

                                      </p>
                                    </div>
                                 <button type="submit"  class="centered btn btn-warning">Publier</button>


                                 </form>

            @csrf




                        </div>
                      </div>
                  </div>
                  <div class="tab-pane fade" id="sheet" role="tabpanel" >
                      <div class="product_d_table">
                        <div class="">

                            <h3>Déposer votre annonce gratuite </h3>


                            <form  action="{{url('annancecs')}}" method="POST" enctype="multipart/form-data"   @submit="checkForm2" novalidate="true" >

                                {{ csrf_field() }}

                            <div class="form-group">


                  <div class="row">


                    <div class="col-lg-6 col-md-6">
                            <label for="tele">Votre nom:</label>
                                <input type="text"    class="form-control" name="Nom" v-model="annoncec.nom">
                    </div>
                    <div class="col-lg-6 col-md-6">
                                <label for="tele">Téléphone :</label>
                                <input type="text"   class="form-control"  name="Téléphone" v-model="annoncec.tele">

                    </div>
                  </div>
<div class="row">


  <div class="col-md-6">
   <label class="label">Ville</label>
   <select   @change="getidville2();"   name="ville"  class="form-control" v-model="ville">
            <option disabled>ville</option>
            <option v-for="ville in villes">@{{ville.nomVille}}</option>
   </select>
<input type="hidden" name="idville"  v-model="annoncec.idville">

  </div>
  <div class="col-md-6">
    <label for="comment">Titre:</label>
    <input type="text" class="form-control"    v-model="annoncec.descMin" rows="5" name="descMin">

  </div>
</div>



              </div>



                                        <div class="row">

                                          <div class="col-md-12">
                                            <label for="comment">Description détaillée:</label>
                                            <textarea class="form-control"    v-model="annoncec.descMax" rows="5"  name="descMax"></textarea>
                                          </div>

                                        </div>









                                      <div class="form-group">
                                          <label for="comment">selectionner les images:</label>
                                      <div class="custom-upload centered">
                                            <input type="file" id="images2"   class="form-control" name="imamges[]" multiple accept="image/*">
                                          {{-- <div class="images">
                                                  <div class="pic">
                                                 Ajouter
                                                  </div>
                                              </div> --}}
                                              </div>
                                      </div>

                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-lg-12">
                                                    <label for="tele">Prix:</label>
                                                    <input  type="number"  class="form-control"  name="prix" v-model="annoncec.prix">
                                        </div>
                                      </div>
                                </div>
                                <div class="form-group">


                                     <p   v-if="errors2.length">
                                       <b>Veuillez corriger les erreurs suivants:</b>

                                       <ul class="alert alert-danger" v-if="errors2.length">
                                         <li v-for="er2 in errors2">@{{ er2 }}</li>
                                       </ul>

                                     </p>
                                   </div>


                                 <button type="submit"  class="centered btn btn-warning">Publier</button>


                                 </form>

            @csrf




                        </div>
                      </div>
                      <div class="product_info_content">
                          <p></p>
                      </div>
                  </div>


              </div>
          </div>


        </div>
    </div>

    <script type="text/javascript">
      var a = new Vue({
        el:'#a',
        data:{

 errors: [],
 errors2: [],
          id_car:0,
          id_piece:0,

          empty:false,
          selected_marque: 'marque',
          selected_module: 'module',
          selected_motorisation: 'motorisation',

          display_marque: true,
          display_module: false,
          display_motorisation: false,


          selected_categorie: 'categorie',
          selected_scategorie: 'sous categorie',
          selected_piece: 'piece',

          display_categorie: true,
          display_scategorie: false,
          display_piece: false,



villes:[],
ville:null,
      marques:[],
      modules:[],
      motorisations:[],


      categories:[],
      scategories:[],
      pieces:[],
      annonce:{
        images:[],
         Description:null,
         prix:0,
         nom:null,
         tele:null,
         piece:null,
         motorisation:null,
         marque:null,
         module:null,

         idville:0,


      },
      annoncec:{
        images:[],
        nom:null,
        tele:null,
        prix:null,
        idville:null,
        descMin:null,
        descMax:null,
      }

        },
        methods:{

          checkForm: function (e) {
               this.errors = [];


               ////check nom value ///////
               if (!this.annonce.nom) {
                 this.errors.push("le champ Nom est obligatoire.");
               }else if (!isNaN(this.annonce.nom)) {
                 this.errors.push("le champ Nom doit être en lettres.");
               }
               ////check prix value ///////
               if (!this.annonce.prix) {
                 this.errors.push("le champ Prix est obligatoire.");
               }else if (isNaN(this.annonce.prix)) {
                 this.errors.push("le champ prix doit être un nombre numérique.");
               }
                ////check Téléphone value ///////
                if (!this.annonce.tele) {
                  this.errors.push("le champ Téléphone est obligatoire.");
                }else if (isNaN(this.annonce.prix)) {
                  this.errors.push("le champ Téléphone doit être un nombre numérique.");
                }
                ///////////id_car////////////
                if (!this.id_piece) {
                  this.errors.push("le champ pièce est obligatoire, merci de choisire Catégorie et sous Catégorie.");
                }
                if (!this.id_car) {
                  this.errors.push("le champ Motorisation est obligatoire, merci de choisire le Module et la Marque de votre voiture.");
                }
                ////////Description//////
                if (!this.annonce.Description) {
                  this.errors.push("le champ Description est obligatoire.");
                }
                ///////////ville ////////

                if (this.annonce.idville==0) {
                  this.errors.push("le champ Ville est obligatoire.");
                }

                ////images//
                if(document.getElementById("images").value == "") {
                    this.errors.push("Veuillez selectionner les images de votre pièce.");
                  }
               if (!this.errors.length) {
                 return true;
               }

               e.preventDefault();
             },

             checkForm2: function (e) {
                  this.errors2 = [];


                  ////check nom value ///////
                  if (!this.annoncec.nom) {
                    this.errors2.push("le champ Nom est obligatoire.");
                  }else if (!isNaN(this.annoncec.nom)) {
                    this.errors2.push("le champ Nom doit être en lettres.");
                  }
                  ////check prix value ///////
                  if (!this.annoncec.prix) {
                    this.errors2.push("le champ Prix est obligatoire.");
                  }else if (isNaN(this.annoncec.prix)) {
                    this.errors2.push("le champ prix doit être un nombre numérique.");
                  }
                   ////check Téléphone value ///////
                   if (!this.annoncec.tele) {
                     this.errors2.push("le champ Téléphone est obligatoire.");
                   }else if (isNaN(this.annoncec.prix)) {
                     this.errors2.push("le champ Téléphone doit être un nombre numérique.");
                   }



                   ////////Description//////
                   if (!this.annoncec.descMin) {
                     this.errors2.push("le champ titre est obligatoire.");
                   }

                   if (!this.annoncec.descMax) {
                     this.errors2.push("le champ Description détaillée est obligatoire.");
                   }
                   ///////////ville ////////

                   if (this.annoncec.idville==0) {
                     this.errors2.push("le champ Ville est obligatoire.");
                   }

                   ////images//
                   if(document.getElementById("images2").value == "") {
                       this.errors2.push("Veuillez selectionner les images de votre pièce.");
                     }
                  if (!this.errors2.length) {
                    return true;
                  }

                  e.preventDefault();
                },



            getAnnonce:function(){
                    axios.get("http://127.0.0.1:8000/annonce/getannonce")
                    .then(response=>{

                      this.marques=response.data.marque;
                      this.villes=response.data.villes;

                      this.categories=response.data.categorie;


                      console.log('succes',response);
                    })
                    .catch(error=>{
                      console.log('error',error);
                    })
                  },

                  addAnnonce:function(){
                    this.annonce.marque=this.selected_marque;
                    this.annonce.module=this.selected_module;
                    axios.post("http://127.0.0.1:8000/annances",this.annonce)
                    .then(response=>{


                      // this.marques=response.data.marque;
                      // this.categories=response.data.categorie;


                      console.log('succes',response);
                    })
                    .catch(error=>{
                      console.log('error',error);
                    })
                  },


                 getmodule:function(){
                   axios.get("http://127.0.0.1:8000/annonce/getmodule/"+this.selected_marque)
                   .then(response=>{
                     this.modules=response.data.module;
                     this.motorisations=[];
                     this.display_module= true;
                     this.display_motorisation= false;
                     console.log('succes',response);
                   })
                   .catch(error=>{
                     console.log('error',error);
                   })
                 },

                 getidville2:function(){
                   axios.get("http://127.0.0.1:8000/annonce/getidville/"+this.ville)
                   .then(response=>{
                      this.annoncec.idville=response.data[0].idVille;
                     console.log('succes',response);
                   })
                   .catch(error=>{
                     console.log('error',error);
                   })
                 },
                 getidville:function(){
                   axios.get("http://127.0.0.1:8000/annonce/getidville/"+this.ville)
                   .then(response=>{
                      this.annonce.idville=response.data[0].idVille;
                     console.log('succes',response);
                   })
                   .catch(error=>{
                     console.log('error',error);
                   })
                 },
                 getcarid:function(){
                   axios.get("http://127.0.0.1:8000/getidv/"+this.selected_marque+"/"+this.selected_module+"/"+this.selected_motorisation)
                   .then(response=>{
                     this.id_car=response.data[0].idVoiture;

                     console.log('succes',response);
                   })
                   .catch(error=>{
                     console.log('error',error);
                   })
                 },
                 getid:function(){
                   axios.get("http://127.0.0.1:8000/getid/"+this.annonce.piece)
                   .then(response=>{
                     this.id_piece=response.data[0].idPieace;
                     console.log('succes',response);
                   })
                   .catch(error=>{
                     console.log('error',error);
                   })
                 },

                 getMotorisation:function(){
                   axios.get("http://127.0.0.1:8000/annonce/getmotorisation/"+this.selected_module+"/"+this.selected_marque)
                   .then(response=>{
                     this.motorisations=response.data.motorisation;
                     this.display_motorisation= true;
                     console.log('succes',response);
                   })
                   .catch(error=>{
                     console.log('error',error);
                   })
                 },
                 getscategorie:function(){
                   axios.get("http://127.0.0.1:8000/annonce/getscategorie/"+this.selected_categorie)
                   .then(response=>{
                     this.scategories=response.data.scat;
                     this.pieces=[];
                     this.display_scategorie= true;
                     this.display_piece= false;
                     console.log('succes',response);
                   })
                   .catch(error=>{
                     console.log('error',error);
                   })
                 },
                 getpiece:function(){
                   axios.get("http://127.0.0.1:8000/annonce/getpiece/"+this.selected_scategorie)
                   .then(response=>{
                     this.pieces=response.data.piece;
                     this.display_piece= true;
                     console.log('succes',response);
                   })
                   .catch(error=>{
                     console.log('error',error);
                   })
                 },


        },
        computed: {
    isComplete () {


      return this.annonce.nom && this.annonce.marque && this.annonce.module && this.annonce.motorisation && this.annonce.Description && this.annonce.prix && this.annonce.tele && this.annonce.piece;

    }
  },
        created:function(){

          this.getAnnonce();

        }
      });
    </script>

    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>



@endsection
