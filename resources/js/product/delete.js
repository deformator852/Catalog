export default function productDelete() {
	return {
		selectedProductId: null,
		async deleteProduct(id) {
			this.selectedProductId = id;
			this.showModal();
		},

		showModal() {
			document.getElementById('deleteModal').classList.remove('hidden');

			document.getElementById('confirmDeleteBtn').onclick = async () => {
				await this.confirmDelete(this.selectedProductId);
				this.hideModal();
			};

			document.getElementById('cancelDeleteBtn').onclick = () => {
				this.hideModal();
			};
		},

		hideModal() {
			document.getElementById('deleteModal').classList.add('hidden');
		},

		async confirmDelete(id) {
			try {
				const response = await fetch(`/products/${id}`, {
					method: 'DELETE',
					headers: {
						'Accept': 'application/json',
						'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
					}
				});
				if (!response.ok) throw new Error(`Error ${response.status}`);

				const div = document.getElementById(`product-${id}`);
				if (div) div.remove();

			} catch (error) {
				console.error(error);
			}
		}
	}
}
