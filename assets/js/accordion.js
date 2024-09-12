(function(){

	window.addEventListener("DOMContentLoaded", () => {
		const accordions = Array.from(document.querySelectorAll('.govuk-accordion'));
		
		accordions.forEach((accordion) => {
			const accordionRows = accordion.querySelectorAll('.govuk-accordion__section-content');
			accordionRows.forEach((row, key) => {
				row.id = `accordion-default-content-${key + 1}`
			})
		})
	})
})();