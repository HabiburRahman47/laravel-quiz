<!DOCTYPE html>
<html lang="en">
<head>
  <title>We Connect</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
  <style>
  .fakeimg {
    height: 200px;
    background: #aaa;
  }
    .carousel-inner img {
      width: 100%; /* Set width to 100% */
      min-height: 200px;
    }

    /* Hide the carousel text when the screen is less than 600 pixels wide */
    @media (max-width: 600px) {
      .carousel-caption {
        display: none; 
      }
    }
     body {
  background: #eeeded;
}

.card {
  box-shadow: 0 1px 3px rgba(0,0,0,0.12), 0 1px 2px rgba(0,0,0,0.24);
  transition: all 0.2s ease-in-out;
  box-sizing: border-box;
  margin-top:10px;
  margin-bottom:10px;
  background-color:#FFF;
}

.card:hover {
  box-shadow: 0 5px 5px rgba(0,0,0,0.19), 0 6px 6px rgba(0,0,0,0.23);
}
.card > .card-inner {
  padding:10px;
}
.card .header h2, h3 {
  margin-bottom: 0px;
  margin-top:0px;
}
.card .header {
  margin-bottom:5px;
}
.card img{
  width:100%;
}
  </style>
</head>
<body>
<nav class="navbar navbar-expand-sm bg-dark navbar-dark">
  <a class="navbar-brand" href="#">We Connect</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#collapsibleNavbar">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse" id="collapsibleNavbar">
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" href="#">Properties</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="#">Link</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="#">Link</a>
      </li>    
    </ul>
  </div>  
</nav>
<div class="container-fluid">
    <h2 class="text-center">List of Category</h2><br>
  <hr>
    <div class="row">
        
              @foreach($categories as $category)
              <div class="col-md-3 col-sm-6">
                  <div class="card card-block text-center p-3">
                     <img src="https://via.placeholder.com/400" alt="Photo of sunset">
                      <h5 class="card-title mt-3 mb-3">
                      <a href="{{ route('category.show',$category->id) }}">
                         {{ $category->name }}
                      </a>
                        </h5>
                  </div>
              </div>
              @endforeach
                
         
    </div>
</div>
<div class="jumbotron text-center bg-dark" style="margin-bottom:0">
  <p>Footer</p>
</div>

</body>
</html>
