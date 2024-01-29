<?php
if ($_SESSION['role'] != "admin") {
    echo "<script>alert('You are not premitted into the Page !'); window.location.href = '../../page/page.php?page=dashboard';</script>";
    exit();
}
$id = $_GET["idMember"];
$query = mysqli_query($conn, "SELECT * FROM member WHERE id=$id;");
$res = mysqli_fetch_assoc($query);
?>

<section id="register" class="bg-body-secondary vh-100">
    <div class="container">
        <br>
        <h6 class="mt-3">Admin <span class="fw-bolder text-decoration-underline">Menu</span></h6>
        <h2 class="fw-medium" style="color: var(--mc-green-dark);">Edit <span class="fw-bolder" style="color: var(--mc-green-dark-mono);">Member</span></h2>
        <br>

        <div class="border rounded-4 bg-white col-8">
            <div class="border pt-3 pb-1 d-flex justify-content-center">
                <h5>Modify Member</h5>
            </div>
            <div class="border rounded-4 p-5">
                <form action="../php/helper/member_process.php" method="post">
                    <div class="mb-3 col-8">
                        <label for="register-name" class="form-label">Name <span class="text-danger">*</span> </label>
                        <input type="text" name="register-name" class="form-control p-2" id="register-name" value="<?= $res["nama"] ?>" required>
                    </div>
                    <div class="mb-3 col-8">
                        <label for="register-telp" class="form-label">No. Telp <span class="text-danger">*</span></label>
                        <input type="text" name="register-telp" class="form-control p-2" id="register-telp" value="<?= $res["telp"] ?>" required>
                    </div>
                    <div class="mb-3 col-8">
                        <label for="register-kelamin" class="form-label">Gender <span class="text-danger">*</span></label>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="register-kelamin" value="L" id="register-kelamin" <?= ($res["kelamin"] == "L") ? 'checked' : "" ?> required>
                            <label class="form-check-label" for="register-kelamin">
                                Male
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="register-kelamin" value="P" id="register-kelamin" <?= ($res["kelamin"] == "P") ? 'checked' : "" ?> required>
                            <label class="form-check-label" for="register-kelamin">
                                Female
                            </label>
                        </div>
                    </div>
                    <div class="mb-3 col-8">
                        <label for="register-alamat" class="form-label">Alamat <span class="text-danger">*</span></label>
                        <textarea name="register-alamat" class="form-control p-2" id="register-alamat" row="3" required><?= $res["alamat"] ?></textarea>
                    </div>
                    <button type="submit" class="btn btn-primary text-light p-2">Submit</button>
                    <a class="btn btn-outline-secondary p-2 ps-3 pe-3" href="../page/page.php?page=members">Back</a>

                    <input type="hidden" name="process" value="edit">
                    <input type="hidden" name="id" value="<?= $id ?>">
                </form>
            </div>
        </div>
    </div>
</section>