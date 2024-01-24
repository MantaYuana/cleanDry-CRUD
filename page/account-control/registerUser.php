<!-- TODO: add bootstrap custom form validation -->
<?php
if ($_SESSION['role'] != "admin") {
    echo "<script>alert('You are not premitted into the Page !'); window.location.href = '../../page/page.php?page=dashboard';</script>";
    exit();
}

$query = mysqli_query($conn, "SELECT id, nama FROM outlet;");
$res = mysqli_fetch_all($query);
?>

<section id="register" class="bg-body-secondary vh-100">
    <div class="container">
        <br>
        <h6 class="mt-3">Admin Menu - <span class="fw-bolder text-decoration-underline"><?= $_SESSION['outlet']['nama'] ?>,</span></h6>
        <h2 class="fw-medium" style="color: var(--mc-green-dark);">Register <span class="fw-bolder" style="color: var(--mc-green-dark-mono);">User</span></h2>
        <br>

        <div class="border rounded-4 bg-white col-8">
            <div class="border pt-3 pb-1 d-flex justify-content-center">
                <h5>Add User</h5>
            </div>
            <div class="border rounded-4 p-5">
                <form action="../php/helper/account_process.php" method="post">
                    <div class="mb-3 col-8">
                        <label for="register-name" class="form-label">Name <span class="text-danger">*</span> </label>
                        <input type="text" name="register-name" class="form-control p-2" id="register-name" required>
                    </div>
                    <div class="mb-3 col-8">
                        <label for="register-username" class="form-label">Username <span class="text-danger">*</span></label>
                        <input type="text" name="register-username" class="form-control p-2" id="register-username" required>
                    </div>
                    <div class="mb-3 col-8">
                        <label for="register-password" class="form-label">Password <span class="text-danger">*</span></label>
                        <input type="password" name="register-password" class="form-control p-2" id="register-password" required>
                    </div>
                    <div class="d-flex flex-row mb-3 col-8">
                        <div class="me-3">
                            <label for="register-outlet" name="register-outlet" class="form-label">What outlet is you're based at ? <span class="text-danger">*</span></label>
                            <input type="text" list="outletOptions" name="register-outlet" class="form-control p-2" id="register-username" required autocomplete="off">
                            <!-- TODO: maybe use regex to only take the first 4 numbers -->
                            <datalist id="outletOptions" required>
                                <?php foreach ($res as $key => $value) {
                                    $val = $value[0];
                                    $name = $value[1];
                                    echo "<option value='$val'>$val - $name</option>";
                                } ?>
                            </datalist>
                        </div>

                        <div class="me-3">
                            <label for="register-role" name="register-role" class="form-label">What is your role ? <span class="text-danger">*</span></label>
                            <select class="form-select" name="register-role" required>
                                <option value="kasir">Kasir</option>
                                <option value="owner">Owner</option>
                            </select>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary text-light p-2">Register</button>
                    <a class="btn btn-outline-secondary p-2 ps-3 pe-3" href="../page/page.php?page=users">Back</a>

                    <input type="hidden" name="process" value="register">
                </form>
            </div>
        </div>
    </div>
</section>