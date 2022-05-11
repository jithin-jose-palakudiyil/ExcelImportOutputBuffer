 <style>
       
.nav-link{
    padding: 8px;
    color: #fff;
    font-weight: 400;
}
.navbar-dark .navbar-nav .nav-link.active, 
.navbar-dark .navbar-nav .show>.nav-link {
    color: #333;
    background-color: #F0F0F0;
    border-radius: 8px;
}
.navbar-dark .navbar-nav .nav-link {
    color: rgba(255,255,255, 1);
}

/*list view Css Starts*/



        </style>
  

<nav class="navbar navbar-expand-lg navbar-dark bg-primary">
  <a class="navbar-brand" href="#">{{\Auth::guard(meezzaa_guard)->user()->name}}</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="nav navbar-nav menu">
<!--      <li class="nav-item">
        <a class="nav-link active" href="javascript::void(0)">Export <span class="sr-only">(current)</span></a>
      </li>-->
      
      <li class="nav-item">
        <a class="nav-link" href="{{route('import_index')}}" >Home </a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="{{route('export_index')}}">Export </a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="{{route('log_index')}}" >Log</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="{{route('change_password')}}" >Change Password</a>
      </li>
      <!--
      <li class="nav-item">
        <a class="nav-link" href="#.">Orders</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="#.">About</a>
      </li>-->
      <li class="nav-item">
        <a class="nav-link"  href="{{route('meezzaa_logout')}}" >Logout</a>
      </li>
    </ul>
  </div>
</nav>