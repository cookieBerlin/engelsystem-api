<?php
namespace Engelsystem\ApiResourceBundle\Controller;

use Engelsystem\ApiResourceBundle\Entity\Room;
use Engelsystem\ApiResourceBundle\EngelsystemController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;


class RoomController extends EngelsystemController
{
    public function listAction()
    {
	// DB query
        $repository = $this->getDoctrine()->getRepository('EngelsystemApiResourceBundle:Room');
        $rooms = $repository->findAll();

	// create list
        $temp = "[";
	foreach ( $rooms as &$room) {
            if ( $temp != "[" ) {
                $temp .= ', ';
            }
            $temp .= $room->toJSON();
        }
        $temp .= "]";

	// renerate response            
        $response = new Response( $temp, 200);
	$response->headers->set( 'Content-Type', 'application/json');
        return $response;
    }

    public function createAction()
    {
	// check for required paramters
        $request = $this->get( 'request');
        if ( $request->request->has('name') == false ) {
            return $this->createSelfmadeException( 'parameter "room" not found', 404);
        }

	// create Room and set Values
        $room = new Room();
        $room->setName( $request->request->get('name'));
        if ( $request->request->has('description') ) {
            $room->setDescription(  $request->request->get('description') );
        }
        if ( $request->request->has('visible') ) {
            $room->setVisible(  $request->request->get('visible') );
            $room->setVisible(  $request->request->get('visible') );
        }
        if ( $request->request->has('order_modifier') ) {
            $room->setOrderModifier(  $request->request->get('order_modifier') );
        }

	// save in DB
        $em = $this->getDoctrine()->getEntityManager();
	$em->persist( $room);
	try {
            $em->flush();
        }
        catch( \PDOException $e )
        {
            return $this->createSelfmadeException( 'Room name already exist ('. $e->getMessage(). ')', 409);
        }

	// renerate response            
        $response = $this->readAction( $room->getID() );
        $response->setStatusCode( 201);
	return $response;
    }

    public function readAction($id)
    {
	// get Room form DB
        $repository = $this->getDoctrine()->getRepository( 'EngelsystemApiResourceBundle:Room');
        $room = $repository->findOneById( $id);
	if( $room == null) {
            throw $this->createNotFoundException('The room does not exist');
        }

	// renerate response            
        $response = new Response( $room->toJSON(), 200);
    	$response->headers->set( 'Content-Type', 'application/json');
        return $response;
    }

    public function updateAction($id)
    {
	// get Room from DB
	$em = $this->getDoctrine()->getEntityManager();
        $room = $em->getRepository( 'EngelsystemApiResourceBundle:Room')->findOneById( $id);
	if( $room == null) {
            throw $this->createNotFoundException('The room does not exist');
        }

	// update Values
        $request = $this->get('request');
        if ( $request->request->has('name') ) {
            $room->setName(  $request->request->get('name') );
        }
        if ( $request->request->has('description') ) {
            $room->setDescription(  $request->request->get('description') );
        }
        if ( $request->request->has('visible') ) {
            $room->setVisible(  $request->request->get('visible') );
        }
        if ( $request->request->has('order_modifier') ) {
            $room->setOrderModifier(  $request->request->get('order_modifier') );
        }
	
        // store in db
        $em->flush();
            
	// renerate response            
        $response = $this->readAction( $room->getID() );
        $response->setStatusCode( 202);
	return $response;
    }

    public function deleteAction($id)
    {
        // get Room from DB
	$em = $this->getDoctrine()->getEntityManager();
        $room = $em->getRepository( 'EngelsystemApiResourceBundle:Room')->findOneById( $id);
	if( $room == null) {
            throw $this->createNotFoundException('The room does not exist');
        }

        // remove from DB
        $em->remove( $room);
        $em->flush();

	// renerate response            
        return new Response( "", 202);
    }
}
