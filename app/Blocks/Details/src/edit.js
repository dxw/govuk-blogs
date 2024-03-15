
import { __ } from '@wordpress/i18n';
import { RichText, useBlockProps, useInnerBlocksProps, store as blockEditorStore } from '@wordpress/block-editor';
import { useSelect } from '@wordpress/data';

const TEMPLATE = [
	[
		'core/paragraph',
		{
			placeholder: __( 'Type / to add a hidden block' )
		},
	],
];

export default function Edit( { attributes, setAttributes, clientId }) {

	const { summary } = attributes;

	const blockProps = useBlockProps(
		{ className: "govuk-details" }
	);
	
	const innerBlockProps = useInnerBlocksProps( 
		blockProps, 
		{ 
			template: TEMPLATE,
			allowedBlocks: ['core/paragraph', 'core/list'] 
		}
	);

	const isSelected = useSelect(
		( select ) => {
			const { isBlockSelected, hasSelectedInnerBlock } = select( blockEditorStore );
			return (
				hasSelectedInnerBlock( clientId, true ) || isBlockSelected( clientId )
			);
		},
		[ clientId ]
	);

	return (
		<details 
			{ ...innerBlockProps }
			open={ isSelected }
		>
			<summary className="govuk-details__summary" onClick={ (event) => event.preventDefault() }>
				<span className="govuk-details__summary-text">
					<RichText
						aria-label={ __( 'Write summary' ) }
						placeholder={ __( 'Write summary…' ) }
						allowedFormats={ [] }
						withoutInteractiveFormatting
						value={ summary }
						onChange={ ( newSummary ) => 
							setAttributes( { summary: newSummary })
						}
					/>
				</span>
			</summary>
			<div className='govuk-details__text'>
				{ innerBlockProps.children }
			</div>
		</details>
	);
}
