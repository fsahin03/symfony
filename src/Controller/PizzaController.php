<?php

namespace App\Controller;

use App\Entity\Category;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class PizzaController extends AbstractController
{
    /**
     * @Route("/pizza")
     */
    public function index(EntityManagerInterface $em)
    {

//        return $this->render('pizza/index.html.twig', [
//            'controller_name' => 'PizzaController'
//        ]);
        $cats=$em->getRepository(Category::class)->findAll();
         return $this->render('pizza/index.html.twig',['cats'=>$cats]);
    }
}
