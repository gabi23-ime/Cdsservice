<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $nom = htmlspecialchars($_POST['nom']);
    $email = htmlspecialchars($_POST['email']);
    $besoin = htmlspecialchars($_POST['besoin']);
    $services = isset($_POST['services']) ? $_POST['services'] : [];
    $total = htmlspecialchars($_POST['total']);

    // Créer le message
    $message = "Demande de devis de $nom ($email)\n\n";
    $message .= "Services souhaités:\n";
    foreach($services as $service){
        $message .= "- $service\n";
    }
    $message .= "\nTotal estimé: $total FCFA\n\n";
    $message .= "Description du besoin:\n$besoin";

    // Destinataire (ton mail)
    $to = "tonemail@example.com";
    $subject = "Nouvelle demande de devis CDS Services";

    $headers = "From: $email\r\n";
    $headers .= "Reply-To: $email\r\n";

    if(mail($to, $subject, $message, $headers)){
        echo "<p>Merci $nom, votre demande de devis a été envoyée avec succès !</p>";
    } else {
        echo "<p>Une erreur est survenue, veuillez réessayer.</p>";
    }
} else {
    echo "<p>Formulaire non soumis correctement.</p>";
}
?>
