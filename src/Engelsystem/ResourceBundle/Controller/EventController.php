<?php
namespace Engelsystem\ResourceBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;


class EventController extends Controller
{
    public function getAction()
    {
        return new Response("{}");
    }
}
