<?php
$filename = "data/users.txt";
$fp = fopen($filename,"r");

$array= [];
while($users = fgetcsv($fp)){
    $array[] = $users;
}
if(isset($_POST["delete"])){
    $deletedata = (int) $_POST["delete"];
    unset($array[$deletedata]);
    $m_array = array_values($array);
    $fp = fopen($filename,"w");
   foreach($m_array as $line ){
    fputcsv($fp, $line);
   }
}
if(isset($_POST["add_user"])){
$firstname = $_POST["firstname"] ;
$lastname = $_POST["lastname"] ;
$email = $_POST["email"] ;
$password = $_POST["password"]; 
$role = $_POST["role"] ;
if ($email != "" && $password  != "" && $firstname!="" && $lastname!="" && $role!="") {
    $data = file_get_contents($filename);  
    $fp = fopen($filename, "w");
    fwrite($fp,$data);
    fwrite($fp, "\n{$role}, {$email}, {$password}, {$firstname}, {$lastname}");
    fclose($fp);
}
}
//var_dump($deletedata);
//print_r($array[2]);
?>
<!DOCTYPE html>
<html>
<head>
    <title>Admin Dashboard</title>
    <!-- Add Bootstrap CSS link -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
</head>
<body>
    <div class="container mt-5">
        <div class="row justify-content-between">
            <div class="col-md-6">
                <h1>Admin Dashboard</h1>
            </div>
            <div class="col-md-6 text-right">
                <form method="post" action="logout.php">
                    <button type="submit" name="logout" class="btn btn-danger">Logout</button>
                </form>
            </div>
        </div>
        <h3>Welcome,Home!</h3>    

        <table class="table mt-4">
            <thead>
                <tr>
                    <th>First Name</th>
                    <th>Last Name</th>
                    <th>Email</th>
                    <th>Role</th>
                    <th>id</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                    <?php foreach( $array as $offset=>$user): ?>
                        <?php STATIC $count = -1;
                              $count++; 
                              ?>
                        
                     <tr>
                        
                        <td><?php echo trim($user[3]); ?></td>
                        <td><?php echo trim($user[4]); ?></td>
                        <td><?php echo trim($user[1]); ?></td>
                        <td><?php echo trim($user[0]); ?></td>
                        <td><?php echo $count; ?></td>

                        <td>
                            <form method="POST">
                                <button type="submit" name="edit" value="" class="btn btn-primary">Edit</button>
                                <button type="submit" name="delete" value="<?php echo $count; ?>" class="btn btn-danger">Delete</button>
                            </form>
                        </td>
                    </tr>
                    <?php endforeach; ?>
              
            </tbody>
        </table>
        <br>
        <br>
        <form method="POST">
            <div class="form-row">
                <div class="form-group col-md-2">
                    <input type="text" class="form-control" name="firstname" placeholder="First Name">
                </div>
                <div class="form-group col-md-2">
                    <input type="text" class="form-control" name="lastname" placeholder="Last Name">
                </div>
                <div class="form-group col-md-4">
                    <input type="text" class="form-control" name="email" placeholder="Email">
                </div>
                <div class="form-group col-md-2">
                    <input type="password" class="form-control" name="password" placeholder="Password">
                </div>
                <div class="form-group col-md-2">
                    <select name="role" class="form-control">
                        <option value="admin">Admin</option>
                        <option value="manager">Manager</option>
                        <option value="user">User</option>
                    </select>
                </div>
            </div>
            <button type="submit" name="add_user" class="btn btn-success">Add User</button>
        </form>
    </div>

    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
</body>
</html>
