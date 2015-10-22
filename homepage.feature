#In order to [benefit], as a [stakeholder] I want to [feature]

	Feature: Homepage
		In order to see information about the app
		As a user
		I want to be able to access the site's homepage

	@footer
	Scenario Outline: Check if social media links in the footer are correct
		Given I am on homepage
		Then the "<social_media>" link should have the correct path
		Examples:
		|social_media |
		|facebook     |
		|twitter      |

