

const { __ } = wp.i18n;
const { addFilter } = wp.hooks;
const { createHigherOrderComponent } = wp.compose;
const { Fragment, cloneElement } = wp.element;
const { InspectorControls } = wp.editor;
const { PanelBody, ToggleControl } = wp.components;

function changeClassOfInnerElement( element, blockType, attributes ) {
    // skip if element is undefined
    
	if ( ! element ) {
        return;
    }
	
    // only apply to cover blocks
    if ( blockType.name !== 'core/button' ) {
        return element;
    }

	// console.log(element.props.children.value)
	if (element.props.children) {
		return cloneElement(
			element,
			{ },
			cloneElement( element.props.children, {
				...element.props,
				className: 'govuk-button',
				// value: buttonValue + 'orange'
			})
		)
	}   
}

// function changeClassOfInnerElement( props )
// {
	
// 	if (props.className !== 'wp-block-button') {
// 		return props;
// 	}
// 	console.log(props)
// 	return {
// 		...props,
// 		className: 'govuk-button'
// 	}
// }

wp.hooks.addFilter(
    'blocks.getSaveElement',
    'my-plugin/wrap-cover-block-in-container',
    changeClassOfInnerElement
);


function addClassNameForValidation(props)
{
	console.log(props)
	// if (props.type !== "button" ) {
	// 	return props;
	// }

	// props.className = 'govuk-button'
	
	return props;
}

// wp.hooks.addFilter(
//     'editor.BlockEdit',
//     'my-plugin/with-inspector-controls',
//     addClassNameForValidation
// );

// // Our filter function
// function setBlockCustomClassName( className, blockName ) {
// 	console.log(className, blockName)
//     // return className === 'wp-block-button__link' ? 'govuk-button' : className;
// 	return className
// }

// // Adding the filter
// wp.hooks.addFilter(
//     'blocks.getBlockDefaultClassName',
//     'my-plugin/set-block-custom-class-name',
//     setBlockCustomClassName
// );

const withSubscribeBanner = createHigherOrderComponent( ( BlockEdit ) => {
	return ( props ) => {
		if (props.name !== 'core/button') {
			return <BlockEdit { ...props } />;
		}

		return (
			<>
				
					<BlockEdit { ...props } 
					className="govuk-buton" />
					
						
					

			</>
		);
	};
}, 'withSubscribeBanner' );

addFilter(
	'editor.BlockEdit',
	'mle-block-library/embed-subscribe-edit',
	withSubscribeBanner
);