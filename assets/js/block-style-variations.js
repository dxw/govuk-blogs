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

wp.blocks.registerBlockStyle( 'core/separator', {
	name: 'medium',
	label: 'Medium',
	isDefault: true
} );

wp.blocks.registerBlockStyle( 'core/separator', {
	name: 'large',
	label: 'Large'
} );

wp.blocks.registerBlockStyle( 'core/separator', {
	name: 'x-large',
	label: 'Extra large'
} );

wp.blocks.registerBlockStyle( 'core/list', {
	name: 'spaced',
	label: 'Extra spacing'
} );

wp.blocks.registerBlockStyle( 'core/list', {
	name: 'no-bullet',
	label: 'No bullet'
} );

wp.blocks.registerBlockStyle( 'core/list', {
	name: 'no-bullet-spaced',
	label: 'No bullet & extra spacing' 
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
