<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Login to meezzaa-admin</title>

        <link href="//netdna.bootstrapcdn.com/bootstrap/3.0.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
        <script src="//netdna.bootstrapcdn.com/bootstrap/3.0.0/js/bootstrap.min.js"></script>
        <script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
       

        <!-- Styles -->
        <style>
            .white{
    color:#000;
    background-color:#fff;
}

.btn-facebook {
    color: #ffffff;
    -webkit-text-shadow: 0 -1px 0 rgba(0, 0, 0, 0.25);
    text-shadow: 0 -1px 0 rgba(0, 0, 0, 0.25);
    background-color: #2b4b90;
    *background-color: #133783;
    background-image: -moz-linear-gradient(top, #3b5998, #133783);
    background-image: -webkit-gradient(linear, 0 0, 0 100%, from(#3b5998), to(#133783));
    background-image: -webkit-linear-gradient(top, #3b5998, #133783);
    background-image: -o-linear-gradient(top, #3b5998, #133783);
    background-image: linear-gradient(to bottom, #3b5998, #133783);
    background-repeat: repeat-x;
    border-color: #133783 #133783 #091b40;
    border-color: rgba(0, 0, 0, 0.1) rgba(0, 0, 0, 0.1) rgba(0, 0, 0, 0.25);
    filter: progid:DXImageTransform.Microsoft.gradient(startColorstr='#ff3b5998', endColorstr='#ff133783', GradientType=0);
    filter: progid:DXImageTransform.Microsoft.gradient(enabled=false);
}

    .btn-facebook:hover,
    .btn-facebook:focus,
    .btn-facebook:active,
    .btn-facebook.active,
    .btn-facebook.disabled,
    .btn-facebook[disabled] {
        color: #ffffff;
        background-color: #133783 !important;
        *background-color: #102e6d !important;
    }

    .btn-facebook:active,
    .btn-facebook.active {
        background-color: #0d2456 \9 !important;
    }
    .parsley-required{color: red;font-size: 12px}
    .AbsoluteCenter { margin: auto; position: absolute;  max-height: 350px; top: 0; left: 0; bottom: 0; right: 0; }
        </style>
    </head>
    <body>
 
<div class="AbsoluteCenter">
    <div class="container">
    <div class="row">
    	<div class="col-md-4 col-md-offset-4">
    		<div class="panel panel-default">
			  	<div class="panel-heading">
			    	<h3 class="panel-title">Login to site</h3>
			 	</div>
			  	<div class="panel-body">
                                    <form accept-charset="UTF-8" role="form" action="{{route('meezzaa_admin_login')}}" method="post" >
                                    @csrf
                                    <fieldset>
			    	  	<div class="form-group">
			    		    <input class="form-control" placeholder="email" name="email" type="text">
                                            @error('email')
                                            <span class="parsley-required" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror
			    		</div>
			    		<div class="form-group">
                                            <input class="form-control" placeholder="Password" name="password" type="password" value="">
                                            @error('password')
                                            <span class="parsley-required" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror
			    		</div>
			    		
			    		<input class="btn btn-lg btn-success btn-block" type="submit" value="Login">
                                    </fieldset>
                                    @if($errors->has('message'))
                                        <span class="parsley-required" role="alert">
                                                <strong>
                                                {{ $errors->first('message') }}</strong>
                                            </span>
                                    @endif
			      	</form>
                      
                
                    
			    </div>
			</div>
		</div>
	</div>
</div>
    </div>
    </body>
</html>
