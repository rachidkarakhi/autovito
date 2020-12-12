@extends('layouts.app')


@section('content')
<style media="screen">
  .errors{
    color: red;
  }
</style>
<div class="breadcrumbs_area">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="breadcrumb_content">
                    <ul>
                        <li><a href="index.html">Accueil</a></li>
                        <li>Mon compte</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- my account start  -->
<section class="main_content_area">
    <div class="container" id="a">
        <div class="account_dashboard">
            <div class="row">
                <div class="col-sm-12 col-md-3 col-lg-3">
                    <!-- Nav tabs -->
                    <div class="dashboard_tab_button">
                        <ul role="tablist" class="nav flex-column dashboard-list">
                            <li><a href="#dashboard" data-toggle="tab" class="nav-link active">Tableau de bord</a></li>
                            <li> <a href="#orders" data-toggle="tab" class="nav-link">Mes annonces</a></li>
                            <li><a href="#downloads" data-toggle="tab" class="nav-link">liste de souhaits</a></li>

                            <li><a href="#account-details" data-toggle="tab" class="nav-link">Account details</a></li>
                            <li><a href="#address" data-toggle="tab" class="nav-link">Mot de Passe</a></li>
                            <li>  <a class="dropdown-item" href="{{ route('logout') }}"
                                 onclick="event.preventDefault();
                                               document.getElementById('logout-form').submit();">
                                  {{ __('Logout') }}
                              </a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-sm-12 col-md-9 col-lg-9">
                    <!-- Tab panes -->
                    <div class="tab-content dashboard_content">
                        <div class="tab-pane fade show active" id="dashboard">
                            <h3>Tableau de bord </h3>

                            @if(session()->has('succes'))
                            <div class="alert alert-success" role="alert">{{session()->get('succes')}}</div>
                            @endif
                            @if(Session::has('message'))
                            <p class="alert alert-info">{{ Session::get('message') }}</p>
                            @endif
                            <p>À partir du tableau de bord de votre compte,
                             vous pouvez visualiser vos annonces récentes,
                             Gérer votre liste de souhaits ainsi que changer
                              votre mot de passe et les détails de votre compte.</p>

                        </div>
                        <div class="tab-pane fade" id="orders">
                            <h3>Mes annonces</h3>
                            <div class="table-responsive">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th>Piece</th>
                                            <th>Date de publication </th>
                                              <th>voiture</th>
                                            <th>prix</th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>

                                      <tr v-for="annonce in annonces">
                                          <td>

                                          @{{annonce.desPieace}}
                                          </td>

                                          <td>@{{annonce.created_at}}</td>
                                          <td>

                                            @{{annonce.marque}}

                                          </td>
                                          <td>@{{annonce.prix}}</td>
                                          <td>
                                            <div class="action_links_btn">
                                                <ul>
                                                    <li class="quick_button"><a @click="direct(annonce)"  data-toggle="modal" data-target="#modal_box"  title="Afficher"> <span class="lnr lnr-magnifier"></span></a></li>
                                                    <li ><a  @click="directModif(annonce)"  title="Modifier"><span class="lnr lnr-cog"></span></a></li>
                                                    <li class="compare"><a @click="deleteAnnonce(annonce)" title="supprimer"><span class="lnr lnr-trash"></span></a></li>
                                                </ul>
                                            </div>
                                          </td>
                                      </tr>



                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="downloads">
                            <h3>wish list</h3>
                            <div class="table-responsive">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th>Piece</th>
                                            <th>Voiture</th>
                                            <th>Prix</th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                      <tr v-for="wish in wishs">
                                          <td>

                                          @{{wish.desPieace}}
                                          </td>


                                          <td>

                                            @{{wish.marque}}

                                          </td>
                                          <td>@{{wish.prix}}</td>
                                          <td>
                                            <div class="action_links_btn">
                                                <ul>
                                                    <li class="quick_button"><a @click="direct(wish)"  data-toggle="modal" data-target="#modal_box"  title="Afficher"> <span class="lnr lnr-magnifier"></span></a></li>
                                                    <li class="compare"><a @click="deleteWish(wish)" title="supprimer"><span class="lnr lnr-trash"></span></a></li>
                                                </ul>
                                            </div>
                                          </td>
                                      </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>

                        <div class="tab-pane fade" id="account-details" >
                            <h3>Details du compte </h3>
                            <a href="#">MODIFIER VOTRE PROFIL </a>

                            <div class="login">
                                <div class="login_form_container">
                                    <div class="account_login_form">

                                        <form @submit.prevent="validateForm('form-1')" data-vv-scope="form-1">


                                          <div v-if="upu" style="border-radius:0px" class="alert alert-success" role="alert">
                                            Votre modification a été bien enregistré
                                          </div>

                                          <input type="hidden"  v-model="user.id">

                                            <label>Nom et Prénom:</label> <span class="errors" >@{{ errors.first('form-1.Nom') }}</span>
                                            <input type="text"  v-validate="'required'" name="Nom" v-model="user.name" placeholder="Votre Nom et Prénom">


                                            <label>Téléphone:</label><span class="errors">@{{ errors.first('form-1.Téléphone') }}</span>
                                            <input type="text" v-validate="'required|max:10|min:10'" name="Téléphone" v-model="user.tele" placeholder="exp:06XXXXXXXX">

                                            <div class="form-group">
                                           <label for="exampleFormControlSelect1">Ville:</label>
                                           <select v-model="user.idVille" class="form-control" id="exampleFormControlSelect1" name="ville">

                                             @foreach($villes as $ville)

                                            <option
                                             @if($ville->idVille==$luser->ville_idVille)
                                            selected
                                            @endif
                                             value="{{$ville->idVille}}">{{$ville->nomVille}}
                                           </option>

                                           @endforeach

                                           </select>
                                         </div>
                                            <label>E-Mail:</label> <span class="errors">@{{ errors.first('form-1.E-Mail') }}</span>
                                            <input type="mail" v-validate="'required|email'" name="E-Mail" v-model="user.email" placeholder="exp:exemple@domaine.com">



                                            <div class="save_button primary_btn default_button">
                                                <input  style="background-color:#ffd54c;" class="btn btn-warning" type="submit" name="Modifier" value="Modifier">

</div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane" id="address">
                          <div class="">
                            <h3>MOT DE PASSE </h3>

                                  <div v-if="smf" class="alert alert-danger" role="alert">
                                    Merci de tapez votre mot de passe actuel.
                                  </div>
                              <div class="login_form_container">
                                  <div class="account_login_form">

                                      <form @submit.prevent="validateForm1('form-2')" data-vv-scope="form-2">


                                        <!-- <div v-if="upu" style="border-radius:0px" class="alert alert-success" role="alert">
                                          Votre modification a été bien enregistré
                                        </div> -->



                                          <label>Mot de passe actuel:</label><span v-if="se" class="errors">@{{ errors.first('form-2.actuel') }}</span>
                                          <input type="password"   name="actuel" v-validate="'required|min:8'" v-model="passe.actuel">


                                          <label>Nouveau mot de passe:</label><span v-if="se" class="errors">@{{ errors.first('form-2.Nouveau') }}</span>
                                          <input type="password" name="Nouveau" v-validate="'required|min:8'" v-model="passe.Nouveau">

                                          <label>Confirmez le mot de passe:</label><span v-if="se" class="errors">@{{ errors.first('form-2.confirme') }}</span><span v-if="sec" class="errors">votre confirmation est fausse</span>
                                          <input type="password" name="confirme" v-validate="'required|min:8'" v-model="passe.confirme">

                                          <div class="save_button primary_btn default_button">
                                              <input  style="background-color:#ffd54c;" class="btn btn-warning" type="submit" name="Modifier" value="Modifier">

</div>
                                      </form>
                                  </div>
                              </div>
                          </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- my account end   -->
<!--
<script src="https://cdn.jsdelivr.net/npm/vue/dist/vue.js"></script>
<script src="https://unpkg.com/axios/dist/axios.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/vee-validate@latest/dist/vee-validate.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@8"></script> -->

<!-- Optional: include a polyfill for ES6 Promises for IE11 and Android browser -->
<!-- <script src="https://cdn.jsdelivr.net/npm/promise-polyfill"></script> -->
<!-- unpkg -->
<!-- <script src="https://unpkg.com/vee-validate@latest"></script> -->
<script>
  Vue.use(VeeValidate);
</script>
<script type="text/javascript">
  var a = new Vue({
    el:'#a',
    data:{
      smf:false,
      sec:false,
      se:false,
      upu:false,
      annonces:[],
      wishs:[],
      users:[],
      user:{

            email:'',
            id:0,
            idVille:0,
            name:'',
            nomVille:'',
            tele:'',
      },

      passe:{

            actuel:'',
            Nouveau:'',
            confirme:'',

      },

    },
    methods:{
      getwish:function(){
        axios.get("http://127.0.0.1:8000/getwish")
        .then(response=>{

          this.wishs=response.data.whishs;

          console.log('succes',response);
        })
        .catch(error=>{
          console.log('error',error);
        })
      },
      getAnnonce:function(){
        axios.get("http://127.0.0.1:8000/getannonce")
        .then(response=>{

            this.annonces=response.data.annances;
            this.users=response.data.user;
            this.user.email=response.data.user[0].email;
            this.user.id=response.data.user[0].id;
            this.user.idVille=response.data.user[0].idVille;
            this.user.name=response.data.user[0].name;
            this.user.nomVille=response.data.user[0].nomVille;
            this.user.tele=response.data.user[0].tele;

          console.log('succes',response);
        })
        .catch(error=>{
          console.log('error',error);
        })
      },
      deleteAnnonce:function(annonce){

        Swal.fire({
  title: 'Êtes-vous sûr?',
  text: "Vous ne pourrez pas revenir en arrière!",
  type: 'warning',
  showCancelButton: true,
  confirmButtonColor: '#3085d6',
  cancelButtonColor: '#d33',
  confirmButtonText: 'Oui, supprimez!',
  cancelButtonText: 'Annuler'
}).then((result) => {
  if (result.value) {
    axios.delete("http://127.0.0.1:8000/deleteannonce/"+annonce.numAnnance)
    .then(response=>{

      if (response.data.etat) {
        var position =this.annonces.indexOf(annonce);
        this.annonces.splice(position,1);
      }



      console.log('succes',response);
    })
    .catch(error=>{
      console.log('error',error);
    })
    Swal.fire(
      'Supprimé!',
      'Votre annonce a été supprimé.',
      'Succès'
    )
  }

})

      },
      deleteWish:function(wish){

        Swal.fire({
  title: 'Êtes-vous sûr?',
  text: "Vous ne pourrez pas revenir en arrière!",
  type: 'warning',
  showCancelButton: true,
  confirmButtonColor: '#3085d6',
  cancelButtonColor: '#d33',
  confirmButtonText: 'Oui, supprimez!',
  cancelButtonText: 'Annuler'
}).then((result) => {
  if (result.value) {
    axios.delete("http://127.0.0.1:8000/deletewish/"+wish.id)
    .then(response=>{

      if (response.data.etat) {
        var position =this.wishs.indexOf(wish);
        this.wishs.splice(position,1);
      }



      console.log('succes',response);
    })
    .catch(error=>{
      console.log('error',error);
    })
    Swal.fire(
      'Supprimé!',
      'Votre annonce a été supprimé.',
      'Succès'
    )
  }

})

      },

      updateUser:function(){
        axios.put("http://127.0.0.1:8000/updateuser",this.user)
        .then(response=>{
          if (response.data.etat) {
            //alert(response.data.tst);
            this.upu=true;
          }


          console.log('succes',response);
        })
        .catch(error=>{
          console.log('error',error);
        })
      },
      updatepasse:function(){
        axios.put("http://127.0.0.1:8000/updatepasse",this.passe)
        .then(response=>{
          if (response.data.etat) {
            Swal.fire({
                position: 'top',
                type: 'success',
                title: 'votre mot de passe a été bien enregistré',
                showConfirmButton: false,
                timer: 1500
              });
        this.smf=false;
        this.passe.actuel="";
        this.passe.Nouveau="";
        this.passe.confirme="";

      }else {
        this.smf=true;
      }


          console.log('succes',response);
        })
        .catch(error=>{
          console.log('error',error);
        })
      },
      validateForm(scope) {
        this.$validator.validateAll(scope).then((result) => {
          if (result) {
            // eslint-disable-next-line
            this.updateUser();
//alert('correct
          }
        });
      },

      validateForm1(scope) {
        this.$validator.validateAll(scope).then((result) => {
          if (result) {
                  if (this.coparit()) {
                    this.updatepasse();
                    this.se=false;

                  }else {
                    this.se=true;
                    this.sec=true;
                  }


          }else {
            this.se=true;
          }
        });
      },
      coparit() {
      return this.passe.Nouveau==this.passe.confirme;

      },
      direct(annonce) {

       window.open("annances/"+annonce.numAnnance,'_self');


     },
     directModif(annonce) {

      window.open("annances/"+annonce.numAnnance+"/edit",'_self');


    },








    },
    created:function(){
      this.getAnnonce();
      this.getwish();
    }
  });
</script>

@endsection
