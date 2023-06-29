<!-- *** Head Section *** -->
<?php include('header_m.html'); ?>


    <main>
        <div class="container-fluid">
            <h1 class="mt-4">Enquiry List</h1>
            <ol class="breadcrumb mb-4">
                <li class="breadcrumb-item active">Enquiry</li>
            </ol>
        <div class="card mb-4">
            <div class="card-header"><i class="fas fa-table mr-1"></i>DataTable</div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>No.</th>
                                <th>Date</th>
                                <th>Enquiry Name</th>
                                <th>Email ID</th>
                                <th>Phone No.</th>
                                <th>Course</th>
                                <th>Message</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tfoot>
                            <tr>
                                <th>No.</th>
                                <th>Date</th>
                                <th>Enquiry Name</th>
                                <th>Email ID</th>
                                <th>Phone No.</th>
                                <th>Course</th>
                                <th>Message</th>
                                <th></th>
                            </tr>
                        </tfoot>
                        <tbody>

                        <?php
                            // Database Connection 
                            $host = 'localhost:3306';  
                            $user = 'root';  
                            $pass = '';  
                            $dbname = 'assessdb';

                            $conn = mysqli_connect($host, $user, $pass,$dbname);  
                            $sql = 'SELECT * FROM enquiryinfo';

                            $retval =  mysqli_query($conn, $sql);
                            $num = 1;
                            if(mysqli_num_rows($retval) > 0){  
                                while($row = mysqli_fetch_assoc($retval)){ 
                                    echo "<tr><td> {$num} </td>".
                                    "<td>{$row['edate']}</td>".
                                    "<td>{$row['ename']}</td>".
                                    "<td>{$row['emailid']}</td>".
                                    "<td>{$row['phoneno']}</td>".
                                    "<td>{$row['course']}</td>".
                                    "<td>{$row['message']}</td>".
                                    "<td>".
                                    "<form class='delete_form' action='..\codeengine.html' method='POST'>".
                                    "<input type='hidden' name='mode' value='enquirydelete'>".
                                    "<input type='hidden' name='rowno' value='{$row['eid']}'>".
                                    "<button type='submit' class='btn btn-danger'> <i class='fas fa-times'></i> </button>".
                                    "</form>".
                                    "</td></tr>";
                                    $num++;
                                }
                            }


                            mysqli_close($conn);
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
                            window.location.href = "enquirylist.html";
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

                $('#messagedisplay .alert').delay(5000).slideUp(500, function() {
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
