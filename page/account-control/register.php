<section id="register">

    <div class="d-lg-flex flex-lg-row flex-column align-items-lg-center align-items-start">

        <div class="vh-100 d-flex align-items-center container-fluid col-lg-6 p-5" id="login-register-container" style="background-color: var(--mc-green-dark);">
            <div class="login flex-grow-1 m-md-5 p-md-3">

                <h4 class="text-light fw-bolder"><svg xmlns="http://www.w3.org/2000/svg" width="23" height="23" viewBox="0 0 50 50">
                        <rect x="0" y="0" width="50" height="50" fill="none" stroke="none" />
                        <path fill="currentColor" d="M6 11v33.74C6 46.21 7.237 48 8.76 48h33.218C43.497 48 45 46.21 45 44.74V11zm19.46 26.776c-5.86 0-10.611-4.594-10.611-10.263S19.6 17.25 25.46 17.25s10.611 4.594 10.611 10.263c0 5.67-4.751 10.263-10.611 10.263M41.978 1H8.76C7.237 1 6 2.033 6 3.505V9h39V3.505C45 2.033 43.497 1 41.978 1M19 7H8V3h11zm19.146-.28c-1.249 0-2.258-.979-2.258-2.188c0-1.207 1.009-2.186 2.258-2.186s2.261.979 2.261 2.186c-.001 1.208-1.012 2.188-2.261 2.188" />
                    </svg> CleanDry.</h4>
                <h2 class="text-light fw-bolder">Register Your Account</h2>

                <form action="../php/helper/register_process.php" method="post">
                    <div class="mb-3">
                        <label for="register-name" class="form-label text-light">What is your name ? <span class="text-danger">*</span> </label>
                        <input type="text" name="register-name" class="form-control p-2" id="register-name" required>
                    </div>
                    <div class="mb-3">
                        <label for="register-username" class="form-label text-light">Enter your username <span class="text-danger">*</span></label>
                        <input type="text" name="register-username" class="form-control p-2" id="register-username" required>
                    </div>
                    <div class="mb-3">
                        <label for="register-password" class="form-label text-light">Enter your password <span class="text-danger">*</span></label>
                        <input type="password" name="register-password" class="form-control p-2" id="register-password" required>
                    </div>
                    <div class="mb-3">
                        <label for="register-outlet" name="register-outlet" class="form-label text-light">What outlet is you're based at ? <span class="text-danger">*</span></label>
                        <select class="form-select" name="register-outlet" required>
                            <option selected disabled>Select outlet</option>
                            <option value="admin">Admin</option>
                            <option value="kasir">Kasir</option>
                            <option value="owner">Owner</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="register-role" name="register-role" class="form-label text-light">What is your role ? <span class="text-danger">*</span></label>
                        <select class="form-select" name="register-role" required>
                            <option selected disabled>Select role</option>
                            <option value="admin">Admin</option>
                            <option value="kasir">Kasir</option>
                            <option value="owner">Owner</option>
                        </select>
                    </div>
                    <div class="d-grid gap-2">
                        <button type="submit" class="btn btn-primary text-light p-2">Register</button>
                    </div>
                </form>

                <br>
                <h6 class="hr-text"><span class="text-light">OR</span></h6>

                <p class="text-light lh-1">Already have an account ? <br> Then just continue to the login page !</p>
                <div class="d-grid gap-2">
                    <a href="page.php?page=login" class="btn btn-primary text-light p-2">Login</a>
                </div>

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