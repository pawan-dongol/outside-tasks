# outside tasks Plugins Development


Create a plugin with the following details:

* Create a post type “Event” and add necessary custom fields required for the event. => Done

* Add a custom taxonomy named “Event Type” => Done

* Create a shortcode to list down events with possible attributes. => Done
For eg: [event type=”webinar” limit=”10”]
Above example shortcode will display 10 latest events with the event type as “webinar”.

* Feel free to add in any other attributes that you think might be useful. => Add Event Location, Event time, Event Start Date and Event End Date (Done)

* Add a custom API endpoint and display 10 latest events with pagination included. => /wp-json/event/api/v1/latest-event for api url and for pagination need to send request page=1 or page =2 etc  ** /wp-json/event/api/v1/latest-event?page=2 **

* Build a frontend event filter: filter includes (Event type, month, tag, etc.)
	** You can build a short code to display filters on the frontend.
	** Must be multi-filter
	** Display filterable ( simple dropdown/checkbox ) event list
	** Use of ajax to filter the events
* Gutenberg block
	** Event Slider
		* Normal slider with title and image => Done
		* You can use any slider plugin (slick or any other ) => using slick library 

#Shortcode for event filter
* [event-filter]

#command need to remember
* npm init for set package.json 
* npm install --save-dev --save-exact @wordpress/scripts for gutenberg block js
* npm run build (for npm watch in each changes in js)
* npm cache clean --force
* npm cache verify