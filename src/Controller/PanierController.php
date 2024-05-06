<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\HttpFoundation\File\File;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;
use Stripe\Stripe;
use Stripe\Checkout\Session;
use Doctrine\ORM\EntityManagerInterface;


use App\Entity\Panier;
use App\Entity\Produit;

   
    class PanierController extends AbstractController
    {
        private $entityManager;

        public function __construct(EntityManagerInterface $entityManager)
        {
            $this->entityManager = $entityManager;
        }
    
        /**
         * @Route("/ajouter-au-panier/{id}", name="panier_ajouter", methods={"POST"})
         */
        public function ajouterAuPanier(Request $request, $id): Response
        {
            $produit = $this->getDoctrine()->getRepository(Produit::class)->find($id);
    
            // Vérifier si le produit existe déjà dans le panier
            $panierExist = $this->getDoctrine()->getRepository(Panier::class)->findOneBy(['nomProduit' => $produit->getNom()]);
    
            // Si le produit existe déjà dans le panier, augmentez la quantité
            if ($panierExist) {
                $panierExist->setQuantity($panierExist->getQuantity() + 1);
            } else {
                // Sinon, ajoutez un nouveau produit au panier
                $panier = new Panier();
                $panier->setNomProduit($produit->getNom());
                $panier->setPrixProduit($produit->getPrix());
                $panier->setImage($produit->getImage());
                $panier->setQuantity(1); // Quantité initiale 1
                
                $this->entityManager->persist($panier);
            }
            
            $this->entityManager->flush();
    
            return $this->redirectToRoute('afficher_panier');
        }
    


    /**
     * @Route("/panier", name="afficher_panier")
     */
    public function afficherPanier(): Response
    {
        $entityManager = $this->getDoctrine()->getManager();

        // Récupérer tous les éléments du panier
        $elementsPanier = $entityManager->getRepository(Panier::class)->findAll();

        // Initialiser le total du panier à zéro
        $totalPanier = 0;

        // Calculer le total des prix des produits dans le panier
        foreach ($elementsPanier as $element) {
            $totalPanier += $element->getPrixProduit() * $element->getQuantity();
        }

        return $this->render('panier/afficher.html.twig', [
            'elementsPanier' => $elementsPanier,
            'totalPanier' => $totalPanier, // Passer le total du panier à la vue Twig
        ]);
    
    }


  

  /**
 * @Route("/panier/supprimer/{id}", name="supprimer_produit_panier", methods={"DELETE"})
 */
public function supprimerProduitPanier($id): Response
{
    // Récupérer le produit dans le panier par son ID
    $entityManager = $this->getDoctrine()->getManager();
    $produitPanier = $entityManager->getRepository(Panier::class)->find($id);

    if (!$produitPanier) {
        throw $this->createNotFoundException('Le produit dans le panier n\'existe pas.');
    }

    // Diminuer la quantité du produit de 1
    $quantite = $produitPanier->getQuantity();
    if ($quantite > 1) {
        $produitPanier->setQuantity($quantite - 1);
    } else {
        // Si la quantité est déjà de 1, supprimer complètement le produit du panier
        $entityManager->remove($produitPanier);
    }

    $entityManager->flush();

    // Redirection vers la page du panier après la suppression du produit
    return $this->redirectToRoute('afficher_panier');
}


    /**
 * @Route("/update-quantity", name="update_quantity", methods={"POST"})
 */
public function updateQuantity(Request $request): Response
{
    $productId = $request->request->get('productId');
    $action = $request->request->get('action');

    $entityManager = $this->getDoctrine()->getManager();
    $panier = $entityManager->getRepository(Panier::class)->find($productId);

    if (!$panier) {
        throw $this->createNotFoundException('Le produit dans le panier n\'existe pas.');
    }

    // Augmenter ou diminuer la quantité en fonction de l'action
    if ($action === 'increase') {
        $panier->setQuantity($panier->getQuantity() + 1);
    } elseif ($action === 'decrease' && $panier->getQuantity() > 1) {
        $panier->setQuantity($panier->getQuantity() - 1);
    }

    $entityManager->flush();

    // Retourner une réponse JSON avec la nouvelle quantité
    return new JsonResponse(['quantity' => $panier->getQuantity()]);
}
#[Route('/checkout', name: 'checkout', methods: ['POST'])]
    public function checkout(): Response
    {
        Stripe::setApikey('sk_test_51OpgudEJpKf7W6fkxNSdufRmGjxH3HOBUXRc9B4W5UNiNIXPH68JDq7sLL0DbAUjI6Fk1N4IeY2atmRM9EnbP78b00BBZEm40u');

        // Create a checkout session
        $session = Session::create([
            'payment_method_types' => ['card'],
            'line_items' => [[
                'price_data' => [
                    'currency' => 'USD',
                    'product_data' => [
                        'name' => 'ethereumm',
                    ],
                    'unit_amount' => 2000,
                ],
                'quantity' => 1,
            ]],
            'mode' => 'payment',
            'success_url'  => $this->generateUrl('success_url', [],UrlGeneratorInterface::ABSOLUTE_URL),           
            'cancel_url'  => $this->generateUrl('cancel_url', [],UrlGeneratorInterface::ABSOLUTE_URL),

        ]);
        

        return $this->redirect($session->url, 303);
    
    }

    #[Route('/success-url', name: 'success_url')]
    public function successUrl(): Response
    {
        
        return $this->render('payment/show.html.twig');
    
    }

    #[Route('/cancel-url', name: 'cancel_url')]
    public function cancelUrl(): Response
    {
        
        return $this->render('cancel.html.twig');
        
    
    }
}