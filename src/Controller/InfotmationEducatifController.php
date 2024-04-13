<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class InfotmationEducatifController extends AbstractController
{
    #[Route('/infotmation/educatif', name: 'app_infotmation_educatif')]
    public function index(): Response
    {
        return $this->render('infotmation_educatif/index.html.twig', [
            'controller_name' => 'InfotmationEducatifController',
        ]);
    }
}
