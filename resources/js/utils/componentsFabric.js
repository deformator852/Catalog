import productDelete from "../product/delete.js";
import productPriceAndCategoryFilter from "../product/filter.js";

export default class ComponentsFabric {
	static getProductDeleteComponent() {
		return productDelete
	}

	static getProductPriceAndCategoryFilterComponent() {
		return productPriceAndCategoryFilter
	}

}
