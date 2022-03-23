<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class PizzaController extends AbstractController
{
    /**
     * @Route("/pizza")
     */
    public function index(): Response
    {
        $categories=['vis','']
        return $this->render('pizza/index.html.twig', [
            'controller_name' => 'PizzaController',
            'categories' => $categories,
        ]);
    }
}
