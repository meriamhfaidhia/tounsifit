<?php

namespace App\Controller;

use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;
use Stripe\Stripe;
use Stripe\Checkout\Session;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;

class PaiementController extends AbstractController
{
    public function paiementStripe(): Response
    {
        // Configurez vos clés d'API Stripe
        Stripe::setApiKey('sk_test_51OpgudEJpKf7W6fkxNSdufRmGjxH3HOBUXRc9B4W5UNiNIXPH68JDq7sLL0DbAUjI6Fk1N4IeY2atmRM9EnbP78b00BBZEm40u');

        // Créez une session de paiement Stripe
        $session = Session::create([
            'payment_method_types' => ['card'],
            'line_items' => [
                [
                    'price_data' => [
                        'currency' => 'usd',
                        'unit_amount' => 2000, // Montant en centimes (par exemple, $20.00)
                        'product_data' => [
                            'name' => 'Nom du produit',
                        ],
                    ],
                    'quantity' => 1,
                ],
            ],
            'mode' => 'payment',
            'success_url' => $this->generateUrl('paiement_success', [], UrlGeneratorInterface::ABSOLUTE_URL),
            'cancel_url' => $this->generateUrl('paiement_cancel', [], UrlGeneratorInterface::ABSOLUTE_URL),
        ]);

        // Redirigez l'utilisateur vers la page de paiement Stripe
        return $this->redirect($session->url, 303);
    }
     /**
     * @Route("/paiement/success", name="paiement_success")
     */
    public function paiementSuccess(): Response
    {
        // Traitement après un paiement réussi
        return $this->render('paiement/success.html.twig');
    }

    /**
     * @Route("/paiement/cancel", name="paiement_cancel")
     */
    public function paiementCancel(): Response
    {
        // Traitement après annulation du paiement
        return $this->render('paiement/cancel.html.twig');
    }
}
