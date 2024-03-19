import { useBlockProps } from '@wordpress/block-editor';

export default function save() {
	return (
		<p { ...useBlockProps.save() }>
			{ 'Inset Text – hello from the saved content!' }
		</p>
	);
}
