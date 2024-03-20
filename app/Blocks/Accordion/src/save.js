import { useBlockProps, InnerBlocks } from '@wordpress/block-editor';

export default function save() {

	const blockProps = useBlockProps.save(
		{
			className:"govuk-accordion",
			id:"accordion-default"
		}
	);

	return (
		<div data-module="govuk-accordion" { ...blockProps }>
			<InnerBlocks.Content />
		</div>
	);
}

