import { __ } from '@wordpress/i18n';
import { store as blockEditorStore, useBlockProps, useInnerBlocksProps, RichText } from '@wordpress/block-editor';
import { useEffect, useState } from 'react';

const TEMPLATE = [
	[
		"core/paragraph",
		{
			placeholder: __( 'Add text, or type / to choose a block' ),
			align: 'left'
		},
	]
]

export default function Edit( { attributes, setAttributes, clientId, context } ) {

	const { header, isSelected } = attributes;

	const showAll = context['govukblogs/showAll'];

	const toggleDisplay = () => {
		setAttributes({isSelected: !isSelected})
	}
	
	const displayStatus = () => {
		return isSelected ? 'block' : 'none';
	}

	useEffect(() => {
		setAttributes({isSelected: showAll})
	}, [showAll])

	const blockProps = useBlockProps({
		className: "govuk-accordion__section"
	});

	const innerBlocksProps = useInnerBlocksProps(
		blockProps, 
		{
		template: TEMPLATE,
		allowedBlocks: [
			"core/paragraph",
			"core/list"
			]
		}
	);

	return (
		<>
		<div { ...innerBlocksProps }>
			<div className="govuk-accordion__section-header">
				<h2 className="govuk-accordion__section-heading">
					<span className="govuk-accordion__section-button">
						<RichText
							aria-label={ __( 'Write section header' ) }
							placeholder={ __( 'Write section header…' ) }
							allowedFormats={ [] }
							withoutInteractiveFormatting
							value={ header }
							onChange={ ( newHeader ) => 
								setAttributes( { header: newHeader })
							}
						/>
						<span className="govuk-accordion__section-toggle" data-nosnippet="" onClick={toggleDisplay}>
							<span className="govuk-accordion__section-toggle-focus">
								<span className="govuk-accordion-nav__chevron govuk-accordion-nav__chevron--down"></span>
								<span className="govuk-accordion__section-toggle-text">{isSelected ? 'Hide' : 'Show'}</span>
							</span>
						</span>
					</span>
				</h2>
    		</div>
			
			<div className="govuk-accordion__section-content" style={{display: displayStatus()}}>
				<div className='govuk-body'>
					{ innerBlocksProps.children }
				</div>
			</div>
		</div>
		</>
	);
}
