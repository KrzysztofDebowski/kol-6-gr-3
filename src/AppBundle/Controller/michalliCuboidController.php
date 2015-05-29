<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

use AppBundle\Form\michalliCuboidType;
use michalli\Tools\Cuboid;

class michalliCuboidController extends Controller
{
    /**
     * @Route("/michalli/cuboid/show/form", name="michalli_cuboid_show_form")
     */
    public function showFormAction()
    {
        $cuboid = new Cuboid();
        $form = $this->createCreateForm($cuboid);
        return $this->render(
            'AppBundle:michalliCuboid:form.html.twig',
            array(
                'form' => $form->createView()
            )
        );
    }
    /**
     * @Route("/michalli/cuboid/calc", name="michalli_cuboid_wynik")
     * @Method("POST")
     */
    public function calculateAction(Request $request)
    {
        $cuboid = new Cuboid();
        $form = $this->createCreateForm($cuboid);
        $form->handleRequest($request);
        if ($form->isValid()) {
            return $this->render(
                'AppBundle:michalliCuboid:wynik.html.twig',
                array('wynik' => $cuboid->field())
            );
        }
        return $this->render(
            'AppBundle:michalliCuboid:form.html.twig',
            array(
                'form' => $form->createView()
            )
        );
    }
    /**
     * Creates a form...
     *
     * @param Cuboid $cuboid The object
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createCreateForm(Cuboid $cuboid)
    {
        $form = $this->createForm(new michalliCuboidType(), $cuboid, array(
            'action' => $this->generateUrl('michalli_cuboid_wynik'),
            'method' => 'POST',
        ));
        $form->add('submit', 'submit', array('label' => 'Oblicz'));
        return $form;
   }
}