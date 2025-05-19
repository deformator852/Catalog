import productDelete from "../product/delete.js";
import productCategoryFilter from "../product/categoryFilter.js";
import productPriceFilter from "../product/priceFilter.js";

export default class ComponentsFabric {
    static getProductDeleteComponent() {
        return productDelete
    }

    static getProductCategoryFilterComponent() {
        return productCategoryFilter
    }

    static getProductPriceFilterComponent() {
        return productPriceFilter
    }

    static getProductPriceAndCategoryFilterComponent() {
        return {
            // Состояние
            selectedCategory: '',
            priceMin: '',
            priceMax: '',
            loading: false,
            products: [],

            // Методы из categoryFilter
            async fetchProducts() {
                this.loading = true;
                const params = new URLSearchParams();

                if (this.selectedCategory) {
                    params.append('category', this.selectedCategory);
                }
                if (this.priceMin !== '') {
                    params.append('price_min', this.priceMin);
                }
                if (this.priceMax !== '') {
                    params.append('price_max', this.priceMax);
                }

                try {
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

            onFilterChange() {
                this.fetchProducts();
            },

            truncate(text, length = 50) {
                if (!text) return '';
                if (text.length <= length) return text;
                return text.slice(0, length) + '...';
            },

            init() {
                this.fetchProducts();
            }
        }
    }

}
