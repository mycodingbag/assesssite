<!-- *** Head Section *** -->
<?php include('header_m.html'); ?>

    <main>
        <div class="container-fluid">
            <h1 class="mt-4">Dashboard</h1>
            <ol class="breadcrumb mb-4">
                <li class="breadcrumb-item"><a href="index.html">Dashboard</a></li>
                <li class="breadcrumb-item active">Change Password</li>
            </ol> 
            <div class="card mb-4">
                <div class="card-body">Please enter the old password than you create new password</a>.</div>
            </div>

            <div class="card mb-4 p-3 col-md-6">
            <form id="changepass_form" action="..\codeengine.html" method="POST">
                <input type="hidden" name="mode" value="changepassword">
                <div class="form-row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label class="small mb-1" for="oldPassword">Old Password</label>
                            <input class="form-control py-4" name="oldpasstxt" id="oldPassword" type="password" placeholder="Old password" required /></div>
                    </div>
                </div>
                <div class="form-row">
                    <div class="col-md-12">
                        <div class="form-group"><label class="small mb-1" for="newPassword">New Password</label>
                        <input class="form-control py-4" name="newpasstxt" id="newPassword" type="password" placeholder="New password" required /></div>
                    </div>
                </div>
                
                <div class="form-row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label class="small mb-1" for="confirmPassword">Confirm Password</label>
                            <input class="form-control py-4" name="confirmpasstxt" id="confirmPassword" type="password" placeholder="Confirm password" required />
                        </div>
                    </div>
                </div>
                <div class="form-group mt-4 mb-0">
                    <button class="btn btn-primary btn-block" type="submit">Create Account</button>
                </div>
            </form>
            </div>
        </div>
       
    </main>



<!-- *** Footer Section *** -->
<?php include('footer_m.html'); ?>


<script>


$(document).ready(function(){

    $("#changepass_form").on("submit",function(e){
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
                        '</div>');

                        $("#changepass_form")[0].reset();
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
            console.log('not OK BROW');
            } 	        
        });

    });
});
</script>

</body>
</html>
