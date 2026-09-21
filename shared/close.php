<?php


$isAdmin = isset($_SESSION['role']) && $_SESSION['role'] === 'admin';
$isUser  = isset($_SESSION['role']) && $_SESSION['role'] === 'user';

?>

<footer style="background-color:#1976D2; color:white;" class="mt-5">

    <div class="container py-2">

        <div class="text-center">

            <!-- ================= Logo ================= -->

            <h4 class="fw-bold mb-2">
                <i class="bi bi-star-fill"></i>
                START
            </h4>


            <!-- ================= Social Media ================= -->

            <div class="mb-1">

                <a href="#"
                   class="social-icon"
                   title="Facebook">
                    <i class="bi bi-facebook"></i>
                </a>

                <a href="#"
                   class="social-icon"
                   title="Instagram">
                    <i class="bi bi-instagram"></i>
                </a>

                <a href="#"
                   class="social-icon"
                   title="LinkedIn">
                    <i class="bi bi-linkedin"></i>
                </a>

                <a href="#"
                   class="social-icon"
                   title="GitHub">
                    <i class="bi bi-github"></i>
                </a>

            </div>


            <!-- ================= Links ================= -->

            <div class="mb-2">

                <!-- Everyone -->

                <a href="/nti/FinalProject/ecommerce-project/index.php"
                   class="text-white text-decoration-none mx-2">
                    Home
                </a>

                <a href="/nti/FinalProject/ecommerce-project/categories/list.php"
                   class="text-white text-decoration-none mx-2">
                    Categories
                </a>

                <a href="/nti/FinalProject/ecommerce-project/products/list.php"
                   class="text-white text-decoration-none mx-2">
                    Products
                </a>

                <a href="/nti/FinalProject/ecommerce-project/brands/list.php"
                   class="text-white text-decoration-none mx-2">
                    Brands
                </a>


                <!-- ================= Partners ================= -->

                <?php if ($isAdmin || $isUser) { ?>

                    <a href="/nti/FinalProject/ecommerce-project/Partners/list.php"
                       class="text-white text-decoration-none mx-2">
                        Partners
                    </a>

                <?php } ?>


                <!-- ================= Clients ================= -->

                <?php if ($isAdmin) { ?>

                    <a href="/nti/FinalProject/ecommerce-project/clients/list.php"
                       class="text-white text-decoration-none mx-2">
                        Clients
                    </a>


                    <!-- ================= Employees ================= -->

                    <a href="/nti/FinalProject/ecommerce-project/Employee/list.php"
                       class="text-white text-decoration-none mx-2">
                        Employees
                    </a>

                <?php } ?>

            </div>


            <!-- ================= Line ================= -->

            <hr style="border-color:rgba(255,255,255,.2);">


            <!-- ================= Copyright ================= -->

            <p class="mb-0 opacity-75">
                © 2026 START. All Rights Reserved.
            </p>

        </div>

    </div>

</footer>


<!-- ================= Social Icons Style ================= -->

<style>

.social-icon {

    display: inline-flex;

    align-items: center;

    justify-content: center;

   width: 24px;
    height: 24px;
    margin: 0 2px;
    font-size: 12px;

    border-radius: 50%;

    background-color: white;

    color: #1976D2;

    text-decoration: none;

    

    transition: 0.3s;

}

.social-icon:hover {

    background-color: #17365D;

    color: white;

    transform: translateY(-2px);

}

</style>


<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI"
        crossorigin="anonymous">
</script>

<script src="./js/app.js"></script>

</body>
</html>