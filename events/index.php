<?php
$categories = array(
    'All categories',
    'Student Organisations',
    'Art & Music',
    'Business',
    'Cultural',
    'General Interest',
    'Martial Art',
    'Nature',
    'Religious',
    'Sports',
    'Uniform/Affiliate'
);
?>
<style>
    .event-container {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
        gap: 2rem;
        padding: 2rem 0;
    }
    .event-card {
        background: #fff;
        border-radius: 10px;
        overflow: hidden;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        transition: transform 0.3s ease;
        text-decoration: none;
        color: inherit;
        display: flex;
        flex-direction: column;
    }
    .event-card:hover {
        transform: translateY(-5px);
    }
    .event-image {
        width: 100%;
        height: 200px;
        object-fit: cover;
    }
    .event-content {
        padding: 1.5rem;
        flex-grow: 1;
        display: flex;
        flex-direction: column;
    }
    .event-title {
        font-size: 1.25rem;
        font-weight: 600;
        margin-bottom: 1rem;
        color: #2c3e50;
    }
    .event-info {
        display: flex;
        align-items: center;
        margin-bottom: 0.5rem;
        color: #666;
    }
    .event-info .material-icons {
        font-size: 1.1rem;
        margin-right: 0.5rem;
        color: #0e2b5e;
    }
    .view-details-btn {
        background-color: #0e2b5e;
        color: #fff;
        padding: 0.5rem 1.5rem;
        border-radius: 25px;
        text-align: center;
        margin-top: auto;
        transition: background-color 0.3s ease;
        text-decoration: none;
        align-self: flex-start;
        margin-top: 1rem;
    }
    .view-details-btn:hover {
        background-color: #1a4189;
        color: #fff;
    }
    .filter-container {
        display: flex;
        justify-content: flex-start;
        align-items: center;
        margin-bottom: 2rem;
        gap: 1rem;
        padding: 0 1rem;
    }
    .filter-label {
        font-weight: 500;
        color: #2c3e50;
    }
    .filter-select {
        padding: 0.5rem 2rem 0.5rem 1rem;
        border: 1px solid #ddd;
        border-radius: 25px;
        background-color: white;
        appearance: none;
        background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='16' height='16' viewBox='0 0 24 24' fill='none' stroke='%23333333' stroke-width='2' stroke-linecap='round' stroke-linejoin='round'%3E%3Cpath d='M6 9l6 6 6-6'/%3E%3C/svg%3E");
        background-repeat: no-repeat;
        background-position: right 0.75rem center;
        min-width: 150px;
    }
</style>

<section class="py-4">
    <div class="container">
        <h3 class="fw-bolder text-center">Upcoming Events</h3>
        <center><hr class="bg-primary opacity-100" style="width:70px; height:3px"></center>
        
        <!-- Filter Section -->
        <div class="filter-container">
            <span class="filter-label">Filter:</span>
            <select class="filter-select" id="event-type-filter">
                <?php foreach($categories as $type): ?>
                    <option value="<?= $type ?>"><?= $type ?></option>
                <?php endforeach; ?>
            </select>
        </div>

        <!-- Events Grid -->
        <div class="event-container">
            <?php 
            $events = $conn->query("SELECT e.*, c.name as club_name FROM event_list e 
                                  INNER JOIN club_list c ON e.club_id = c.id 
                                  WHERE e.status = 1 AND e.delete_flag = 0 
                                  AND e.end_datetime >= CURRENT_TIMESTAMP()
                                  ORDER BY e.start_datetime ASC");
            while($row = $events->fetch_assoc()):
                $description = strip_tags(html_entity_decode($row['description']));
                $description = substr($description, 0, 100) . (strlen($description) > 100 ? "..." : "");
            ?>
            <a href="./?page=events/view_event&id=<?= $row['id'] ?>" class="event-card">
                <img src="<?= validate_image($row['event_cover']) ?>" alt="<?= $row['name'] ?>" class="event-image">
                <div class="event-content">
                    <h5 class="event-title"><?= $row['name'] ?></h5>
                    
                    <div class="event-info">
                        <span class="material-icons">calendar_today</span>
                        <span><?= date("M d, Y", strtotime($row['start_datetime'])) ?></span>
                    </div>
                    
                    <div class="event-info">
                        <span class="material-icons">schedule</span>
                        <span><?= date("h:i A", strtotime($row['start_datetime'])) ?></span>
                    </div>
                    
                    <div class="event-info">
                        <span class="material-icons">location_on</span>
                        <span><?= $row['location'] ?></span>
                    </div>
                    
                    <div class="event-info">
                        <span class="material-icons">group</span>
                        <span><?= $row['club_name'] ?></span>
                    </div>
                    
                    <div class="view-details-btn">View Details</div>
                </div>
            </a>
            <?php endwhile; ?>
        </div>
    </div>
</section>

<script>
$(function(){
    // Filter events by type
    $('#event-type-filter').change(function(){
        var selectedType = $(this).val().toLowerCase();
        $('.event-card').each(function(){
            var eventType = $(this).data('type').toLowerCase();
            if(selectedType === 'all categories' || eventType === selectedType){
                $(this).show();
            } else {
                $(this).hide();
            }
        });
    });
});
</script> 