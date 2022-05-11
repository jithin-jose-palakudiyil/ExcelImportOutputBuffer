$(function() 
{ 
    _table();
  setInterval(function(){ _table(); }, 2000);

});

function _table(){
    
    var url=base_url +'/get_log';  
    $.ajax
    ({
       type: 'GET',
        url: url,
        dataType: "json",
        async: false,
        headers: {  'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
//        data :{'application':id},
        success: function(response){ 
//        log_row
                var obj =  $.parseJSON(JSON.stringify(response)); 
                $('#log_row').html(obj.html);
        },
        error: function (request, textStatus, errorThrown)  {  }
    }); 
                    
}