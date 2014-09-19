<?php

namespace Acme\HelloBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\BrowserKit\Request;
use Symfony\Component\HttpFoundation\Response;

class DefaultController extends Controller
{

//    public function indexAction($first_name, $last_name, $color)
//    {
//        $first_name = strtoupper($first_name);
//
//        // Render this page using hello-view template and send the parameters to
//        // the twig.
//        return $this->render(
//            '@AcmeHello/Default/hello-view.html.twig',
//            array(
//                'name' => $first_name,
//                'last_name' => $last_name,
//               'color' => $color,
//            )
//        );
//    }
    public function indexAction($name)
    {
        $response = $this->forward('AcmeHelloBundle:Hello:fancy', array(
                'name' => $name,
                'color' => 'green',
            ));
        // ... further modify the response or return it directly
        return $response;
    }
    public function fancyAction($name, $color)
    {
        // ... create and return a Response object
    }

    public function updateAction()
    {
        $form = $this->createForm(...);
        $form->bindRequest($this->getRequest());
        if ($form->isValid()) {
            // do some sort of processing
            $this->get('session')->setFlash(
                'notice',
                'Your changes were saved!'
            );
            return $this->redirect($this->generateUrl(...));
        }
        return $this->render(...);
    }

}