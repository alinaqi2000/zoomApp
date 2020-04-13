<?php
$mode = '';
$users = array();
$users = array(
    array(
        "name" => "Ali Naqi",
        "cnic" => 124234324,
        "gender" => 'male',
        "degree" => 'graduation'
    ),
    array(
        "name" => "Ashraf",
        "cnic" => 234234324,
        "gender" => 'male',
        "degree" => 'intermediate'
    ),
    array(
        "name" => "Haseeb",
        "cnic" => 234234324324,
        "gender" => 'male',
        "degree" => 'graduation'
    ),
    array(
        "name" => "Izmah",
        "cnic" => 53224325532,
        "gender" => 'female',
        "degree" => 'intermediate'
    )

);
if (isset($_POST['usr_entry'])) {
    $mode = 'view';
    $name = $_POST['name'];
    $cnic = $_POST['cnic'];
    $gender = $_POST['gender'];
    $degree = $_POST['degree'];
}
?>
<div class="col-md-12 col-xs-12">
    <div class="col-12">
        <h1>User Entry</h1>
        <?php
        if ($mode == 'view') {

        ?>
            <div class="col-md-8">
                <div class="row overflow-auto">
                    <table class="table table-hover <?= $themeMode == 'light' ? '' : 'table-dark'; ?>">
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>CNIC</th>
                                <th>Gender</th>
                                <th>Degree</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td><?= $name ?></td>
                                <td><?= $cnic ?></td>
                                <td class="<?= $gender == 'male' ? 'text-success' : 'text-danger'; ?>"><?= $gender == 'male' ? 'Male' : 'Female'; ?></td>
                                <td><?= $degree ?></td>
                            </tr>
                        </tbody>
                    </table>
                    <div class="form-group">
                        <a href="<?= $path ?>index.php?page=users_entry" class="btn <?= $themeMode == 'light' ? 'btn-secondary' : 'btn-outline-secondary'; ?>">Enter New User</a>
                    </div>

                </div>
            </div>
        <?php
        } else {
        ?>
            <div class="col-md-12 my-3">
                <div class="row">
                    <form class="col-md-4" method="post">
                        <div class="form-group">
                            <input type="text" name="name" placeholder="Enter name" class="form-control">
                        </div>
                        <div class="form-group">
                            <input type="number" name="cnic" placeholder="Enter cnic" class="form-control">
                        </div>
                        <div class="form-group">
                            <select name="gender" class="form-control">
                                <option value="0" selected disabled>Select Gender</option>
                                <option value="male">Male</option>
                                <option value="female">Female</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <select name="degree" class="form-control">
                                <option value="0" selected disabled>Select Degree</option>
                                <option value="intermediate">Intermediate</option>
                                <option value="graduation">Graduation</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <input type="submit" class="btn <?= $themeMode == 'light' ? 'btn-info' : 'btn-outline-info'; ?> w-100" name="usr_entry" value="Enter User">
                        </div>
                    </form>
                </div>
            </div>
            <div class="col-md-8">
                <div class="row overflow-auto">
                    <table class="table table-striped table-hover <?= $themeMode == 'light' ? '' : 'table-dark'; ?>">
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>CNIC</th>
                                <th>Gender</th>
                                <th>Degree</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            foreach ($users as $user) {
                            ?>
                                <tr>
                                    <td><?= $user['name'] ?></td>
                                    <td><?= $user['cnic'] ?></td>
                                    <td class="<?= $user['gender'] == 'male' ? 'text-success' : 'text-danger'; ?>"><?= $user['gender'] == 'male' ? 'Male' : 'Female'; ?></td>
                                    <td><?= $user['degree'] ?></td>
                                </tr>
                            <?php
                            }
                            ?>
                        </tbody>
                    </table>


                </div>
            </div>
        <?php
        }
        ?>
    </div>
</div>