wp.domReady(() => {

	wp.blocks.registerBlockVariation(
		'core/buttons',
		{
			name: 'govukblogs/buttons',
			title: 'GOV.UK Buttons',
			description: 'Buttons using GOV.UK markup and styling',
			category: 'govuk-components',
			isDefault: true,
			scope: ['inserter'],
			innerBlocks: [
				[ 
					'core/button', 
				]
			],
			attributes: {
				className: ['wp-govuk-buttons'],
				category: 'govuk-components'
			},
			isActive: [ 'className' ]
		}
	)

	const allowedEmbedBlocks = [
		'vimeo',
		'youtube',
	];
	  
	wp.blocks.getBlockVariations('core/embed').forEach((blockVariation) => {
		if (allowedEmbedBlocks.indexOf(blockVariation.name) === -1) {
		  wp.blocks.unregisterBlockVariation('core/embed', blockVariation.name);
		}
	});
})
