@extends('layouts.master')



@section('content')
<style media="screen">
/* The grid: Four equal columns that floats next to each other */
.column {
float: left;
width: 25%;
padding: 10px;
}

/* Style the images inside the grid */
.column img {
opacity: 0.8;
cursor: pointer;
}

.column img:hover {
opacity: 1;
}

/* Clear floats after the columns */
.row:after {
content: "";
display: table;
clear: both;
}

/* The expanding image container (positioning is needed to position the close button and the text) */
.container {
position: relative;
display: none;
}

/* Expanding image text */
#imgtext {
position: absolute;
bottom: 15px;
left: 15px;
color: white;
font-size: 20px;
}

/* Closable button inside the image */
.closebtn {
position: absolute;
top: 10px;
right: 15px;
color: white;
font-size: 35px;
cursor: pointer;
}
.info{
  color:#fff;
  border-bottom-style: solid;
   border-color: #8b92a9;
  border-right-style: solid;
  border-width: 1px;
}
</style>
<div class="content" id="a">
  <div class="container-fluid">
    <div class="row">
      <div class="col-md-8">
        <div class="card">
          <div class="card-header card-header-primary">
            <h4 class="card-title">Edit Profile</h4>
            <p class="card-category">Complete your profile</p>
          </div>
          <div class="card-body">
            <div class="row">

          <div class="col-lg-12 col-sm-12">
            <div class="tim-typo">
              <h3>
                <span class="tim-note">Description de l'annonce:</span></h3>
            </div>
          <div style="color:#fff;margin-bottom:15px" class="">
          @{{annonces.commentaire}}.
          </div>
          </div>


               <div class="col-lg-6 col-sm-12">
                 <div class="tim-typo">
                   <h3><span class="tim-note">Général</span></h3>
                 </div>
                 <div class="tim-typo">
                   <h4><span class="tim-note">Etat:</span></h4>
                 </div>
                 <div  v-if="annonces.approve=='non'" class="info">
                 ala
                 </div>


                 <div class="tim-typo">
                   <h4><span class="tim-note">Nom:</span></h4>
                 </div>
                 <div  class="info">
                 @{{annonces.nom}}.
                 </div>

                 <div class="tim-typo">
                   <h4><span class="tim-note">Prix:</span></h4>
                 </div>
                 <div  class="info">
                 @{{annonces.prix}}.
                 </div>
                 <div class="tim-typo">
                   <h4><span class="tim-note">Téléphone:</span></h4>
                 </div>
                 <div  class="info">
                 @{{annonces.telephone}}.
                 </div>
                 <div class="tim-typo">
                   <h4><span class="tim-note">Date de création:</span></h4>
                 </div>
                 <div  class="info">
                 @{{annonces.created_at}}.
                 </div>
                 <div class="tim-typo">
                   <h4><span class="tim-note">Date de création:</span></h4>
                 </div>
                 <div  class="info">
                 @{{annonces.updated_at}}.
                 </div>





               </div>

               <div class="col-lg-6 col-sm-12">
                 <div class="tim-typo">
                   <h3><span class="tim-note">Infos sur la piece</span></h3>
                 </div>
                 <div class="tim-typo">
                   <h4><span class="tim-note">Pièce:</span></h4>
                 </div>
                 <div  class="info">
                 @{{annonces.desPieace}}.
                 </div>


                 <div class="tim-typo">
                   <h4><span class="tim-note">Sous catégorie:</span></h4>
                 </div>
                 <div class="info" >
                 @{{annonces.desSousCat}}.
                 </div>

                 <div class="tim-typo">
                   <h4><span class="tim-note">Catégorie:</span></h4>
                 </div>
                 <div  class="info">
                 @{{annonces.desCat}}.
                 </div>


                 <div class="tim-typo">
                   <h4><span class="tim-note">Marque:</span></h4>
                 </div>
                 <div  class="info">
                 @{{annonces.marque}}.
                 </div>
                 <div class="tim-typo">
                   <h4><span class="tim-note">Module:</span></h4>
                 </div>
                 <div  class="info">
                 @{{annonces.module}}.
                 </div>
                 <div class="tim-typo">
                   <h4><span class="tim-note">Motorisation:</span></h4>
                 </div>
                 <div  class="info">
                 @{{annonces.motorisation}}.
                 </div>





               </div>

            </div>

              <div class="row">


                <div class="row">
                  <div class="column" v-for="image in images">
                    <img :src="'../../storage/'+image.nameImage"  onclick="myFunction(this);">
                  </div>
                </div>

                <!-- The expanding image container -->
                <div class="container">
                  <!-- Close the image -->
                  <span onclick="this.parentElement.style.display='none'" class="closebtn">&times;</span>

                  <!-- Expanded image -->
                  <img id="expandedImg" style="width:100%">

                  <!-- Image text -->
                  <div id="imgtext"></div>
                </div>
              </div>


              <div class="clearfix"></div>

          </div>
        </div>
      </div>


      <div class="col-md-4">
        <div class="card card-profile">
          <div class="card-avatar">

          </div>
          <div class="card-body">
            <h6 class="card-category">CEO / Co-Founder</h6>
            <h4 class="card-title">Alec Thompson</h4>
            <p class="card-description">
              Don't be scared of the truth because we need to restart the human foundation in truth And I love you like Kanye loves Kanye I love Rick Owens’ bed design but the back is...
            </p>
            <a href="#pablo" class="btn btn-primary btn-round">Follow</a>
          </div>
        </div>
      </div>



    </div>
  </div>
</div>
<script type="text/javascript">
function myFunction(imgs) {
// Get the expanded image
var expandImg = document.getElementById("expandedImg");
// Get the image text
var imgText = document.getElementById("imgtext");
// Use the same src in the expanded image as the image being clicked on from the grid
expandImg.src = imgs.src;
// Use the value of the alt attribute of the clickable image as text inside the expanded image
imgText.innerHTML = imgs.alt;
// Show the container element (hidden with CSS)
expandImg.parentElement.style.display = "block";
}
</script>

<script>
  Vue.use(VeeValidate);
</script>
<script type="text/javascript">
  var a = new Vue({
    el:'#a',
    data:{
      id: {!! json_encode($num) !!},
      annonces:{},
      images:[],
    },
    methods:{

      getAnnonce:function(){
        axios.get("http://127.0.0.1:8000/getannonceForEdite/"+this.id)
        .then(response=>{
          this.annonces=response.data.annances;
          this.images=response.data.image;
          console.log('succes',response);
        })
        .catch(error=>{
          console.log('error',error);
        })
      },







    },
    created:function(){
      this.getAnnonce();

    }
  });
</script>
@endsection
