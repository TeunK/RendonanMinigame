<?php

namespace Rendonan\MiniBundle\Controller;

use Rendonan\MiniBundle\Form\Type\AccountType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Rendonan\MiniBundle\Entity\Account;
use Symfony\Component\HttpFoundation\Request;

class RegisterController extends Controller
{
    public function indexAction(Request $request)
    {
        $account = new Account();

        $form = $this->createForm(new AccountType(), $account, array(
            'action' => $this->generateUrl('rendonan_mini_registration'),
            'method' => 'POST'
        ));

        $form->handleRequest($request);
        if ($form->isValid())
        {
            //registerUser($form->getData());

            $em = $this->getDoctrine()->getManager();
            $em->persist($form->getData());
            $em->flush();

            //exit("form was valid.");
            return $this->redirect($this->generateUrl("rendonan_mini_thankyou"));

//            return $this->forward("RendonanMiniBundle:Default:thankyou", array(
//                'username' => $account->getUsername()
//            ));

        }

        return $this->render('RendonanMiniBundle:Default:Pages/register.html.twig',
            array(
                'registerForm' => $form->createView()
            ));
    }

    public function thankyouAction()
    {

        return $this->render('RendonanMiniBundle:Default:Pages/thankyou.html.twig',
            array(

            ));
    }

    function registerUser($registration)
    {

    }

}
