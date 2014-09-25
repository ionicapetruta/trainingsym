<?php

namespace Acme\TaskBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Acme\TaskBundle\Entity\Task;
use Symfony\Component\HttpFoundation\Request;


class TaskController extends Controller
{
    /**
     * @param $name
     * @return \Symfony\Component\HttpFoundation\Responses
     */
    public function indexAction($name)
    {
        return $this->render('AcmeTaskBundle:Default:index.html.twig', array('name' => $name));
    }

    public function updateTask($task)
    {
        $em = $this->getDoctrine()->getManager();
        $em->persist($task);
        $em->flush();
    }

    /**
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function newAction(Request $request)
    {
        // create a task and give it some dummy data for this example
        $task = new Task();
        $task->setTask('Write a blog post');
        $task->setDueDate(new \DateTime('tomorrow'));
        $form = $this->createFormBuilder($task)
            ->add('task', 'text')
            ->add('dueDate', 'date')
            ->add('save', 'submit', array('label' => 'Create Post'))
            ->add('saveAndAdd', 'submit', array('label' => 'Save and Add'))
            ->getForm();
        $form->handleRequest($request);

        if ($form->isValid() == true) {
            $this->updateTask($task);
            // perform some action, such as saving the task to the database
            return $this->render('AcmeTaskBundle:Default:new.html.twig', array(
                    'form' => $form->createView(),
                ));
        }
//        $url = $this->generateUrl('acme_task_homepage', array('name' => 'a'));
//        return $this->redirect($url);



        return $this->render('AcmeTaskBundle:Default:new.html.twig', array(
                'form' => $form->createView(),
            ));
    }
}
