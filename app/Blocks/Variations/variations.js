wp.domReady(() => {

	wp.blocks.registerBlockVariation(
		'core/buttons',
		{
			name: 'govukblogs/buttons',
			title: 'GOV.UK buttons',
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
})

