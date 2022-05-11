<!DOCTYPE html>
<html>
<head>
    <title>Import  Data</title>
    @include('member.head')
     <style>
          
.funkyradio div {
  clear: both;
  overflow: hidden;
}

.funkyradio label {
  width: 50%;
  border-radius: 3px;
  border: 1px solid #D1D3D4;
  font-weight: normal;
}

.funkyradio input[type="radio"]:empty,
.funkyradio input[type="checkbox"]:empty {
  display: none;
}

.funkyradio input[type="radio"]:empty ~ label,
.funkyradio input[type="checkbox"]:empty ~ label {
  position: relative;
  line-height: 1.5em;
  text-indent: 3.25em;
  margin-top: 1em;
  cursor: pointer;
  -webkit-user-select: none;
     -moz-user-select: none;
      -ms-user-select: none;
          user-select: none;
}

.funkyradio input[type="radio"]:empty ~ label:before,
.funkyradio input[type="checkbox"]:empty ~ label:before {
  position: absolute;
  display: block;
  top: 0;
  bottom: 0;
  left: 0;
  content: '';
  width: 2.5em;
  background: #D1D3D4;
  border-radius: 3px 0 0 3px;
}

.funkyradio input[type="radio"]:hover:not(:checked) ~ label,
.funkyradio input[type="checkbox"]:hover:not(:checked) ~ label {
  color: #888;
}

.funkyradio input[type="radio"]:hover:not(:checked) ~ label:before,
.funkyradio input[type="checkbox"]:hover:not(:checked) ~ label:before {
  content: '\2714';
  text-indent: .9em;
  color: #C2C2C2;
}

.funkyradio input[type="radio"]:checked ~ label,
.funkyradio input[type="checkbox"]:checked ~ label {
  color: #777;
}

.funkyradio input[type="radio"]:checked ~ label:before,
.funkyradio input[type="checkbox"]:checked ~ label:before {
  content: '\2714';
  text-indent: .9em;
  color: #333;
  background-color: #ccc;
}

.funkyradio input[type="radio"]:focus ~ label:before,
.funkyradio input[type="checkbox"]:focus ~ label:before {
  box-shadow: 0 0 0 3px #999;
}

.funkyradio-default input[type="radio"]:checked ~ label:before,
.funkyradio-default input[type="checkbox"]:checked ~ label:before {
  color: #333;
  background-color: #ccc;
}

.funkyradio-primary input[type="radio"]:checked ~ label:before,
.funkyradio-primary input[type="checkbox"]:checked ~ label:before {
  color: #fff;
  background-color: #337ab7;
}

.funkyradio-success input[type="radio"]:checked ~ label:before,
.funkyradio-success input[type="checkbox"]:checked ~ label:before {
  color: #fff;
  background-color: #5cb85c;
}

.funkyradio-danger input[type="radio"]:checked ~ label:before,
.funkyradio-danger input[type="checkbox"]:checked ~ label:before {
  color: #fff;
  background-color: #d9534f;
}

.funkyradio-warning input[type="radio"]:checked ~ label:before,
.funkyradio-warning input[type="checkbox"]:checked ~ label:before {
  color: #fff;
  background-color: #f0ad4e;
}

.funkyradio-info input[type="radio"]:checked ~ label:before,
.funkyradio-info input[type="checkbox"]:checked ~ label:before {
  color: #fff;
  background-color: #5bc0de;
}
 
     </style>
</head>
<body>
   
        
@include('nav')

<div class="container">
    <div class="card bg-light mt-3">
        <div class="card-header">
            Import &nbsp;  
            <div style="float: right">
            <label>Download example</label>
            <a href="{{asset('public/images/example.xlsx')}}" > <img src="public/images/excel.png" style="width:80px" alt=""/></a>
            </div>
        </div>
        
        
@include('member.flash')      
        
   
        
        <div class="card-body">
            <form action="{{ route('import') }}" method="POST" enctype="multipart/form-data">
                {{ csrf_field() }}
                <input type="file" name="file" class="form-control">
                 {!! $errors->first('file', '<p class="alert alert-danger">:message</p>') !!}
                  <br>
                  <div class="row">
                      
                <div class="col-md-4">
                    <h6>Imapge Options</h6>

                    <div class="funkyradio"> 
                        <div class="funkyradio-success">
                            <input type="radio" name="images" value="3" id="radio3"  checked=""/>
                            <label for="radio3">3 Images</label>
                        </div>
                        <div class="funkyradio-success">
                            <input type="radio" name="images"  value="4"id="radio4" />
                            <label for="radio4">4 Images</label>
                        </div>
                        <div class="funkyradio-success">
                            <input type="radio" name="images" value="5" id="radio5" />
                            <label for="radio5">5 Images</label>
                        </div> 
                    </div>
                </div>
                <div class="col-md-4">
                    <h6>Production</h6>

                    <div class="funkyradio"> 
                        <div class="funkyradio-success">
                            <input type="radio" name="production" value="true" id="radio11"  />
                            <label for="radio11">True</label>
                        </div>
                        <div class="funkyradio-success">
                            <input type="radio" name="production"  value="false"id="radio44" checked="" />
                            <label for="radio44">False</label>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <h6>Write Title</h6>

                    <div class="funkyradio"> 
                        <div class="funkyradio-success">
                            <input type="radio" name="WriteTitle" value="true" id="radio111"  />
                            <label for="radio111">Yes</label>
                        </div>
                        <div class="funkyradio-success">
                            <input type="radio" name="WriteTitle"  value="false"id="radio444" checked="" />
                            <label for="radio444">No</label>
                        </div>
                    </div>
                </div>
                
                
                  </div>
                <button  type="submit" class="btn btn-success pull-right" style="float: right">Import Data</button>
                
            </form>
        </div>
    </div>
</div>
    
<!--<div class="container">
    <div class="card bg-light mt-3">
        <div class="card-header">
            Import Operations  
        </div>
     
        
        
               <div class="card">
                <div class="card-body">

                     
                    <table id="datatable"  data-url=''  class="table table-bordered dt-responsive nowrap"
                        style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                        <thead>
                            <tr>
                        
                                <th>Id</th> 
                                <th>Created at</th> 
                                 <th>File</th> 
                                <th>Status</th>
                                <th>Log</th> 
                                <th>Reports</th> 
                            </tr>
                        </thead>


                        
                    </table>

                </div>
            </div>
        
    </div>
</div>-->
</body>
</html>