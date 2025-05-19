export default function productDelete() {
    return {
        async deleteProduct(id) {
            if (!confirm('Are you sure you want to delete this product?')) return;

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
