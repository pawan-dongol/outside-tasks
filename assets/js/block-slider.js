( function( blocks, editor, element ) {
	var el = element.createElement;

	blocks.registerBlockType( 'event/slider', {
		title: 'Event Slider', // The title of block in editor.
		icon: 'slides', // The icon of block in editor.
		category: 'common', // The category of block in editor.
		attributes: {
		 url: {
	        type: 'string',
	        source: 'attribute',
	        selector: 'img',
	        attribute: 'src',
	    }
		
		},
		edit: function( props ) {
			return (
				el( 'div', { className: props.className },
					el(
						editor.RichText,
						{
							tagName: 'div',
							className: 'event-slider-url',
							value: props.attributes.url,
							onChange: function( url ) {
								props.setAttributes( { url: url } );
							}
						}
					),
				
				)
			);
		},
		save: function( props ) {
			return (
				el( 'div', { className: props.className },
					el( editor.RichText.Content, {
						tagName: 'p',
						className: 'event-slider-url',
						value: props.attributes.url,
					} ),
				)
			);
		},
	} );
} )( window.wp.blocks, window.wp.editor, window.wp.element );