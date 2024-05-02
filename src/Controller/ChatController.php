<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ChatController extends AbstractController
{
    /**
     * @Route("/chat/send-message", name="chat_send_message", methods={"POST"})
     */
    public function sendMessage(Request $request): Response
    {
        // Render the chat interface template without passing any response variable
        return $this->render('chat/chat.html.twig');
    }
}
