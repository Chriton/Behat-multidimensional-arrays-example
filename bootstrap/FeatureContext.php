<?php

use Behat\Behat\Context\ClosuredContextInterface,
    Behat\Behat\Context\TranslatedContextInterface,
    Behat\Behat\Context\BehatContext,
    Behat\Behat\Exception\PendingException;
use Behat\Gherkin\Node\PyStringNode,
    Behat\Gherkin\Node\TableNode,
	Behat\MinkExtension\Context\MinkContext;

//
// Require 3rd-party libraries here:
//
//   require_once 'PHPUnit/Autoload.php';
//   require_once 'PHPUnit/Framework/Assert/Functions.php';
//

/**
 * Features context.
 */
class FeatureContext extends MinkContext
{
    /**
     * Initializes context.
     * Every scenario gets it's own context object.
     *
     * @param array $parameters context parameters (set them up through behat.yml)
     */

	//we are going to store our data in this multidimensional array
	private static $links = array(

		'facebook' => array
			(
			'xpath'        => "//*[@class='socials']/ul/li[1]/a",
			'correct_href' => "https://www.facebook.com/example"
			),

		'twitter' => array
			(
			'xpath'        => "//*[@class='socials']/ul/li[2]/a",
			'correct_href' => "https://twitter.com/example"
			)
	);

	/**
	 * @param array $parameters
	 */
	public function __construct(array $parameters)
    {
        // Initialize your context here
    }

	/**
	 * @throws Exception
	 */
	public function show_error()
	{
		throw new Exception("Element not found or xpath is incorrect!");
	}


	/**
	 * @Then /^the "([^"]*)" link should have the correct path$/
	 */
	public function theLinkShouldHaveTheCorrectPath($social_media)
	{
		try
			{
			//if we don't find the element then we trigger our custom show_error method
			$get_href = $this->getSession()->getPage()->find('xpath', self::$links[$social_media]['xpath']) or self::show_error();

			//we compare the 'href' attribute of the element we found with ours
			if(self::$links[$social_media]['correct_href'] != $get_href->getAttribute('href'))
				{
				//if they don't match we are going to fail this scenario
				throw new Exception("The link to $social_media is not correct!");
				}
			}
		catch(Exception $e)
			{
			//here we catch our exceptions
			throw new Exception("Something went wrong! " . $e->getMessage());
			}
	}

}
