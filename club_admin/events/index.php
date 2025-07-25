<?php if($_settings->chk_flashdata('success')): ?>
<script>
	alert_toast("<?php echo $_settings->flashdata('success') ?>",'success')
</script>
<?php endif;?>
<div class="card card-outline rounded-0 card-navy">
	<div class="card-header">
		<h3 class="card-title">List of Events</h3>
		<div class="card-tools">
			<a href="./?page=events/manage_event" class="btn btn-flat btn-primary"><span class="fas fa-plus"></span> Create New</a>
		</div>
	</div>
	<div class="card-body">
        <div class="container-fluid">
			<table class="table table-hover table-striped table-bordered" id="list">
				<colgroup>
					<col width="5%">
					<col width="15%">
					<col width="20%">
					<col width="20%">
					<col width="15%">
					<col width="15%">
					<col width="10%">
				</colgroup>
				<thead>
					<tr>
						<th>#</th>
						<th>Date Created</th>
						<th>Event</th>
						<th>Schedule</th>
						<th>Location</th>
						<th>Status</th>
						<th>Action</th>
					</tr>
				</thead>
				<tbody>
					<?php 
					$i = 1;
						$qry = $conn->query("SELECT * from `event_list` where club_id = '{$_settings->userdata('club_id')}' and delete_flag = 0 order by `name` asc ");
						while($row = $qry->fetch_assoc()):
					?>
						<tr>
							<td class="text-center"><?php echo $i++; ?></td>
							<td><?php echo date("Y-m-d H:i",strtotime($row['date_created'])) ?></td>
							<td><?php echo $row['name'] ?></td>
							<td>
								<p class="m-0"><b>Start:</b> <?php echo date("M d, Y h:i A",strtotime($row['start_datetime'])) ?></p>
								<p class="m-0"><b>End:</b> <?php echo date("M d, Y h:i A",strtotime($row['end_datetime'])) ?></p>
							</td>
							<td><?php echo $row['location'] ?></td>
							<td class="text-center">
								<?php if($row['status'] == 1): ?>
									<span class="badge badge-success px-3 rounded-pill">Approved</span>
								<?php elseif($row['status'] == 2): ?>
									<span class="badge badge-danger px-3 rounded-pill">Rejected</span>
								<?php else: ?>
									<span class="badge badge-primary px-3 rounded-pill">Pending</span>
								<?php endif; ?>
							</td>
							<td align="center">
								<button type="button" class="btn btn-flat p-1 btn-default btn-sm dropdown-toggle dropdown-icon" data-toggle="dropdown">
									Action
								<span class="sr-only">Toggle Dropdown</span>
								</button>
								<div class="dropdown-menu" role="menu">
									<a class="dropdown-item" href="./?page=events/view_event&id=<?php echo $row['id'] ?>"><span class="fa fa-eye text-dark"></span> View</a>
									<div class="dropdown-divider"></div>
									<a class="dropdown-item" href="./?page=events/manage_event&id=<?php echo $row['id'] ?>"><span class="fa fa-edit text-primary"></span> Edit</a>
									<div class="dropdown-divider"></div>
									<a class="dropdown-item delete_data" href="javascript:void(0)" data-id="<?php echo $row['id'] ?>"><span class="fa fa-trash text-danger"></span> Delete</a>
								</div>
							</td>
						</tr>
					<?php endwhile; ?>
				</tbody>
			</table>
		</div>
	</div>
</div>
<script>
	$(document).ready(function(){
		$('.delete_data').click(function(){
			_conf("Are you sure to delete this event permanently?","delete_event",[$(this).attr('data-id')])
		})
		$('.table').dataTable({
			columnDefs: [
					{ orderable: false, targets: [6] }
			],
			order:[0,'asc']
		});
		$('.dataTable td,.dataTable th').addClass('py-1 px-2 align-middle')
	})
	function delete_event($id){
		start_loader();
		$.ajax({
			url:_base_url_+"classes/Master.php?f=delete_event",
			method:"POST",
			data:{id: $id},
			dataType:"json",
			error:err=>{
				console.log(err)
				alert_toast("An error occurred.",'error');
				end_loader();
			},
			success:function(resp){
				if(typeof resp== 'object' && resp.status == 'success'){
					location.reload();
				}else{
					alert_toast("An error occurred.",'error');
					end_loader();
				}
			}
		})
	}
</script> 