<?php
if(isset($_GET['id'])){
    $qry = $conn->query("SELECT e.*, c.name as club_name FROM event_list e 
                        INNER JOIN club_list c ON e.club_id = c.id 
                        WHERE e.id = '{$_GET['id']}' AND e.club_id = '{$_settings->userdata('club_id')}'");
    if($qry->num_rows > 0){
        foreach($qry->fetch_array() as $k => $v){
            if(!is_numeric($k))
            $$k = $v;
        }
    }
}
?>
<div class="card card-outline rounded-0 card-navy">
    <div class="card-header">
        <h3 class="card-title">Event Details</h3>
        <div class="card-tools">
            <a href="./?page=events/manage_event&id=<?= isset($id) ? $id : '' ?>" class="btn btn-flat btn-primary"><span class="fa fa-edit"></span> Edit</a>
            <a href="./?page=events" class="btn btn-flat btn-default"><span class="fa fa-backward"></span> Back to List</a>
        </div>
    </div>
    <div class="card-body">
        <div class="container-fluid">
            <div class="row justify-content-center">
                <div class="col-md-8">
                    <?php if(isset($event_cover)): ?>
                        <img src="<?= validate_image($event_cover) ?>" alt="Event Cover" class="img-thumbnail mb-3" style="width: 100%;">
                    <?php endif; ?>
                    
                    <dl>
                        <dt class="text-muted">Event Name</dt>
                        <dd class="pl-4"><?= isset($name) ? $name : "" ?></dd>
                        
                        <dt class="text-muted">Location</dt>
                        <dd class="pl-4"><?= isset($location) ? $location : "" ?></dd>
                        
                        <dt class="text-muted">Schedule</dt>
                        <dd class="pl-4">
                            <p class="m-0"><b>Start:</b> <?= isset($start_datetime) ? date("M d, Y h:i A", strtotime($start_datetime)) : "" ?></p>
                            <p class="m-0"><b>End:</b> <?= isset($end_datetime) ? date("M d, Y h:i A", strtotime($end_datetime)) : "" ?></p>
                        </dd>
                        
                        <dt class="text-muted">Status</dt>
                        <dd class="pl-4">
                            <?php if(isset($status)): ?>
                                <?php if($status == 1): ?>
                                    <span class="badge badge-success px-3 rounded-pill">Approved</span>
                                <?php elseif($status == 2): ?>
                                    <span class="badge badge-danger px-3 rounded-pill">Rejected</span>
                                <?php else: ?>
                                    <span class="badge badge-primary px-3 rounded-pill">Pending</span>
                                <?php endif; ?>
                            <?php endif; ?>
                        </dd>
                        
                        <dt class="text-muted">Description</dt>
                        <dd class="pl-4">
                            <?= isset($description) ? html_entity_decode($description) : "" ?>
                        </dd>
                    </dl>
                </div>
            </div>
        </div>
    </div>
</div> 