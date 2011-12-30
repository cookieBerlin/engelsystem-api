<?php
namespace Engelsystem\ResourceBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;


class ShiftTaskController extends Controller
{
    public function listAction($shift_id)
    {
        return new Response("[]");
    }

    public function createAction($shift_id, $type_id)
    {
        return new Response(null, 201);
    }

    public function updateAction($shift_id, $type_id, $task_id)
    {
        return new Response(null, 404);
    }

    public function deleteAction($shift_id, $type_id, $task_id)
    {
        return new Response(null, 404);
    }

    public function deleteAllAction($shift_id)
    {
        return new Response(null, 404);
    }
}
