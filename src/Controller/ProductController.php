<?php
namespace App\Controller;
use App\Entity\Product;
use App\Entity\Category;
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


class ProductController extends AbstractController {
    /**
     * @Route("/", name="naslovna")
     */
    public function index (){

        $products = $this->getDoctrine()->getRepository(Product::class)->findAll();
        $categories = $this->getDoctrine()->getRepository(Category::class)->findAll();

        return $this->render('posts/index.html.twig', array('products' => $products, 'categories' => $categories));
    }

    /**
     * @Route("/products/{categoryId}", name="findbycat")
     */
    public function showProductsAction($categoryId)
    {
        $category = $this->getDoctrine()
            ->getRepository(Category::class)
            ->find($categoryId);

        $products = $category->getProducts();
        $categories = $this->getDoctrine()->getRepository(Category::class)->findAll();

        return $this->render('posts/category.html.twig', array('products' => $products,'category'=>$category, 'categories' => $categories));
    }

}
