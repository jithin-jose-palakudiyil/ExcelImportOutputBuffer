 
<?php if(isset($collection) && $collection ):
    $array_keys = array_keys($collection->first()); 
    if(!empty($array_keys)): 
        ?> 
       <table>
           <thead> 
            <tr>
                <?php
                 $i=0;
                foreach ($array_keys as $key_n => $value_n):  
                    $key_name = trim($value_n);
                    if($i != count($array_keys)-1 && $key_name !=''):
                        echo '<th>'.$key_name.'</th>';
                    endif; 
                    $i++;
                endforeach;
                ?>
            </tr>
            </thead>
            <tbody>
                <?php 
                foreach ($collection as $key => $value): 
                    $n=0; 
                    foreach ($value as $key_ => $value_) :
                        if($n == 0): echo '<tr>'; endif;
                            echo '<td>'.$value_.'</td>';
                            $n++;
                        if($n == count($value)): echo '</tr>'; endif;
                    endforeach;   
                endforeach;
                ?> 
            </tbody>
        </table>
        <?php
    endif;
    ?> 
<?php endif; ?>
