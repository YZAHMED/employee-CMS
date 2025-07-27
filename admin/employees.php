<?php

include( 'includes/database.php' );
include( 'includes/config.php' );
include( 'includes/functions.php' );

secure();

  if( isset( $_GET['delete'] ) )
  {
    
    $id = $_GET['delete'];
    
    $query = 'DELETE FROM employees WHERE id = '.$id.' LIMIT 1';
    mysqli_query( $connect, $query );
    
    set_message( 'Employee has been deleted' );
    
    header( 'Location: employees.php' );
    die();
    
  }

include( 'includes/header.php' );

?>

  <h2>Employees</h2>

  <p>
    <a href="employees_add.php">Add Employee</a>
  </p>

<?php get_message(); ?>

<table border="1">
  <tr>
    <th>ID</th>
    <th>Photo</th>
    <th>Name</th>
    <th>Email</th>
    <th>Phone</th>
    <th>Department</th>
    <th>Position</th>
    <th>Hire Date</th>
    <th>Salary</th>
    <th>Status</th>
    <th></th>
    <th></th>
  </tr>
  <?php
  
  $query = 'SELECT * FROM employees ORDER BY last_name, first_name';
  $result = mysqli_query( $connect, $query );
  
  while( $record = mysqli_fetch_assoc( $result ) )
  {
    
    ?>
    <tr>
      <td><?php echo $record['id']; ?></td>
      <td>
        <?php if($record['photo']): ?>
          <img src="<?php echo $record['photo']; ?>" width="50">
        <?php else: ?>
          <p>No photo</p>
        <?php endif; ?>
      </td>
      <td><?php echo $record['first_name'].' '.$record['last_name']; ?></td>
      <td><?php echo $record['email']; ?></td>
      <td><?php echo $record['phone']; ?></td>
      <td><?php echo $record['department']; ?></td>
      <td><?php echo $record['position']; ?></td>
      <td><?php echo $record['hire_date']; ?></td>
      <td>$<?php echo number_format($record['salary'], 2); ?></td>
      <td><?php echo $record['status']; ?></td>
      <td>
        <a href="employees_edit.php?id=<?php echo $record['id']; ?>">Edit</a> |
        <a href="employees_photo.php?id=<?php echo $record['id']; ?>">Photo</a>
      </td>
      <td>
        <a href="employees.php?delete=<?php echo $record['id']; ?>" onclick="return confirm('Are you sure you want to delete this employee?')">Delete</a>
      </td>
    </tr>
    <?php
    
  }
  
  ?>
</table>

<p>
  <a href="dashboard.php">Back to Dashboard</a>
</p>

<?php

include( 'includes/footer.php' );

?> 