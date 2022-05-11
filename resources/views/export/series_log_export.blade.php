 

<?php if(isset($series) && $series ):  ?>
 
   <table border = 1> 
       <thead> 
           <tr>
            <th>Meezzaa_Series_No</th>
            <th>Response</th>
            <th>response_code</th> 
            <th>response_data</th>
           </tr>
       </thead> 
     
       <tbody> 
        <?php  foreach ($series as $key => $value): ?>
           <tr>
               <td><?php echo $value->sheet_code; ?></td>
               <td><?php echo $value->response; ?></td>
               <td><?php echo $value->response_code; ?></td>
               <td><?php echo $value->response_data; ?></td>
           </tr>      
        <?php    endforeach; ?>
      </tbody>
   </table> 
<?php endif; ?>