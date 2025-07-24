<?php
if(isset($_GET['id'])){
    $qry = $conn->query("SELECT * FROM `event_list` where id = '{$_GET['id']}' and club_id = '{$_settings->userdata('club_id')}' ");
    if($qry->num_rows > 0){
        foreach($qry->fetch_array() as $k => $v){
            if(!is_numeric($k))
            $$k = $v;
        }
    }
}
?>
<style>
    #cimg{
        max-height: 15vh;
        width: 15vh;
        object-fit: scale-down;
        object-position: center center;
    }
    .form-label {
        position: static !important;
        margin-bottom: 0.5rem;
        font-size: 0.875rem;
        color: #344767;
    }
    .form-control {
        border: 1px solid #d2d6da;
        padding: 0.5rem 0.75rem;
        line-height: 1.4;
    }
    .input-group-dynamic .form-control {
        padding-left: 0.75rem !important;
    }
    .input-group-dynamic .form-control:focus {
        border-color: #0e2b5e;
    }
    select.form-control {
        appearance: auto;
    }
</style>
<section class="py-4">
    <div class="container">
        <h2 class="fw-bolder text-center"><b><?= isset($id) ? "Edit Event" : "Create New Event" ?></b></h2>
        <hr>
        <div class="row justify-content-center">
            <div class="col-lg-8 col-md-10 col-sm-12 col-xs-12">
                <form action="" id="event-form" class="py-3">
                    <input type="hidden" name="id" value="<?= isset($id) ? $id : '' ?>">
                    
                    <div class="form-group mb-3">
                        <label for="name" class="form-label">Event Name <span class="text-danger">*</span></label>
                        <input type="text" id="name" name="name" value="<?= isset($name) ? $name : "" ?>" class="form-control" required>
                    </div>

                    <div class="form-group mb-3">
                        <label for="category" class="form-label">Category <span class="text-danger">*</span></label>
                        <select id="category" name="category" class="form-control" required>
                            <option value="" disabled <?= !isset($category) ? 'selected' : '' ?>>Select Category</option>
                            <option value="Student Organisations" <?= isset($category) && $category == 'Student Organisations' ? 'selected': '' ?>>Student Organisations</option>
                            <option value="Art & Music" <?= isset($category) && $category == 'Art & Music' ? 'selected': '' ?>>Art & Music</option>
                            <option value="Business" <?= isset($category) && $category == 'Business' ? 'selected': '' ?>>Business</option>
                            <option value="Cultural" <?= isset($category) && $category == 'Cultural' ? 'selected': '' ?>>Cultural</option>
                            <option value="General Interest" <?= isset($category) && $category == 'General Interest' ? 'selected': '' ?>>General Interest</option>
                            <option value="Martial Art" <?= isset($category) && $category == 'Martial Art' ? 'selected': '' ?>>Martial Art</option>
                            <option value="Nature" <?= isset($category) && $category == 'Nature' ? 'selected': '' ?>>Nature</option>
                            <option value="Religious" <?= isset($category) && $category == 'Religious' ? 'selected': '' ?>>Religious</option>
                            <option value="Sports" <?= isset($category) && $category == 'Sports' ? 'selected': '' ?>>Sports</option>
                            <option value="Uniform/Affiliate" <?= isset($category) && $category == 'Uniform/Affiliate' ? 'selected': '' ?>>Uniform/Affiliate</option>
                        </select>
                    </div>

                    <div class="form-group mb-3">
                        <label for="location" class="form-label">Location <span class="text-danger">*</span></label>
                        <input type="text" id="location" name="location" value="<?= isset($location) ? $location : "" ?>" class="form-control" required>
                    </div>

                    <div class="form-group mb-3">
                        <label for="description" class="form-label">Description <span class="text-danger">*</span></label>
                        <textarea rows="4" id="description" name="description" class="form-control" required><?= isset($description) ? $description : '' ?></textarea>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group mb-3">
                                <label for="start_datetime" class="form-label">Start Date & Time <span class="text-danger">*</span></label>
                                <input type="datetime-local" id="start_datetime" name="start_datetime" 
                                    value="<?= isset($start_datetime) ? date("Y-m-d\TH:i", strtotime($start_datetime)) : "" ?>" 
                                    class="form-control" 
                                    min="<?= date('Y-m-d\TH:i') ?>"
                                    required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group mb-3">
                                <label for="end_datetime" class="form-label">End Date & Time <span class="text-danger">*</span></label>
                                <input type="datetime-local" id="end_datetime" name="end_datetime" 
                                    value="<?= isset($end_datetime) ? date("Y-m-d\TH:i", strtotime($end_datetime)) : "" ?>" 
                                    class="form-control" 
                                    required>
                            </div>
                        </div>
                    </div>

                    <div class="form-group mb-3">
                        <label for="event_cover" class="form-label">Event Cover Image <?= !isset($id) ? '<span class="text-danger">*</span>' : '' ?></label>
                        <input type="file" class="form-control" id="event_cover" name="event_cover" accept="image/*" <?= !isset($id) ? 'required' : '' ?>>
                    </div>

                    <?php if(isset($event_cover)): ?>
                        <div class="form-group mb-3 d-flex justify-content-center">
                            <img src="<?= validate_image($event_cover) ?>" alt="Event Cover" id="cimg" class="img-fluid img-thumbnail bg-gradient-dark">
                        </div>
                    <?php endif; ?>

                    <div class="row">
                        <div class="col-md-12 text-center">
                            <button type="submit" class="btn bg-primary bg-gradient btn-sm text-light w-25"><span class="material-icons">save</span> Save</button>
                            <a href="./?page=events" class="btn bg-deafult border bg-gradient btn-sm w-25"><span class="material-icons">keyboard_arrow_left</span> Cancel</a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>
<script>
    $(document).ready(function(){
        if($('#description').length > 0){
            tinymce.init({
                selector: '#description',
                height: 300,
                plugins: [
                    'advlist autolink lists link image charmap print preview anchor',
                    'searchreplace visualblocks code fullscreen',
                    'insertdatetime media table paste code help wordcount'
                ],
                toolbar: 'undo redo | formatselect | ' +
                'bold italic backcolor | alignleft aligncenter ' +
                'alignright alignjustify | bullist numlist outdent indent | ' +
                'removeformat | help',
                content_style: 'body { font-family:Helvetica,Arial,sans-serif; font-size:14px }'
            });
        }

        // Date validation
        $('#start_datetime').change(function(){
            var start = $(this).val();
            $('#end_datetime').attr('min', start);
            
            // If end date is earlier than start date, update it
            var end = $('#end_datetime').val();
            if(end && end < start) {
                $('#end_datetime').val(start);
            }
        });
        
        $('#event-form').submit(function(e){
            e.preventDefault();
            
            // Validate dates
            var start = new Date($('#start_datetime').val());
            var end = new Date($('#end_datetime').val());
            
            if(end < start) {
                alert('End date cannot be earlier than start date');
                return false;
            }
            
            $('.pop-alert').remove();
            var _this = $(this);
            var el = $('<div>');
            el.addClass("pop-alert alert alert-danger text-light");
            el.hide();
            start_loader();
            $.ajax({
                url:'../classes/Master.php?f=save_event',
                data: new FormData($(this)[0]),
                cache: false,
                contentType: false,
                processData: false,
                method: 'POST',
                type: 'POST',
                dataType: 'json',
                error:err=>{
                    console.error(err);
                    el.text("An error occurred while saving data");
                    _this.prepend(el);
                    el.show('slow');
                    $('html, body').scrollTop(_this.offset().top - '150');
                    end_loader();
                },
                success:function(resp){
                    if(resp.status == 'success'){
                        location.href= './?page=events/view_event&id='+resp.eid;
                    }else if(!!resp.msg){
                        el.text(resp.msg);
                        _this.prepend(el);
                        el.show('slow');
                        $('html, body').scrollTop(_this.offset().top - '150');
                    }else{
                        el.text("An error occurred while saving data");
                        _this.prepend(el);
                        el.show('slow');
                        $('html, body').scrollTop(_this.offset().top - '150');
                    }
                    end_loader();
                }
            });
        });

        $('#event_cover').change(function(){
            var input = this;
            if (input.files && input.files[0]) {
                var reader = new FileReader();
                reader.onload = function(e) {
                    $('#cimg').attr('src', e.target.result);
                }
                reader.readAsDataURL(input.files[0]);
            }
        });
    });
</script> 