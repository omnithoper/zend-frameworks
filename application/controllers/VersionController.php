<?php
class VersionController extends Zend_Rest_Controller
{
    /*
     * http://www.chrisdanielson.com/2009/09/02/creating-a-php-rest-api-using-the-zend-framework/
     */
	public function init()
    {
		#$this->_helper->layout()->disableLayout();
            #$this->_helper->viewRenderer->setNoRender();

        $bootstrap = $this->getInvokeArg('bootstrap');
 
		$options = $bootstrap->getOption('resources');
 
		$contextSwitch = $this->_helper->getHelper('contextSwitch');
		$contextSwitch->addActionContext('index', array('xml','json'))->initContext();
 
		//$this->_helper->viewRenderer->setNeverRender();	
		$this->view->success = "true";
		$this->view->version = "1.0";
	}

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
        $doc->formatOutput = false;
        $doc->preserveWhiteSpace = false;
        $root_element = $doc->createElement("response");
        $doc->appendChild($root_element);

        $statusElement = $doc->createElement("success");
        $statusElement->appendChild($doc->createTextNode("true"));
        $root_element->appendChild($statusElement);

        $versionElement = $doc->createElement("version");
        $versionElement->appendChild($doc->createTextNode("1.0"));
        $root_element->appendChild($versionElement);

        header('Content-Type: application/xml');
        echo $doc->saveXML(); exit;
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