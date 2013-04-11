<?php

use \Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

/**
 * This class checks the BaseController, and also the routing.
 * Everything for BaseController should be routed through /items
 *
 * @group controllers
 * @group base
 */
class BaseControllerTest extends TestCase 
{
    public function testValidClass()
    {   
    }
    
    // public function testNotFoundWorks()
    // {
    //     $response = BaseControllerStub::notFound();
    //     $this->assertEquals(404, $response->getStatusCode());
    //     $this->assertEquals('application/json', 
    //         $response->headers->get('content-type'));
    //     $this->assertEquals('[]', $response->getContent());
    // }

    // public function testNotFoundWorksWithErrorMessage()
    // {
    //     $response = BaseControllerStub::notFound('test');
    //     $this->assertEquals(404, $response->getStatusCode());
    //     $this->assertEquals('application/json', 
    //         $response->headers->get('content-type'));
    //     $this->assertEquals('{"errors":["test"]}', $response->getContent());
    // }

    // public function testBadRequestWorks()
    // {
    //     $response = BaseControllerStub::badRequest('test');
    //     $this->assertEquals(400, $response->getStatusCode());
    //     $this->assertEquals('application/json', 
    //         $response->headers->get('content-type'));
    //     $this->assertEquals('{"errors":["test"]}', $response->getContent());
    // }

    // public function testRequestOkWorks()
    // {
    //     $response = BaseControllerStub::OK('test');
    //     $this->assertEquals(200, $response->getStatusCode());
    //     $this->assertEquals('application/json', 
    //         $response->headers->get('content-type'));
    //     $this->assertEquals('["test"]', $response->getContent());
    // }

}

