class ProductValidator {
    static validate(productFormData) {
        const errors = []
        const name = productFormData.get('name')
        const price = productFormData.get('price')
        const image = productFormData.get('image')
        const imageSizeInKb = image.size / 1024
        if (name.length > 255) {
            errors.push('Product name should be less than 255 symbols')
        }
        if (price < 0) {
            errors.push('Product price can\'t be less than 0')
        }
        if (imageSizeInKb > 4028) {
            errors.push('Product image too big')
        }
        return errors
    }
}

export default ProductValidator
