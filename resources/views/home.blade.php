@extends('layouts.app')
@section('title',$title)

@section('content')
	<div x-data="ComponentsFabric.getProductPriceAndCategoryFilterComponent()">
		<div class="products-filter">
			<form @submit.prevent>
				<select name="category" x-model="selectedCategory" @change="onFilterChange"
								class="products-filter__select">
					<option value="">All categories</option>
					@foreach($categories as $category)
						<option value="{{ $category->id }}">{{ $category->name }}</option>
					@endforeach
				</select>
			</form>
		</div>

		<div class="price-filter">
			<label>
				Min Price:
				<input type="number" min="0" step="0.01" x-model.number="priceMin" @change="onFilterChange"
							 class="price-filter__input" placeholder="0">
			</label>
			<label>
				Max Price:
				<input type="number" min="0" step="0.01" x-model.number="priceMax" @change="onFilterChange"
							 class="price-filter__input" placeholder="10000">
			</label>
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
