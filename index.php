<?php

include( 'admin/includes/database.php' );
include( 'admin/includes/config.php' );
include( 'admin/includes/functions.php' );

?>
<!doctype html>
<html>
<head>
  
  <meta charset="UTF-8">
  <meta http-equiv="Content-type" content="text/html; charset=UTF-8">
  
  <title>Employee Management System - Company Portal</title>
  
  <style>
    body {
      font-family: Arial, sans-serif;
      max-width: 1200px;
      margin: auto;
      padding: 20px;
      background-color: #f5f5f5;
    }
         .header {
       background: #007bff;
       color: white;
       padding: 20px;
       margin-bottom: 30px;
       text-align: center;
     }
    .stats-container {
      display: grid;
      grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
      gap: 20px;
      margin-bottom: 30px;
    }
         .stat-card {
       background: white;
       padding: 20px;
       text-align: center;
     }
    .stat-number {
      font-size: 2.5em;
      font-weight: bold;
      color: #007bff;
    }
    .employees-grid {
      display: grid;
      grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
      gap: 20px;
    }
         .employee-card {
       background: white;
       padding: 20px;
       border: 1px solid #ccc;
     }
    .employee-name {
      font-size: 1.2em;
      font-weight: bold;
      color: #333;
      margin-bottom: 10px;
    }
    .employee-info {
      color: #666;
      margin: 5px 0;
    }
    .department-badge {
      background: #e9ecef;
      padding: 4px 8px;
      border-radius: 12px;
      font-size: 0.8em;
      color: #495057;
    }
         .admin-link {
       text-align: center;
       margin-top: 30px;
       padding: 20px;
       background: #f8f9fa;
     }
    .admin-link a {
      color: #007bff;
      text-decoration: none;
      font-weight: bold;
    }

    #clock-in-section {
  background: white;
  padding: 20px;
  border: 1px solid #ccc;
  margin-bottom: 30px;
  border-radius: 4px;
  margin-top: 30px;
}

#clock-in-form {
  display: flex;
  flex-direction: column;
  gap: 15px;
  max-width: 400px;
}

#clock-in-form label {
  font-weight: bold;
  color: #333;
}

#clock-in-form select {
  padding: 10px;
  font-size: 1em;
  border: 1px solid #ccc;
  border-radius: 4px;
}

#clock-in-form button {
  background-color: #007bff;
  color: white;
  padding: 10px;
  font-size: 1em;
  border: none;
  border-radius: 4px;
  cursor: pointer;
}

#clock-in-form button:hover {
  background-color: #0056b3;
}

  </style>
  
</head>
<body>

  <div class="header">
    <h1>Employee Portal</h1>
    <p>Employee Management System</p>
  </div>

  <div class="stats-container">
    <?php
    $query = 'SELECT COUNT(*) as total FROM employees';
    $result = mysqli_query( $connect, $query );
    $total_employees = mysqli_fetch_assoc($result)['total'];
    
    $query = 'SELECT COUNT(*) as total FROM employees WHERE status = "Active"';
    $result = mysqli_query( $connect, $query );
    $active_employees = mysqli_fetch_assoc($result)['total'];
    
    $query = 'SELECT COUNT(*) as total FROM departments';
    $result = mysqli_query( $connect, $query );
    $total_departments = mysqli_fetch_assoc($result)['total'];
    
    $query = 'SELECT AVG(salary) as avg_salary FROM employees WHERE status = "Active"';
    $result = mysqli_query( $connect, $query );
    $avg_salary = mysqli_fetch_assoc($result)['avg_salary'];
    ?>
    
    <div class="stat-card">
      <div class="stat-number"><?php echo $total_employees; ?></div>
      <div>Total Employees</div>
    </div>
    
    <div class="stat-card">
      <div class="stat-number"><?php echo $active_employees; ?></div>
      <div>Active Employees</div>
    </div>
    
    <div class="stat-card">
      <div class="stat-number"><?php echo $total_departments; ?></div>
      <div>Departments</div>
    </div>
    
    <div class="stat-card">
      <div class="stat-number">$<?php echo number_format($avg_salary, 0); ?></div>
      <div>Average Salary</div>
    </div>
  </div>

  <h2>Employee Directory</h2>
  <p>Our team:</p>

  <div class="employees-grid">
    <?php
    $query = 'SELECT * FROM employees WHERE status = "Active" ORDER BY last_name, first_name';
    $result = mysqli_query( $connect, $query );
    
    while($record = mysqli_fetch_assoc($result)):
    ?>
    
    <div class="employee-card">
      <?php if($record['photo']): ?>
        <div style="text-align: center; margin-bottom: 15px;">
          <img src="<?php echo $record['photo']; ?>" style="width: 100px; height: 100px; border: 1px solid #ccc;">
        </div>
      <?php endif; ?>
      <div class="employee-name"><?php echo $record['first_name'] . ' ' . $record['last_name']; ?></div>
      <div class="employee-info">
        <strong>Position:</strong> <?php echo $record['position']; ?>
      </div>
      <div class="employee-info">
        <strong>Department:</strong> 
        <span class="department-badge"><?php echo $record['department']; ?></span>
      </div>
      <div class="employee-info">
        <strong>Email:</strong> <?php echo $record['email']; ?>
      </div>
      <div class="employee-info">
        <strong>Hired:</strong> <?php echo date('M Y', strtotime($record['hire_date'])); ?>
      </div>
    </div>
    
    <?php endwhile; ?>
  </div>

  <h2>Department Overview</h2>
  <div class="employees-grid">
    <?php
    $query = 'SELECT d.name, d.description, COUNT(e.id) as employee_count 
              FROM departments d 
              LEFT JOIN employees e ON d.name = e.department AND e.status = "Active"
              GROUP BY d.id 
              ORDER BY d.name';
    $result = mysqli_query( $connect, $query );
    
    while($record = mysqli_fetch_assoc($result)):
    ?>
    
    <div class="employee-card">
      <div class="employee-name"><?php echo $record['name']; ?> Department</div>
      <div class="employee-info"><?php echo $record['description']; ?></div>
      <div class="employee-info">
        <strong>Employees:</strong> <?php echo $record['employee_count']; ?>
      </div>
    </div>
    
    <?php endwhile; ?>
  </div>

  
    <!-- 
  created employee drop down
  next submit to function that updates employee clocked in boolean to true
  then create section that shows clocked in employees (select all where clocked in is true)
  create clock out form/button and function update clocked in to false

  update database to include employee time logs table
  update clock in the log clock in time
  update clock out to log clock out time 
  
  back end employee time log reading

  if still have time after this, add live time reading

  afterwards format sections html css
  
  
    -->
  <h2>Clock In Employes</h2>
  <section id="clock-in-section">
    <form id="clock-in-form" method="POST">
      <label for="employee">Select Employee: </label>
      <select name="employee">
        <option value="">--Please choose an option--</option>
        <?php
        $query = 'SELECT * FROM employees WHERE clocked_in = FALSE ORDER BY last_name, first_name';
        $result = mysqli_query( $connect, $query );
      while ($record = mysqli_fetch_assoc($result)){
        echo '<option value="' . $record["id"] . '">' . $record["first_name"] . ' '.$record["last_name"] . '</option>';
      }
        ?>
      </select>
      <button type="submit" name="clockin">Clock In</button>
    </form>
    </section>

  <section id="clocked-in-employees">
  <div class="employees-grid">
  <?php

 function listClockedinEmployees() {

  global $connect;

  $query = '
    SELECT e.*, tl.timestamp AS clocked_in_at, 
           TIMESTAMPDIFF(MINUTE, tl.timestamp, NOW()) AS minutes_clocked_in
    FROM employees e
    JOIN (
      SELECT employee_id, MAX(timestamp) AS timestamp
      FROM time_logs
      WHERE action = "clock_in"
      GROUP BY employee_id
    ) tl ON e.id = tl.employee_id
    WHERE e.clocked_in = TRUE
    ORDER BY tl.timestamp DESC
  ';

  $result = mysqli_query($connect, $query);

  while ($record = mysqli_fetch_assoc($result)) {
    $minutes = (int)$record['minutes_clocked_in'];
    $hours = floor($minutes / 60);
    $remaining = $minutes % 60;
    $duration = ($hours > 0 ? $hours . 'h ' : '') . $remaining . 'm';

    echo '
    <article class="employee-container-ci">
      <div class="employee-card">
        <h3>' . $record['first_name'] . ' ' . $record['last_name'] . '</h3>
        <p>' . $record['position'] . '</p>
        <p>clocked in at: ' . $record['clocked_in_at'] . ' (' . $duration . ' ago)</p>
        <form method="POST">
          <input type="hidden" name="id" value="' . $record['id'] . '"/>
          <button type="submit" name="clockOut"> Clock Out </button>
        </form>
      </div>
    </article>
    ';
  }
}

 listClockedinEmployees();


  ?>
</div>
  <section>

    <?php

    if($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['clockin'])){

      // get id from form

      $id = $_POST['employee'];

      //check if user is clocked in (not really neccesary but just incase)

      function checkEmployeeClockedIn($employeeid){

         global $connect;

        $query = 'SELECT clocked_in FROM employees WHERE id = "' . $employeeid . '"';
        $result = mysqli_query($connect, $query);
        
        if ($record = mysqli_fetch_assoc($result)){
          if($record['clocked_in']){
            die('Employee already clocked in.');
          }
        }
      }

      checkEmployeeClockedIn($id);
      

      //set user of this id clocked in boolean to true

      function clockInEmployee($employeeid){

        global $connect;

        $query = 'UPDATE employees SET clocked_in = TRUE WHERE id = "' . $employeeid . '"';
        $result = mysqli_query($connect, $query);

        if(!$result){
          die("Error clocking in employee");
        }

        // log employee clock in

         $logQuery = 'INSERT INTO time_logs (employee_id, action) VALUES ("' . $employeeid . '", "clock_in")';
          mysqli_query($connect, $logQuery);

        header("Location: " . $_SERVER['PHP_SELF']);
        exit;
    

      }

      clockInEmployee($id);

    }

    // clock out emplyee

    if($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['clockOut'])){

      $id = $_POST['id'];

      function clockOutEmployee($employeeid){

        global $connect;

        $query = 'UPDATE employees SET clocked_in = FALSE WHERE id ="' . $employeeid . '"';
        $result = mysqli_query($connect, $query);

        if(!$result){
          die("Error clocking out employee.");
        }

        // log employee clock out

        $logQuery = 'INSERT INTO time_logs (employee_id, action) VALUES ("' . $employeeid . '", "clock_out")';
        mysqli_query($connect, $logQuery);

         header("Location: " . $_SERVER['PHP_SELF']);
        exit;

      }

      clockOutEmployee($id);
    }

    ?>


<div class="admin-link">
    <p><a href="admin/">Admin Login</a> - For authorized personnel only</p>
    
  </div>

</body>
</html>
