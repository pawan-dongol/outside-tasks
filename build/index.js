!function(e){var t={};function r(n){if(t[n])return t[n].exports;var o=t[n]={i:n,l:!1,exports:{}};return e[n].call(o.exports,o,o.exports,r),o.l=!0,o.exports}r.m=e,r.c=t,r.d=function(e,t,n){r.o(e,t)||Object.defineProperty(e,t,{enumerable:!0,get:n})},r.r=function(e){"undefined"!=typeof Symbol&&Symbol.toStringTag&&Object.defineProperty(e,Symbol.toStringTag,{value:"Module"}),Object.defineProperty(e,"__esModule",{value:!0})},r.t=function(e,t){if(1&t&&(e=r(e)),8&t)return e;if(4&t&&"object"==typeof e&&e&&e.__esModule)return e;var n=Object.create(null);if(r.r(n),Object.defineProperty(n,"default",{enumerable:!0,value:e}),2&t&&"string"!=typeof e)for(var o in e)r.d(n,o,function(t){return e[t]}.bind(null,o));return n},r.n=function(e){var t=e&&e.__esModule?function(){return e.default}:function(){return e};return r.d(t,"a",t),t},r.o=function(e,t){return Object.prototype.hasOwnProperty.call(e,t)},r.p="",r(r.s=2)}([function(e,t){e.exports=window.wp.element},function(e,t){e.exports=window.wp.blocks},function(e,t,r){"use strict";r.r(t);var n=r(0),o=r(1);alert("test");const{RichText:l,InspectorControls:i,MediaUpload:c}=wp.blockEditor,{PanelBody:a,IconButton:u}=wp.components;Object(o.registerBlockType)("event/slick-slider",{title:"Event Slider",description:"Block to generate slider",icon:"slides",category:"common",attributes:{title:{type:"string",source:"html",selector:"h2"},sliderImage:{type:"string",selector:".slider-container",default:null}},edit({attributes:e,setAttributes:t}){const{title:r,sliderImage:o}=e;return[Object(n.createElement)(i,{style:{marginBottom:"40px"}},Object(n.createElement)(a,{title:"Slider Image Settings"},Object(n.createElement)("p",null,Object(n.createElement)("strong",null," Select a Slider Image:")),Object(n.createElement)(c,{onSelect:function(e){t({sliderImage:e.sizes.full.url})},type:"image",value:o,render:({open:e})=>Object(n.createElement)(u,{onClick:e,icon:"upload",className:"editor-media-placeholder__button is-button is-default is-large"},"Slider Image")}))),Object(n.createElement)("div",{class:"slider-container",style:{backgroundImage:`url(${o})`,backgroundSize:"cover",backgroundPosition:"center",backgroundRepeat:"no-repeat"}},Object(n.createElement)(l,{key:"editable",tagName:"h2",placeholder:"Slider Title",value:r,onChange:function(e){t({title:e})}}))]},save({attributes:e}){const{title:t,sliderImage:r}=e;return Object(n.createElement)("div",null,Object(n.createElement)("div",{class:"slider-container",style:{backgroundImage:`url(${r})`,backgroundSize:"cover",backgroundPosition:"center",backgroundRepeat:"no-repeat",height:"500px"}},Object(n.createElement)(l.Content,{tagName:"h2",value:t})))}})}]);