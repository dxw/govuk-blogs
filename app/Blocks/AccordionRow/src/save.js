import { useBlockProps, InnerBlocks, RichText } from '@wordpress/block-editor';

export default function save( { attributes } ) {
	
	const header = attributes.header ? attributes.header : '';
	
	const blockProps = useBlockProps.save({
		className: "govuk-accordion__section"
	});

	return (
		<div { ...blockProps }>
			<div className="govuk-accordion__section-header">
				<h2 className="govuk-accordion__section-heading">
					<span className="govuk-accordion__section-button" id="accordion-default-heading-1">
						<RichText.Content value={ header }
						/>
					</span>
				</h2>
    		</div>
			<div className="govuk-accordion__section-content">
				<InnerBlocks.Content />
			</div>
		</div>
	);
}
