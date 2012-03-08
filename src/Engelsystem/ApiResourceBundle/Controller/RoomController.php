<?php
namespace Engelsystem\ApiResourceBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Engelsystem\ApiResourceBundle\Entity\Room;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;


class RoomController extends Controller
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

	// renerate responce            
        $responce = new Response( $temp, 200);
	$responce->headers->set( 'Content-Type', 'application/json');
        return $responce;
    }

    public function createAction()
    {
	// check for required paramters
        $request = $this->get('request');
        if ( $request->request->has('name') == false ) {
            return new Response( "", 404);
        }

	// create Room an dset Values
        $room = new Room();
	$room->setName( $request->request->get('name'));

	// save in DB
        $em = $this->getDoctrine()->getEntityManager();
	$em->persist( $room);
	try {
            $em->flush();
        }
        catch( \PDOException $e )
        {
            //return new Response( '["": "'. $e->getMessage(). ' ('. $e->getCode(). ')"', 404);
            return new Response( '', 409);
        }

	// renerate responce            
        $responce = $this->readAction( $room->getID() );
        $responce->setStatusCode( 201);
	return $responce;
    }

    public function readAction($id)
    {
	// get Room form DB
        $repository = $this->getDoctrine()->getRepository( 'EngelsystemApiResourceBundle:Room');
        $room = $repository->findOneById( $id);
	if( $room == null) {
            return new Response( "", 404);
        }

	// renerate responce            
        $responce = new Response( $room->toJSON(), 200);
    	$responce->headers->set( 'Content-Type', 'application/json');
        return $responce;
    }

    public function updateAction($id)
    {
	// get Room from DB
	$em = $this->getDoctrine()->getEntityManager();
        $room = $em->getRepository( 'EngelsystemApiResourceBundle:Room')->findOneById( $id);
	if( $room == null) {
            return new Response( "", 404);
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
            
	// renerate responce            
        $responce = $this->readAction( $room->getID() );
        $responce->setStatusCode( 202);
	return $responce;
    }

    public function deleteAction($id)
    {
        // get Room from DB
	$em = $this->getDoctrine()->getEntityManager();
        $room = $em->getRepository( 'EngelsystemApiResourceBundle:Room')->findOneById( $id);
	if( $room == null) {
            return new Response( "", 404);
        }

        // remove from DB
        $em->remove( $room);
        $em->flush();

	// renerate responce            
        $responce = new Response( "", 202);
//    	$responce->headers->set( 'Content-Type', 'application/json');
        return $responce;
    }
}
