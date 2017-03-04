<?php
class VersionController extends Zend_Rest_Controller
{
    /*
     * http://www.chrisdanielson.com/2009/09/02/creating-a-php-rest-api-using-the-zend-framework/
     */

    /**
     * The index action handles index/list requests; it should respond with a
     * list of the requested resources.
     */
    public function indexAction()
    {
        //if you want to have access to a particular paramater use the helper function as follows:
        //print $this->_helper->getParam('abc');
        //To test with this use:  http://myURL/format/xml/abc/1002
    }

    public function listAction()
    {
        $doc = new DOMDocument();
        $root_element = $doc->createElement("response");
        $doc->appendChild($root_element);

        $statusElement = $doc->createElement("success");
        $statusElement->appendChild($doc->createTextNode("true"));
        $root_element->appendChild($statusElement);

        $versionElement = $doc->createElement("version");
        $versionElement->appendChild($doc->createTextNode("1.0"));
        $root_element->appendChild($versionElement);

        $nameElement = $doc->createElement("name");
        $nameElement->appendChild($doc->createTextNode("anthony"));
        $root_element->appendChild($nameElement);

        $lastNameElement = $doc->createElement("lastName");
        $lastNameElement->appendChild($doc->createTextNode("anthony"));
        $nameElement->appendChild($lastNameElement);

        header('Content-Type: application/xml');
        echo $doc->saveXML(); 
        exit;
    }

    public function readAction()
    {
        $test = file_get_contents('http://anthony.zend.com/version/list');
        $test = simplexml_load_string($test);
        Zend_Debug::dump($test); 
        Zend_Debug::dump($test->name); 
        Zend_Debug::dump($test->version); 
        die();
    }

    public function getAction()
    {
        $this->_forward('index');
    }

    public function newAction()
    {
        $this->_forward('index');
    }

    public function postAction()
    {
        $this->_forward('index');
    }

    public function editAction()
    {
        $this->_forward('index');
    }

    public function putAction()
    {
        $this->_forward('index');
    }

    public function deleteAction()
    {
        $this->_forward('index');
    }
}