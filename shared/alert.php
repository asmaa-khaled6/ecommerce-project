<?php if (!empty($successmessage)) { ?>

    <div
        class="custom-alert success-alert alert-dismissible fade show"
        role="alert"
    >

        <div class="d-flex align-items-center">

            <div class="alert-icon success-icon">

                <i class="bi bi-check-lg"></i>

            </div>

            <div class="alert-content">

                <strong>Success!</strong>

                <div>
                    <?php echo $successmessage; ?>
                </div>

            </div>

            <button
                type="button"
                class="btn-close ms-auto"
                data-bs-dismiss="alert"
                aria-label="Close"
            ></button>

        </div>

    </div>

<?php } ?>


<?php if (!empty($errormessage)) { ?>

    <div
        class="custom-alert error-alert alert-dismissible fade show"
        role="alert"
    >

        <div class="d-flex align-items-center">

            <div class="alert-icon error-icon">

                <i class="bi bi-exclamation-lg"></i>

            </div>

            <div class="alert-content">

                <strong>Error!</strong>

                <div>
                    <?php echo $errormessage; ?>
                </div>

            </div>

            <button
                type="button"
                class="btn-close ms-auto"
                data-bs-dismiss="alert"
                aria-label="Close"
            ></button>

        </div>

    </div>

<?php } ?>


<style>

.custom-alert {

    border: none;

    border-radius: 14px;

    padding: 15px 18px;

    margin-bottom: 25px;

    box-shadow: 0 6px 20px rgba(0,0,0,0.08);

    animation: slideDown 0.4s ease;

}


.success-alert {

    background-color: #EAF8F0;

    color: #176B3A;

    border-left: 5px solid #28A745;

}


.error-alert {

    background-color: #FFF0F0;

    color: #9B1C1C;

    border-left: 5px solid #DC3545;

}


.alert-icon {

    width: 38px;

    height: 38px;

    border-radius: 50%;

    display: flex;

    align-items: center;

    justify-content: center;

    margin-right: 12px;

    font-size: 20px;

    font-weight: bold;

}


.success-icon {

    background-color: #28A745;

    color: white;

}


.error-icon {

    background-color: #DC3545;

    color: white;

}


.alert-content {

    font-size: 15px;

    line-height: 1.5;

}


.alert-content strong {

    font-size: 16px;

}


.custom-alert .btn-close {

    margin-left: auto;

    padding: 8px;

}


@keyframes slideDown {

    from {

        opacity: 0;

        transform: translateY(-15px);

    }

    to {

        opacity: 1;

        transform: translateY(0);

    }

}

</style>


<script>

setTimeout(function () {

    const alerts = document.querySelectorAll('.custom-alert');

    alerts.forEach(function (alert) {

        const closeButton = alert.querySelector('.btn-close');

        if (closeButton) {

            closeButton.click();

        }

    });

}, 3000);

</script>