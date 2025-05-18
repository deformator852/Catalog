@extends('layouts.app')
@section('title',$title)

@section('content')
    <div x-data="productFilter()" x-init="fetchProducts()">
        <div class="products-filter">
            <form @submit.prevent>
                <select name="category" x-model="selectedCategory" @change="fetchProducts"
                        class="products-filter__select">
                    <option value="">All categories</option>
                    @foreach($categories as $category)
                        <option value="{{ $category->id }}" @selected(request('category') == $category->id)>
                            {{ $category->name }}
                        </option>
                    @endforeach
                </select>
            </form>
        </div>

        <div class="products-list" style="margin-top: 30px">
            <template x-if="loading">
                <p>Загрузка...</p>
            </template>

            <template x-if="!loading">
                <template x-for="product in products" :key="product.id">
                    <div class="products-list__item" :id="`product-${product.id}`">
                        <p class="products-list__name" x-text="truncate(product.name)"></p>
                        <p class="products-list__category" x-text="product.category?.name || 'No category'"></p>
                        <p class="products-list__price" x-text="`$${product.price}`"></p>
                        <img class="products-list__image" :src="`/storage/${product.image}`" :alt="product.name">
                    </div>
                </template>
            </template>
        </div>
    </div>

@endsection
<script>
    window.routes = {
        productsList: '{{ route('products.list') }}'
    }

    function productFilter() {
        return {
            selectedCategory: '{{ request('category') }}',
            products: [],
            loading: false,

            async fetchProducts() {
                this.loading = true;
                const params = new URLSearchParams();
                if (this.selectedCategory) {
                    params.append('category', this.selectedCategory);
                }

                try {
                    const response = await fetch(`${window.routes.productsList}?${params.toString()}`, {
                        headers: {'Accept': 'application/json'}
                    });
                    console.log(response.url)
                    if (!response.ok) throw new Error(`Ошибка при получении данных.Ошибка ${response.status}`);
                    this.products = await response.json();
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

</script>
