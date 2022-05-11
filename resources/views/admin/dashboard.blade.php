<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>admin dashboard</title>
        <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.2/css/all.min.css" rel="stylesheet" id="bootstrap-css">
        <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
        <script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
        <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script> 

        <!-- Styles -->
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
    </head>
    <body>
       
<nav class="navbar navbar-expand-lg navbar-dark bg-primary">
  <a class="navbar-brand" href="#">User Manager</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="nav navbar-nav menu">
      <li class="nav-item">
        <a class="nav-link active" href="javascript::void(0)">User <span class="sr-only">(current)</span></a>
      </li>
      <!--
      <li class="nav-item">
        <a class="nav-link" href="#.">Orders</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="#.">About</a>
      </li>-->
      <li class="nav-item">
        <a class="nav-link"  href="{{route('meezzaa_admin_logout')}}" >Logout</a>
      </li>
    </ul>
  </div>
</nav>
        
        
<div class="container">
    <?php if(isset($FrontUser) && $FrontUser): ?>
        <form method="post" action="{{route('meezzaa_admin_user_updation',$FrontUser->id)}}">
    <?php else: ?>
    <form method="post" action="{{route('meezzaa_admin_user_creation')}}">
    <?php endif; ?>
        @csrf
   <br/><br/>
    <div class="row">
        <div class="col-md-12">
                    @if(Session::has('flash-success-message'))
                    <div class="alert bg-success text-white alert-styled-left alert-dismissible" style="background-color: #009688 !important;">
                        <button type="button" class="close" data-dismiss="alert"><span>×</span></button>
                        <span class="font-weight-semibold">Well done!</span> {!! Session::get('flash-success-message')!!}
                    </div> 
                    @endif

                    @if(Session::has('flash-error-message')) 
                    <div class="alert bg-danger text-white alert-styled-left alert-dismissible">
                        <button type="button" class="close" data-dismiss="alert"><span>×</span></button>
                        <span class="font-weight-semibold">Oh snap!</span> {!! Session::get('flash-error-message') !!}.
                    </div>
                    @endif
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group mb-3">
                                <label for="name">Name <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" id="name" placeholder="name" name="name" value="{{(isset($FrontUser->name) && $FrontUser) ? $FrontUser->name : old('name')}}"  >
                                @if($errors->has('name'))
                                <div class="invalid-feedback" style="display: block">{{ $errors->first('name') }}</div>
                                @endif
                            </div> 
                        </div>
                        <div class="col-md-4">
                            <div class="form-group mb-3">
                                <label for="email">Email <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" id="email" placeholder="email" name="email" value="{{(isset($FrontUser->email) && $FrontUser) ? $FrontUser->email : old('email')}} ">
                                @if($errors->has('email'))
                                    <div class="invalid-feedback" style="display: block">{{ $errors->first('email') }}</div>
                                @endif
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group mb-3">
                                <label for="password">Password <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" id="password" placeholder="password" name="password"  >
                                @if($errors->has('password'))
                                    <div class="invalid-feedback" style="display: block">{{ $errors->first('password') }}</div>
                                @endif
                            </div>
                        </div> 
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <button type="submit"  style="float: right" class="btn btn-primary mr-1 waves-effect waves-light pull-right">Submit </button>
                        </div>
                    </div>

                </div>
            </div> 
        </div>
    </div>
    </form>
    
    
    <br/><br/>
    <style>
        
        .table-bordered {
border: 1px solid #dddddd;
border-collapse: separate;
border-left: 0;
-webkit-border-radius: 4px;
-moz-border-radius: 4px;
border-radius: 4px;
}

.table {
width: 100%;
margin-bottom: 20px;
background-color: transparent;
border-collapse: collapse;
border-spacing: 0;
display: table;
}

.widget.widget-table .table {
margin-bottom: 0;
border: none;
}

.widget.widget-table .widget-content {
padding: 0;
}

.widget .widget-header + .widget-content {
border-top: none;
-webkit-border-top-left-radius: 0;
-webkit-border-top-right-radius: 0;
-moz-border-radius-topleft: 0;
-moz-border-radius-topright: 0;
border-top-left-radius: 0;
border-top-right-radius: 0;
}

.widget .widget-content {
padding: 20px 15px 15px;
background: #FFF;
border: 1px solid #D5D5D5;
-moz-border-radius: 5px;
-webkit-border-radius: 5px;
border-radius: 5px;
}

.widget .widget-header {
position: relative;
height: 40px;
line-height: 40px;
background: #E9E9E9;
background: -moz-linear-gradient(top, #fafafa 0%, #e9e9e9 100%);
background: -webkit-gradient(linear, left top, left bottom, color-stop(0%, #fafafa), color-stop(100%, #e9e9e9));
background: -webkit-linear-gradient(top, #fafafa 0%, #e9e9e9 100%);
background: -o-linear-gradient(top, #fafafa 0%, #e9e9e9 100%);
background: -ms-linear-gradient(top, #fafafa 0%, #e9e9e9 100%);
background: linear-gradient(top, #fafafa 0%, #e9e9e9 100%);
text-shadow: 0 1px 0 #fff;
border-radius: 5px 5px 0 0;
box-shadow: 0 2px 5px rgba(0,0,0,0.1),inset 0 1px 0 white,inset 0 -1px 0 rgba(255,255,255,0.7);
border-bottom: 1px solid #bababa;
filter: progid:DXImageTransform.Microsoft.gradient(startColorstr='#FAFAFA', endColorstr='#E9E9E9');
-ms-filter: "progid:DXImageTransform.Microsoft.gradient(startColorstr='#FAFAFA', endColorstr='#E9E9E9')";
border: 1px solid #D5D5D5;
-webkit-border-top-left-radius: 4px;
-webkit-border-top-right-radius: 4px;
-moz-border-radius-topleft: 4px;
-moz-border-radius-topright: 4px;
border-top-left-radius: 4px;
border-top-right-radius: 4px;
-webkit-background-clip: padding-box;
}

thead {
display: table-header-group;
vertical-align: middle;
border-color: inherit;
}

.widget .widget-header h3 {
top: 2px;
position: relative;
left: 10px;
display: inline-block;
margin-right: 3em;
font-size: 14px;
font-weight: 600;
color: #555;
line-height: 18px;
text-shadow: 1px 1px 2px rgba(255, 255, 255, 0.5);
}

.widget .widget-header [class^="icon-"], .widget .widget-header [class*=" icon-"] {
display: inline-block;
margin-left: 13px;
margin-right: -2px;
font-size: 16px;
color: #555;
vertical-align: middle;
}
    </style>
    
    
    
    
    
    
    <div class="span7">   
        <div class="widget stacked widget-table action-table">

            <div class="widget-header">
                <i class="fas fa-list icon-th-list"></i>
                <h3>Mebers</h3>
            </div>  

            <div class="widget-content">

                <table class="table table-striped table-bordered">
                    <thead>
                        <tr>
                                <th>Name</th>
                                <th>email</th>
                                <th class="td-actions">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $FrontUser =\App\FrontUser::OrderBy('id','desc')->get(); ?>
                        <?php if($FrontUser->isNotEmpty()):
                            foreach ($FrontUser as $key => $value) :
                            ?>
                         <tr>
                            <td>{{$value->name}}</td>
                            <td>{{$value->email}}</td>
                            <td class="td-actions">
                                    <a href="{{route('meezzaa_admin_dashboard')}}?mem_id={{$value->id}}" class="btn btn-small btn-primary">
                                        <i class="fas fa-edit"></i>									
                                    </a>

                                    <a href="{{route('meezzaa_admin_user_deletion',$value->id)}}"  onclick="return confirm('Are you sure you want to delete this item?');" class="btn btn-small">
                                        <i class="fas fa-trash-alt"></i>										
                                    </a>
                            </td>
                            </tr>
                            <?php
                            endforeach;
                        endif; ?>
                         
                    </tbody>
                </table>

            </div>  

        </div> 
    </div>
    
    
    <script>
    function show_alert() {
  if(!confirm("Do you really want to do this?")) {
    return false;
  }
  this.form.submit();
}
    </script>
    
</div>
        

        
        
    </body>
</html>
