 

<?php if(isset($listing) && $listing ): ?>
 
   <table border = 1> 
       <thead> 
           <tr>
            <th>Meezza_Number</th>
            <th>Seller_ID</th>
            <th>Response</th>
            <th>response_code</th> 
            <th>response_data</th>
           </tr>
       </thead> 
     
       <tbody> 
        <?php  foreach ($listing as $key => $value): ?>
           <tr>
               <?php $explode = explode('_', $value->sheet_code); ?>
               <td><?php echo isset($explode[0]) ? $explode[0] : ''; ?></td>
               <td><?php echo isset($explode[1]) ? $explode[1] : ''; ?></td>
               <td><?php echo $value->response; ?></td>
               <td><?php echo $value->response_code; ?></td>
               <td><?php echo $value->response_data; ?></td>
           </tr>      
        <?php    endforeach; ?>
      </tbody>
   </table> 
<?php endif; ?>