<?php

namespace App\Controller;

use App\Entity\Produit;
use App\Form\ProduitType;
use App\Repository\ProduitRepository;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Session\SessionInterface;

use App\Entity\Panier;


/**
 * @Route("/produit")
 */
class ProduitController extends AbstractController
{
    #[Route('/info', name: 'app_produit')]
    public function index(): Response
    {
        return $this->render('Produit/index.html.twig', [
            'controller_name' => 'ProduitController',
        ]);
    } 
    
    #[Route('/new', name: 'produit_add', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager, SessionInterface $session): Response
    {
        $produit = new Produit();
        $form = $this->createForm(ProduitType::class, $produit);
        $form->handleRequest($request);
    
        if ($form->isSubmitted() && $form->isValid()) {
            $file = $form->get('image')->getData();
            $fileName = uniqid().'.'.$file->guessExtension();
            $file->move($this->getParameter('images_directorys'), $fileName);
            $produit->setImage($fileName);
            
            $entityManager->persist($produit);
            $entityManager->flush();
    
            // Ajouter le message flash de succès
            $session->getFlashBag()->add('success', 'Le produit a été ajouté avec succès.');
    
            return $this->redirectToRoute('produit_show', ['id' => $produit->getIdProduit()]);
        }
    
        // Affichage du formulaire
        return $this->renderForm('Produit/add.html.twig', [
            'produit' => $produit,
            'formB' => $form,
        ]);
    }
    
    
    /**
     * @Route("/delete/{id}", name="produit_delete")
     */
    public function DeleteProduit($id, ProduitRepository $produitRepository, ManagerRegistry $doctrine): Response
    {
        $em = $doctrine->getManager();
        $produit = $produitRepository->find($id);

        // Check if the entity exists
        if (!$produit) {
            throw $this->createNotFoundException('Produit not found');
        }

        $em->remove($produit);
        $em->flush();

        return $this->redirectToRoute('produit_show');
    }

    /**
     * @Route("/show", name="produit_show")
     */
    public function show(ProduitRepository $produitRepository): Response
    {
        $produits = $produitRepository->findAll();
        return $this->render('Produit/show.html.twig', ['produits' => $produits]);
    }

    /**
     * @Route("/update/{id}", name="produit_update")
     */
    public function UpdateProduit(ManagerRegistry $doctrine, Request $request, ProduitRepository $produitRepository, $id): Response
    {
        $produit = $produitRepository->find($id);
        $form = $this->createForm(ProduitType::class, $produit);
        $form->handleRequest($request);
    
        if ($form->isSubmitted() && $form->isValid()) {
            // Traitement de l'image
            $file = $form->get('image')->getData();
            if ($file) {
                $fileName = uniqid().'.'.$file->guessExtension();
                $file->move($this->getParameter('images_directorys'), $fileName);
                $produit->setImage($fileName);
            }
    
            $em = $doctrine->getManager();
            $em->persist($produit);
            $em->flush();
    
            return $this->redirectToRoute('produit_show', ['id' => $produit->getIdProduit()]);
        }
    
        return $this->render('Produit/update.html.twig', [
            'formB' => $form->createView(),
        ]);
    }
    /**
    * @Route("/grid", name="produit_grid")
    */
    public function showGrid(ProduitRepository $produitRepository): Response
    {
     $produits = $produitRepository->findAll();
     return $this->render('Produit/grid.html.twig', ['produits' => $produits]);
      }
    /**
    * @Route("/product/{id}", name="product_details")
    */
    public function productDetails($id, ProduitRepository $produitRepository): Response
   {
    $produit = $produitRepository->find($id);

     return $this->render('Produit/details.html.twig', [
        'produit' => $produit,
     ]);
   }
   

   /**
 * @Route("/product/{id}", name="add_to_cart")
 */
 public function addToCart(Request $request, $id)
 {
    $produit = $this->getDoctrine()->getRepository(Produit::class)->find($id);

    // Ici, vous ajoutez le produit au panier. Cela dépend de votre logique métier.

    return $this->redirectToRoute('panier');
}
  /**
 * @Route("/product/{id}", name="affiche_to_panier")
 */

public function afficherPanier()
{
    // Récupérer les produits ajoutés au panier
    // Implémentez cette logique en fonction de votre structure de base de données

    // Exemple fictif :
    $produitsPanier = $this->getDoctrine()->getRepository(ProduitPanier::class)->findAll();

    // Passer les produits à votre template pour affichage
    return $this->render('front/panier.html.twig', [
        'produitsPanier' => $produitsPanier,
    ]);
}

    
    }

