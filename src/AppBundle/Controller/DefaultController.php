<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Event\GetResponseEvent;
use Symfony\Component\Validator\Constraints\DateTime;

class DefaultController extends Controller
{


    /**
     * @Route("/{_locale}", name="homepage", defaults={"_locale":"ro"}, requirements={"_locale":"%app.locales%"})
     */
    public function indexAction(Request $request, $_locale)
    {
        /*
           http://stackoverflow.com/questions/34711082/symfony-3-redirect-all-routes-to-current-locale-version
           http://symfony.com/doc/current/routing/requirements.html

        */

        // replace this example code with whatever you need
        return $this->render(':frontEnd/index:index.html.twig');

    }

    /**
     * @Route("/{_locale}/{categorie}/{subcategorie}", name="show_products",
     *     requirements={
     *          "categorie" : "%app.categorie%",
     *          "subcategorie" : "%app.subcategorie%"
     *      }
     * )
     * @Method(methods={"GET"})
     */
    public function showProducts(Request $request, $_locale, $categoire, $subcategorie)
    {
        $em = $this->getDoctrine()->getManager();
        $qb = $em->createQueryBuilder();
        $qb->from('AppBundle:Admin\Category', 'c')
            ->select(array('c', 's', 'p'))
            ->leftJoin('c.subcategory', 's')
            ->leftJoin('s.picture', 'p');

        $categorii  = $qb->getQuery()->getArrayResult();

        return $this->render(':frontEnd/showProducts:index.html.twig', ['categorii' => $categorii]);
    }

    /**
     * @Route("/{_locale}/contact", name="contact", defaults={"_locale":"ro"}, requirements={"_locale":"%app.locales%"})
     */
    public function contactAction(Request $request, $_locale)
    {
        return $this->render(':frontEnd:home.html.twig');
    }


    public function showMenuAction()
    {
        $em = $this->getDoctrine()->getManager();
        $qb = $em->createQueryBuilder();
        $qb->from('AppBundle:Admin\Category', 'c')
            ->select(array('c', 's', 'p'))
            ->leftJoin('c.subcategory', 's')
            ->leftJoin('s.picture', 'p');

        $categorii  = $qb->getQuery()->getArrayResult();
        $columns = $em->getRepository('AppBundle:Admin\Category')->findAll();
        return $this->render(':frontEnd/index:menu.html.twig',['categorii' => $categorii, 'produse' => $columns, '_locale' => 'ro']);
    }

}