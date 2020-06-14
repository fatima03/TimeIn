<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Projects</title>

    <!-- Plugins -->
    <link rel="stylesheet" href="plugins/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="plugins/style.css">
    <script src="plugins/jquery/jquery-3.5.1.min.js"></script>
    <script src="plugins/bootstrap/js/bootstrap.min.js"></script>

    <?php 
      include 'app.php';

      if (isset($_POST['add_project'])) {
        $job_code = $app->cleanInput($_POST['job_code']);
        $proj_name = $app->cleanInput($_POST['proj_name']);
        $proj_ref = $app->cleanInput($_POST['proj_ref']);
        $proj_id = $app->cleanInput($_POST['proj_id']);
        $app->addProject($job_code, $proj_name, $proj_ref, $proj_id);
      }

      if (isset($_POST['save_project'])) {
        $job_code = $app->cleanInput($_POST['old_job_code']);
        $proj_name = $app->cleanInput($_POST['new_proj_name']);
        $proj_ref = $app->cleanInput($_POST['new_proj_ref']);
        $proj_id = $app->cleanInput($_POST['new_proj_id']);
        $app->editProject($job_code, $proj_name, $proj_ref, $proj_id);
      }

      if (isset($_POST['remove_project'])) {
        $job_code = $app->cleanInput($_POST['del_job_code']);
        $app->removeProject($job_code);
      }


    ?>

  </head>

  <body>
  <form id="projectForm" method="post" action="" class="form-horizontal">

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

    <div class="container-fluid col-md-10 col-md-offset-1">
      <div class="table-responsive">          
        <table class="table table-striped table-hover">
          <thead>
            <tr>
              <th></th>
              <th>Job Code</th>
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
                  echo '<tr>';
                  echo '<td>'.$sr_no++.'</td>';
                  foreach ($row as $col => $x) {
                    echo '<td class="'.$col.'">'.$x.'</td>';
                  }
                  echo '<td align="center">';
                  echo '<button type="button" class="btn btn-warning btn-xs editProject">
                        <span class="glyphicon glyphicon-pencil"></span> 
                        </button>&emsp;';
                  echo '<button type="submit" name="remove_project" class="btn btn-danger btn-xs removeProject">
                        <span class="glyphicon glyphicon-remove" color="red"></span> 
                        </button>';
                  echo '</td>';
                  echo '</tr>';
                }
              }
            ?>
            <tr>
              <td id="abc"><?=$sr_no?></td>
              <td><input type="text" name="job_code" style="width: 100%;"></td>
              <td><input type="text" name="proj_name" style="width: 100%;"></td>
              <td><input type="text" name="proj_ref" style="width: 100%;"></td>
              <td><input type="text" name="proj_id" style="width: 100%;"></td>
              <td align="center"><input type="submit" name="add_project" class="btn btn-primary" value="+ Add Project"></td>
            </tr>
          </tbody>
        </table>
      </div>
    </div>

  </form>

  <script>
    $(document).ready(function(){

      /* Script for Edit button */
      $(".editProject").click(function(){
        // $(".editProject").hide();
        var btn = '<input type="submit" name="save_project" class="btn btn-warning" value="Save">';
        $(this).parent().append(btn);
        //job_code
        var c1 = $(this).parents("tr").children(".job_code");
        var t1 = '<input type="hidden" name="old_job_code" value="'+c1.text()+'" style="width: 100%;">';
        c1.append(t1);
        //proj_name
        var c1 = $(this).parents("tr").children(".proj_name");
        var t1 = '<input type="text" name="new_proj_name" value="'+c1.text()+'" style="width: 100%;">';
        c1.text('');
        c1.append(t1);
        //proj_ref
        var c1 = $(this).parents("tr").children(".proj_ref");
        var t1 = '<input type="text" name="new_proj_ref" value="'+c1.text()+'" style="width: 100%;">';
        c1.text('');
        c1.append(t1);
        //proj_id
        var c1 = $(this).parents("tr").children(".proj_id");
        var t1 = '<input type="text" name="new_proj_id" value="'+c1.text()+'" style="width: 100%;">';
        c1.text('');
        c1.append(t1);
        $(".editProject").remove();
        $(".removeProject").remove();
      });

      $(".removeProject").click(function(){
       
        //job_code in a hidden location
        var c1 = $(this).parents("tr").children(".job_code");
        var t1 = '<input type="hidden" name="del_job_code" value="" style="width: 100%;">';
        if( confirm('Are you sure you want to delete "'+c1.text()+'"?') ) {
            t1 = '<input type="hidden" name="del_job_code" value="'+c1.text()+'" style="width: 100%;">';
        }
        c1.append(t1);

      });

    });
  </script>

  </body>
</html>