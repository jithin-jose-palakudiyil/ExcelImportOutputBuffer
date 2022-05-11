<!DOCTYPE html>
<html>
<head>
    <title>Log</title>
    @include('member.head')
    <script src="{{asset('public/js/log.js')}}" type="text/javascript"></script>
</head>
<body>
<style>
  
#customers {
  font-family: "Trebuchet MS", Arial, Helvetica, sans-serif;
  border-collapse: collapse;
  width: 100%;
}

#customers td, #customers th {
  border: 1px solid #ddd;
  padding: 8px;
}

#customers tr:nth-child(even){background-color: #f2f2f2;}

#customers tr:hover {background-color: #ddd;}

#customers th {
  padding-top: 12px;
  padding-bottom: 12px;
  text-align: left;
  background-color: #4CAF50;
  color: white;
}

        </style>
  
@include('nav')       
 
<div class="container">
    <div class="card bg-light mt-3">
      
    @include('member.flash')   
        <table id="customers">
            <thead>   
                <tr>
                  <th>Id</th>
                  <th>File</th>
                  <th>Status</th>
                   <th>Log</th>
                </tr>
            </thead>
            <tbody id="log_row"> 
               
            </tbody> 
        </table>

        
    </div>
</div>
    

</body>
</html>