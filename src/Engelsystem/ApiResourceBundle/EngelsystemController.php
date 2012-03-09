<?php
namespace Engelsystem\ApiResourceBundle;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;

class EngelsystemController extends Controller
{
    public function createSelfmadeException( $status_text, $status_code)
    {
        $response = new Response();
        $response->setStatusCode( $status_code);
        $response->headers->set( 'Content-Type', 'application/json; charset=utf-8');
        return $this->render('TwigBundle:Exception:error.html.twig', 
                             array('status_code' => $status_code, 
                                   'status_text' => $status_text), $response); 
   } 
}
