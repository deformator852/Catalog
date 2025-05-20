export default function productPriceAndCategoryFilter() {
	return {
		selectedCategory: '',
		priceMin: '',
		priceMax: '',
		loading: false,
		products: [],

		async fetchProducts() {
			this.loading = true;
			const params = new URLSearchParams();
			if (this.selectedCategory) {
				params.append('category', this.selectedCategory);
			}
			if (this.priceMin !== '' && this.priceMin !== null) {
				params.append('price_min', this.priceMin);
			}
			if (this.priceMax !== '' && this.priceMax !== null) {
				params.append('price_max', this.priceMax);
			}
			try {
				const response = await fetch(`${window.routes.productsList}?${params.toString()}`, {
					headers: {'Accept': 'application/json'}
				});
				if (!response.ok) throw new Error(`Error retrieving data. Error text: ${response.status}`);
				const data = await response.json();
				this.products = data.data;
				// console.log(this.products)
			} catch (error) {
				console.log(error);
			} finally {
				this.loading = false;
			}
		},

		async onFilterChange() {
			await this.fetchProducts();
		},

		truncate(text, length = 50) {
			if (!text) return '';
			if (text.length <= length) return text;
			return text.slice(0, length) + '...';
		},

		async init() {
			await this.fetchProducts();
		}
	}
}
