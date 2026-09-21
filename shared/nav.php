<?php 

if (session_status() === PHP_SESSION_NONE) { 
    session_start(); 
} 

$isAdmin = isset($_SESSION['role']) && $_SESSION['role'] === 'admin'; 
$isUser  = isset($_SESSION['role']) && $_SESSION['role'] === 'user'; 

?> 

<nav class="navbar navbar-expand-lg" style="background-color:#2F8FEF;"> 

    <div class="container-fluid"> 

        <!-- ================= Logo ================= --> 

        <a 
            class="navbar-brand text-white fs-3 fw-bold" 
            href="/nti/FinalProject/ecommerce-project/index.php" 
        > 
            <i class="bi bi-star"></i> 
            STAR 
        </a> 


        <!-- ================= Mobile Button ================= --> 

        <button 
            class="navbar-toggler" 
            type="button" 
            data-bs-toggle="collapse" 
            data-bs-target="#navbarSupportedContent" 
            aria-controls="navbarSupportedContent" 
            aria-expanded="false" 
            aria-label="Toggle navigation" 
        > 
            <span class="navbar-toggler-icon"></span> 
        </button> 


        <div 
            class="collapse navbar-collapse" 
            id="navbarSupportedContent" 
        > 


            <!-- ================= Main Menu ================= --> 

            <ul class="navbar-nav me-auto mb-2 mb-lg-0"> 


                <!-- ================= Products ================= --> 

                <?php if ($isAdmin) { ?>

                    <li class="nav-item dropdown"> 

                        <a 
                            class="nav-link dropdown-toggle text-white" 
                            href="#" 
                            role="button" 
                            data-bs-toggle="dropdown" 
                        > 
                            Products 
                        </a> 

                        <ul class="dropdown-menu"> 

                            <li> 
                                <a 
                                    class="dropdown-item" 
                                    href="/nti/FinalProject/ecommerce-project/products/add.php" 
                                > 
                                    Add Product 
                                </a> 
                            </li> 

                            <li> 
                                <a 
                                    class="dropdown-item" 
                                    href="/nti/FinalProject/ecommerce-project/products/list.php" 
                                > 
                                    List Products 
                                </a> 
                            </li> 

                        </ul> 

                    </li>

                <?php } elseif ($isUser) { ?>

                    <li class="nav-item"> 
                        <a 
                            class="nav-link text-white" 
                            href="/nti/FinalProject/ecommerce-project/products/list.php" 
                        > 
                            Products 
                        </a> 
                    </li>

                <?php } else { ?>

                    <li class="nav-item"> 
                        <a 
                            class="nav-link text-white" 
                            href="/nti/FinalProject/ecommerce-project/products/list.php" 
                        > 
                            Products 
                        </a> 
                    </li>

                <?php } ?>


                <!-- ================= Categories ================= --> 

                <?php if ($isAdmin) { ?>

                    <li class="nav-item dropdown"> 

                        <a 
                            class="nav-link dropdown-toggle text-white" 
                            href="#" 
                            role="button" 
                            data-bs-toggle="dropdown" 
                        > 
                            Categories 
                        </a> 

                        <ul class="dropdown-menu"> 

                            <li> 
                                <a 
                                    class="dropdown-item" 
                                    href="/nti/FinalProject/ecommerce-project/categories/add.php" 
                                > 
                                    Add Category 
                                </a> 
                            </li> 

                            <li> 
                                <a 
                                    class="dropdown-item" 
                                    href="/nti/FinalProject/ecommerce-project/categories/list.php" 
                                > 
                                    List Categories 
                                </a> 
                            </li> 

                        </ul> 

                    </li>

                <?php } elseif ($isUser) { ?>

                    <li class="nav-item"> 
                        <a 
                            class="nav-link text-white" 
                            href="/nti/FinalProject/ecommerce-project/categories/list.php" 
                        > 
                            Categories 
                        </a> 
                    </li>

                <?php } else { ?>

                    <li class="nav-item"> 
                        <a 
                            class="nav-link text-white" 
                            href="/nti/FinalProject/ecommerce-project/categories/list.php" 
                        > 
                            Categories 
                        </a> 
                    </li>

                <?php } ?>


                <!-- ================= Brands ================= --> 

                <?php if ($isAdmin) { ?>

                    <li class="nav-item dropdown"> 

                        <a 
                            class="nav-link dropdown-toggle text-white" 
                            href="#" 
                            role="button" 
                            data-bs-toggle="dropdown" 
                        > 
                            Brands 
                        </a> 

                        <ul class="dropdown-menu"> 

                            <li> 
                                <a 
                                    class="dropdown-item" 
                                    href="/nti/FinalProject/ecommerce-project/brands/add.php" 
                                > 
                                    Add Brand 
                                </a> 
                            </li> 

                            <li> 
                                <a 
                                    class="dropdown-item" 
                                    href="/nti/FinalProject/ecommerce-project/brands/list.php" 
                                > 
                                    List Brands 
                                </a> 
                            </li> 

                        </ul> 

                    </li>

                <?php } elseif ($isUser) { ?>

                    <li class="nav-item"> 
                        <a 
                            class="nav-link text-white" 
                            href="/nti/FinalProject/ecommerce-project/brands/list.php" 
                        > 
                            Brands 
                        </a> 
                    </li>

                <?php } else { ?>

                    <li class="nav-item"> 
                        <a 
                            class="nav-link text-white" 
                            href="/nti/FinalProject/ecommerce-project/brands/list.php" 
                        > 
                            Brands 
                        </a> 
                    </li>

                <?php } ?>


                <!-- ================= Partners ================= --> 

                <?php if ($isAdmin) { ?>

                    <li class="nav-item dropdown"> 

                        <a 
                            class="nav-link dropdown-toggle text-white" 
                            href="#" 
                            role="button" 
                            data-bs-toggle="dropdown" 
                        > 
                            Partners 
                        </a> 

                        <ul class="dropdown-menu"> 

                            <li> 
                                <a 
                                    class="dropdown-item" 
                                    href="/nti/FinalProject/ecommerce-project/Partners/add.php" 
                                > 
                                    Add Partner 
                                </a> 
                            </li> 

                            <li> 
                                <a 
                                    class="dropdown-item" 
                                    href="/nti/FinalProject/ecommerce-project/Partners/list.php" 
                                > 
                                    List Partners 
                                </a> 
                            </li> 

                        </ul> 

                    </li>

                <?php } elseif ($isUser) { ?>

                    <li class="nav-item"> 
                        <a 
                            class="nav-link text-white" 
                            href="/nti/FinalProject/ecommerce-project/Partners/list.php" 
                        > 
                            Partners 
                        </a> 
                    </li>

                <?php } else { ?>

                    <li class="nav-item"> 
                        <a 
                            class="nav-link text-white" 
                            href="/nti/FinalProject/ecommerce-project/Partners/list.php" 
                        > 
                            Partners 
                        </a> 
                    </li>

                <?php } ?>


                <!-- ================= Clients ================= --> 

                <?php if ($isAdmin) { ?>

                    <li class="nav-item dropdown"> 

                        <a 
                            class="nav-link dropdown-toggle text-white" 
                            href="#" 
                            role="button" 
                            data-bs-toggle="dropdown" 
                        > 
                            Clients 
                        </a> 

                        <ul class="dropdown-menu"> 

                            <li> 
                                <a 
                                    class="dropdown-item" 
                                    href="/nti/FinalProject/ecommerce-project/clients/add.php" 
                                > 
                                    Add Client 
                                </a> 
                            </li> 

                            <li> 
                                <a 
                                    class="dropdown-item" 
                                    href="/nti/FinalProject/ecommerce-project/clients/list.php" 
                                > 
                                    List Clients 
                                </a> 
                            </li> 

                        </ul> 

                    </li>
<?php } ?>


                <!-- ================= Employees ================= --> 

                <?php if ($isAdmin) { ?> 

                    <li class="nav-item dropdown"> 

                        <a 
                            class="nav-link dropdown-toggle text-white" 
                            href="#" 
                            role="button" 
                            data-bs-toggle="dropdown" 
                        > 
                            Employees 
                        </a> 

                        <ul class="dropdown-menu"> 

                            <li> 
                                <a 
                                    class="dropdown-item" 
                                    href="/nti/FinalProject/ecommerce-project/Employee/add.php" 
                                > 
                                    Add Employee 
                                </a> 
                            </li> 

                            <li> 
                                <a 
                                    class="dropdown-item" 
                                    href="/nti/FinalProject/ecommerce-project/Employee/list.php" 
                                > 
                                    List Employees 
                                </a> 
                            </li> 

                        </ul> 

                    </li> 

                <?php } ?>


                <!-- ================= Cart ================= --> 

                <?php if ($isUser) { ?> 

                    <li class="nav-item"> 

                        <a 
                            class="nav-link text-white" 
                            href="/nti/FinalProject/ecommerce-project/products/cart.php" 
                        > 

                            <i class="bi bi-cart3"></i> 
                            Cart 

                        </a> 

                    </li> 

                <?php } ?>


                <!-- ================= Favorites ================= --> 

                <?php if ($isUser) { ?> 

                    <li class="nav-item"> 

                        <a 
                            class="nav-link text-white" 
                            href="/nti/FinalProject/ecommerce-project/products/favorites.php" 
                        > 

                            <i class="bi bi-heart-fill"></i> 
                            Favorites 

                        </a> 

                    </li> 

                <?php } ?> 

            </ul> 


            <!-- ================= Right Side ================= --> 

            <ul class="navbar-nav ms-auto align-items-center"> 


                <?php if ($isAdmin || $isUser) { ?> 


                    <!-- Welcome --> 

                    <li class="nav-item d-flex align-items-center me-3"> 

                        <span class="text-white fw-semibold"> 
                            Hello, <?php echo htmlspecialchars($_SESSION['name'] ?? 'User'); ?> 👋 
                        </span> 

                        <span 
                            class="badge rounded-pill ms-2" 
                            style="background-color:white; color:#2F8FEF;" 
                        > 
                            <?php echo $isAdmin ? 'Admin' : 'User'; ?> 
                        </span> 

                    </li> 


                    <!-- Logout --> 

                    <li class="nav-item"> 

                        <a 
                            class="nav-link text-white" 
                            href="/nti/FinalProject/ecommerce-project/logout.php" 
                        > 

                            <i class="bi bi-box-arrow-right"></i> 
                            Logout 

                        </a> 

                    </li> 


                <?php } else { ?> 


                    <!-- Login --> 

                    <li class="nav-item"> 

                        <a 
                            class="nav-link text-white" 
                            href="/nti/FinalProject/ecommerce-project/clients/login.php" 
                        > 

                            <i class="bi bi-box-arrow-in-right"></i> 
                            Login 

                        </a> 

                    </li> 


                    <!-- Signup --> 

                    <li class="nav-item"> 

                        <a 
                            class="nav-link text-white" 
                            href="/nti/FinalProject/ecommerce-project/clients/signup.php" 
                        > 

                            <i class="bi bi-person-plus"></i> 
                            Signup 

                        </a> 

                    </li> 

                <?php } ?> 

            </ul> 

        </div> 

    </div> 

</nav>