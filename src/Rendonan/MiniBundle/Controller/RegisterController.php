<?php

namespace Rendonan\MiniBundle\Controller;

use Rendonan\MiniBundle\Form\Type\AccountType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Rendonan\MiniBundle\Entity\Account;
use Symfony\Component\HttpFoundation\Request;
use Rendonan\MiniBundle\Scripts\GetSession;
use Symfony\Component\HttpFoundation\Session\Session;

class RegisterController extends Controller
{
    public function indexAction(Request $request)
    {
        $getSession        = new GetSession($this->get('session'));
        $getSessionData    = $getSession->getData();

        //if user is already logged in, DO NOT allow registration
        if (!$getSessionData["online"])
        {
            $account = new Account();

            $form = $this->createForm(new AccountType(), $account, array(
                'action' => $this->generateUrl('rendonan_mini_registration'),
                'method' => 'POST'
            ));

            $form->handleRequest($request);
            if ($form->isValid())
            {
                //register new user
                $em = $this->getDoctrine()->getManager();
                $user = $form->getData();
                $em->persist($user);
                $em->flush();

                //auto-fillin login form, forward to login action
                $loginRequest = new Request();
                $username = $user->getUsername();
                $password = $user->getPassword();
                $loginRequest->request->set('_username',$username);
                $loginRequest->request->set('_password',$password);
                $loginRequest->setMethod('POST');
                $this->loginAction($loginRequest);

                //redirect to main page
                return $this->redirect($this->generateUrl("rendonan_mini_homepage"));
            }

            return $this->render('RendonanMiniBundle:Default:Pages/register.html.twig',
                array(
                    'online'    => $getSessionData["online"],
                    'name'      => $getSessionData["username"],
                    'registerForm' => $form->createView()
                ));
        }
        else
        {
            return $this->render('RendonanMiniBundle:Default:Pages/thankyou.html.twig',
                array(
                    'online'    => $getSessionData["online"],
                    'name'      => $getSessionData["username"],
                    'title'     => "Sorry,",
                    'message'   => "you are already logged in and can therefore not register again."
                ));
        }
    }

    public function loginAction(Request $request) {

        //return boolean, true if length of string falls within min/max range
        function sizeRange($string, $min, $max)
        {
            if (strlen($string) >= $min && strlen($string) <= $max)
            {
                return 1;
            }
            else
            {
                return 0;
            }
        }

        //range allowed for input-length of username and password
        $rangemin = 4;
        $rangemax = 20;

        $em = $this->getDoctrine()->getManager();
        $repository = $em->getRepository('RendonanMiniBundle:Account');
        if ($request->getMethod() == 'POST')
        {
            $username = $request->get('_username');
            $password = ($request->get('_password'));

            //validation check
            $alphaUser = ctype_alnum($username);
            $alphaPass = ctype_alnum($password);
            $rangeUser = sizeRange($username,$rangemin,$rangemax);
            $rangePass = sizeRange($password,$rangemin,$rangemax);

            //Form input validation, username and password must be alphanumeric between range 4 - 20 characters.
            if ($alphaUser && $alphaPass && $rangeUser && $rangePass)
            {
                $user = $repository->findOneBy(array('username' => $username, 'password' => $password));
                if ($user)
                {
                    $session = new Session();
                    $session->set('online',1);
                    $session->set('username',$username);

                    $getSession        = new GetSession($this->get('session'));
                    $getSessionData    = $getSession->getData();

                    return $this->render('RendonanMiniBundle:Default:Pages/thankyou.html.twig',
                        array(
                            'online'    => $getSessionData["online"],
                            'name'      => $getSessionData["username"],
                            'title'     => "Success!",
                            'message'   => "Welcome ".$getSessionData["username"].", you are now logged in."
                        ));
                }
                else
                {
                    $getSession        = new GetSession($this->get('session'));
                    $getSessionData    = $getSession->getData();
                    return $this->render('RendonanMiniBundle:Default:Pages/thankyou.html.twig',
                        array(
                            'online'    => $getSessionData["online"],
                            'name'      => $getSessionData["username"],
                            'title'     => "Error,",
                            'message'   => "username and password do not match."
                        ));
                }
            }
            else
            {
                $getSession        = new GetSession($this->get('session'));
                $getSessionData    = $getSession->getData();
                return $this->render('RendonanMiniBundle:Default:Pages/thankyou.html.twig',
                    array(
                        'online'    => $getSessionData["online"],
                        'name'      => $getSessionData["username"],
                        'title'     => "Error,",
                        'message'   => "Invalid input used for username / password: Must be alphanumeric with length $rangemin - $rangemax characters."
                    ));
            }
        }
        else
        {
            $getSession        = new GetSession($this->get('session'));
            $getSessionData    = $getSession->getData();
            return $this->render('RendonanMiniBundle:Default:Pages/main.html.twig',
                array(
                    'online'    => $getSessionData["online"],
                    'name'      => $getSessionData["username"],
                ));
        }
    }

    public function logoutAction()
    {
        //destroy the session
        $session = $this->get('session');
        $session->clear();

        //restart session as anonymous user (online=false)
        $session        = new GetSession($this->get('session'));
        $sessionData    = $session->getData();
        return $this->redirect($this->generateUrl("rendonan_mini_homepage"));
    }

    public function thankyouAction()
    {
        $session        = new GetSession($this->get('session'));
        $sessionData    = $session->getData();
        if (!$sessionData["online"])
        {
            return $this->render('RendonanMiniBundle:Default:Pages/thankyou.html.twig',
                array(
                    'online'    => $sessionData["online"],
                    'name'      => $sessionData["username"],
                    'title'     => "Registration Successful!",
                    'message'   => "Congratulations, your account has been created!"
                ));
        }
        else
        {
            return $this->render('RendonanMiniBundle:Default:Pages/main.html.twig',
                array(
                    'online'    => $sessionData["online"],
                    'name'      => $sessionData["username"],
                ));
        }
    }
}
