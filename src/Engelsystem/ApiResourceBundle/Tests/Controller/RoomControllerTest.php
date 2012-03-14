<?php

namespace Engelsystem\ApiResourceBundle\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class RoomControllerTest extends WebTestCase
{
    public function testList()
    {
        $client = static::createClient();
	$description = 'DESC1'. time();
	
        // create with name 
	$name = 'TestList1'. time();
        $crawler = $client->request('POST', '/api/v1/resource/room', array( 'name' => $name));
        $this->assertEquals( 201, $client->getResponse()->getStatusCode());
       
	$name = 'TestList2'. time();
        $crawler = $client->request('POST', '/api/v1/resource/room', array( 'name' => $name, 'description' => $description));
        $this->assertEquals( 201, $client->getResponse()->getStatusCode());
       
	$name = 'TestList3'. time();
        $crawler = $client->request('POST', '/api/v1/resource/room', array( 'name' => $name, 'description' => $description));
        $this->assertEquals( 201, $client->getResponse()->getStatusCode());
       
        // check unfiltert list
        $crawler = $client->request('GET', '/api/v1/resource/room');
        $this->assertEquals( 200, $client->getResponse()->getStatusCode());
        $Result = json_decode( $client->getResponse()->getContent(), true);
        $this->assertTrue( sizeof( $Result) >= 3);

        // check name filtert list
        $crawler = $client->request('GET', '/api/v1/resource/room', array( 'filter_name' => $name));
        $Result = json_decode( $client->getResponse()->getContent(), true);
        $this->assertEquals( 1, sizeof( $Result));

        // check description / name filtert list
        $crawler = $client->request('GET', '/api/v1/resource/room', array( 'filter' => $name));
        $this->assertEquals( 200, $client->getResponse()->getStatusCode());
        $Result = json_decode( $client->getResponse()->getContent(), true);
        $this->assertEquals( 1, sizeof( $Result));

        $crawler = $client->request('GET', '/api/v1/resource/room', array( 'filter' => $description));
        $this->assertEquals( 200, $client->getResponse()->getStatusCode());
        $Result = json_decode( $client->getResponse()->getContent(), true);
        $this->assertEquals( 2, sizeof( $Result));
    }

    public function testCreate()
    {
        $client = static::createClient();

        // get without 
        $crawler = $client->request('POST', '/api/v1/resource/room');
        $this->assertRegExp('/( not found")/', $client->getResponse()->getContent());
        $this->assertEquals( 404, $client->getResponse()->getStatusCode());
       
	// create with name 
	$name = 'TestCreate1'. time();
        $crawler = $client->request('POST', '/api/v1/resource/room', array( 'name' => $name));
        $this->assertEquals( 201, $client->getResponse()->getStatusCode());
       
	// create with name, description and visible 
	$name = 'TestCreate2'. time();
        $crawler = $client->request('POST', '/api/v1/resource/room', 
                                    array( 'name' => $name,
                                           'description' => 'description ...',
                                           'visible' => false) );
        $this->assertEquals( 201, $client->getResponse()->getStatusCode());
	$Result = json_decode( $client->getResponse()->getContent());
        $this->assertEquals( $Result->name, $name);
        $this->assertEquals( $Result->description->_empty_, 'description ...');
        $this->assertEquals( $Result->visible, false);
	
        // create with existing name 
        $crawler = $client->request('POST', '/api/v1/resource/room', array( 'name' => $name));
        $this->assertEquals( 409, $client->getResponse()->getStatusCode());
    }

    public function testGet()
    {
        $client = static::createClient();

        // get not existing room
        $crawler = $client->request('GET', '/api/v1/resource/room/-3242');
        $this->assertEquals( 404, $client->getResponse()->getStatusCode());
	
        // create with name 
	$name = 'TestGet'. time();
        $crawler = $client->request('POST', '/api/v1/resource/room', array( 'name' => $name));
        $this->assertEquals( 201, $client->getResponse()->getStatusCode());
	$Result = json_decode( $client->getResponse()->getContent());
       
	// get existing room
        $crawler = $client->request('GET', '/api/v1/resource/room/'. $Result->id);
        $this->assertEquals( 200, $client->getResponse()->getStatusCode());
    }
    
    public function testUpdate()
    {
        $client = static::createClient();

        // update not existing room
        $crawler = $client->request('PUT', '/api/v1/resource/room/-3242');
        $this->assertEquals( 404, $client->getResponse()->getStatusCode());

        // create with name 
	$name = 'TestUpdate'. time();
        $crawler = $client->request('POST', '/api/v1/resource/room', array( 'name' => $name));
        $this->assertEquals( 201, $client->getResponse()->getStatusCode());
	$Result = json_decode( $client->getResponse()->getContent());

	// Update existing room 1
	$name = 'TestUpdate1_'. time();
        $crawler = $client->request('PUT', '/api/v1/resource/room/'. $Result->id, 
                                    array( 'name' => $name,
                                           'description' => 'description1...',
                                           'visible' => true));
        $this->assertEquals( 202, $client->getResponse()->getStatusCode());
	$Result = json_decode( $client->getResponse()->getContent());
        $this->assertEquals( $Result->name, $name);
        $this->assertEquals( $Result->description->_empty_, 'description1...');
        $this->assertEquals( $Result->visible, 1);

	// Update existing room 2
	$name = 'TestUpdate2_'. time();
        $crawler = $client->request('PUT', '/api/v1/resource/room/'. $Result->id, 
                                    array( 'name' => $name,
                                           'description' => 'description2...',
                                           'visible' => false));
        $this->assertEquals( 202, $client->getResponse()->getStatusCode());
	$Result = json_decode( $client->getResponse()->getContent());
        $this->assertEquals( $Result->name, $name);
        $this->assertEquals( $Result->description->_empty_, 'description2...');
        $this->assertEquals( $Result->visible, false);
    }
    
    public function testDelete()
    {
        $client = static::createClient();

        // Delete not existing room
        $crawler = $client->request('DELETE', '/api/v1/resource/room/-3242');
        $this->assertEquals( 404, $client->getResponse()->getStatusCode());

        // create with name 
	$name = 'TestDelete'. time();
        $crawler = $client->request('POST', '/api/v1/resource/room', array( 'name' => $name));
        $this->assertEquals( 201, $client->getResponse()->getStatusCode());
	$Result = json_decode( $client->getResponse()->getContent());

	// Delete existing room
        $crawler = $client->request('DELETE', '/api/v1/resource/room/'. $Result->id);
        $this->assertEquals( 202, $client->getResponse()->getStatusCode());
    }
}
