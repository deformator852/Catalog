export default function productPriceFilter() {
    return {
        priceMin: '',
        priceMax: '',
        loading: false,
        products: [],

        async filterPrice() {
            this.loading = true;
            const params = new URLSearchParams();

            if (this.priceMin !== '') {
                params.append('price_min', this.priceMin);
            }
            if (this.priceMax !== '') {
                params.append('price_max', this.priceMax);
            }

            try {
                console.log(`${window.routes.productsList}?${params.toString()}`)
                const response = await fetch(`${window.routes.productsList}?${params.toString()}`, {
                    headers: {'Accept': 'application/json'}
                });
                if (!response.ok) throw new Error(`Ошибка при получении данных. Ошибка ${response.status}`);
                const data = await response.json();
                this.products = data.data;
            } catch (error) {
                console.log('Ошибка: ', error);
            } finally {
                this.loading = false;
            }
        },

        emitPriceChange() {
            this.fetchProducts();
        },

        truncate(text, length = 50) {
            if (!text) return '';
            if (text.length <= length) return text;
            return text.slice(0, length) + '...';
        },
    }
}
