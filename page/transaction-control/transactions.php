<section id="transaction">
    <div class="container">
        <br>
        <div class="page-heading d-flex justify-content-between align-items-center">
            <div>
                <h5 class="mt-3">Outlet <span class="fw-bolder text-decoration-underline"><?= $_SESSION['outlet']['nama'] ?>,</span></h5>
                <h6>Welcome <span class="fw-bolder"><?= ucwords($_SESSION['role']) ?> <?= $_SESSION['username'] ?></span></h6>
            </div>
            <div>
                <button type="button" class="btn btn-primary p-2 ps-5 pe-5"><a class="link-underline link-light link-underline-opacity-0" href="../page/page.php?page=register-transaction">Add Transaction</a></button>
            </div>
        </div>
        <br>


    </div>
</section>