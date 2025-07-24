<?php
if(isset($_GET['id'])){
    $qry = $conn->query("SELECT e.*, c.name as club_name FROM event_list e 
                        INNER JOIN club_list c ON e.club_id = c.id 
                        WHERE e.id = '{$_GET['id']}' AND e.status = 1 AND e.delete_flag = 0");
    if($qry->num_rows > 0){
        foreach($qry->fetch_array() as $k => $v){
            if(!is_numeric($k))
            $$k = $v;
        }
    }
}
?>
<style>
    #event-cover {
        width: 100%;
        max-height: 400px;
        object-fit: cover;
        object-position: center center;
        border-radius: 10px;
    }
    .event-details {
        margin-top: 2rem;
    }
    .event-meta {
        display: flex;
        align-items: center;
        margin-bottom: 0.5rem;
        color: #666;
    }
    .event-meta .material-icons {
        font-size: 1.2rem;
        margin-right: 0.5rem;
        color: #0e2b5e;
    }
    .event-description {
        margin-top: 2rem;
        line-height: 1.6;
    }
    .register-btn {
        background-color: #0e2b5e;
        color: #fff;
        padding: 0.75rem 2rem;
        border-radius: 25px;
        text-decoration: none;
        display: inline-block;
        margin-top: 2rem;
        transition: background-color 0.3s ease;
    }
    .register-btn:hover {
        background-color: #1a4189;
        color: #fff;
    }
</style>

<section class="py-4">
    <div class="container">
        <?php if(isset($id)): ?>
            <div class="card rounded-0">
                <div class="card-body">
                    <div class="container-fluid">
                        <img src="<?= validate_image($event_cover) ?>" alt="<?= $name ?>" id="event-cover" class="mb-3">
                        
                        <h2 class="fw-bold"><?= $name ?></h2>
                        
                        <div class="event-meta">
                            <span class="material-icons">group</span>
                            <span>Organized by <?= $club_name ?></span>
                        </div>
                        
                        <div class="event-meta">
                            <span class="material-icons">calendar_today</span>
                            <span><?= date("F d, Y", strtotime($start_datetime)) ?></span>
                        </div>
                        
                        <div class="event-meta">
                            <span class="material-icons">schedule</span>
                            <span><?= date("h:i A", strtotime($start_datetime)) ?> - <?= date("h:i A", strtotime($end_datetime)) ?></span>
                        </div>
                        
                        <div class="event-meta">
                            <span class="material-icons">location_on</span>
                            <span><?= $location ?></span>
                        </div>
                        
                        <div class="event-description">
                            <?= html_entity_decode($description) ?>
                        </div>
                        
                        <a href="./?page=events/register&id=<?= $id ?>" class="register-btn">
                            <span class="material-icons align-middle">how_to_reg</span> Register for Event
                        </a>
                    </div>
                </div>
            </div>
        <?php else: ?>
            <div class="card rounded-0">
                <div class="card-body">
                    <div class="container-fluid">
                        <h4 class="text-center">Event not found.</h4>
                    </div>
                </div>
            </div>
        <?php endif; ?>
    </div>
</section> 