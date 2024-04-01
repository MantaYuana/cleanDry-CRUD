<?php 
if ($_SESSION['role'] == "owner") {
    echo "<script>alert('Only Cashier and Admin are premitted into this Page !'); window.location.href = '../page/page.php?page=dashboard';</script>";
    exit();
}
?>

<section id="register">
    <div class="container">
        <br>
        <?php
        $outlet_name = $_SESSION['outlet']['nama'];
        if ($_SESSION['role'] != "admin") {
            echo "<h5 class='mt-3'>Outlet <span class='fw-bolder text-decoration-underline'>$outlet_name,</span></h5>";
        }else{
            echo "<h6 class='mt-3'>Admin <span class='fw-bolder text-decoration-underline'>Menu</span></h6>";
        }
        ?>
        <h2 class="fw-medium" style="color: var(--mc-green-dark);">Register <span class="fw-bolder" style="color: var(--mc-green-dark-mono);">Member</span></h2>
        <br>

        <div class="card shadow mb-4 col-8">
            <div class="card-header p-3">
                <h5 class="m-0 font-weight-bold text-center">Add Member</h5>
            </div>
            <div class="card-body p-5">
                <form action="../php/helper/member_process.php" method="post">
                    <div class="mb-3 col-8">
                        <label for="register-name" class="form-label">Name <span class="text-danger">*</span> </label>
                        <input type="text" name="register-name" class="form-control p-2" id="register-name" required>
                    </div>
                    <div class="mb-3 col-8">
                        <label for="register-telp" class="form-label">No. Telp <span class="text-danger">*</span></label>
                        <input type="text" name="register-telp" class="form-control p-2" id="register-telp" required>
                    </div>
                    <div class="mb-3 col-8">
                        <label for="register-kelamin" class="form-label">Gender <span class="text-danger">*</span></label>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="register-kelamin" value="L" id="register-kelamin" required>
                            <label class="form-check-label" for="register-kelamin">
                                Male
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="register-kelamin" value="P" id="register-kelamin" required>
                            <label class="form-check-label" for="register-kelamin">
                                Female
                            </label>
                        </div>
                    </div>
                    <div class="mb-3 col-8">
                        <label for="register-alamat" class="form-label">Alamat <span class="text-danger">*</span></label>
                        <textarea name="register-alamat" class="form-control p-2" id="register-alamat" row="3" required></textarea>
                    </div>
                    <button type="submit" class="btn btn-primary text-light p-2">Register</button>
                    <a class="btn btn-outline-secondary p-2 ps-3 pe-3" href="../page/page.php?page=members">Back</a>

                    <input type="hidden" name="process" value="register">
                </form>
            </div>
        </div>
    </div>
</section>