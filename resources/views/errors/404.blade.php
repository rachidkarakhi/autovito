@extends('layouts.app')



@section('content')
<div>
  <!--error section area start-->
 <div class="error_section">
     <div class="container">
         <div class="row">
             <div class="col-12">
                 <div class="error_form">
                     <h1>404</h1>
                     <h2>Opps! PAGE INTROUVABLE</h2>
                     <!-- <p>Sorry but the page you are looking for does not exist, have been<br> removed, name changed or is temporarity unavailable.</p> -->

                     <a href="{{ url('/') }}">Retour à l'accueil</a>
                 </div>
             </div>
         </div>
     </div>
 </div>
 <!--error section area end-->
</div>
@endsection
