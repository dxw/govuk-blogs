import { useBlockProps, InnerBlocks } from '@wordpress/block-editor';

export default function save() {

	const blockProps = useBlockProps.save( { className: 'govuk-inset-text' } );

	return (
		<div { ...blockProps }>
			<InnerBlocks.Content />
		</div>
	);
}
