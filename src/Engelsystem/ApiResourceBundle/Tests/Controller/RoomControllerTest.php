<?php

namespace Engelsystem\ApiResourceBundle\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class RoomControllerTest extends WebTestCase
{
    public function testList()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/api/v1/resource/room');
        $this->assertEquals( 200, $client->getResponse()->getStatusCode());
    }

    public function testCreate()
    {
        $client = static::createClient();

        // get without 
        $crawler = $client->request('POST', '/api/v1/resource/room');
        $this->assertRegExp('/( not found")/', $client->getResponse()->getContent());
        $this->assertEquals( 404, $client->getResponse()->getStatusCode());
       
	// create with name 
	$name = 'Test'. time();
        $crawler = $client->request('POST', '/api/v1/resource/room', array( 'name' => $name));
        $this->assertEquals( 201, $client->getResponse()->getStatusCode());
       
	// create with name, description, visible and order_modifier 
	$name = 'Test'. time();
        $crawler = $client->request('POST', '/api/v1/resource/room', 
                                    array( 'name' => $name,
                                           'description' => 'description ...',
                                           'visible' => false,
                                           'order_modifier' => 23));
        $this->assertEquals( 201, $client->getResponse()->getStatusCode());
	$Result = json_decode( $client->getResponse()->getContent());
        $this->assertEquals( $Result->name, $name);
        $this->assertEquals( $Result->description->_empty_, 'description ...');
        $this->assertEquals( $Result->visible, false);
        $this->assertEquals( $Result->order_modifier, 23);
	
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
	$name = 'Test'. time();
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
	$name = 'Test'. time();
        $crawler = $client->request('POST', '/api/v1/resource/room', array( 'name' => $name));
        $this->assertEquals( 201, $client->getResponse()->getStatusCode());
	$Result = json_decode( $client->getResponse()->getContent());

	// Update existing room 1
	$name = 'Test1_'. time();
        $crawler = $client->request('PUT', '/api/v1/resource/room/'. $Result->id, 
                                    array( 'name' => $name,
                                           'description' => 'description1...',
                                           'visible' => true,
                                           'order_modifier' => 42));
        $this->assertEquals( 202, $client->getResponse()->getStatusCode());
	$Result = json_decode( $client->getResponse()->getContent());
        $this->assertEquals( $Result->name, $name);
        $this->assertEquals( $Result->description->_empty_, 'description1...');
        $this->assertEquals( $Result->visible, 1);
        $this->assertEquals( $Result->order_modifier, 42);

	// Update existing room 2
	$name = 'Test2_'. time();
        $crawler = $client->request('PUT', '/api/v1/resource/room/'. $Result->id, 
                                    array( 'name' => $name,
                                           'description' => 'description2...',
                                           'visible' => false,
                                           'order_modifier' => -23));
        $this->assertEquals( 202, $client->getResponse()->getStatusCode());
	$Result = json_decode( $client->getResponse()->getContent());
        $this->assertEquals( $Result->name, $name);
        $this->assertEquals( $Result->description->_empty_, 'description2...');
        $this->assertEquals( $Result->visible, false);
        $this->assertEquals( $Result->order_modifier, -23);
    }
    
    public function testDelete()
    {
        $client = static::createClient();

        // Delete not existing room
        $crawler = $client->request('DELETE', '/api/v1/resource/room/-3242');
        $this->assertEquals( 404, $client->getResponse()->getStatusCode());

        // create with name 
	$name = 'Test'. time();
        $crawler = $client->request('POST', '/api/v1/resource/room', array( 'name' => $name));
        $this->assertEquals( 201, $client->getResponse()->getStatusCode());
	$Result = json_decode( $client->getResponse()->getContent());

	// Delete existing room
        $crawler = $client->request('DELETE', '/api/v1/resource/room/'. $Result->id);
        $this->assertEquals( 202, $client->getResponse()->getStatusCode());
    }
    
}
