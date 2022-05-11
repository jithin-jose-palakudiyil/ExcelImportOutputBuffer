<!DOCTYPE html>
<html>
<head>
    <title>Change Password</title>
    @include('member.head')
</head>
<body>
 
 @include('nav')       
 
<div class="container">
    <div class="card bg-light mt-3">
      
    @include('member.flash')   
        
        <div class="card-body">
            <form action="{{ route('change_password_update') }}" method="POST" enctype="multipart/form-data">
                {{ csrf_field() }}
                <label>password</label>
                <input type="text" name="password" class="form-control">
                 {!! $errors->first('file', '<p class="alert alert-danger">:message</p>') !!}
                <br>
              
                <button  type="submit" class="btn btn-success pull-right" style="float: right">submit</button>
                
            </form>
        </div>
    </div>
</div>
    

</body>
</html>