<?php if(isset($collect) && $collect->isNotEmpty()): ?>
    <?php foreach ($collect as $key => $value) :   ?>
        <tr>
          <td>{{$value['id']+1000}}</td>
          <td><a href="{{$value['excel_path']}}"> <img src="{{asset('public/images/excel.png')}}" style="width:80px" alt=""/> </a></td>
          <td>
                <?php if($value['is_completed'] ==0): ?>
                    created
                <?php elseif($value['is_completed']==1): ?>
                <b>processing</b>
                <hr/>
                <div style="margin-top:5px">
                    <span class="btn icon-btn btn-info" href="#">{{ ( isset($value['response_total']) && $value['response_total'] ) ? $value['response_total'] : '0'  }}</span> &nbsp;
                    <span class="btn icon-btn btn-success" href="#">{{ ( isset($value['response_success']) && $value['response_success'] ) ? $value['response_success'] : '0' }}</span> &nbsp;
                    <span class="btn icon-btn btn-danger" href="#">{{ ( isset($value['response_error']) && $value['response_error'] ) ? $value['response_error'] : '0' }}</span>
                </div>
                <?php elseif($value['is_completed'] ==2): ?>
                <b>Finished</b>
                <hr/>
                <div style="margin-top:5px">
                    <span class="btn icon-btn btn-info" href="#">{{ ( isset($value['response_total']) && $value['response_total'] ) ? $value['response_total'] : '0'  }}</span> &nbsp;
                    <span class="btn icon-btn btn-success" href="#">{{ ( isset($value['response_success']) && $value['response_success'] ) ? $value['response_success'] : '0' }}</span> &nbsp;
                    <span class="btn icon-btn btn-danger" href="#">{{ ( isset($value['response_error']) && $value['response_error'] ) ? $value['response_error'] : '0' }}</span>
                </div>
                <?php endif; ?>
          </td>
           <td><a href="{{route('download_register_group', $value['encrypt_id'])}}"> <img src="{{asset('public/images/excel.png')}}" style="width:80px" alt=""/></a></td>
        </tr> 
    <?php endforeach;
?>
<?php endif; ?>

                