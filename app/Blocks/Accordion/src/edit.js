import { __ } from '@wordpress/i18n';
import { useBlockProps, useInnerBlocksProps } from '@wordpress/block-editor';

export default function Edit() {

	const blockProps = useBlockProps(
		{
			className:"govuk-accordion",
			id:"accordion-default"
		}
	);

	const innerBlocksProps = useInnerBlocksProps( blockProps, {
		defaultBlock: 'govukblogs/accordion-row',
		template: [ [ 'govukblogs/accordion-row' ] ],
		templateInsertUpdatesSelection: true,
		allowedBlocks: ['govukblogs/accordion-row'] 
	} );

	return (
		<div data-module="govuk-accordion" { ...innerBlocksProps }> 
			
		</div>
	);
}


