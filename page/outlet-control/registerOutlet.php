<?php
if ($_SESSION['role'] != "admin") {
    echo "<script>alert('You are not premitted into the Page !'); window.location.href = '../../page/page.php?page=dashboard';</script>";
    exit();
}
?>

<section id="register">
    <div class="container">
        <br>
        <h6 class="mt-3">Admin <span class="fw-bolder text-decoration-underline">Menu</span></h6>
        <h2 class="fw-medium" style="color: var(--mc-green-dark);">Register <span class="fw-bolder" style="color: var(--mc-green-dark-mono);">Outlet</span></h2>
        <br>

        <div class="card shadow mb-4 col-8">
            <div class="card-header p-3">
                <h5 class="m-0 font-weight-bold text-center">Add Outlet</h5>
            </div>
            <div class="card-body p-5">
                <form action="../php/helper/outlet_process.php" method="post">
                    <div class="mb-3 col-8">
                        <label for="register-name" class="form-label">Name <span class="text-danger">*</span> </label>
                        <input type="text" name="register-name" class="form-control p-2" id="register-name" required>
                    </div>
                    <div class="mb-3 col-8">
                        <label for="register-telp" class="form-label">No. Telp <span class="text-danger">*</span></label>
                        <input type="text" name="register-telp" class="form-control p-2" id="register-telp" required>
                    </div>
                    <div class="mb-3 col-8">
                        <label for="register-alamat" class="form-label">Alamat <span class="text-danger">*</span></label>
                        <textarea name="register-alamat" class="form-control p-2" id="register-alamat" row="3" required></textarea>
                    </div>
                    <button type="submit" class="btn btn-primary text-light p-2">Register</button>
                    <a class="btn btn-outline-secondary p-2 ps-3 pe-3" href="../page/page.php?page=outlets">Back</a>

                    <input type="hidden" name="process" value="register">
                </form>
            </div>
        </div>
    </div>
</section>