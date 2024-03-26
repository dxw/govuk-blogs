(function(){

	window.addEventListener("DOMContentLoaded", () => {
		const buttons = Array.from(document.querySelectorAll('.wp-govuk-buttons .wp-element-button'));
		
		buttons.forEach((button) => {
			button.setAttribute("role", "button")
		})
	})
})();