<?php
$categories = array(
    'All categories',
    'Student Organisations',
    'Accounting & Finance',
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
    .club-item:nth-child(2n-5){
        backdrop-filter: brightness(0.9);
    }
    .club-item:hover{
        backdrop-filter: brightness(0.78);
    }
    .club-item:hover .club-logo{
        transform:scale(1.2)
    }
    .img-holder{
        width:15rem;
        height:15rem;
    }
    .club-logo{
        width:100%;
        height:100%;
        object-fit:cover;
        object-position:center center;
        transition: all .2s ease-in-out;
    }
    .truncate-3{
        display: -webkit-box;
        -webkit-line-clamp: 3;
        -webkit-box-orient: vertical;
        overflow: hidden;
    }
    /* Search Interface Styles */
    .search-container {
        display: flex;
        justify-content: space-between;
        margin-bottom: 2rem;
        gap: 2rem;
        padding: 0 1rem;
    }
    .search-section {
        flex: 1;
    }
    .search-section h3 {
        font-size: 1.2rem;
        margin-bottom: 0.75rem;
        color: #333;
    }
    .search-input {
        width: 100%;
        padding: 0.75rem;
        border: 1px solid #ddd;
        border-radius: 4px;
        font-size: 1rem;
    }
    .category-select {
        width: 100%;
        padding: 0.75rem;
        border: 1px solid #ddd;
        border-radius: 4px;
        font-size: 1rem;
        background-color: white;
        cursor: pointer;
    }
    .search-button {
        background-color: #FF8C42;
        color: white;
        border: none;
        padding: 0.75rem 2.5rem;
        border-radius: 2rem;
        font-size: 1rem;
        cursor: pointer;
        margin-top: 1.9rem;
        transition: background-color 0.3s ease;
    }
    .search-button:hover {
        background-color: #F17A35;
    }
</style>
<section class="py-4">
    <div class="container">
        <h3 class="fw-bolder text-center">Clubs & Societies</h3>
        <center>
            <hr class="bg-primary w-25 opacity-100">
        </center>

        <!-- Search Interface -->
        <div class="search-container">
            <div class="search-section">
                <h3>Search by keyword</h3>
                <input type="text" id="keyword-search" class="search-input" placeholder="Keywords">
            </div>
            <div class="search-section">
                <h3>Search by category</h3>
                <select id="category-search" class="category-select">
                    <?php foreach($categories as $category): ?>
                        <option value="<?= $category ?>"><?= $category ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
            <button type="button" id="search-btn" class="search-button">Search</button>
        </div>

        <div class="row justify-content-center py-5" id="clubs-container">
            <?php 
            $clubs = $conn->query("SELECT * FROM `club_list` where `status` = 1 and delete_flag = 0 order by `name` asc ");
            while($row = $clubs->fetch_assoc()):
            ?>
            <a href='./?page=clubs/view_details&id=<?= $row['id'] ?>' class="col-md-4 club-item px-3 py-4" data-category="<?= $row['category'] ?>">
                <div class="d-flex justify-content-center">
                    <div class="img-holder position-relative overflow-hidden border rounded-circle">
                        <img src="<?= validate_image($row['logo_path']) ?>" alt="<?= $row['name'] ?>" class="image-thumbnail club-logo">
                    </div>
                </div>
                <h5 class="text-center"><b><?= $row['name'] ?></b></h5>
                <p class="text-sm text-muted text-center truncate-3"><?= $row['description'] ?></p>
            </a>
            <?php endwhile; ?>
        </div>
    </div>
</section>
<script>
    $(function(){
        // Search functionality
        $('#search-btn').click(function() {
            const keyword = $('#keyword-search').val().toLowerCase();
            const category = $('#category-search').val();
            
            $('.club-item').each(function() {
                const $club = $(this);
                const clubName = $club.find('h5').text().toLowerCase();
                const clubDesc = $club.find('p').text().toLowerCase();
                const clubCategory = $club.data('category');
                
                const matchesKeyword = keyword === '' || 
                    clubName.includes(keyword) || 
                    clubDesc.includes(keyword);
                    
                const matchesCategory = category === 'All categories' || 
                    clubCategory === category;
                
                if (matchesKeyword && matchesCategory) {
                    $club.show();
                } else {
                    $club.hide();
                }
            });
        });

        // Reset search when inputs change
        $('#keyword-search, #category-search').on('input change', function() {
            if ($(this).val() === '') {
                $('.club-item').show();
            }
        });
    });
</script>