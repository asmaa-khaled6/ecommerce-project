<?php

session_start();

include('../shared/database.php');


// ==========================================
// Check if user is logged in
// ==========================================

if (!isset($_SESSION['user_id'])) {

    header("Location: ../clients/login.php");
    exit;

}


// Get logged-in user
$user_id = $_SESSION['user_id'];


// ==========================================
// ADD PRODUCT TO CART
// ==========================================

if (isset($_GET['add'])) {

    $product_id = $_GET['add'];

    // Check if product already exists in cart
    $checkQuery = "SELECT * FROM cart
                   WHERE user_id = $user_id
                   AND product_id = $product_id";

    $checkResult = mysqli_query($conn, $checkQuery);


    if (!$checkResult) {

        $_SESSION['errormessage'] = "Something went wrong.";

        header("Location: list.php");
        exit;

    }


    // Product already exists
    if (mysqli_num_rows($checkResult) > 0) {

        // Increase quantity
        $updateQuery = "UPDATE cart
                        SET quantity = quantity + 1
                        WHERE user_id = $user_id
                        AND product_id = $product_id";

        if (mysqli_query($conn, $updateQuery)) {

            $_SESSION['successmessage'] =
                "Product Quantity Updated In Cart Successfully";

        } else {

            $_SESSION['errormessage'] =
                "Failed To Update Product Quantity";

        }


    } else {

        // Add product for first time
        $insertQuery = "INSERT INTO cart
                        (user_id, product_id, quantity)
                        VALUES
                        ($user_id, $product_id, 1)";

        if (mysqli_query($conn, $insertQuery)) {

            $_SESSION['successmessage'] =
                "Product Added To Cart Successfully";

        } else {

            $_SESSION['errormessage'] =
                "Failed To Add Product To Cart";

        }

    }


    // Return to products list
    header("Location: list.php");
    exit;

}


// ==========================================
// REMOVE PRODUCT FROM CART
// ==========================================

if (isset($_GET['remove'])) {

    $cart_id = $_GET['remove'];


    // Make sure this cart item belongs to current user
    $deleteQuery = "DELETE FROM cart
                    WHERE id = $cart_id
                    AND user_id = $user_id";


    if (mysqli_query($conn, $deleteQuery)) {

        $_SESSION['successmessage'] =
            "Product Removed From Cart Successfully";

    } else {

        $_SESSION['errormessage'] =
            "Failed To Remove Product From Cart";

    }


    // Return to cart
    header("Location: cart.php");
    exit;

}


// ==========================================
// If no action
// ==========================================

header("Location: list.php");
exit;

?>