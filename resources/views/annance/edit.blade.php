@extends('layouts.app')



@section('content')
<style media="screen">
  .errors{
    color: red;
  }
</style>
<div id="a">

  <div class="product_details mt-20">
      <div class="container">
          <div class="row">
            <div class="col-lg-6 col-md-6">
               <div class="product-details-tab">
                    @foreach ($listImage as $image)
                    <div id="img-1" class="zoomWrapper single-zoom">
                        <a href="#">
                            <img class="img-size"  id="zoom1" src="{{ asset('storage/'.$image->nameImage) }}" data-zoom-image="{{ asset('storage/'.$image->nameImage) }}" alt="big-1">
                        </a>
                    </div>
                     @break
                     @endforeach
                    <div class="single-zoom-thumb">
                        <ul class="s-tab-zoom owl-carousel single-product-active" id="gallery_01">
                            @foreach ($listImage as $image)
                            <li>
                                <a href="#" class="elevatezoom-gallery active" data-update="" data-image="{{ asset('storage/'.$image->nameImage) }}" data-zoom-image="{{ asset('storage/'.$image->nameImage) }}">
                                    <img class="img-size" src="{{ asset('storage/'.$image->nameImage) }}" alt="zo-th-1"/>
                                </a>

                            </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
              <div class="col-lg-6 col-md-6">
                  <div class="product_d_right">
                     <form action="#" >

                          <h1>@{{annonce.desPieace}}</h1>
                          <div class="price_box">
                          <span class="current_price">@{{annonce.prix}}MAD</span>

                          </div>
                          <div class="product_desc">






                    <ul>
                      <li class="text-capitalize">  Marque :@{{annonce.marque}}</li>
                      <li class="text-capitalize">  Module :@{{annonce.module}}</li>
                      <li class="text-capitalize"> Nom :@{{annonce.nom}}</li>
                      <li class="text-capitalize">Téléphone :@{{annonce.telephone}}</li>
                    </ul>


                          </div>
                          <div class="product_variant color">
                              <h3>Description </h3>
                              <p>@{{annonce.commentaire}}</p>
</div>
                      </form>

                  </div>
              </div>
          </div>
      </div>
  </div>

  <!--product details end-->

  <!--product info start-->
  <div class="product_d_info">
      <div class="container">
          <div class="row">
              <div class="col-12">
                  <div class="product_d_inner">
                      <div class="product_info_button">
                          <ul class="nav" role="tablist">
                              <li >
                                  <a class="active" data-toggle="tab" href="#info" role="tab" aria-controls="info" aria-selected="false">Modifier</a>
                              </li>
                              <!-- <li>
                                   <a data-toggle="tab" href="#sheet" role="tab" aria-controls="sheet" aria-selected="false">Specification</a>
                              </li> -->

                          </ul>
                      </div>
                      <div class="tab-content">
                          <div class="tab-pane fade show active" id="info" role="tabpanel" >
                              <div class="product_info_content">
                                <div class="product_review_form" name="">
                                  <div class="alert alert-success" role="alert" v-if="upu">
                                    Vos modifications ont été bien enregistrées
                                  </div>
                                    <form @submit.prevent="validateForm('form-1')" data-vv-scope="form-1">

                                        <div class="row">
                                          <div class="col-lg-4 col-md-4">
                                              <label for="author">Nom:</label><span class="errors" >@{{ errors.first('form-1.Nom') }}</span>
                                              <input   type="text"  v-validate="'required'" name="Nom" v-model="annonce.nom">

                                          </div>
                                          <div class="col-lg-4 col-md-4">
                                              <label for="author">Téléphone:</label><span class="errors" >@{{ errors.first('form-1.Téléphone') }}</span>
                                              <input   type="text" v-validate="'required|max:10|min:10'"  name="Téléphone" v-model="annonce.telephone">

                                          </div>
                                          <div class="col-lg-4 col-md-4">
                                              <label for="author">Prix:</label><span class="errors" >@{{ errors.first('form-1.Prix') }}</span>
                                              <input   type="text" v-validate="'required|decimal:2'"  name="Prix" v-model="annonce.prix">

                                          </div>

                                            <div class="col-lg-4 col-md-4">
                                              <div class="form-group">
                                                 <label for="exampleFormControlInput1">Marque:</label>
                                                 <select class="custom-select" v-model="annonce.marque" @change="getModule()">
                                                   <option >@{{annonce.marque}}</option>


                                                   <option    v-for="car in voitures">@{{car.marque}}</option>

                                                 </select>
                                                </div>
                                            </div>
                                            <div class="col-lg-4 col-md-4">
                                              <div class="form-group">
                                                 <label for="exampleFormControlInput1">Module:</label>
                                                 <select selected class="custom-select" v-model="annonce.module" @change="getMot()">
                                                   <option>@{{annonce.module}}</option>

                                                   <option v-for="mod in modules">@{{mod.module}}</option>




                                                 </select>
                                                </div>
                                            </div>
                                            <div class="col-lg-4 col-md-4">
                                              <div class="form-group">
                                                 <label for="exampleFormControlInput1" >Motorisation:</label><span class="errors" >@{{ errors.first('form-1.Motorisation') }}</span>
                                                 <select   @change="getidv()" class="custom-select" v-model="annonce.motorisation" name="Motorisation" v-validate="'required'">
                                                   <option  selected>@{{annonce.motorisation}}</option>
                                                   <option v-for="mot in motorisations">@{{mot.motorisation}}</option>
                                                 </select>
                                                </div>
                                            </div>

                                                                                        <div class="col-lg-4 col-md-4">

                                                                                          <div class="form-group">
                                                                                             <label for="exampleFormControlInput1">Catégorie:</label>
                                                                                             <select class="custom-select" v-model="annonce.desCat" @change="getscat()">
                                                                                               <option >@{{annonce.desCat}}</option>
                                                                                               <option    v-for="cat in categories">@{{cat.desCat}}</option>

                                                                                             </select>
                                                                                            </div>
                                                                                        </div>
                                                                                        <div class="col-lg-4 col-md-4">
                                                                                          <div class="form-group">
                                                                                             <label for="exampleFormControlInput1">Sous catégorie:</label>
                                                                                             <select class="custom-select" v-model="annonce.desSousCat"  @change="getpiece()">
                                                                                               <option>@{{annonce.desSousCat}}</option>

                                                                                               <option v-for="scat in scategories">@{{scat.desSousCat}}</option>
                                                                                             </select>
                                                                                            </div>
                                                                                        </div>
                                                                                        <div class="col-lg-4 col-md-4">
                                                                                          <div class="form-group">
                                                                                             <label for="exampleFormControlInput1">Pièces:</label><span class="errors" >@{{ errors.first('form-1.Pièces') }}</span>
                                                                                             <select class="custom-select" v-model="annonce.desPieace" @change="getid()" v-validate="'required'" name="Pièces" >
                                                                                               <option >@{{annonce.desPieace}}</option>
                                                                                                <option   v-for="piece in pieces">@{{piece.desPieace}}</option>
                                                                                             </select>
                                                                                            </div>
                                                                                        </div>


                                            <div class="col-12">
                                                <label for="review_comment">Description: </label><span class="errors" >@{{ errors.first('form-1.Description') }}</span>
                                                <textarea id="review_comment" v-validate="'required|min:10'"   name="Description" v-model="annonce.commentaire"></textarea>
                                            </div>



                                        </div>
                                        <button type="submit">Enregistrer</button>
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

</div>




<!-- Optional: include a polyfill for ES6 Promises for IE11 and Android browser -->

<script>
  Vue.use(VeeValidate);
</script>

<script type="text/javascript">
  var a = new Vue({
    el:'#a',
    data:{

      id: {!! json_encode($id) !!},

      upu:false,

      voitures:[],
      modules:[],
      motorisations:[],
      categories:[],
      scategories:[],
      pieces:[],

      //annonce pour le data binding
      annonce:{
         commentaire:"",
         prix:0,
         nom:"",
         commentaire:"",
         user_id:0,
         telephone:"",
         marque:"",
         idVoiture:0,
         desPieace:"",
         idPieace:0,
         module:"",
         motorisation:"",
         desCat:"",
         desSousCat:"",
         numAnnance:0,
      }

    },
    methods:{
      getAnnonce:function(){
        axios.get("http://127.0.0.1:8000/getannoncetoedit/"+this.id)
        .then(response=>{

           this.voitures=response.data.listVoiture;
           this.categories=response.data.listCatego;

           this.annonce.numAnnance=this.id;
            this.annonce.prix=response.data.annances[0].prix;
            this.annonce.nom=response.data.annances[0].nom;
            this.annonce.commentaire=response.data.annances[0].commentaire;
            this.annonce.user_id=response.data.annances[0].user_id;
            this.annonce.telephone=response.data.annances[0].telephone;
            this.annonce.marque=response.data.annances[0].marque;
            this.annonce.idVoiture=response.data.annances[0].idVoiture;
            this.annonce.desPieace=response.data.annances[0].desPieace;
            this.annonce.idPieace=response.data.annances[0].idPieace;
            this.annonce.module=response.data.annances[0].module;
            this.annonce.motorisation=response.data.annances[0].motorisation;
            this.annonce.desCat=response.data.annances[0].desCat;
            this.annonce.desSousCat=response.data.annances[0].desSousCat;


          console.log('succes',response);
        })
        .catch(error=>{
          console.log('error',error);
        })
      },
      getModule:function(){
        axios.get("http://127.0.0.1:8000/getmodule/"+this.annonce.marque)
        .then(response=>{
          this.modules=response.data;

          this.annonce.module=response.data[0].module;
          this.annonce.motorisation='';
          console.log('succes',response);
        })
        .catch(error=>{
          console.log('error',error);
        })
      },
      getMot:function(){
        axios.get("http://127.0.0.1:8000/getmot/"+this.annonce.module)
        .then(response=>{

          this.motorisations=response.data;

          this.annonce.motorisation=response.data[0].motorisation;
          this.annonce.idVoiture=response.data[0].idVoiture;

          console.log('succes',response);
        })
        .catch(error=>{
          console.log('error',error);
        })
      },
      getscat:function(){
        axios.get("http://127.0.0.1:8000/getscat/"+this.annonce.desCat)
        .then(response=>{

            this.scategories=response.data;

            this.annonce.desSousCat=response.data[0].desSousCat;
            this.annonce.desPieace='';
            this.annonce.idPieace=0;
          console.log('succes',response);
        })
        .catch(error=>{
          console.log('error',error);
        })
      },
      getpiece:function(){
        axios.get("http://127.0.0.1:8000/getpiece/"+this.annonce.desSousCat)
        .then(response=>{
          this.annonce.desPieace=response.data[0].desPieace;
          this.annonce.idPieace=response.data[0].idPieace;
          this.pieces=response.data;
          console.log('succes',response);
        })
        .catch(error=>{
          console.log('error',error);
        })
      },

      getid:function(){
        axios.get("http://127.0.0.1:8000/getid/"+this.annonce.desPieace)
        .then(response=>{
          this.annonce.idPieace=response.data[0].idPieace;
          console.log('succes',response);
        })
        .catch(error=>{
          console.log('error',error);
        })
      },
      getidv:function(){
        axios.get("http://127.0.0.1:8000/getidv/"+this.annonce.marque+"/"+this.annonce.module+"/"+this.annonce.motorisation)
        .then(response=>{

          this.annonce.idVoiture=response.data[0].idVoiture;

          console.log('succes',response);
        })
        .catch(error=>{
          console.log('error',error);
        })
      },
      updateAnnonce:function(){
        axios.put("http://127.0.0.1:8000/updateannonce",this.annonce)
        .then(response=>{
          if (response.data.etat) {
            //alert(response.data.tst);
            Swal.fire({
              position: 'top',
              type: 'success',
              title: 'Vos modifications ont été bien enregistrées',
              showConfirmButton: false,
              timer: 1500
            })

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
              this.updateAnnonce();
  //alert('correct
          }
        });
      },


    },
    created:function(){
     this.getAnnonce();


    }
  });
</script>

@endsection
