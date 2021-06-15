import { registerBlockType } from '@wordpress/blocks';

alert('test');

const { 
    RichText,
    InspectorControls,
    MediaUpload
}  = wp.blockEditor;

const { 
    PanelBody,
    IconButton
} = wp.components;


registerBlockType( 'event/slick-slider', {
    title: 'Event Slider',
    description: 'Block to generate slider',
    icon: 'slides',
    category: 'common',

    // custom attributes
    attributes:{
    	title:{
    		type: 'string',
    		source: 'html',
            selector: 'h2'
    	},
        sliderImage: {
            type: 'string',
            selector: '.slider-container',
            default: null
        }
      
    },


    // built-in function
    edit( { attributes, setAttributes } ) {

    	// Custom function
       const {
            title,
            sliderImage
       } = attributes;

       function onChangeTitle(newTitle){
            setAttributes( { title: newTitle } );
       }

       function onSelectImage(newImage){
            setAttributes( { sliderImage: newImage.sizes.full.url } );
       }

       return ([
            <InspectorControls style={ { marginBottom: '40px' } }>
                <PanelBody title={ 'Slider Image Settings' }>
                    <p><strong> Select a Slider Image:</strong></p>
                    <MediaUpload  
                        onSelect={ onSelectImage }
                        type="image"
                        value={ sliderImage } 
                        render={ ( { open } ) => {
                            return (
                                  <IconButton
                                onClick={ open }
                                icon="upload"
                                className="editor-media-placeholder__button is-button is-default is-large">
                                    Slider Image
                                </IconButton>       
                            );
                    } }>
                    </MediaUpload>
                </PanelBody>
            </InspectorControls>,
            
            <div class="slider-container"  style={{ 
                backgroundImage: `url(${sliderImage})`,
                backgroundSize: "cover",
                backgroundPosition: "center",
                backgroundRepeat: "no-repeat",
            }} >

                <RichText key="editable"
                          tagName="h2"  
                          placeholder="Slider Title"
                          value={ title }
                          onChange={ onChangeTitle }
                          />
            </div>
        ]);
    },

    save( { attributes })
    { 
    	const {
            title,
            sliderImage
        } = attributes;

        return (
            
            <div class="slider-container"  style={{ 
                backgroundImage: `url(${sliderImage})`,
                backgroundSize: "cover",
                backgroundPosition: "center",
                backgroundRepeat: "no-repeat",
            }} >
              
                <RichText.Content tagName="h2"  
                         value={ title }
                />
            </div>
        );

    }
} );