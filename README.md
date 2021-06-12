# outside tasks Plugins Development


Create a plugin with the following details:

* Create a post type “Event” and add necessary custom fields required for the event.
* Add a custom taxonomy named “Event Type”
* Create a shortcode to list down events with possible attributes.
For eg: [event type=”webinar” limit=”10”]
Above example shortcode will display 10 latest events with the event type as “webinar”.
* Feel free to add in any other attributes that you think might be useful.
* Add a custom API endpoint and display 10 latest events with pagination included.
* Build a frontend event filter: filter includes (Event type, month, tag, etc.)
	** You can build a short code to display filters on the frontend.
	** Must be multi-filter
	** Display filterable ( simple dropdown/checkbox ) event list
	** Use of ajax to filter the events
* Gutenberg block
	** Event Slider
		* Normal slider with title and image
		* You can use any slider plugin (slick or any other )
