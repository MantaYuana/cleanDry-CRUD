<section id="register">

    <div class="container">

        <form action="../php/helper/register_process.php" method="post">
            <div class="mb-3">
                <label for="register-name" class="form-label">What is your name ?</label>
                <input type="text" name="register-name" class="form-control" id="register-name">
            </div>
            <div class="mb-3">
                <label for="register-username" class="form-label">Enter your username</label>
                <input type="text" name="register-username" class="form-control" id="register-username">
            </div>
            <div class="mb-3">
                <label for="register-password" class="form-label">Enter your password</label>
                <input type="password" name="register-password" class="form-control" id="register-password">
            </div>
            <div class="mb-3">
                <label for="register-role" name="register-role" class="form-label">What is your role ?</label>
                <select class="form-select" name="register-role">
                    <option selected disabled>Select role</option>
                    <option value="admin">Admin</option>
                    <option value="kasir">Kasir</option>
                    <option value="owner">Owner</option>
                </select>
            </div>
            <!-- FIXME: make submit button stretch -->
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>

    </div>

</section>