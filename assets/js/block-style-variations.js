wp.blocks.registerBlockStyle( 'core/button', {
	name: 'default',
	label: 'Default',
	isDefault: true
} );

wp.blocks.registerBlockStyle( 'core/button', {
	name: 'start',
	label: 'Start',
} );

wp.blocks.registerBlockStyle( 'core/button', {
	name: 'secondary',
	label: 'Secondary'
} );

wp.blocks.registerBlockStyle( 'core/button', {
	name: 'inverse',
	label: 'Inverse'
} );

wp.blocks.registerBlockStyle( 'core/list', {
	name: 'spaced',
	label: 'Extra spacing'
} );

wp.domReady(function(){
	wp.blocks.unregisterBlockStyle( 'core/button', 'fill' );
});

wp.domReady(function(){
	wp.blocks.unregisterBlockStyle( 'core/button', 'outline' );
});

wp.domReady(function(){
	wp.blocks.unregisterBlockStyle( 'core/separator', 'default' );
});

wp.domReady(function(){
	wp.blocks.unregisterBlockStyle( 'core/separator', 'dots' );
});

wp.domReady(function(){
	wp.blocks.unregisterBlockStyle( 'core/separator', 'wide' );
});

wp.domReady(function(){
	wp.blocks.unregisterBlockStyle( 'core/quote', ['plain', 'default'] );
})
