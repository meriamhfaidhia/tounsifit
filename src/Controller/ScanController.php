<?php
namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ScannerController extends AbstractController
{
    /**
     * @Route("/scanner", name="scanner")
     */
    public function scanBarcode(Request $request): Response
    {
        // Vérifie si le formulaire a été soumis
        if ($request->isMethod('POST')) {
            // Récupère le fichier de l'image téléchargée
            $imageFile = $request->files->get('barcode_image');

            // Vérifie si une image a été téléchargée
            if ($imageFile) {
                // Lis le code-barres à partir de l'image
                $barcode = $this->readBarcode($imageFile);

                // Effectue la logique pour déterminer si le produit est sain
                $message = $this->checkProductSafety($barcode);

                // Affiche le message
                return $this->render('scanner/result.html.twig', [
                    'message' => $message,
                ]);
            }
        }

        // Affiche le formulaire de téléchargement de l'image
        return $this->render('scanner/scan.html.twig');
    }

    // Méthode pour lire le code-barres à partir de l'image
    private function readBarcode($imageFile)
    {
        // Code pour lire le code-barres à partir de l'image
        // Utilise une bibliothèque PHP pour cela
        // Exemple d'utilisation du conteneur de services :
        // $barcodeReader = $this->get('app.barcode_reader');
        // $barcode = $barcodeReader->read($imageFile);
    }

    // Méthode pour vérifier si le produit est sain ou non
    private function checkProductSafety($barcode)
    {
        // Effectue la logique nécessaire pour déterminer si le produit est sain
        // Par exemple, tu peux utiliser une base de données ou une API pour cette vérification
        // Ici, je vais simplement simuler une vérification en fonction du code-barres
        if ($barcode === '1234566778889') {
            return 'Produit non sain';
        } else {
            return 'Produit sain';
        }
    }
}