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
     /* img{
        height:150px;
        width:100%;
      } */

        div [class^="col-"]{
          padding-left:5px;
          padding-right:5px;
        }
        .card{
          transition:0.5s;
          cursor:pointer;
        }
        .card-title{  
          font-size:15px;
          transition:1s;
          cursor:pointer;
        }

        .card:hover{
          transform: scale(1.05);
          box-shadow: 10px 10px 15px rgba(0,0,0,0.3);
        }
        .card-text{
          height:80px;  
        }

        .card::before, .card::after {
          position: absolute;
          top: 0;
          right: 0;
          bottom: 0;
          left: 0;
          transform: scale3d(0, 0, 1);
          transition: transform .3s ease-out 0s;
          background: rgba(255, 255, 255, 0.1);
          content: '';
          pointer-events: none;
        }
        .card::before {
          transform-origin: left top;
        }
        .card::after {
          transform-origin: right bottom;
        }
        .card:hover::before, .card:hover::after, .card:focus::before, .card:focus::after {
          transform: scale3d(1, 1, 1);
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
<div class="container p-3">
     <div class="row">
        <div class="col-sm-5">
            <h3>Previous Quiz Result</h3>
            <table class="table">
                <thead>
                  <tr>
                    <th>No</th>
                    <th>Quiz Name</th>
                    <th>Total Question</th>
                    <th>Total Right Answer</th>
                    <th>Status</th>
                    <th>Action</th>
                  </tr>
                </thead>
                <tbody>
                  <tr>
                    @foreach ($quizSessions as $key=>$item)
                         <td>{{ $key+1 }}</td>
                        <td>{{ $item->quiz_name }}</td>
                        @if($item->status==0)
                         <td>{{ $item->result->total_question }}</td>
                         <td>{{ $item->result->total_right_ans }}</td>
                         <td>{{ $item->status }}</td>
                        @else
                         @php
                          $total_question=0;
                          $total_right_ans=0;                             
                         @endphp
                         <td>{{ $total_question }}</td>
                         <td>{{ $total_right_ans }}</td>
                         <td>{{ $item->status }}</td>
                         <td><a href="#" class="btn btn-success">Start Again</a></td>
                        @endif
                        
                        <td></td>
                        </tr>                       
                    @endforeach
                  
                </tbody>
             </table>
        </div>
        <div class="col-sm-2">
          
        </div>
    </div>
</div>

<div class="jumbotron text-center" style="margin-bottom:0">
  <p>Footer</p>
</div>

</body>
</html>
