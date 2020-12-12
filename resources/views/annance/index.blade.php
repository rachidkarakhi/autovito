  @extends('layouts.app')


@section('content')
<div id="a">


<div class="shop_area shop_fullwidth">
    <div class="container">
        <div class="row">
          <div class="col-lg-3 col-md-12">
             <!--sidebar widget start-->
              <aside class="sidebar_widget">
                  <div class="widget_inner">
                    <div class="widget_list widget_categories">
                        <h2>Afficher toutes les annonces</h2>

                              <div class="form-group">
                                <div class="row">
                                <div class="col-md-12">
                                  <button type="button" class="btn btn-warning" v-on:click="getAnnonce">Toutes les annonces</button>


                                    </div>



                                </div>
                              </div>

                    </div>
                    <div class="widget_list widget_categories">
                        <h2>Filtrer par Ville</h2>

                              <div class="form-group">
                                <div class="row">
                                <div class="col-md-12">
                                    <label class="label">Ville</label>
                                    <select  v-model="selected_ville"  @change="filtrer()" class="form-control">

                                      <option v-for="ville in villes"  >@{{ville.nomVille}}</option>

                                    </select>
                                    </div>



                                </div>
                              </div>

                    </div>
                      <div class="widget_list widget_categories">
                          <h2>Filtrer par marque</h2>

                                <div class="form-group">
                                  <div class="row">
                                  <div class="col-md-12">
                                      <label class="label">Marque</label>
                                      <select @change=" filtrer();getmodule();" v-model="selected_marque"   class="form-control">

                                        <option v-for="marque in marques"  >@{{marque.marque}}</option>

                                      </select>
                                      </div>
                                      <div class="col-md-12">
                                       <label class="label">Module</label>
                                      <select v-if="display_module"  @change=" filtrer();getMotorisation();" name="module" id="module" class="form-control" v-model="selected_module" >
                                          <option v-for="module in modules"  >@{{module.module}}</option>
                                      </select>

                                        <select v-else class="form-control notd" v-model="selected_module" name="">

                                      </select>
                                      </div>
                                      <div class="col-md-12">
                                       <label class="label">Motorisation</label>

                                      <select v-if="display_motorisation"  @change=" filtrer()" name="motorisation" id="motorisation" class="form-control"  v-model="selected_motorisation">

                                               <option v-for="motorisation in motorisations"  >@{{motorisation.motorisation}}</option>
                                      </select>

                                      <select v-else class="form-control notd"  v-model="selected_motorisation" name="">

                                      </select>

                                     </div>

                                  </div>
                                </div>

                      </div>

                      <div class="widget_list widget_categories">
                          <h2>filtrer par piece</h2>
                          <div class="form-group">
                          <div class="row">
                        <div class="col-md-12">
                            <label class="label">Categorie</label>
                            <select @change=" filtrer();getscategorie();" name="categorie" id="catigorie_idCat" class="form-control" v-model="selected_categorie">



                                  <option v-for="categorie in categories"  >@{{categorie.desCat}}</option>



                            </select>
                        </div>


                        <div class="col-md-12">
                             <label class="label">sous Categorie</label>
                            <select v-if="display_scategorie" @change=" filtrer();getpiece();" name="sousCategories" id="sousCategories" class="form-control"  v-model="selected_scategorie">


                                <option v-for="scategorie in scategories">@{{scategorie.desSousCat}}</option>
                            </select>
                            <select v-else class="form-control notd"  name="" v-model="selected_scategorie">

                            </select>
                            </div>
                            <div class="col-md-12">
                             <label class="label">Piece</label>
                            <select v-if="display_piece" @change="filtrer()" name="piece" id="piece" class="form-control" v-model="selected_piece">
                                     <option v-for="piece in pieces">@{{piece.desPieace}}</option>
                            </select>

                            <select v-model="selected_piece" v-else class="form-control notd"  name="">

                            </select>
                            </div>
                           </div>

                        </div>
                      </div>

                  </div>

              </aside>
              <!--sidebar widget end-->
          </div>
          <div class="col-lg-9 col-md-12">
              <!--shop wrapper start-->
              <!--shop toolbar start-->

              <div class="shop_title">
                  <h1>Toutes les annonces</h1>
              </div>
              <div class="shop_toolbar_wrapper">
                  <div class="shop_toolbar_btn">

                      <button data-role="grid_3" type="button" class=" btn-grid-3" data-toggle="tooltip" title="3"></button>

                      <button data-role="grid_4" type="button"  class=" btn-grid-4" data-toggle="tooltip" title="4"></button>

                      <button data-role="grid_list" type="button"  class="active btn-list" data-toggle="tooltip" title="List"></button>
                  </div>
                  <!-- <div class=" niceselect_option">

                      <form class="select_option" action="#">
                          <select name="orderby" id="short">

                              <option selected value="1">Sort by average rating</option>
                              <option  value="2">Sort by popularity</option>
                              <option value="3">Sort by newness</option>
                              <option value="4">Sort by price: low to high</option>
                              <option value="5">Sort by price: high to low</option>
                              <option value="6">Product Name: Z</option>
                          </select>
                      </form>


                  </div> -->
                  <!-- <div class="page_amount">
                      <p>Showing 1–9 of 21 results</p>
                  </div> -->
              </div>
               <!--shop toolbar end-->

               <div  class="row shop_wrapper grid_list">

                 <div  v-if="empty" class=" col-12 ">
                   <div class="alert alert-dark" role="alert">
                      empty
                  </div>
                 </div>


              <!-- real one  -->

                  <div  v-for="annonce in annonces" class=" col-12 ">
                    <div class="single_product">
                        <div class="product_name grid_name">
                            <h3><a href="product-details.html">@{{annonce.desPieace}}</a></h3>
                            <p class="manufacture_product"><a href="#">@{{annonce.desSousCat}} </a></p>
                        </div>
                        <div class="product_thumb">
                          <div class="ph" v-for="image in images">




                            <a v-if="image.annance_numAnnance == annonce.numAnnance" class="primary_img"  >  <img  height="150" width="150" @click="direct(annonce)" :src="'../storage/'+image.nameImage" alt=""></a>

                            <div class="label_product">
                                <span class="label_sale">@{{annonce.marque}}</span>
                            </div>
                          </div>
                        </div>
                        <div class="product_content grid_content">
                            <div class="content_inner">

                                <div class="product_footer d-flex align-items-center">
                                    <div class="price_box">
                                        <span class="current_price">@{{annonce.prix}} MAD</span>

                                    </div>
                                    <div class="add_to_cart">
                                      <li class="quick_button"><a @click="direct(annonce)" data-toggle="modal" data-target="#modal_box"  title="consulter"> <span class="lnr lnr-magnifier"></span></a></li>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="product_content list_content">
                          <!-- hna bda -->

                            <div class="left_caption">
                               <div class="product_name">
                                 <ul>


                                    <li> <b>Pièce:</b>  @{{annonce.desPieace}}</li>
                                    <li><b>Marque:</b>  @{{annonce.marque}}</li>
                                    <li> <b>Module:</b>@{{annonce.module}}</li>
                                    <li><b>Motorisation:</b> @{{annonce.motorisation}}</li>
                                    <div v-for="ville in villes"  class="">
                                      <li v-if="ville.idVille ===annonce.ville_idVille " ><b>Ville :</b> @{{ville.nomVille}}</li>
                                    </div>
                                    <li style="color:#fff">-------------------------------------------------------------------______</li>
                                    </ul>
                                </div>


                            </div>
                                            <div class="right_caption " >

                                               <div class="price_box">
                                                    <span class="current_price">@{{annonce.prix}} MAD</span>
                                                </div>
                                                <!-- <div class="cart_links_btn ">
                                                    <a @click="direct(annonce)" title="Consulter">Consulter</a>

                                                </div> -->
                                                <div class="action_links_btn">
<a @click="direct(annonce)"  title="Afficher plus de détailles"> <span style="font-size: 30px;color: #ffd54c;"   class="lnr lnr-magnifier"></span></a>
  <a @click="addToWishs(annonce)"  title="Ajouter à la liste de souhaits"> <span style="font-size: 30px;color: #ffd54c;"    class="lnr lnr-heart"></span></a>
<a @click="spamer(annonce)" title="signaler un spam"> <span style="font-size: 30px;color: #ffd54c;"    class="lnr lnr-circle-minus"></span></a>

                                                    <!-- <ul>
                                                      <li class="wishlist">  <span style="color: #ffd54c;">
                                                        <a @click="direct(annonce)"  title="Afficher plus de détailles"> <span style="font-size: 35px;"   class="lnr lnr-magnifier"></span></a>

                                                          </span>
                                                        </li>
                                                    <li class="quick_button">  <span style="color: #ffd54c;">
                                                      <a @click="addToWishs(annonce)"  title="Ajouter à la liste de souhaits"> <span style="font-size: 35px;"    class="lnr lnr-heart"></span></a>

                                                        </span>
                                                      </li>

                                                    <li class="wishlist">  <span style="color: #ffd54c;">
                                                      <a @click="spamer(annonce)" title="signaler un spam"> <span style="font-size: 35px;"    class="lnr lnr-circle-minus"></span></a>


                                                        </span>
                                                      </li>

                                                </ul> -->
                                                        <!-- <ul>
                                                        <i class="fa fa-plus" aria-hidden="true"></i>

                                                        <li class="quick_button"><a href="#" data-toggle="modal" data-target="#modal_box"  title="quick view"> <span class="lnr lnr-magnifier"></span></a></li>
                                                        <li class="wishlist"><a href="wishlist.html" title="Add to Wishlist"><span class="lnr lnr-heart"></span></a></li>
                                                        <li class="compare"><a href="#" title="compare"><span class="lnr lnr-sync"></span></a></li>
                                                    </ul> -->
                                                </div>
                                            </div>
                        </div>
                        <!-- hna sala  -->
                    </div>
                  </div>













              </div>

              <div class="shop_toolbar t_bottom">
                  <!-- <div class="pagination">
                      <ul>
                          <li class="current">1</li>
                          <li><a href="#">2</a></li>
                          <li><a href="#">3</a></li>
                          <li class="next"><a href="#">next</a></li>
                          <li><a href="#">>></a></li>
                      </ul>
                  </div> -->

              </div>
              <!--shop toolbar end-->
              <!--shop wrapper end-->
          </div>






        </div>
    </div>
</div>
</div>


<!--
    <script src="{{asset('assets/js/vue.js')}}"></script>
    <script src="{{asset('assets/js/axios.min.js')}}"></script>
    <script src="{{asset('assets/js/vee-validate.js')}}"></script>
    <script src="{{asset('assets/js/sweetalert.js')}}"></script>
    <script src="{{asset('assets/js/vee-validate-latest.js')}}"></script> -->
    <!-- <script src="{{asset('assets/js/promise.js')}}"></script> -->

    <script type="text/javascript">
      var a = new Vue({
        el:'#a',
        data:{
          empty:false,
          selected_ville: 'ville',
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
      wishs:[],
      annonces:[],
      images:[],
      marques:[],
      modules:[],
      motorisations:[],
villes:[],
      categories:[],
      scategories:[],
      pieces:[],
        },
        methods:{

                        isEmpty:function(obj){
                    for(var key in obj) {
                        if(obj.hasOwnProperty(key))
                            return false;
                    }
                    return true;
                },

                  getAnnonce:function(){
                   this.selected_ville= "ville";
                     this.selected_marque= "marque";
                    this.selected_module= "module";
                    this.selected_motorisation= "motorisation";

                    this.display_marque= true;
                    this.display_module= false;
                    this.display_motorisation= false;


                    this.selected_categorie= "categorie";
                    this.selected_scategorie= "sous categorie";
                    this.selected_piece= "piece";

                    this.display_categorie= true;
                    this.display_scategorie= false;
                    this.display_piece= false;

                    axios.get("http://127.0.0.1:8000/annonce/getannonce")
                    .then(response=>{
                      this.annonces=response.data.annances;
                      this.marques=response.data.marque;
                      this.images=response.data.listImage;
                      this.categories=response.data.categorie;
                      this.villes=response.data.villes;



                      if (this.isEmpty(this.annonces)) {
                        this.empty=true;
                      }else {
                          this.empty=false;
                      }
                      console.log('succes',response);
                    })
                    .catch(error=>{
                      console.log('error',error);
                    })
                  },
                  filtrer:function(){
                    axios.get("http://127.0.0.1:8000/annonce/filter/"+this.selected_marque+"/"+this.selected_module+"/"+this.selected_motorisation+"/"+this.selected_categorie+"/"+this.selected_scategorie+"/"+this.selected_piece+"/"+this.selected_ville)
                    .then(response=>{
                      this.annonces=response.data.annances;
                      if (this.isEmpty(this.annonces)) {
                        this.empty=true;
                      }else {
                          this.empty=false;
                      }
                      console.log('succes',response);
                    })
                    .catch(error=>{
                      console.log('error',error);
                    })
                  },
                  direct(annonce) {

                   window.open("annances/"+annonce.numAnnance,'_self');


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

                 addToWishs(annonce) {
                   //add to wishlist from here //
                   axios.post("http://127.0.0.1:8000/addwish/",annonce)
                   .then(response=>{
                     if (response.data.etat) {
                       Swal.fire({
                                 position: 'top',
                                 type: 'success',
                                 title: 'Une annonce a été enregistré',
                                 showConfirmButton: false,
                                 timer: 1500
                               })
                     }else {
                       Swal.fire({
                          type: 'error',
                          title: 'Oops...',
                          text: 'Pour ajouter  cette annonce a votre liste des souhaits, vous devez vous connecter',
                          footer: '<a href="{{ route('login') }}">se connecter</a>'
                        })
                     }

                     console.log('succes',response);
                   })
                   .catch(error=>{
                     console.log('error',error);
                   })


                },
                spamer(annonce) {
                  //add to wishlist from here //
                  // axios.post("http://127.0.0.1:8000/addwish/",annonce)
                  // .then(response=>{
                  //   if (response.data.etat) {
                  //     Swal.fire({
                  //               position: 'top',
                  //               type: 'success',
                  //               title: 'Une annonce a été enregistré',
                  //               showConfirmButton: false,
                  //               timer: 1500
                  //             })
                  //   }else {
                  //     Swal.fire({
                  //        type: 'error',
                  //        title: 'Oops...',
                  //        text: 'Pour ajouter  cette annonce a votre liste des souhaits, vous devez vous connecter',
                  //        footer: '<a href="{{ route('login') }}">se connecter</a>'
                  //      })
                  //   }
                  //
                  //   console.log('succes',response);
                  // })
                  // .catch(error=>{
                  //   console.log('error',error);
                  // })
                  Swal.fire({
                            position: 'top',
                            type: 'success',
                            title: 'Votre signal a été bien reçu, merci pour votre  aide',
                            showConfirmButton: false,
                            timer: 1500
                          })

               },


        },
        created:function(){

          this.getAnnonce();

        }
      });
    </script>



@endsection
