<?php

namespace Rendonan\MiniBundle\Controller;

use Rendonan\MiniBundle\Form\Type\AccountType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Rendonan\MiniBundle\Entity\Account;
use Symfony\Component\HttpFoundation\Request;
use Rendonan\MiniBundle\Scripts\GetSession;

class RegisterController extends Controller
{
    public function indexAction(Request $request)
    {
        $account = new Account();

        $getSession        = new GetSession();
        $getSessionData    = $getSession->getData();

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
            return $this->redirect($this->generateUrl("rendonan_mini_thankyou",
                array(
                    'online'    => 0,
                    'name'=>$request->get('_username')
                )));

//            return $this->forward("RendonanMiniBundle:Default:thankyou", array(
//                'username' => $account->getUsername()
//            ));

        }

        return $this->render('RendonanMiniBundle:Default:Pages/register.html.twig',
            array(
                'online'    => $getSessionData[1],
                'name'      => $getSessionData[2],
                'registerForm' => $form->createView()
            ));
    }

    public function loginAction(Request $request) {
        $session = $request->getSession();
        $em = $this->getDoctrine()->getEntityManager();
        $repository = $em->getRepository('RendonanMiniBundle:Account');
        if ($request->getMethod() == 'POST') {
            $session->clear();
            $username = $request->get('_username');
            $password = ($request->get('_password'));
            $user = $repository->findOneBy(array('username' => $username, 'password' => $password));
            if ($user) {
                $session->set('online',1);
                $session->set('username',$username);

                $getSession        = new GetSession();
                $getSessionData    = $getSession->getData();

                return $this->render('RendonanMiniBundle:Default:Pages/thankyou.html.twig',
                    array(
                        'online'    => $getSessionData[1],
                        'name'      => $getSessionData[2]
                    ));
            } else {
                return $this->render('RendonanMiniBundle:Default:Pages/main.html.twig',
                    array(
                        'online'    => 0,
                        'name'      => 'Login Error, user:'.$username.', pass:'.$password)
                );
            }
        }/* else {
            if ($session->has('login')) {
                $login = $session->get('login');
                $username = $login->getUsername();
                $password = $login->getPassword();
                $user = $repository->findOneBy(array('username' => $username, 'password' => $password));
                if ($user) {
                    return $this->render('LoginLoginBundle:Default:Pages/welcome.html.twig',
                        array(
                            'online'    => $sessionData[1],
                            'name'      => $sessionData[2]
                        ));
                }
            }
            return $this->render('RendonanMiniBundle:Default:Pages/main.html.twig',
                array(
                    'online'    => $sessionData[1],
                    'name'      => $sessionData[2]
                ));
        }*/
    }

    public function logoutAction()
    {
        //destroy session
        session_destroy();

        //restart session as anonymous user (online=false)
        $session        = new GetSession();
        $sessionData    = $session->getData();

        return $this->render('RendonanMiniBundle:Default:Pages/main.html.twig',
            array(
                'online'    => $sessionData[1],
                'name'      => $sessionData[2]
            )
        );
    }

    public function thankyouAction()
    {
        $session        = new GetSession();
        $sessionData    = $session->getData();

        return $this->render('RendonanMiniBundle:Default:Pages/thankyou.html.twig',
            array(
                'online'    => $sessionData[1],
                'name'      => $sessionData[2]
            ));
    }
}
