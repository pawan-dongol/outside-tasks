import { registerBlockType } from '@wordpress/blocks';

registerBlockType( 'event/slick-slider', {
    title: 'Event Slider',
    description: 'Block to generate slider using slick',
    icon: 'slides',
    category: 'common',

    // custom attributes
    attributes:{
    	content:{
    		type: 'string',
    		source: 'text',
    	}
    },


    // built-in function
    edit( { attributes, setAttributes } ) {

    	// Custom function

    	function updateTitle(event){
    		setAttributes( { content : event.target.value } );
    	}

    	return <input type="text" value={ attributes.content }  onChange={ updateTitle } />;
    },

    save( { attributes })
    { 
    	return <p> Title: {attributes.content} </p>;

    }
} );