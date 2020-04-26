<?php
namespace App\Controller;
use App\Entity\Category;
use App\Entity\Product;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\DateType;


class CategoryController extends AbstractController {
    /**
     * @Route("/categories/{id}", name="categories_page")
     */
    public function index (Request $request, $id){

        $categories = $this->getDoctrine()->getRepository(Category::class)->find($id);
        $products = $this->getDoctrine()->getRepository(Product::class)->findAll();
      

        if (!$categories) {
            throw $this->createNotFoundException(
                'No cat found for id '.$id
            );
        }
        return new Response('Check out this great product: '.$categories->getName());
        
    }
}