<?php 
@session_start();
require("connection.php");

 	if (isset($_SESSION['user'])) {
 		# code...

 		// $user_info = $_SESSION['user'];
 		// $user_id = $user_info['id'];

 		// $summary_query = "SELECT status.term as term, status.definition as definition, COUNT(DISTINCT user_id) as count FROM summary RIGHT JOIN status ON summary.status_id=status.id Group by status.term, status.definition Order By count desc;";
 		$usersSummary_query = "SELECT c.term as term, d.first_name as firstname, d.last_name as lastname, d.email as email FROM (SELECT user_id as user_id, max(timestamp) as latest FROM `summary` GROUP by user_id) as a LEFT JOIN summary as b ON a.latest=b.timestamp RIGHT JOIN status as c on b.status_id = c.id LEFT JOIN users as d on a.user_id = d.id Group by c.term, d.first_name, d.last_name, d.email";
 		$usersSummary_array = mysqli_query($conn, $usersSummary_query); 		
 	}

 	$x = 0;

?>


<!-- <div class="col-md-9 d-flex align-items-stretch">
	<input id="searchTable" class="form-control mr-sm-2" type="search" placeholder="Search name or status" aria-label="Search">
</div> -->
<div class="col-md-9 d-flex align-items-stretch">
  <div class="table-responsive">
	<table  id="dashboardTable" class="table text-center">
	  <thead class="thead-styling">
	    <tr>
	      <th scope="col">#</th>
	      <th scope="col">First name</th>
	      <th scope="col">Last name</th>
	      <th scope="col">Email</th>
	      <th scope="col">Current Status</th>
	    </tr>
	  </thead>
	  <tbody id="resultTable" >

<?php foreach ($usersSummary_array as $users): ?>
		    <tr>
		      <th scope="row"><?php echo ++$x; ?></th>
		      <td><?php echo $users['firstname']; ?></td>
		      <td><?php echo $users['lastname']; ?></td>
		      <td><?php echo $users['email']; ?></td>
		      <td><?php echo $users['term']; ?></td>
		    </tr>	
<?php endforeach ?>
	  </tbody>
	</table>
  </div>
</div>



<!-- External Script -->
<!-- <script type="text/javascript" src="../assets/js/getdashboard_searchuser.js"></script> -->