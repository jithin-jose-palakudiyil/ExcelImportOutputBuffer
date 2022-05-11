$(function() 
{ 
//   if($('#datatable').length)
//    {     
//        $.extend( $.fn.dataTable.defaults, 
//        {
//            autoWidth: false,
//            columnDefs: [{ 
//                orderable: false,
//                width: 100,
//                //targets: [ 3 ]
//            }],
//            dom: '<"datatable-header"fl><"datatable-scroll"t><"datatable-footer"ip>',
//            language: {
//                search: '<span>Filter:</span> _INPUT_',
//                searchPlaceholder: 'Type to filter...',
//                lengthMenu: '<span>Show:</span> _MENU_',
//                paginate: { 'first': 'First', 'last': 'Last', 'next': $('html').attr('dir') == 'rtl' ? '&larr;' : '&rarr;', 'previous': $('html').attr('dir') == 'rtl' ? '&rarr;' : '&larr;' }
//            }
//        });
//        data_table();
//        setInterval(function(){ data_table(); }, 2000);
//        
//         
//    }
});


//function data_table(){
//        var url=$('#datatable').attr('data-url');
//        $('#datatable').DataTable 
//        ({
//            destroy: true,
//            processing: true,
//            serverSide: true, 
//            ajax: url,      
//            columns: [ 
//                
//                        {
//                            data: "id", sortable: false,
//                            render: function (data, type, full) {  return  full.id+1000; } 
//                        }, 
////                        {
////                            data: "created_at", sortable: false,
////                            render: function (data, type, full) {  return  full.created_at; } 
////                        }, 
//                         {
//                            data: "null", sortable: false,  
//                            render: function (data, type, full) 
//                            {  
//                                var html = '<a href="'+full.excel_path+'"> <img src="public/images/excel.png" style="width:80px" alt=""/> </a>';
//                                return html;
//                            } 
//                        } ,
//                           {
//                            data: "null", sortable: false,  
//                            render: function (data, type, full) 
//                            {  
//                                var html = '';
//                                if(full.is_completed=='0'){
//                                   html = 'created';  
//                                }
//                                else if(full.is_completed=='1'){
//                                   
//                                    html = '<b>processing</b> <hr/><div style="margin-top:5px">'+
//                                            '<span class="btn icon-btn btn-info" href="#">'+full.response_total+'</span> &nbsp;'+
//                                           '<span class="btn icon-btn btn-success" href="#">'+full.response_success+'</span> &nbsp;'+
//                                           '<span class="btn icon-btn btn-danger" href="#">'+full.response_error+'</span>'+
//                                           '</div>'
//                                   ; 
//                                }
//                                else if(full.is_completed=='2'){
//                                   html = '<b>Finished</b> <hr/><div style="margin-top:5px">'+
//                                            '<span class="btn icon-btn btn-info" href="#">'+full.response_total+'</span> &nbsp;'+
//                                           '<span class="btn icon-btn btn-success" href="#">'+full.response_success+'</span> &nbsp;'+
//                                           '<span class="btn icon-btn btn-danger" href="#">'+full.response_error+'</span>'+
//                                           '</div>'
//                                   ;  
//                                } 
//                                return html;
//                            } 
//                        }  ,
//                         
//                            
//                        {
//                            data: "null", sortable: false,  
//                            render: function (data, type, full) 
//                            {  
//                                var ur=base_url+'/download-log/'+full.encrypt_id;
//                                var html = '<a href="'+ur+'"> <img src="public/images/excel.png" style="width:80px" alt=""/></a>';
//                                return html;
//                            } 
//                        } ,
//                     ] 
//        });
//}
