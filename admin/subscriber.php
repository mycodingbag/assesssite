<!-- *** Head Section *** -->
<?php include('header_m.html'); ?>


    <main>
        <div class="container-fluid">
            <h1 class="mt-4">User List</h1>
            <ol class="breadcrumb mb-4">
                <li class="breadcrumb-item active">Users</li>
            </ol>
        <div class="card mb-4">
            <div class="card-header"><i class="fas fa-table mr-1"></i>DataTable</div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>User Name</th>
                                <th>Password</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tfoot>
                            <tr>
                                <th>ID</th>
                                <th>User Name</th>
                                <th>Password</th>
                                <th></th>
                            </tr>
                        </tfoot>
                        <tbody>

                        <?php
                            
                            $myFile = "js/subscriber.json";
                            $arr_data = array();
                            $jsondata = file_get_contents($myFile);
                            $arr_data = json_decode($jsondata, true);
                            $num = 1;
                            foreach( $arr_data as $data){
                                echo "<tr><td> {$num} </td>".
                                "<td>{$data['date']}</td>".
                                "<td>{$data['email']}</td>".
                                "<td>".
                                    "<form class='delete_form' action='..\codeengine.html' method='POST'>".
                                    "<input type='hidden' name='mode' value='subscriberdelete'>".
                                    "<input type='hidden' name='rowno' value='{$num}'>".
                                    "<button type='submit' class='btn btn-danger'> <i class='fas fa-times'></i> </button>".
                                    "</form>".
                                "</td></tr>";
                                $num++;
                            }

                            /*
                            echo "<tr><td> {$row['uid']} </td>".
                            "<td>{$row['uname']}</td>".
                            "<td>{$row['upassword']}</td>".
                            "<td>{$row['remark']}</td></tr>";
                             */  
                        ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        </main>




<!-- *** Footer Section *** -->
<?php include('footer_m.html'); ?>




<script>

    $(document).ready(function(){
        
        $(".delete_form").on("submit",function(e){
            e.preventDefault();

            $.ajax({
            url: "../codeengine.html",
            type: "POST",
            data:  new FormData(this),
            contentType: false,
            cache: false,
            processData:false,
            success: function(data){
                    
                    data = jQuery.parseJSON(data);

                    if(data.mode == 'ok'){
                        
                        $('#messagedisplay').append(''+
                        '<div class="alert alert-success alert-dismissible fade show" role="alert"  >'+
                            data.msg+
                            '<button type="button" class="close " data-dismiss="alert" aria-label="Close">'+
                            '<span aria-hidden="true">&times;</span>'+
                            '</button>'+
                        '</div>').delay(5000,function(){
                            window.location.href = "subscriber.html";
                        });

                        
                    }else{
                        $('#messagedisplay').append(''+
                        '<div class="alert alert-danger alert-dismissible fade show" role="alert"  >'+
                            data.msg+
                            '<button type="button" class="close " data-dismiss="alert" aria-label="Close">'+
                            '<span aria-hidden="true">&times;</span>'+
                            '</button>'+
                        '</div>');
                    }

                $('#messagedisplay .alert').delay(5000).slideUp(200, function() {
                    $(this).alert('close');
                });
      
                },
                error: function(){
                
                } 	        
            });
            
        });

    });
</script>

</body>
</html>
