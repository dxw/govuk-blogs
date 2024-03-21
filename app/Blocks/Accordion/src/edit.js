import { __ } from '@wordpress/i18n';
import { useBlockProps, useInnerBlocksProps } from '@wordpress/block-editor';

export default function Edit( { attributes, setAttributes } ) {

	const { showAll } = attributes;

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

	const toggleAll = () => {
		setAttributes({showAll: !showAll})
	}

	return (
		<div className='govuk-frontend-supported'>
		<div className="govuk-accordion__controls">
			<button type="button" className="govuk-accordion__show-all" aria-expanded="false" onClick={toggleAll}>
				<span className="govuk-accordion-nav__chevron govuk-accordion-nav__chevron--down"></span>
				<span className="govuk-accordion__show-all-text">Show all sections</span>
			</button>
		</div>
		<div data-module="govuk-accordion" { ...innerBlocksProps }> 
			
		</div>
	
		</div>
	);
}


