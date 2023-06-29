<!-- *** Head Section *** -->
<?php include('header_m.html'); ?>

    <main>
        <div class="container-fluid">
            <h1 class="mt-4">Gallery Setting</h1>
            <ol class="breadcrumb mb-4">
                <li class="breadcrumb-item active">Gallery</li>
            </ol>
            <div class="card mb-4">
                <div class="card-header d-flex" >
                    <button id="back_btn" class="btn btn-light mx-1"><i class="fas fa-arrow-left"></i></button>
                    <button id="upload_btn" class="btn btn-light mx-1"><i class="fas fa-upload"></i></button>
                    <button id="add_folder_btn" class="btn btn-light mx-1"><i class="fas fa-folder-plus"></i></button>
                    <button id="delete_btn" class="btn btn-light mx-1"><i class="fas fa-trash"></i></button>
                    <span id="addressbar" class="border flex-grow-1 p-1 px-3 bg-white">/gallery/</span>
                </div>
                <div class="card-body d-flex flex-wrap p-3" id="container">
                    
                    
                </div>
            </div>
        </div>
    </main>

    <!-- Rename Folder -->
    <div class="modal" id="addfolder" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Folder Name</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <input type="text" value="" id="foldernametxt" class="form-control" placeholder="Enter Folder Name" />
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" id="addfolderbtn" class="btn btn-primary">Create Folder</button>
            </div>
            </div>
        </div>
    </div>

    <!-- img View Folder -->
    <div class="modal" id="showimg" tabindex="-1" role="dialog">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
           
                <div class="modal-body">
                    <div class="card">
                        <img class="card-img-top" src="" id="imgdata" alt="" >
                    </div>
                </div>
            
            </div>
        </div>
    </div>

    <!-- Image Upload Folder -->
    <div class="modal" id="addimages" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <form id="form_upload_img" action="galleryengin.html" method="POST" enctype="multipart/form-data">
                    <div class="modal-header">
                        <h5 class="modal-title">Upload Images</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            
                                <div class="form-group">
                                    <input type='hidden' name='mode' value='imgupload'>
                                    <input type='hidden' name='uploaddir' value=''>
                                    <label for="imgupload" class="small">Please click 'Choose File' & Select images then click upload.</label>
                                    <input type="file" class="form-control-file" name="imgupload[]" id="imgupload" accept="image/x-png,image/gif,image/jpeg" multiple>
                                </div>
                            
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" id="addfolderbtn" class="btn btn-primary">Upload</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

<!-- *** Footer Section *** -->
           
</div>
        </div>
        <script src="https://code.jquery.com/jquery-3.4.1.min.js" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
        <script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js" crossorigin="anonymous"></script>
        <script src="https://cdn.datatables.net/1.10.20/js/dataTables.bootstrap4.min.js" crossorigin="anonymous"></script>

        <script>


        

        function showfolder(){
            var adds = $("#addressbar").text().trim(' ');
            $('input[name="uploaddir"]').val(adds.slice(0,-1));

            $.ajax({
                url:'galleryengin.html',
                type:'post',
                data:{mode:'shows',addsdata:adds},
                success:function(response){
                    var jsondata = JSON.parse(response);
                    $('#container').html(' ');
                    jsondata.forEach(function(item){
                        if(!(item == '.' || item == '..')){
                            item = item.toLowerCase();
                            if(item.search('.jpg') != -1 || item.search('.gif') != -1 || item.search('.png') != -1 || item.search('.jpeg') != -1){
                                $('#container').append(
                                    '<div class="p-1 text-center m-2 mx-4 btn"  style="position:relative;">'+
                                        '<img src="../images'+(adds+item)+'" width="200px" ><br>'+
                                        '<p style="word-break: break-all;">'+item+'</p>'+
                                        '<button  class="btn btn-light rounded-circle" style="position:absolute;top:-10px;right:-10px;">'+
                                            '<i data-id="'+item+'" class="fas fa-1x fa-check text-success"></i>'+
                                        '</button>'+
                                    '</div>');
                            }else{
                                $('#container').append(
                                    '<div class="p-1 text-center m-2 mx-4 btn"   style="position:relative;">'+
                                        '<i class="fas fa-folder fa-7x text-muted"></i><br>'+
                                        '<p style="word-break: break-all;">'+item+'</p>'+
                                        '<button  class="btn btn-light rounded-circle" style="position:absolute;top:-10px;right:-10px;">'+
                                            '<i data-id="'+item+'" class="fas fa-1x fa-check text-success"></i>'+
                                        '</button>'+
                                    '</div>');
                            }
                        }
                        
                    });

                    $('#container div').dblclick(function(){
                        var curpath = $(this).children()[2].innerHTML.toLowerCase();
                        if(curpath.search('.jpg') == -1 || item.search('.gif') != -1 || curpath.search('.png') != -1 || curpath.search('.jpeg') != -1){
                            $("#addressbar").text(adds+$(this).children()[2].innerHTML+'/');
                            showfolder();
                        }else{
                            $('#imgdata').attr('src','../images'+adds+curpath);
                            $('#showimg').modal('show');
                        }
                    });

                    $('#container div button').click(function(){
                        if($(this).children().hasClass('fa-check')){
                            $(this).children().removeClass('fa-check');
                            $(this).children().removeClass('text-success');
                            $(this).children().addClass('fa-times');
                            $(this).children().addClass('text-danger');
                        }else{
                            $(this).children().removeClass('fa-times');
                            $(this).children().removeClass('text-danger');
                            $(this).children().addClass('fa-check');
                            $(this).children().addClass('text-success');
                        }
                    });
                }
            });
            


        }

        $(document).ready(function(){
            
            showfolder();
            $("#back_btn").click(function(){

                
                var adds = $("#addressbar").text().trim(' ');
                if(adds != '/gallery/'){
                    var splitdata = adds.split('/');
                    splitdata.pop();
                    splitdata.pop();
                    adds = '/';
                    splitdata.forEach(function(item){
                        if(item != ''){
                            adds+=item;
                        }
                    });
                    adds += '/';
                    $("#addressbar").text(adds);
                    showfolder();
                }
            });

            $("#delete_btn").click(function(){
                let no = 0;
                document.querySelectorAll('#container div button svg').forEach(function(item){
                    if($(item).hasClass('fa-times')){
                        var adds = $("#addressbar").text().trim(' ');
                        var datas = $(item).data('id').toLowerCase(); 
                        var typefile = 'folder';

                        if(datas.search('.jpg') != -1 || datas.search('.gif') != -1 || datas.search('.png') != -1 || datas.search('.jpeg') != -1){
                            typefile = 'file';
                        }
                        console.log(typefile);

                        $.ajax({
                            url:'galleryengin.html',
                            type:'post',
                            data:{mode:'delete',addsdata:adds+datas,itemtype:typefile},
                            success:function(response){
                               
                            }
                        });
                         no++;
                    }
                });

                showfolder();
            });


            $("#add_folder_btn").click(function(){
                $('#addfolder').modal('show');
            });
            
            $("#addfolderbtn").click(function(){
                if($('#foldernametxt').val() != ''){
                    var newfoldername = $('#foldernametxt').val();
                    var adds = $("#addressbar").text().trim(' ');
                    
                    $.ajax({
                        url:'galleryengin.html',
                        type:'post',
                        data:{mode:'newfolder',addsdata:adds+newfoldername},
                        success:function(response){
                            
                        }
                    });
                    
                    $('#addfolder').modal('hide');
                    showfolder();
                }
            });
            
            $("#upload_btn").click(function(){
                $('#addimages').modal('show');
            });

            $("#form_upload_img").on("submit",function(e){
                e.preventDefault();

                $.ajax({
                    url: "galleryengin.html",
                    type: "POST",
                    data:  new FormData(this),
                    contentType: false,
                    cache: false,
                    processData:false,
                    success: function(data){
                            $('#addimages').modal('hide');
                            $("#imgupload").val('');
                            showfolder();
                        },
                    error: function(){} 	        
                });
            });

        });

        </script>


    </body>
</html>