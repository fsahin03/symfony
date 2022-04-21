<?php

namespace App\Controller;

use App\Entity\Category;
use App\Repository\PizzasRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Pizza;

class PizzaController extends AbstractController
{
    /**
     * @Route("/categories")
     */
    public function index(EntityManagerInterface $em)
    {

        $cats=$em->getRepository(Category::class)->findAll();

         return $this->render('pizza/index.html.twig',['cats'=>$cats]);
    }

    /**
     * @Route ("/pizza/{id}" , name="pizza")
     */
//    function pizza(EntityManagerInterface $em, $id){
//        $pizzas = $em->getRepository(Pizza::class)->findBy(['category_id'=>$id]);
//        dd($pizzas);
//        //return $this->render('pizza/pizza.html.twig',['pizza'=>$pizza]);
//    }

public function pizza(EntityManagerInterface $em, $id)
{
    $category=$em->getRepository(Category::class)->find($id);
    $pizzas=$category->getPizzas();
    return $this->render('pizza/pizza.html.twig',['pizzas'=>$pizzas]);
}

}
