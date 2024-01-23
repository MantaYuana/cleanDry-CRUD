<!-- NOTE: only able to delete outlet if no transaction, user, member, or any data is entered -->
<?php
if ($_SESSION['role'] != "admin") {
    echo "<script>alert('You are not premitted into the Page !'); window.location.href = '../../page/page.php?page=dashboard';</script>";
    exit();
}
?>

<section id="register" class="bg-body-secondary vh-100">
    <div class="container">
        <br>
        <h6 class="mt-3">Outlet <span class="fw-bolder text-decoration-underline"><?= $_SESSION['outlet']['nama'] ?>,</span></h6>
        <h2 class="fw-medium" style="color: var(--mc-green-dark);">Register <span class="fw-bolder" style="color: var(--mc-green-dark-mono);">Package</span></h2>
        <br>

        <div class="border rounded-4 bg-white col-8">
            <div class="border pt-3 pb-1 d-flex justify-content-center">
                <h5>Add Package</h5>
            </div>
            <div class="border rounded-4 p-5">
                <form action="../php/helper/package_process.php" method="post">
                    <div class="mb-3 col-8">
                        <label for="register-name" class="form-label">Name <span class="text-danger">*</span> </label>
                        <input type="text" name="register-name" class="form-control p-2" id="register-name" required>
                    </div>
                    <div class="mb-3 col-8">
                        <label for="register-jenis" class="form-label">Type <span class="text-danger">*</span></label>
                        <select class="form-select" name="register-jenis" required>
                            <option value="kiloan">by weight</option>
                            <option value="selimut">Blanket</option>
                            <option value="bed_cover">Bed Cover</option>
                            <option value="kaos">Shirt</option>
                            <option value="lain">Other</option>
                        </select>
                    </div>
                    <div class="mb-3 col-8">
                        <label for="register-harga" class="form-label">Price <span class="text-danger">*</span></label>
                        <div class="input-group">
                            <input type="number" name="register-harga" class="form-control p-2" id="register-harga" required>
                            <span class="input-group-text">/kg</span>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary text-light p-2">Submit</button>
                    <a class="btn btn-outline-secondary p-2 ps-3 pe-3" href="../page/page.php?page=packages">Back</a>

                    <input type="hidden" name="process" value="register">
                </form>
            </div>
        </div>
    </div>
</section>