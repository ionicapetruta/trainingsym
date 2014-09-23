<?php

namespace Acme\StoreBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Acme\StoreBundle\Entity\Category;
use Acme\StoreBundle\Entity\Product;
use Acme\StoreBundle\Entity\ProductRepository;
use Symfony\Component\HttpFoundation\Response;

class DefaultController extends Controller
{
    public function indexAction($name)
    {
        return $this->render('AcmeStoreBundle:Default:index.html.twig', array('name' => $name));
    }

    /**
     * Create action.
     *
     * @return Response
     */
    public function createAction()
    {
        $product = new Product();
        $product->setName('A Foo Bar');
        $product->setPrice('19.99');
        $product->setDescription('Lorem ipsum dolor');
        $em = $this->getDoctrine()->getManager();
        $em->persist($product);
        $em->flush();

        return new Response('Created product id '.$product->getId());
    }

    /**
     * Show action.
     *
     * @param number $id
     * @throws \Symfony\Component\HttpKernel\Exception\NotFoundHttpException
     */
    public function showAction($id)
    {
        $product = $this->getDoctrine()
            ->getRepository('AcmeStoreBundle:Product')
            ->find($id);
        if (!$product) {
            throw $this->createNotFoundException(
                'No product found for id '.$id
            );
        }
    }

    /**
     * Update action.
     *
     * @param $id
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     * @throws \Symfony\Component\HttpKernel\Exception\NotFoundHttpException
     */
    public function updateAction($id)
    {
        $em = $this->getDoctrine()->getManager();
        $product = $em->getRepository('AcmeStoreBundle:Product')->find($id);
        if (!$product) {
            throw $this->createNotFoundException(
                'No product found for id '.$id
            );
        }
        $product->setName('New product name!');
        $em->flush();
        return $this->redirect($this->generateUrl('homepage'));
    }

    /**
     * Create product action.
     *
     * @return Response
     */
    public function createProductAction()
    {
        $category = new Category();
        $category->setName('Main Products');
        $product = new Product();
        $product->setName('Foo');
        $product->setPrice(19.99);
        $product->setDescription('Lorem ipsum dolor');
        // relate this product to the category
        $product->setCategory($category);
        $em = $this->getDoctrine()->getManager();
        $em->persist($category);
        $em->persist($product);
        $em->flush();
        return new Response(
            'Created product id: '.$product->getId()
            .' and category id: '.$category->getId()
        );
    }

    public function showAllEntryAction()
    {

        $productRepository = $this->getDoctrine()
            ->getRepository('AcmeStoreBundle:Product');

        $products = $productRepository->findAll();
//        $products = 1;
        $params = array (
            'gigel' => $products,
        );
        return $this->render('@AcmeStore/Default/view.html.twig',
            $params
        );
    }

}
