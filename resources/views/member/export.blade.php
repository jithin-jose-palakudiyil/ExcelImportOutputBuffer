<!DOCTYPE html>
<html>
<head>
    <title>Export</title>
    @include('member.head')
</head>
<body>
 
 @include('nav')       
 
<div class="container">
    <div class="card bg-light mt-3">
      
    @include('member.flash')   
       
        <div class="card-body">
            <form action="{{ route('export_save') }}" method="POST" enctype="multipart/form-data" onSubmit="window.location.reload()">
                {{ csrf_field() }}
                <label>File To Export</label>
                <input type="file" name="file" class="form-control">
                 {!! $errors->first('file', '<p class="alert alert-danger">:message</p>') !!}
                 <br/>
                <label>Row Number</label>
                <input type="text" name="row_numer" class="form-control">
                 {!! $errors->first('row_numer', '<p class="alert alert-danger">:message</p>') !!}
                <br>
              
                <button  type="submit" class="btn btn-success pull-right" style="float: right">submit</button>
                
            </form>
        </div>
    </div>
</div>
 <script>
       setInterval(function(){  
if (typeof $.cookie('ExportStarted') === 'undefined'){
 //no cookie

} else {
 //have cookie
window.location.reload();
 $.removeCookie('ExportStarted', { path: '/' });
}
 }, 10);
 </script>
</body>
</html>