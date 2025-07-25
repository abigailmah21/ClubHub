<?php 
if(isset($_GET['id'])){
    $qry = $conn->query("SELECT * FROM `club_list` where id = '{$_GET['id']}' and delete_flag = 0 ");
    if($qry->num_rows > 0 ){
        foreach($qry->fetch_array() as $k => $v){
            if(!is_numeric($k))
            $$k = $v;
        }
    }
}
?>
<div class="section py-5">
    <div class="container">
        <h2 class="text-center"><b>Applying to <?= isset($name) ? $name : '' ?></b></h2>
        <center>
            <hr class="border-dark border-4 opacity-100" width="10%" style="height:2.5px">
        </center>
        <div class="alert-container mb-5"></div>
        <form action="" id="application-form" enctype="multipart/form-data">
            <input type="hidden" name="id">
            <input type="hidden" name="club_id" value="<?= isset($id) ? $id : '' ?>">
            <div class="row mb-2">
                <div class="col-lg-4 col-md-6 col-sm-12 col-xs-12">
                    <div class="form-group mb-3 input-group input-group-dynamic">
                        <label class="form-label" for="firstname">First Name <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" required="required" id="firstname" name="firstname">
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 col-sm-12 col-xs-12">
                    <div class="form-group mb-3 input-group input-group-dynamic">
                        <label class="form-label" for="lastname">Last Name <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" required="required" id="lastname" name="lastname">
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 col-sm-12 col-xs-12">
                    <div class="form-group mb-3 input-group input-group-dynamic">
                        <label class="form-label" for="student_id">Student ID <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" required="required" id="student_id" name="student_id" pattern="[0-9]{6}" title="Student ID must be exactly 6 digits">
                    </div>
                </div>
            </div>
            <div class="row mb-2">
                <div class="col-lg-4 col-md-6 col-sm-12 col-xs-12">
                    <div class="form-group mb-3 input-group input-group-dynamic is-filled">
                        <label class="form-label" for="gender">Gender <span class="text-danger">*</span></label>
                        <select type="text" class="form-select" required="required" id="gender" name="gender">
                            <option value="">Select Gender</option>
                            <option value="Male">Male</option>
                            <option value="Female">Female</option>
                        </select>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 col-sm-12 col-xs-12">
                    <div class="form-group mb-3 input-group input-group-dynamic">
                        <label class="form-label" for="year_of_study">Year of Study <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" required="required" id="year_of_study" name="year_of_study">
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 col-sm-12 col-xs-12">
                    <div class="form-group mb-3 input-group input-group-dynamic">
                        <label class="form-label" for="course">Course <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" required="required" id="course" name="course">
                    </div>
                </div>
            </div>
            <div class="row mb-2">
                <div class="col-lg-4 col-md-6 col-sm-12 col-xs-12">
                    <div class="form-group mb-3 input-group input-group-dynamic">
                        <label class="form-label" for="email">Sunway iMail <span class="text-danger">*</span></label>
                        <input type="email" class="form-control" required="required" id="email" name="email">
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 col-sm-12 col-xs-12">
                    <div class="form-group mb-3 input-group input-group-dynamic">
                        <label class="form-label" for="contact">Contact No. <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" required="required" id="contact" name="contact">
                    </div>
                </div>
            </div>
            <div class="row mb-2">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="form-group mb-3">
                        <label class="form-label" for="message">Why do you want join to this club?</label>
                        <textarea rows="4" class="form-control border px-2 py-3 rounded-0" id="message" name="message"></textarea>
                    </div>
                </div>
            </div>
            <div class="text-end pt-3">
                <button class="btn btn-primary btn-sm"><span class="material-icons">send</span> Submit Application</button>
                <a href="./?page=clubs/view_details&id=<?= isset($id) ? $id : '' ?>" class="btn btn-light border btn-sm"><span class="material-icons">arrow_back_ios</span> Cancel</a>
            </div>
        </form>
    </div>
</div>
<script>
    $(function(){
        $('#application-form').submit(function(e){
            e.preventDefault()
            $('.pop-alert').remove()
            var _this = $(this)
            var el = $('<div>')
            el.addClass("pop-alert alert alert-danger text-light")
            el.hide()

            // Student ID validation
            var studentId = $('#student_id').val();
            if (!studentId || studentId.trim() === "") {
                el.text("Student ID is required.")
                $('.alert-container').html(el)
                el.show('slow')
                $('html, body').scrollTop(_this.offset().top - '150')
                end_loader()
                return false;
            }

            // Check if Student ID is exactly 6 digits
            var studentIdPattern = /^[0-9]{6}$/;
            if (!studentIdPattern.test(studentId)) {
                el.text("Student ID must be exactly 6 digits.")
                $('.alert-container').html(el)
                el.show('slow')
                $('html, body').scrollTop(_this.offset().top - '150')
                end_loader()
                return false;
            }

            // Check if email matches iMail pattern
            var email = $('#email').val();
            var imailPattern = /@imail\.sunway\.edu\.my$/i;
            if (!imailPattern.test(email)) {
                el.text("Please use your Sunway iMail address (@imail.sunway.edu.my).")
                $('.alert-container').html(el)
                el.show('slow')
                $('html, body').scrollTop(_this.offset().top - '150')
                end_loader()
                return false;
            }

            // Check if student ID matches email prefix
            var emailPrefix = email.split('@')[0];
            if (studentId !== emailPrefix.substring(0, 6)) {
                el.text("Your Student ID should match the first 6 digits of your iMail address.")
                $('.alert-container').html(el)
                el.show('slow')
                $('html, body').scrollTop(_this.offset().top - '150')
                end_loader()
                return false;
            }

            start_loader()
            $.ajax({
                url:'./classes/Master.php?f=save_application',
                type:'POST',
                method:'POST',
                cache:false,
                contentType:false,
                processData:false,
                data:new FormData(_this[0]),
                dataType:'json',
                error:err=>{
                    console.error(err)
                    el.text("An error occured while saving data")
                    $('.alert-container').html(el)
                    el.show('slow')
                    $('html, body').scrollTop(_this.offset().top - '150')
                    end_loader()
                },
                success:function(resp){
                    if(resp.status == 'success'){
                        location.href= './?page=clubs/view_details&id=<?= isset($id) ? $id : '' ?>';
                    }else if(!!resp.msg){
                        el.text(resp.msg)
                        $('.alert-container').html(el)
                        el.show('slow')
                        $('html, body').scrollTop(_this.offset().top - '150')
                    }else{
                        el.text("An error occured while saving data")
                        $('.alert-container').html(el)
                        el.show('slow')
                        $('html, body').scrollTop(_this.offset().top - '150')
                    }
                    end_loader()
                    console
                }
            })
        })
    })
</script>