<!-- TODO: add bootstrap custom form validation -->
<?php
if ($_SESSION['role'] != "admin") {
    echo "<script>alert('You are not premitted into the Page !'); window.location.href = '../page/page.php?page=dashboard';</script>";
    exit();
}

$query = mysqli_query($conn, "SELECT id, nama FROM outlet;");
$res = mysqli_fetch_all($query);
?>

<section id="register">
    <div class="container">
        <br>
        <h6 class="mt-3">Admin Menu - <span class="fw-bolder text-decoration-underline"><?= $_SESSION['outlet']['nama'] ?>,</span></h6>
        <h2 class="fw-medium" style="color: var(--mc-green-dark);">Register <span class="fw-bolder" style="color: var(--mc-green-dark-mono);">User</span></h2>
        <br>

        <div class="card shadow mb-4 col-8">
            <div class="card-header p-3">
                <h5 class="m-0 font-weight-bold text-center">Add User</h5>
            </div>
            <div class="card-body p-5">
                <form action="../php/helper/account_process.php" method="post">
                    <div class="mb-3">
                        <label for="register-name" class="form-label">Name <span class="text-danger">*</span> </label>
                        <input type="text" name="register-name" class="form-control p-2" id="register-name" required>
                    </div>
                    <div class="mb-3">
                        <label for="register-username" class="form-label">Username <span class="text-danger">*</span></label>
                        <input type="text" name="register-username" class="form-control p-2" id="register-username" required>
                    </div>
                    <div class="mb-3">
                        <label for="register-password" class="form-label">Password <span class="text-danger">*</span></label>
                        <input type="password" name="register-password" class="form-control p-2" id="register-password" required>
                    </div>
                    <div class="d-flex flex-row mb-3">
                        <div class="me-3 col-8">
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