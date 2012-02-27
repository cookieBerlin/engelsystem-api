<?php
namespace Engelsystem\ApiResourceBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;


class ShiftController extends Controller
{
    public function listAction()
    {
        return new Response('[{'.
				'"kind": "engelsystem#resource/shift",'.
				'"id": "string",'.
				'"name": "string",'.
				'"description": "string",'.
				'"room": { '.
					'"id": "string",'.
					'"name": "string",'.
					'"description": "string"'.
				'},'.
				'"time": {'.
					'"start": "datetime",'.
					'"duration": "string" '.
				'}'.
			'}]');
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
