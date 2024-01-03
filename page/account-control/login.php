<section id="login">

    <div class="container">

        <form action="../php/helper/login_process.php" method="post">
            <div class="mb-3">
                <label for="login-username" class="form-label">Username</label>
                <input type="text" name="login-user" class="form-control" id="login-username">
            </div>
            <div class="mb-3">
                <label for="login-password" class="form-label">Password</label>
                <input type="password" name="login-password" class="form-control" id="login-password">
                <div id="forgotPassword" class="form-text"><a href="#" class="link-primary link-offset-2 link-offset-3-hover link-underline link-underline-opacity-0 link-underline-opacity-75-hover">Forgot you password ?</a></div>
            </div>
            <!-- FIXME: make submit button stretch -->
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>

    </div>

</section>