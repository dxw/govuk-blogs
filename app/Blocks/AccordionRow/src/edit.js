import { __ } from '@wordpress/i18n';
import { store as blockEditorStore, useBlockProps, useInnerBlocksProps, RichText } from '@wordpress/block-editor';
import { useSelect } from '@wordpress/data';

const TEMPLATE = [
	[
		"core/paragraph"
	]
]

export default function Edit( { attributes, setAttributes, clientId } ) {

	const { header } = attributes;

	const isSelected = useSelect(
		( select ) => {
			const { isBlockSelected, hasSelectedInnerBlock } = select( blockEditorStore );
			return (
				hasSelectedInnerBlock( clientId, true ) ||  isBlockSelected( clientId ) ? false : true
			);
		},
		[ clientId ]
	);

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
					</span>
				</h2>
    		</div>
			<div className="govuk-accordion__section-content" hidden={ isSelected }>
				<div className='govuk-body'>
					{ innerBlocksProps.children }
				</div>
			</div>
		</div>
	);
}
