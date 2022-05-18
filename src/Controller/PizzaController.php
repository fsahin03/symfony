<?php

namespace App\Controller;

use App\Entity\Category;
use App\Entity\Order;
use App\Repository\OrderRepository;
use App\Repository\PizzasRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\HttpFoundation\Request;
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

    /**
     * @Route ("/order/{id}" , name="order")
     */
    public function order(Request $request, Pizza $pizza, OrderRepository $orderRepository)
    {

        $order = new Order();
        $order->setPizza($pizza);
        $order->setStatus("in progress");

        $form = $this->createFormBuilder($order)
            ->add("fname", TextType::class, ['label' => 'Voornaam'])
            ->add("sname", TextType::class, ['label' =>'Achternaam'])
            ->add("address", TextType::class, ['label'=>'adres'])
            ->add("city", TextType::class,['label'=>'stad'])
            ->add("zipcode",TextType::class,['label'=>"postcode"])
            ->add('save', SubmitType::class, ['label' => 'Verzenden'])
            ->getForm();

        $form->handleRequest($request);

        if($form->isSubmitted()&&$form->isValid()){
            $order = $form->getData();

            $orderRepository->add($order);
            print("Bedankt voor uw bestelling");

        }



        return $this->renderForm('pizza/order.html.twig', [
            'form'=> $form
        ]);
    }

}
