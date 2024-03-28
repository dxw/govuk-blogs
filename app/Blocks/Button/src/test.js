function wrapCoverBlockInContainer( element, blockType, attributes ) {
    // skip if element is undefined
    
	if ( ! element ) {
        return;
    }
	
    // only apply to cover blocks
    if ( blockType.name !== 'core/button' ) {
        return element;
    }

    // return the element wrapped in a div
    return <div className="cover-block-wrapper">{ element }</div>;
}

wp.hooks.addFilter(
    'blocks.getSaveElement',
    'my-plugin/wrap-cover-block-in-container',
    wrapCoverBlockInContainer
);
