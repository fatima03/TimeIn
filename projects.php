<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Projects</title>

    <!-- Plugins -->
    <link rel="stylesheet" href="plugins/bootstrap/css/bootstrap.min.css">
    <script src="plugins/jquery/jquery-3.5.1.min.js"></script>
    <script src="plugins/bootstrap/js/bootstrap.min.js"></script>

    <?php 
      include 'app.php';
      if (isset($_POST['add_project'])) {
        $job_no = $app->cleanInput($_POST['job_no']);
        $proj_name = $app->cleanInput($_POST['proj_name']);
        $proj_ref = $app->cleanInput($_POST['proj_ref']);
        $proj_id = $app->cleanInput($_POST['proj_ref']);
        $app->addProject($job_no, $proj_name, $proj_ref, $proj_id);
      }
    ?>

  </head>
  <body>

    <nav class="navbar navbar-inverse">
      <div class="container-fluid">
        <div class="navbar-header">
          <a class="navbar-brand" href="index.php">WebSiteName</a>
        </div>
        <ul class="nav navbar-nav">
          <li><a href="index.php">Dashboard</a></li>
          <li class="active"><a href="projects.php">Projects</a></li>
          <li><a href="#">Staff</a></li>
          <li><a href="#">TimeSheet</a></li>
          <li><a href="#">Invoice</a></li>
        </ul>
        <ul class="nav navbar-nav navbar-right">
          <li><a href="#"><span class="glyphicon glyphicon-user"></span> Sign Up</a></li>
          <li><a href="#"><span class="glyphicon glyphicon-log-in"></span> Login</a></li>
        </ul>
      </div>
    </nav>

    <div class="container-fluid">
      <div class="table-responsive ">          
        <table class="table table-hover">
          <thead>
            <tr>
              <th></th>
              <th>Job Number</th>
              <th>Project Name</th>
              <th>Project Reference</th>
              <th>Project ID</th>
              <th></th>
            </tr>
          </thead>
          <tbody>
            <?php $sr_no = 1; 
              $result = $app -> getProjects();
              if ( !is_string($result)) {
                while($row = $result->fetch_assoc()) {
                  echo "<tr>";
                  echo "<td>".$sr_no++."</td>";
                  foreach ($row as $x) {
                    echo "<td>".$x."</td>";
                  }
                  echo "<td></td>";
                  echo "</tr>";
                }
              }
            ?>
            <tr>
              <form method="post" action="" class="form-horizontal">
                <td><?=$sr_no?></td>
                <td><input type="text" name="job_no" style="width: 100%;"></td>
                <td><input type="text" name="proj_name" style="width: 100%;"></td>
                <td><input type="text" name="proj_ref" style="width: 100%;"></td>
                <td><input type="text" name="proj_id" style="width: 100%;"></td>
                <td><input type="submit" name="add_project" class="btn btn-primary" value="+ Add Project"></td>
              </form>
          </tbody>
        </table>
      </div>

    </div>
  </body>
</html>