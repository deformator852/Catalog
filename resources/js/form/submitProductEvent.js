import ProductValidator from "../utils/validators.js";

const form = document.querySelector('.add-product__form')
if (form) {
	form.addEventListener('submit', (event) => {
		const formData = new FormData(form)
		const errors = ProductValidator.validate(formData)
		if (errors.length > 0) {
			const errorsContainer = document.querySelector('.errors')
			errorsContainer.innerHTML = '';
			errors.forEach((error) => {
				errorsContainer.innerHTML += `<p>${error}</p>`
			})
			event.preventDefault()
		}
	})
}
