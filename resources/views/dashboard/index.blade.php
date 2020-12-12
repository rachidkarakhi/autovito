@extends('layouts.master')



@section('content')
<div class="content" id="a">
  <div class="container-fluid">
        <div class="row">


          <div class="col-xl-3 col-lg-6 col-md-6 col-sm-6">
            <div class="card card-stats">
              <div class="card-header card-header-success card-header-icon">
                <div class="card-icon">
                  <i class="material-icons">chrome_reader_mode</i>
                </div>
                <p class="card-category">Annonces</p>
                <h3 class="card-title">  @{{annonce}}


                </h3>
              </div>
              <div class="card-footer">
                <div class="stats">
                  <i class="material-icons">update</i>
                  <a v-on:click="getAnnonce"  style="color:#fff">show</a>
                </div>
              </div>
            </div>
          </div>
          <div class="col-xl-3 col-lg-6 col-md-6 col-sm-6">
            <div class="card card-stats">
              <div class="card-header card-header-info card-header-icon">
                <div class="card-icon">
                  <i class="material-icons">chat</i>
                </div>
                <p class="card-category">Non approuvé</p>
                <h3 class="card-title">@{{non_approuve}}

                </h3>
              </div>
              <div class="card-footer">
                <div class="stats">
                  <i class="material-icons">update</i>
                  <a v-on:click="getnon_approuve"  style="color:#fff">show</a>
                </div>
              </div>
            </div>
          </div>
          <div class="col-xl-3 col-lg-6 col-md-6 col-sm-6">
            <div class="card card-stats">
              <div class="card-header card-header-warning card-header-icon">
                <div class="card-icon">
                  <i class="material-icons">people</i>

                </div>
                <p class="card-category">Utilisateurs</p>
                <h3 class="card-title">@{{utilisateurs}}

                </h3>
              </div>
              <div class="card-footer">
                <div class="stats">
                  <i class="material-icons">update</i>
                  <a v-on:click="getUsers" style="color:#fff">show</a>
                </div>
              </div>
            </div>
          </div>



          <div class="col-xl-3 col-lg-6 col-md-6 col-sm-6">
            <div class="card card-stats">
              <div class="card-header card-header-danger card-header-icon">
                <div class="card-icon">
                  <i class="material-icons">not_interested</i>

                </div>
                <p class="card-category">Spam</p>

                <h3 class="card-title">@{{spam}}


                </h3>
              </div>
              <div class="card-footer">
                <div class="stats">
                  <i class="material-icons">update</i>
                  <a v-on:click="getspam"  style="color:#fff">show</a>
                </div>
              </div>
            </div>
          </div>



        </div>

        <div v-if="annonce_show" class="card">
          <div class="card-header card-header-success">
            <h4 class="card-title ">Annonces</h4>
            <p class="card-category">Tous les annonces(approuvé et non approuvé)</p>
          </div>
          <div class="card-body">
            <div class="table-responsive">
              <table class="table table-hover">
                <thead class=" text-primary">
                    <th>ID</th><th>Piece</th><th>voiture</th><th>Etat</th><th>Date de publication</th><th>prix</th><th>User</th>
                </thead>
                <tbody>

                    <tr v-for="annonce in annonces" v-on:click="direct(annonce)">
                        <td  class="text-primary">
                            @{{annonce.numAnnance}}
                        </td>
                        <td>
                            @{{annonce.desPieace}}
                        </td>
                        <td>
                            @{{annonce.marque}}
                        </td>

                        <td>
                            @{{annonce.approve}}
                        </td>
                        <td>
                            @{{annonce.created_at}}
                        </td>
                        <td >
                              @{{annonce.prix}}
                        </td>
                        <td >
                            @{{annonce.nom}}
                        </td>
                    </tr>



                </tbody>
              </table>
            </div>
          </div>
        </div>



        <div v-if="user_show" class="card">
          <div class="card-header card-header-warning">
            <h4 class="card-title ">Utilisateurs</h4>
            <p class="card-category">Tous les utilisateurs ont déjà créé un compte</p>
          </div>
          <div class="card-body">
            <div class="table-responsive">
              <table class="table table-hover">
                <thead class=" text-primary">
                    <th>ID</th><th>nom</th><th>E-mail</th><th>Tele</th><th>Ville</th><th>date de creation</th>
                </thead>
                <tbody>

                    <tr v-for="user in users">
                        <td  class="text-primary">
                            @{{user.id}}
                        </td>
                        <td>
                            @{{user.name}}
                        </td>
                        <td>
                            @{{user.email}}
                        </td>
                        <td>
                            @{{user.tele}}
                        </td>
                        <td >
                              @{{user.nomVille}}
                        </td>
                        <td >
                            @{{user.created_at}}
                        </td>
                    </tr>



                </tbody>
              </table>
            </div>
          </div>
        </div>




        <div v-if="spam_show" class="card">
          <div class="card-header card-header-danger">
            <h4 class="card-title ">spam</h4>
            <p class="card-category">pas encore défini</p>
          </div>
          <div class="card-body">
            <div class="table-responsive">

            </div>
          </div>
        </div>
        <div v-if="Contac_show" class="card">
          <div class="card-header card-header-info">
            <h4 class="card-title ">Les annonces Non approuvé</h4>
            <p class="card-category">Approuver ou supprimer les annonces </p>
          </div>
          <div class="card-body">
            <div class="table-responsive">
              <table class="table table-hover">
                <thead class=" text-primary">
                    <th>ID</th><th>Piece</th><th>voiture</th><th>Etat</th><th>Date de publication</th><th>prix</th><th>User</th>
                </thead>
                <tbody>

                    <tr v-for="annonce in annoncesnonap">
                        <td  class="text-primary">
                            @{{annonce.numAnnance}}
                        </td>
                        <td>
                            @{{annonce.desPieace}}
                        </td>
                        <td>
                            @{{annonce.marque}}
                        </td>

                        <td>
                            @{{annonce.approve}}
                        </td>
                        <td>
                            @{{annonce.created_at}}
                        </td>
                        <td >
                              @{{annonce.prix}}
                        </td>
                        <td >
                            @{{annonce.nom}}
                        </td>
                    </tr>



                </tbody>
              </table>
            </div>
          </div>
        </div>




  </div>
</div>
<script>
  Vue.use(VeeValidate);
</script>
<script type="text/javascript">
  var a = new Vue({
    el:'#a',
    data:{
      user_show:false,
      annonce_show:false,
      Contac_show:false,
      spam_show:false,

      utilisateurs:0,
      annonce:0,
      non_approuve:0,
      spam:0,

      annonces:[],
      users:[],
annoncesnonap:[],

    },
    methods:{

      getAnnonce:function(){
        axios.get("http://127.0.0.1:8000/getannonceForD")
        .then(response=>{

            this.annonces=response.data.annances;
            this.utilisateurs=response.data.users;
            this.annonce=response.data.annance;
            this.non_approuve=response.data.annancenon;


            this.user_show=false;
            this.annonce_show=true;
            this.Contac_show=false;
            this.spam_show=false;

          console.log('succes',response);
        })
        .catch(error=>{
          console.log('error',error);
        })
      },
      getUsers:function(){
        axios.get("http://127.0.0.1:8000/getUsers")
        .then(response=>{

            this.users=response.data.users;

            this.user_show=true;
            this.annonce_show=false;
            this.Contac_show=false;
            this.spam_show=false;

          console.log('succes',response);
        })
        .catch(error=>{
          console.log('error',error);
        })
      },
      getspam:function(){

        this.user_show=false;
        this.annonce_show=false;
        this.Contac_show=false;
        this.spam_show=true;
      },
      getnon_approuve:function(){
        axios.get("http://127.0.0.1:8000/getnonapprouve")
        .then(response=>{

            this.annoncesnonap=response.data.annances;
            this.user_show=false;
            this.annonce_show=false;
            this.Contac_show=true;
            this.spam_show=false;

          console.log('succes',response);
        })
        .catch(error=>{
          console.log('error',error);
        })


      },
      direct(annonce) {

       window.open("dashboard/annonce/"+annonce.numAnnance,'_self');


     },






    },
    created:function(){
      this.getAnnonce();

    }
  });
</script>

@endsection
