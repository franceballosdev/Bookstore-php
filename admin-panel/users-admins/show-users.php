<?php require "../includes/header.php"; ?>  
<?php require "../../config/config.php"; ?> 

<?php

    if(!isset($_SESSION['admin_name'])) {
        header('location: '.ADMINURL. "/admins/login-admins.php");     
    }

    $search = isset($_GET['search']) ? $_GET['search'] : '';

    if (!empty($search)) {
        $select = $conn->prepare("SELECT * FROM users WHERE username LIKE ? OR email LIKE ?");
        $select->execute(["%$search%", "%$search%"]);
    } else {
        $select = $conn->query("SELECT * FROM users");
        $select->execute();
    }

    $users = $select->fetchAll(PDO::FETCH_OBJ);
?>
    <div class="container mt-5" style="font-family: 'Fira Sans', sans-serif; margin-bottom: 100px;">
        <div class="row">
            <div class="col">
                <h1 class="text-center mb-5">List showing all the users registered</h1>
                <form action="show-users.php" method="GET">
                <div class="d-flex justify-content-end w-100">
                    <div class="input-group mb-3 mt-3 w-50">
                        <input type="text" name="search" class="form-control" placeholder="Search users by username or email" value="<?= $search ?>">
                        <button type="submit" class="btn btn-dark btn-lg" style="background-color: #130303; border-radius: 0 1rem 1rem 0  ;"> Search </button>
                    </div>
                </div>
                </form>
                <?php if(!empty($users)): ?>
                <div class="card rounded-4 shadow">
                    <div class="card-body">
                        <h3 class="card-title d-inline">All users</h3>
                        <table class="table mb-5 table-hover mt-5">
                            <thead>
                                <tr>
                                    <th scope="col">id</th>
                                    <th scope="col">Username</th>
                                    <th scope="col">Email</th>
                                    <th scope="col">User created at</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach($users as $user): ?>
                                    <tr>
                                        <th scope="row"><?= $user->id ?></th>
                                        <td><?= $user->username ?></td>
                                        <td><?= $user->email ?></td>
                                        <td><?= $user->created_at ?></td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
                <?php else: ?>
                    <div class="card rounded-4 shadow">
                        <div class="card-body">
                            <h1 class="card-title d-inline">There are no users</h1>
                        </div>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
