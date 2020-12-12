@extends('layouts.app')


@section('content')
<div id="a">
<section class="slider_section mb-50">
<div class="container">
        <div class="row">

            <div class="col-12">
                <div class="slider_area owl-carousel">
                    <div class="single_slider d-flex align-items-center" data-bgimg="assets/img/bg/p2.jpg">
                        <div class="slider_content">
                            <h2>Utile</h2>
                            <h1>Tout l'équipement de votre automobile.</h1>
                            <a class="button" href="{{url('annances')}}">Trouvez vos pièces auto</a>
                        </div>

                    </div>
                    <div class="single_slider d-flex align-items-center" data-bgimg="assets/img/bg/p3.jpg">
                        <div class="slider_content">
                            <h2>Joie de l'utilisation</h2>
                            <h1>Facil a trouver vos pièces auto</h1>
                            <a class="button" href="{{url('annances')}}">Trouvez vos pièces auto</a>
                        </div>
                    </div>
                    <div class="single_slider d-flex align-items-center" data-bgimg="assets/img/bg/p2.jpg">
                        <div class="slider_content">
                            <h2>Rapide</h2>
                            <h1>Trouver vos pièces auto rapidement</h1>
                            <a class="button" href="{{url('annances')}}">Trouvez vos pièces auto</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>

      </div>
</section>



<section class="small_product_area mb-50">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="section_title">
                   <h2><span> <strong>Les catégories</strong></span></h2>
                </div>
                <div class="product_carousel small_product product_column3 owl-carousel">
                  @foreach ($cat_list as $cat)


                    <div class="single_product">
                        <div class="product_content">


                            <div class="product_ratings">
                              <h4><h4> <a href="{{url('annonces',['cat' => $cat->desCat, 'scat' => 'sous categorie']) }}">{{$cat->desCat}}</a> </h4></h4>
                            </div>

                        </div>
                        <div class="product_thumb">
                            <a class="primary_img" href=""><img src="assets/img/bg/p2.jpg" alt=""></a>
                        </div>
                    </div>
              @endforeach


                </div>
            </div>
        </div>
    </div>
</section>




<section class="featured_categories mb-50">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="section_title">
                   <h2><span> <strong>les plus récents</strong></span></h2>
                </div>
                <div class="featured_containe">

                    <div class="featured_carousel featured_column3 owl-carousel">
@foreach ($listAnnance as $Annance )
                        <div class="single_items">

                            <div class="single_featured">

                                <div class="featured_thumb">
                                    <a href="{{url('annances/'.$Annance->numAnnance)}}"><img src="{{asset('storage/'.$listImage->firstWhere('annance_numAnnance', $Annance->numAnnance)->nameImage)}}" alt=""></a>
                                </div>
                                <div class="featured_content">
                                    <h3 class="product_name"><a href="#">{{$listPiece->firstWhere('idPieace', $Annance->pieace_idPieace)->desPieace}}</a></h3>
                                    <div class="sub_featured">
                                        <ul>
                                            <li><a href="#">{{$car_list->firstWhere('idVoiture',$Annance->voiture_idVoiture)->marque}}</a></li>
                                              <li>  <div class="price_box">
                                                    <span class="current_price">{{$Annance->prix}} MAD</span>
                                                </div></li>
                                        </ul>
                                    </div>
                                    <a class="view_more" href="{{url('annances/'.$Annance->numAnnance)}}">Voir les détails</a>
                                </div>
                            </div>


                        </div>

  @endforeach

                    </div>

                </div>
            </div>
        </div>
    </div>
</section>



<!--banner area end-->
<section class="small_product_area mb-50">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="section_title">
                   <h2><span> <strong>Les plus demandés </strong></span></h2>
                </div>
                <div class="product_carousel small_product product_column3 owl-carousel">
                  @foreach ($listAnnance as $Annance )


                    <div class="single_product">
                        <div class="product_content">
                            <h5>{{$listPiece->firstWhere('idPieace', $Annance->pieace_idPieace)->desPieace}}</h5>

                            <div class="product_ratings">
                              <h4><h4>{{$car_list->firstWhere('idVoiture', $Annance->voiture_idVoiture)->marque}}</h4></h4>
                            </div>
                            <div class="price_box">
                                <span class="current_price">{{$Annance->prix}} MAD</span>
                            </div>
                        </div>
                        <div class="product_thumb">
                            <a class="primary_img" href="{{url('annances/'.$Annance->numAnnance)}}"><img src="{{asset('storage/'.$listImage->firstWhere('annance_numAnnance', $Annance->numAnnance)->nameImage)}}" alt=""></a>
                        </div>
                    </div>
                @endforeach


                </div>
            </div>
        </div>
    </div>
</section>


</div>
 <!--featured categories area start-->
 <script>
  Vue.use(VeeValidate);
</script>
<script type="text/javascript">
  var a = new Vue({
    el:'#a',
    data:{
        s:"lal",
        scats:[],
        cats:[],
    },
    methods:{
      getscat:function(id){
        axios.get("http://127.0.0.1:8000/getscat/"+id)
        .then(response=>{

          this.scats=response.data.scats;

          console.log('succes',response);
        })
        .catch(error=>{
          console.log('error',error);
        })
      },
      getcat:function(){
        axios.get("http://127.0.0.1:8000/getcat")
        .then(response=>{

          this.cats=response.data.cats;


          console.log('succes',response);
        })
        .catch(error=>{
          console.log('error',error);
        })
      },

      direct(annonce) {

       window.open("annances/"+annonce.numAnnance,'_self');
     },

    },
    created:function(){
        this.getcat();
    }
  });
</script>

@endsection
