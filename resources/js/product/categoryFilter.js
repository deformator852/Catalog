export default function productCategoryFilter() {
    return {
        selectedCategory: new URLSearchParams(window.location.search).get('category') || '',
        products: [],
        loading: false,

        async categoryFilter() {
            this.loading = true;
            const params = new URLSearchParams();
            if (this.selectedCategory) {
                params.append('category', this.selectedCategory);
            }

            try {
                const response = await fetch(`${window.routes.productsList}?${params.toString()}`, {
                    headers: {'Accept': 'application/json'}
                });
                if (!response.ok) throw new Error(`Ошибка при получении данных.Ошибка ${response.status}`);
                const data = await response.json();
                this.products = data.data
            } catch (error) {
                console.log('Ошибка: ', error);
            } finally {
                this.loading = false;
            }
        },

        truncate(text, maxLength = 30) {
            return text.length > maxLength ? text.slice(0, maxLength) + '…' : text;
        }
    }
}
