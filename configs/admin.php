<!DOCTYPE html>
<html>
<head>
  <title>RStudio admin site</title>
  <!--ONLINE REQUIREMENTS-->
  <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css" rel="stylesheet" type='text/css'>
  <link href="https://opensource.keycdn.com/fontawesome/4.7.0/font-awesome.min.css" rel="stylesheet" type='text/css'>
  <!--ONLINE REQUIREMENTS-->
  <script type="text/javascript" src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
  <script type="text/javascript">
  function closeSession(){
    var dest = document.location.href.replace("//","//log:out@");
    var xhr = new XMLHttpRequest();
    xhr.open("POST", dest, true);
    xhr.setRequestHeader("Content-Type", "application/json");
    xhr.send();
    location.reload();
  }
  </script>
  <style>
  body {max-width: 1024px; margin: auto;background-color:#333;}
  </style>
</head>

<body>
  <?php
  $message="";

  if (false){
    echo "<h1 style='color:#fff;'>Not allowed</h1>";
    exit;
  }

  if (isset($_POST['action'])) {
    switch ($_POST['action']) {
      case 'create_user':
      create_user();
      break;
      case 'create_students':
      create_students();
      break;
      case 'delete_students':
      delete_students();
      break;
      case 'delete_users':
      delete_users();
      break;
    }
  }

  function create_user() {
    global $message;
    $message = "The new user has been successfully created";
  }

  function create_students() {
    global $message;
    $message = "All students were successfully added.";
  }

  function delete_students() {
    global $message;
    $message = "All students were successfully removed.";
  }

  function delete_users() {
    global $message;
    $message = "The selected users has been successfully removed.";
  }
  ?>
  <a class='btn btn-danger pull-right' onclick='javascript:closeSession()'> <i class='fa fa-sign-out' aria-hidden='true'></i> Logout</a>
  <h1 style='color:#fff;'>Welcome to RStudio admin site</h1>
  <div style="background-color:#fff;padding: 80px 60px;" class="row">
    <div class='col-sm-12' style='margin-bottom:10px;'>
      <?php
      if ($message != "") {
        echo "<div class='well'><p class='text-success'>" . $message . "</p></div>";
      }
      ?>
    </div>

    <div class='col-sm-6' style='margin-bottom:20px;'>
      <form action="admin.php" method="post">
        <h2>Create new user</h2>
        <p class='text-info'><i class='fa fa-info-circle'></i> Please type the name for the new user and the password for RStudio</p>
        <input type="hidden" name="action" value="create_user">
        <div class="form-group">
          <label for="user">User name:</label>
          <input type="text" class="form-control" id="user">
        </div>
        <div class="form-group">
          <label for="pwd">Password:</label>
          <input type="password" class="form-control" id="pwd">
        </div>
        <button type="submit" class="btn btn-success">Create user</button>
      </form>
      <form action="admin.php" method="post">
        <h2>Create new student accounts</h2>
        <p class='text-info'><i class='fa fa-info-circle'></i> Please type the total number of accounts to be created, and the prefix for the password for student accounts.</p>
        <input type="hidden" name="action" value="create_students">
        <div class="form-group">
          <label for="user">Number of accounts:</label>
          <input type="number" class="form-control" id="user">
        </div>
        <div class="form-group">
          <label for="pwd">Password prefix:</label>
          <input type="text" class="form-control" id="pwd">
        </div>
        <button type="submit" class="btn btn-success">Create student accounts</button>
      </form>
    </div>
    <div class='col-sm-6' style='margin-bottom:20px;'>
      <h2>Delete users</h2>
      <p class='text-info'><i class='fa fa-info-circle'></i> Please choose the accounts that you want to remove.</p>
      <form action="admin.php" method="post" style=" float: left; margin-right: 10px; ">
        <input type="hidden" name="action" value="delete_students">
        <button type="submit" class="btn btn-warning">Delete all student accounts</button>
      </form>
      <form action="admin.php" method="post">
        <input type="hidden" name="action" value="delete_users">
        <button type="submit" class="btn btn-danger">Delete selected users</button>
        <table class="table">
          <thead>
            <tr>
              <th></th>
              <th>User name</th>
            </tr>
          </thead>
          <tbody>
            <?php
            function getUsers() {
              $out = shell_exec('ls /home/');
              return rtrim($out, "\n");
            }
            $users = explode("\n", getUsers());
            foreach ($users as $value) {
              echo "<tr><td><input type='checkbox' name='delete_users' value='" . $value . "'></td><td>" . $value . "</td></tr>";
            }
            ?>
          </tbody>
        </table>
      </form>
    </div>
  </div>
</body>
</html>
