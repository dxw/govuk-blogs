import { __ } from '@wordpress/i18n';
import { useBlockProps, useInnerBlocksProps, store as blockEditorStore } from '@wordpress/block-editor';

const TEMPLATE = [
	[
		'core/paragraph',
		{
			placeholder: __( 'Type / to choose a block' )
		},
	],
];

export default function Edit() {

	const blockProps = useBlockProps(
		{ className: "govuk-inset-text" }
	);

	const innerBlockProps = useInnerBlocksProps(
		blockProps,
		{
			template: TEMPLATE,
			allowedBlocks: ['core/paragraph', 'core/list']
		}
	);

	return (
		<div { ...innerBlockProps }>
			{ innerBlockProps.children }
		</div>
	);
}
