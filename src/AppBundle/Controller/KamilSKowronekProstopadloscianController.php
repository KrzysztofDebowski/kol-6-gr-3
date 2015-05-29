<?php
namespace AppBundle\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use AppBundle\Form\KamilSkowronekProstopadloscianType;
use KamilSkowronek\Tools\Prostopadloscian;
class KamilSkowronekProstopadloscianController extends Controller
{
    /**
     * @Route("/KamilSkowronek/prostopadloscian/show/form", name="KamilSkowronek_prostopadloscian_show_form")
     */
    public function showFormAction()
    {
        $prostopadloscian = new Prostopadloscian();
        $form = $this->createCreateForm($prostopadloscian);
        return $this->render(
            'AppBundle:KamilSkowronekProstopadloscian:form.html.twig',
            array(
                'form' => $form->createView()
            )
        );
    }
    /**
     * @Route("/KamilSkowronek/prostopadloscian/calc", name="KamilSkowronek_prostopadloscian_licz")
     * @Method("POST")
     */
    public function calculateAction(Request $request)
    {
        $prostopadloscian = new Prostopadloscian();
        $form = $this->createCreateForm($prostopadloscian);
        $form->handleRequest($request);
        if ($form->isValid()) {
            return $this->render(
                'AppBundle:KamilSkowronekProstopadloscian:wynik.html.twig',
                array('wynik' => $prostopadloscian->prostopadloscian())
            );
        }
        return $this->render(
            'AppBundle:KamilSkowronekProstopadloscian:form.html.twig',
            array(
                'form' => $form->createView()
            )
        );
    }
    /**
     * Creates a form...
     *
     * @param Prostopadloscian $prostopadloscian The object
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createCreateForm(Prostopadloscian $prostopadloscian)
    {
        $form = $this->createForm(new KamilSkowronekProstopadloscianType(), $prostopadloscian, array(
            'action' => $this->generateUrl('KamilSkowronek_prostopadloscian_licz'),
            'method' => 'POST',
        ));
        $form->add('submit', 'submit', array('label' => 'Oblicz'));
        return $form;
    }
}