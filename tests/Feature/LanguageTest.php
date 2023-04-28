<?php

namespace Tests\Feature;

use Tests\TestCase;

class LanguageTest extends TestCase
{
	/**
	 * A basic feature test example.
	 */
	public function testSwitchLangWithValidLanguage()
	{
		$language = 'en'; // A valid language

		// Call the controller method with a valid language
		$response = $this->call('GET', "/lang/$language");

		// Assert that the session has been updated with the new language
		//		$response->ddSession();
		$this->assertEquals($language, session('applocale'));

		// Assert that the response redirects back
		$response->assertRedirect();
	}
}
