<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;


/* =====================================================
   PHPMailer
===================================================== */

require __DIR__ . '/vendor/autoload.php';


/* =====================================================
   ONLY ACCEPT POST REQUESTS
===================================================== */

if ($_SERVER["REQUEST_METHOD"] !== "POST") {

    exit("Invalid request.");

}


/* =====================================================
   RECEIVING EMAIL
===================================================== */

$to = "edwin4odhiambo@gmail.com";


/* =====================================================
   FORM INFORMATION
===================================================== */

$formType = htmlspecialchars(
    $_POST["form_type"] ?? "Hospital Inquiry"
);

$patientName = htmlspecialchars(
    $_POST["patientName"] ?? ""
);

$telephone = htmlspecialchars(
    $_POST["telephone"] ?? ""
);

$email = htmlspecialchars(
    $_POST["email"] ?? ""
);

$location = htmlspecialchars(
    $_POST["location"] ?? ""
);

$emergency = htmlspecialchars(
    $_POST["emergency"] ?? ""
);

$test = htmlspecialchars(
    $_POST["test"] ?? ""
);

$inquiry = htmlspecialchars(
    $_POST["inquiry"] ?? ""
);

$patientNumber = htmlspecialchars(
    $_POST["patientNumber"] ?? ""
);

$problem = htmlspecialchars(
    $_POST["problem"] ?? ""
);


/* =====================================================
   EMAIL SUBJECT
===================================================== */

$subject =
    "Masco Hospitals - " . $formType;


/* =====================================================
   EMAIL MESSAGE
===================================================== */

$message = "
MASCO HOSPITALS KENYA
==============================

NEW HOSPITAL REQUEST

Type:
$formType

Patient Name:
$patientName

Telephone:
$telephone

Email:
$email

Patient Number:
$patientNumber

Current Location:
$location

Emergency Description:
$emergency

Laboratory Test:
$test

Laboratory Inquiry:
$inquiry

Problem Description:
$problem

==============================

Submitted from:
Masco Hospitals Website
";


/* =====================================================
   CREATE PHPMailer
===================================================== */

$mail = new PHPMailer(true);


try {


    /* =================================================
       GMAIL SMTP
    ================================================= */

    $mail->isSMTP();

    $mail->Host = "smtp.gmail.com";

    $mail->SMTPAuth = true;

    $mail->Username =
        "edwin4odhiambo@gmail.com";


    /*
       IMPORTANT:

       Replace the value below with your
       Google App Password.

       DO NOT use your normal Gmail password.
    */

    $mail->Password =
        "YOUR_GMAIL_APP_PASSWORD";


    $mail->SMTPSecure =
        PHPMailer::ENCRYPTION_STARTTLS;

    $mail->Port = 587;


    /* =================================================
       SENDER
    ================================================= */

    $mail->setFrom(
        "edwin4odhiambo@gmail.com",
        "Masco Hospitals Website"
    );


    /* =================================================
       RECEIVER
    ================================================= */

    $mail->addAddress(
        $to,
        "Masco Hospitals"
    );


    /* =================================================
       REPLY TO PATIENT
    ================================================= */

    if (
        !empty($email) &&
        filter_var(
            $email,
            FILTER_VALIDATE_EMAIL
        )
    ) {

        $mail->addReplyTo(
            $email,
            $patientName ?: "Patient"
        );

    }


    /* =================================================
       EMAIL CONTENT
    ================================================= */

    $mail->isHTML(false);

    $mail->Subject = $subject;

    $mail->Body = $message;


    /* =================================================
       SEND
    ================================================= */

    $mail->send();


    /* =================================================
       SUCCESS
    ================================================= */

    header(
        "Location: index.html?status=success"
    );

    exit;


} catch (Exception $e) {


    /* =================================================
       ERROR
    ================================================= */

    error_log(
        "PHPMailer Error: " .
        $mail->ErrorInfo
    );


    header(
        "Location: index.html?status=error"
    );

    exit;

}

?>