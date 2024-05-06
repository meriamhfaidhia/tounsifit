<?php

namespace App\Controller;

use App\Entity\Produit;
use App\Repository\ProduitRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;

class LikeDislikeController extends AbstractController
{
    /**
     * @Route("/like/{id}", name="like_product", methods={"POST"})
     */
    public function likeProduct(Produit $produit, EntityManagerInterface $entityManager): JsonResponse
    {
        // Récupérer la relation LikeDislike associée à ce Produit
        $likeDislike = $produit->getLikeDislike();

        // Vérifier si la relation LikeDislike existe
        if ($likeDislike === null) {
            $likeDislike = new LikeDislike();
            // Associer la relation LikeDislike à ce Produit
            $produit->setLikeDislike($likeDislike);
        }
        
        // Incrémenter le compteur de likes
        $likes = $likeDislike->getLikes() + 1;
        $likeDislike->setLikes($likes);
        
        // Mettre à jour l'entité Produit avec LikeDislike
        $entityManager->persist($produit);
        $entityManager->flush();

        // Retourner la nouvelle valeur des likes au format JSON
        return new JsonResponse(['likes' => $likes, 'message' => 'Vous avez aimé ce produit']);
    }
}
