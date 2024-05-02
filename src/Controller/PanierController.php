<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\HttpFoundation\File\File;
use Symfony\Component\HttpFoundation\JsonResponse;


use App\Entity\Panier;
use App\Entity\Produit;

   
    class PanierController extends AbstractController
    {
        /**
         * @Route("/ajouter-au-panier/{id}", name="panier_ajouter", methods={"POST"})
         */
        public function ajouterAuPanier(Request $request, $id): Response
        {
            $produit = $this->getDoctrine()->getRepository(Produit::class)->find($id);
        
            $panier = new Panier();
            $panier->setNomProduit($produit->getNom());
            $panier->setPrixProduit($produit->getPrix());
            $panier->setImage($produit->getImage()); // Vous pouvez modifier cela en fonction de la structure de votre base de données
        
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($panier);
            $entityManager->flush();
        
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
    public function supprimerProduitPanier(Request $request, $id): Response
    {
        $entityManager = $this->getDoctrine()->getManager();
        $produitPanier = $entityManager->getRepository(Panier::class)->find($id);

        if (!$produitPanier) {
            throw $this->createNotFoundException('Le produit dans le panier n\'existe pas.');
        }

        $entityManager->remove($produitPanier);
        $entityManager->flush();

        // Redirection vers la page du panier après la suppression du produit
        return $this->redirectToRoute('produit_grid');
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
}