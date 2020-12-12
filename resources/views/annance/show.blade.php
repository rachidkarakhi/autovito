@extends('layouts.app')



@section('content')

    @foreach ($selectAnnance as $annance)



     <!--product details start-->
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

                            </ul>
                        </div>
                            @endforeach
                    </div>
                </div>
                <div class="col-lg-6 col-md-6">
                    <div class="product_d_right">
                       <form action="#">

                            <h1>{{$listPiece->firstWhere('idPieace', $annance->pieace_idPieace)->desPieace}}</h1>


                            <div class="price_box">

                            <span class="current_price">{{$annance->prix}} MAD</span>


                            </div>
                            <div class="product_desc">
<ul>


                            <li class="text-capitalize"> <b>Marque :</b> {{$listVoiture->firstWhere('idVoiture', $annance->voiture_idVoiture)->marque }}</li>
                            <li class="text-capitalize"> <b>Module :</b> {{$listVoiture->firstWhere('idVoiture', $annance->voiture_idVoiture)->module }}</li>
                            <li class="text-capitalize"> <b>Nom :</b>{{$annance->nom}}</li>
                            <li class="text-capitalize"><b>Telephone :</b>{{$annance->telephone}}</li>
</ul>
                            </div>
                        </form>
                        <div class="product_desc">
                          <div class="product_d_inner">
                              <div class="product_info_button">
                                  <ul class="nav" role="tablist">
                                      <li >
                                          <a class="active" data-toggle="tab" href="#info" role="tab" aria-controls="info" aria-selected="false">Description</a>
                                      </li>

                                  </ul>
                              </div>
                              <div class="tab-content">
                                  <div class="tab-pane fade show active" id="info" role="tabpanel" >
                                      <div class="product_info_content">
                                        <p>{{ $annance->commentaire }}</p>

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

    <!--product details end-->

    <!--product info start-->
    <div class="product_d_info">
        <div class="container">
            <div class="row">
                <div class="col-12">

                </div>
            </div>
        </div>
    </div>
    <!--product info end-->
 @endforeach
@endsection
