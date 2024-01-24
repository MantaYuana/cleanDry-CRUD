<!-- TODO: add bootstrap custom form validation -->
<?php
if ($_SESSION['role'] != "admin") {
    echo "<script>alert('You are not premitted into the Page !'); window.location.href = '../../page/page.php?page=dashboard';</script>";
    exit();
}

$id = $_GET["idUser"];
$query = mysqli_query($conn, "SELECT * FROM user WHERE id=$id;");
$res = mysqli_fetch_assoc($query);
?>

<section id="register" class="bg-body-secondary vh-100">
    <div class="container">
        <br>
        <h6 class="mt-3">Admin Menu - <span class="fw-bolder text-decoration-underline"><?= $_SESSION['outlet']['nama'] ?>,</span></h6>
        <h2 class="fw-medium" style="color: var(--mc-green-dark);">Edit <span class="fw-bolder" style="color: var(--mc-green-dark-mono);">User</span></h2>
        <br>

        <div class="border rounded-4 bg-white col-8">
            <div class="border pt-3 pb-1 d-flex justify-content-center">
                <h5>Modify User</h5>
            </div>
            <div class="border rounded-4 p-5">
                <form action="../php/helper/account_process.php" method="post">
                    <div class="mb-3 col-8">
                        <label for="register-name" class="form-label">Name <span class="text-danger">*</span> </label>
                        <input type="text" name="register-name" class="form-control p-2" id="register-name" value="<?= $res["nama"] ?>" required>
                    </div>
                    <div class="mb-3 col-8">
                        <label for="register-username" class="form-label">Username <span class="text-danger">*</span></label>
                        <input type="text" name="register-username" class="form-control p-2" id="register-username" value="<?= $res["username"] ?>" required>
                    </div>
                    <div class="mb-3 col-8">
                        <label for="register-password" class="form-label">Enter a new password (optional)</label>
                        <div class="input-group">
                            <input type="password" name="register-password" class="form-control p-2" id="register-password">
                            <input type="checkbox" class="btn-check" id="input-showPassword" onclick="showPassword()" autocomplete="off">
                            <label class="btn btn-outline-primary" for="input-showPassword">Show Password</label>
                        </div>

                        <div class="form-text">This will override your current password</div>
                    </div>

                    <div class="mb-3 col-8">
                        <label for="register-role" name="register-role" class="form-label">What is your role ? <span class="text-danger">*</span></label>
                        <select class="form-select" name="register-role" required>
                            <option value="kasir">Kasir</option>
                            <option value="owner">Owner</option>
                        </select>
                    </div>
                    <button type="submit" class="btn btn-primary text-light p-2">Submit</button>
                    <a class="btn btn-outline-secondary p-2 ps-3 pe-3" href="../page/page.php?page=users">Back</a>

                    <input type="hidden" name="process" value="edit">
                    <input type="hidden" name="id" value="<?= $id ?>">
                </form>
            </div>
        </div>
    </div>
</section>

<!-- TODO: seperate into different js file -->
<script>
    function showPassword() {
        const input = document.getElementById('register-password');
        if (input.type === 'password') {
            input.type = 'text';
        } else {
            input.type = 'password';
        }
    }
</script>