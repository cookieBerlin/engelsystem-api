<?php
namespace Engelsystem\ApiResourceBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;


class RoomController extends Controller
{
    public function listAction()
    {
        return new Response("[]");
    }

    public function createAction()
    {
        return new Response(null, 201);
    }

    public function readAction($id)
    {
        return new Response(null, 404);
    }

    public function updateAction($id)
    {
        return new Response(null, 404);
    }

    public function deleteAction($id)
    {
        return new Response(null, 404);
    }
}
