<?php
if (isset($_POST["submit"])) {
    // Die E-Mail-Adresse, an die die Kontaktanfragen gesendet werden
    $empfaenger = "katerkarlooo@gmx.ch";

    // Validierung der Formulardaten
    $name = $_POST["name"];
    $email = $_POST["email"];
    $nachricht = $_POST["nachricht"];
    $error = "";

    if (empty($name) || empty($email) || empty($nachricht)) {
        $error = "Bitte füllen Sie alle Felder aus";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $error = "Ungültige E-Mail-Adresse";
    }

    if (empty($error)) {
        // Text der E-Mail-Nachricht
        $mailnachricht = "Sie haben eine Anfrage über Ihr Kontaktformular erhalten:\n";
        $mailnachricht .= "Name: " . $name . "\n" .
            "E-Mail: " . $email . "\n" .
            "Datum: " . date("d.m.Y H:i") . "\n" .
            "\n\n" . $nachricht . "\n";

        // Betreff der E-Mail-Nachricht
        $mailbetreff = "Neue Kontaktanfrage von " . $name . " (" . $email . ")";

        // E-Mail versenden
        if (mail($empfaenger, $mailbetreff, $mailnachricht)) {
            $success = "Wir haben Ihre Anfrage erhalten und werden sie so schnell wie möglich bearbeiten. <br>";
        } else {
            $error = "Beim Versenden Ihrer Anfrage ist ein Fehler aufgetreten! Versuchen Sie es bitte später noch einmal.";
        }
    }
}
?>