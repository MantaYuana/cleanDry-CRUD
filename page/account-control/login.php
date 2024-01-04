<section id="login" class="overflow-hidden">

    <div class="d-lg-flex flex-lg-row flex-column align-items-lg-center align-items-start" >

        <div class="vh-100 d-flex align-items-center container-fluid col-lg-6 p-5" id="login-register-container" style="background-color: var(--mc-green-dark);">
            <div class="login flex-grow-1">
                <h4 class="text-light">CleanDry</h4>
                <h2 class="text-light">Welcome Back !</h2>

                <p class="text-light">Don't have an account yet ? <br> Then create one, it's free !</p>
                <div class="d-grid gap-2">
                    <a href="dashboard.php?page=register" class="btn btn-primary text-light">Register</a>
                </div>

                <form action="../php/helper/login_process.php" method="post">
                    <div class="mb-3">
                        <label for="login-username" class="form-label text-light">Username</label>
                        <input type="text" name="login-user" class="form-control" id="login-username">
                    </div>
                    <div class="mb-3">
                        <label for="login-password" class="form-label text-light">Password</label>
                        <input type="password" name="login-password" class="form-control" id="login-password">
                        <div id="forgotPassword" class="form-text"><a href="#" class="link-light link-offset-2 link-underline-opacity-50 link-underline-opacity-100-hover">Forgot you password ?</a></div>
                    </div>
                    <!-- FIXME: make submit button stretch -->
                    <div class="d-grid gap-2">
                        <button type="submit" class="btn btn-primary text-light">Submit</button>
                    </div>
                </form>
            </div>

        </div>

        <div class="d-lg-inline d-none container col-6 p-5" id="cover" style="background-color: var(--mc-white-full);">
            <div class="img">
                <img class="img-fluid align-self-center" src="../assets/img/cover.png">
            </div>
            <div class="text-heading text-center">
                <p>Quickly <b> clean all of your wardrobes </b>, using CleanDry latest <br>
                    prepriortary <b> web based client application </b></p>
            </div>
        </div>
    </div>
</section>