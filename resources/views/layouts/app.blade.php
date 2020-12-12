<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="no-js">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">



    <title>{{ config('app.name', 'Laravel') }}</title>


    <!-- Fonts -->

    <!-- <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet" type="text/css"> -->
    <!-- <link rel="stylesheet" href="https://cdn.linearicons.com/free/1.0.0/icon-font.min.css"> -->

    <!-- Styles -->
    <link rel="stylesheet" href="https://cdn.linearicons.com/free/1.0.0/icon-font.min.css">
    <script src="https://cdn.linearicons.com/free/1.0.0/svgembedder.min.js"></script>
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">

    <link href="{{ asset('css/theme.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="{{asset('assets/css/bootstrap.min.css')}}">


    <link href="{{ asset('/css/theme/navigation.css') }}" rel="stylesheet">
    <link href="{{ asset('css/theme/rangeslider.css') }}" rel="stylesheet">
    <link href="{{ asset('css/theme/settings.css') }}" rel="stylesheet">
    <link href="{{ asset('css/theme/skin-1.css') }}" rel="stylesheet">
    <link href="{{ asset('css/theme/style.css') }}" rel="stylesheet">
    <link href="{{ asset('css/theme/templete.css') }}" rel="stylesheet">

     <!-- CSS
    ========================= -->


    <!-- Plugins CSS -->
    <link rel="stylesheet" href=" {{asset('assets/css/plugins.css')}}">
    {{-- icon --}}
    <link rel="stylesheet" href=" https://use.fontawesome.com/releases/v5.6.3/css/all.css">
    <link href="https://unpkg.com/ionicons@4.2.2/dist/css/ionicons.min.css" rel="stylesheet">
    <!-- Main Style CSS -->
    <link rel="stylesheet" href="{{asset('assets/css/style.css')}}">

    {{-- templete style : ------  --}}
    {{-- <link href="{{ asset('xhtml/css/style.css') }}" rel="stylesheet">
    <link href="{{ asset('xhtml/css/templete.css') }}" rel="stylesheet">
    <link class="skin" href="{{ asset('xhtml/css/skin/skin-1.css') }}" rel="stylesheet">
    <link class="skin" href="{{ asset('xhtml/plugins/rangeslider/rangeslider.css') }}" rel="stylesheet">
    <link href="{{ asset('xhtml/plugins/revolution/css/settings.css') }}" rel="stylesheet">
    <link href="{{ asset('xhtml/plugins/revolution/css/navigation.css') }}" rel="stylesheet"> --}}


    <script src="{{asset('assets/js/vue.js')}}"></script>
    <script src="{{asset('assets/js/axios.min.js')}}"></script>
    <script src="{{asset('assets/js/vee-validate.js')}}"></script>
    <script src="{{asset('assets/js/sweetalert.js')}}"></script>
    <script src="{{asset('assets/js/vee-validate-latest.js')}}"></script>
    <script src="{{asset('assets/js/promise.js')}}"></script>



</head>
<body>
    <div id="app">


            <!-- Main Wrapper Start -->
    <!--header area start-->
    <header class="header_area header_padding">
        <!--header top start-->

        <!--header top start-->
        <!--header top start-->
        <div class="header_top">
            <div class="container">
                <div class="top_inner">
                    <div class="row align-items-center">
                    <div class="col-lg-6 col-md-6">
                        <div class="follow_us">
                            <label>Follow Us:</label>
                            <ul class="follow_link">
                                <li><a href="#"><i class="ion-social-facebook"></i></a></li>
                                <li><a href="#"><i class="ion-social-twitter"></i></a></li>
                                <li><a href="#"><i class="ion-social-googleplus"></i></a></li>
                                <li><a href="#"><i class="ion-social-youtube"></i></a></li>
                            </ul>
                        </div>
                    </div>


                    <div class="col-lg-6 col-md-6">
                        <div class="top_right text-right">
                            <ul>

                                 @guest
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                            </li>
                            @if (Route::has('register'))

                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                                </li>
                            @endif
                        @else

                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }} <span class="caret"></span>
                                </a>

                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ url('/profil') }}">Mon profil </a>
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>



                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        @csrf
                                    </form>
                                </div>

                            </li>
                        @endguest




                            </ul>
                        </div>
                    </div>
                </div>
                </div>
            </div>
        </div>
        <!--header top start-->
        <!--header middel start-->
        <div class="header_middle">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-lg-3 col-md-6">
                        <div class="logo">
                            <a href="{{ url('/') }}"><img src="{{asset('assets/img/logo/logo.png')}}" alt=""></a>
                        </div>
                    </div>
                    <div class="col-lg-9 col-md-6">
                        <div class="middel_right">
                            <div style="margin-right: 30%;" class="search-container">
                              <a style="border-radius: 0px;" class="btn btn-dark btn-lg" href="{{url('annonces/create') }}"  role="button">Déposer une annonce gratuite</a>

                            </div>
                            <div class="middel_right_info">


                                <div class="mini_cart_wrapper">
                                    <a href="javascript:void(0)"><span class="lnr lnr-heart"></span>Liste de souhaits </a>
                                    <span class="cart_quantity">{{$Cwhishs}}</span>
                                    <!--mini cart-->
                                     <div class="mini_cart">
                                       @foreach ($whishs as $whish)

                                        <div class="cart_item">
                                          <a href="lol.html">
                                            <div class="cart_info">
                                                <a href="#"> <b>Marque :</b>  {{ $whish->marque }}</a>

                                                <span class="quantity"><b>Pièce :</b>{{ $whish->desPieace }}</span>
                                                <span class="price_cart"><b>Prix :</b>{{ $whish->prix }} MAD</span>

                                            </div>
                                            </a>
                                            <div class="cart_remove">
                                                <a href="#"> <span class="lnr lnr-magnifier"></span> </a>
                                            </div>
                                        </div>

                                        @endforeach


                                        @if (Auth::check())
                                        <div class="mini_cart_footer">
                                           <div class="cart_button">
                                                <a href="{{ url('/profil') }}">Afficher la liste</a>
                                            </div>


                                        </div>
                                        @else
                                        <div class="">
                                          vous devez vous connecter
                                        </div>

                                        @endif



                                    </div>
                                    <!--mini cart end-->
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!--header middel end-->
        <!--header bottom satrt-->
        <div class="header_bottom bottom_two sticky-header">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-12">
                        <div class="header_bottom_container">




                            <div class="main_menu">
                                 <nav>
                                 <ul>







                                     <li class="mega_items"><a href="">Direction / Suspension / Train<i class="fa fa-angle-down"></i></a>
                                        <div class="mega_menu">
                                            <ul class="mega_menu_inner">
                                                <li><a href="#"></a>
                                                    <ul>
                                                        @for ($i = 0; $i < 4; $i++)
                                                            <li><a href="{{url('annonces/Direction-Suspension-Train',$direction_list[$i]->desSousCat) }}" >{{$direction_list[$i]->desSousCat}}</a></li>
                                                        @endfor
                                                    </ul>
                                                </li>
                                                <li><a href="#"></a>
                                                    <ul>
                                                        @for ($i = 4; $i < 8  ; $i++)
                                                            <li><a href="{{url('annonces/Direction-Suspension-Train',$direction_list[$i]->desSousCat) }}">{{$direction_list[$i]->desSousCat}}</a></li>
                                                        @endfor
                                                    </ul>
                                                </li>
                                                <li><a href="#"></a>
                                                    <ul>
                                                        @for ($i = 8; $i < 12  ; $i++)
                                                            <li><a href="{{url('annonces/Direction-Suspension-Train',$direction_list[$i]->desSousCat) }}">{{$direction_list[$i]->desSousCat}}</a></li>
                                                        @endfor
                                                    </ul>
                                                </li>
                                                <li><a href="#"></a>
                                                    <ul>
                                                        @for ($i = 12; $i < 14  ; $i++)
                                                            <li><a href="{{url('annonces/Direction-Suspension-Train',$direction_list[$i]->desSousCat) }}">{{$direction_list[$i]->desSousCat}}</a></li>
                                                        @endfor
                                                    </ul>
                                                </li>



                                            </ul>
                                            <div class="banner_static_menu">
                                                <a href="shop.html"><img src="{{ URL::asset('assets/img/bg/banner1.jpg')}}"  alt=""></a>

                                            </div>
                                        </div>
                                    </li>
                                   <li class="mega_items"><a href="shop.html">Pièces moteur<i class="fa fa-angle-down"></i></a>
                                        <div class="mega_menu">
                                            <ul class="mega_menu_inner">
                                                <li><a href="#"></a>
                                                    <ul>
                                                        @for ($i = 0; $i < 4; $i++)
                                                            <li><a href="{{url('annonces/pieces moteur',$pmoteur_list[$i]->desSousCat) }}">{{$pmoteur_list[$i]->desSousCat}}</a></li>
                                                        @endfor
                                                    </ul>
                                                </li>
                                                <li><a href="#"></a>
                                                    <ul>
                                                        @for ($i = 4; $i < 8  ; $i++)
                                                            <li><a href="{{url('annonces/pieces moteur',$pmoteur_list[$i]->desSousCat) }}">{{$pmoteur_list[$i]->desSousCat}}</a></li>
                                                        @endfor
                                                    </ul>
                                                </li>
                                                <li><a href="#"></a>
                                                    <ul>
                                                        @for ($i = 8; $i < 13  ; $i++)
                                                            <li><a href="{{url('annonces/pieces moteur',$pmoteur_list[$i]->desSousCat) }}">{{$pmoteur_list[$i]->desSousCat}}</a></li>
                                                        @endfor
                                                    </ul>
                                                </li>




                                            </ul>
                                            <div class="banner_static_menu">
                                                <a href="shop.html"><img src="assets/img/bg/banner1.jpg" alt=""></a>
                                            </div>
                                        </div>
                                    </li>
                                    <li><a href="blog.html">visibilité<i class="fa fa-angle-down"></i></a>
                                        <ul class="sub_menu pages">

                                            @foreach ($visibilite_list as $visibl)
                                                  <li><a href="{{url('annonces/visibilte',$visibl->desSousCat) }}">{{$visibl->desSousCat}}</a></li>
                                            @endforeach
                                        </ul>
                                    </li>
                                    <li><a href="#">freinage <i class="fa fa-angle-down"></i></a>
                                        <ul class="sub_menu pages">
                                          @foreach ($frienage_list as $visibl)
                                                <li><a href="{{url('annonces/Freinage',$visibl->desSousCat) }}">{{$visibl->desSousCat}}</a></li>
                                          @endforeach
                                        </ul>
                                    </li>


                                    <li><a href="{{url('annonces/Contact') }}"> Contact Us</a></li>
                                </ul>
                            </nav>
                            </div>
                        </div>

                    </div>

                </div>
            </div>
        </div>
        <!--header bottom end-->

    </header>
    <!--Offcanvas menu area start-->
       <div class="Offcanvas_menu">
           <div class="container">
               <div class="row">
                   <div class="col-12">
                       <div class="canvas_open">
                           <span>MENU</span>
                           <a href="javascript:void(0)"><i class="ion-navicon"></i></a>
                       </div>
                       <div class="Offcanvas_menu_wrapper">

                           <div class="canvas_close">
                                 <a href="#"><i class="ion-navicon"></i></a>
                           </div>


                           <div class="top_right text-right">
                             <style>

</style>
                               <ul>
                                 @guest



                                     <li class="nav-item" >
                                         <a style="border-right: 1px solid grey;" class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                                     </li>


                                     @if (Route::has('register'))

                                         <li class="nav-item">
                                             <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                                         </li>
                                     @endif
                                 @else

                                     <li class="nav-item dropdown">
                                         <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                             {{ Auth::user()->name }} <span class="caret"></span>
                                         </a>

                                         <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                             <a class="dropdown-item" href="{{ url('/profil') }}">Mon profil </a>
                                             <a class="dropdown-item" href="{{ route('logout') }}"
                                                onclick="event.preventDefault();
                                                              document.getElementById('logout-form').submit();">
                                                 {{ __('Logout') }}
                                             </a>



                                             <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                                 @csrf
                                             </form>
                                         </div>

                                     </li>
                                 @endguest

                                    </li>




                               </ul>
                           </div>
                           <div class="Offcanvas_follow">
                               <label>Follow Us:</label>
                               <ul class="follow_link">
                                   <li><a href="#"><i class="ion-social-facebook"></i></a></li>
                                   <li><a href="#"><i class="ion-social-twitter"></i></a></li>
                                   <li><a href="#"><i class="ion-social-googleplus"></i></a></li>
                                   <li><a href="#"><i class="ion-social-youtube"></i></a></li>
                               </ul>
                           </div>
                           <div class="search-container">

                               <a style="border-radius: 0px;" class="btn btn-dark btn-lg" href="{{url('annonces/create') }}"  role="button">Déposer une annonce </a>


                           </div>
                           <div id="menu" class="text-left ">
                                <ul>





                                   <li><a href="">Direction / Suspension / Train</a>
                                       <ul class="sub_menu">
                                         @foreach ($direction_list as $direction)

                                              <li><a href="{{url('annonces/Direction-Suspension-Train',$direction->desSousCat) }}">{{ $direction->desSousCat }}</a></li>
                                          @endforeach

                                       </ul>
                                   </li>


                                   <li><a href="index.html">Pièces moteur</a>
                                       <ul class="sub_menu">


                                         @foreach ($pmoteur_list as $pmoteur)

                                              <li><a href="{{url('annonces/pieces moteur',$pmoteur->desSousCat) }}">{{ $pmoteur->desSousCat }}</a></li>
                                          @endforeach

                                       </ul>
                                   </li>

                                   <li><a href="index.html">visibilité</a>
                                       <ul class="sub_menu">



                                         @foreach ($visibilite_list as $visibl)

                                              <li><a href="{{url('annonces/visibilte',$visibl->desSousCat) }}">{{ $visibl->desSousCat }}</a></li>
                                          @endforeach

                                       </ul>
                                   </li>


                                  <li><a href="index.html">freinage</a>
                                      <ul class="sub_menu">



                                        @foreach ($frienage_list as $frienage)

                                             <li><a href="{{url('annonces/Freinage',$visibl->desSousCat) }}">{{ $frienage->desSousCat }}</a></li>
                                         @endforeach

                                      </ul>
                                  </li>


                                   <!-- <li><a href="about.html">about Us</a></li> -->
                                   <li><a href="{{url('annonces/Contact') }}"> Contact Us</a></li>
                               </ul>
                           </div>
                       </div>
                   </div>
               </div>
           </div>

       </div>
   <!--Offcanvas menu area end-->



        <main class="py-4">
            @yield('content')

      </main>
    </div>
    <section class="call_to_action">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="call_action_inner">
                        <div class="call_text">
                            <h3>Notre  <span>mission </span> est de vous facilite la vie</h3>
                            <p>Trouvez les pièces de votre véhicule facilement</p>
                        </div>
                        <div class="discover_now">
                            <a href="{{url('annances')}}">Trouvez maintenant</a>
                        </div>
                        <div class="link_follow">
                            <ul>
                                <li><a href="#"><i class="ion-social-facebook"></i></a></li>
                                <li><a href="#"><i class="ion-social-twitter"></i></a></li>
                                <li><a href="#"><i class="ion-social-googleplus"></i></a></li>
                                <li><a href="#"><i class="ion-social-youtube"></i></a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <footer class="footer_widgets">
        <div class="container">
            <div class="footer_top">
                <div class="row">
                    <div class="col-lg-4 col-md-6">
                        <div class="widgets_container contact_us">
                            <div class="footer_logo">
                                <a href="#"><img src="assets/img/logo/logo.png" alt=""></a>
                            </div>
                            <div class="footer_contact">
                                <p>Nous sommes une équipe de ...</p>
                                <p><span>Address</span> 188,rue ben barka lot Erraja 2éme Etage -ben Ahmed</p>
                                <p><span>besoin d'aide?</span>Call: 0613612796 OR:0662132296</p>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-4 col-md-6">
                       <div class="widgets_container">
                            <p>Copyright &copy; 2019 <a href="#">THE DEVE</a>  All Right Reserved.</p>

                        </div>
                    </div>
                </div>
            </div>

        </div>
    </footer>



<script src="{{asset('assets/js/bootstrap.min.js')}}"></script>
<script src="{{asset('assets/js/jquery.min.js')}}"></script>

 <script>
$(document).ready(function(){

 $('.dynamic').change(function(){
  if($(this).val() != '')
  {
        var select = $(this).attr('id');
        var value = $(this).val();
        var dependent = $(this).data('dependent');

        var _token = $('input[name="_token"]').val();
    // alert(_token + ' '+ value + ' '+select+ ' ' + dependent ); //9 sousCategories piece 7 catigorie_idCat sousCategories

    $.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});
    $.ajax({
        url:"{{ route('annancecontroller.fetch') }}",
        method:"POST",
        data:{select:select , _token:_token , 'value':value , 'dependent':dependent},

        success:function(result)
        {
            // alert(result.test + 'oui ***'+result.output);
         $('#'+dependent).html(result.output);
         $('#change').html(result.test);

        },
        error:function(){
        alert("error!!!!");
    }


    })



    }
    });

 $('#marque').change(function(){
  $('#module').val('');
  $('#motorisation').val('');
 });

 $('#marque').change(function(){
  $('#module').val('');
 });


});
</script>

<!-- JS
============================================ -->

<!-- Plugins JS -->


<script type="text/javascript" src="{{asset('assets/js/plugins.js')}}">

</script>

<!-- Main JS -->
<script src="{{asset('assets/js/main.js')}}"></script>
<!-- <script src="https://unpkg.com/ionicons@4.2.2/dist/ionicons.js"></script> -->


    <!-- <script src="https://cdn.linearicons.com/free/1.0.0/svgembedder.min.js"></script> -->





  </body>
  </html>
