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
        $em = $this->getDoctrine()->getEntityManager();
        $repository = $this->getDoctrine()->getRepository( 'EngelsystemApiResourceBundle:Room');
        $request = $this->get( 'request');
        if ( $request->query->has( 'filter_name') ) {
            $rooms = $repository->createQueryBuilder( 'p')
                                ->where( 'p.name = :name')
                                ->setParameter( 'name', $request->query->get( 'filter_name'))
                                ->getQuery()
                                ->getResult();
        } else if ( $request->query->has('filter') ) {
            $rooms = $repository->createQueryBuilder( 'p')
                                ->where( 'p.name = :name')
                                ->setParameter( 'name', $request->query->get( 'filter'))
                                ->orWhere( 'p.description = :description')
                                ->setParameter( 'description', $request->query->get( 'filter'))
                                ->getQuery()
                                ->getResult();
        } else {
            $rooms = $repository->findAll();
        }

	// create list
        $temp = "[";
	foreach ( $rooms as &$room) {
            if ( $temp != "[" ) {
                $temp .= ', ';
            }
            $temp .= $room->toJSON();
        }
        $temp .= "]";

        return new Response( $temp, 200);
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

        return new Response( $room->toJSON(), 200);
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
