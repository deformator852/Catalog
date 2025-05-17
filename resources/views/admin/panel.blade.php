@php use Illuminate\Support\Str; @endphp
    <!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel</title>
    @vite(['resources/scss/app.scss', 'resources/js/app.js'])
</head>

<body>
<div class="add-product">
    <div class="errors add-product__errors"></div>
    <form class="add-product__form" action="{{route('products.store')}}" method="POST"
          enctype="multipart/form-data">
        @csrf
        <div>
            <input class="input" type="text" placeholder="name" name="name" required>
        </div>
        <div>
            <textarea rows="20" cols="84" class="add-product__description" name="description" required></textarea>
        </div>
        <div>
            <input class="input" value="0" type="number" name="price" required>
        </div>
        <div>
            <input type="file" name="image" required>
        </div>
        <div>
            <select class="add-product__category" name="category" required>
                @foreach($categories as $category)
                    <option value="{{$category['id']}}">{{$category['name']}}</option>
                @endforeach
            </select>
        </div>
        <button class="add-product__submit submit" type="submit">create</button>
    </form>
</div>
<div class="admin-products-list">
    @foreach($products as $product)
        <div class="admin-products-list__item" id="product-{{$product->id}}">
            <p>{{Str::limit($product->name,30)}}</p>
            <p>${{$product->price}}</p>
            <img class="admin-products-list__image" src="{{asset('storage/'.$product->image)}}"
                 alt="{{$product->name}}">
            <div class="admin-products-list__delete">
                <button
                    hx-delete="{{route('products.destroy',$product->id)}}"
                    hx-target="#product-{{$product->id}}"
                    hx-swap="delete"
                    hx-confirm="Are you sure you want to delete this product?"
                >
                    Delete
                </button>
            </div>
        </div>
    @endforeach
</div>
</body>
<script>
    document.body.addEventListener('htmx:configRequest', (event) => {
        const method = event.detail.verb.toUpperCase();
        if (['POST', 'DELETE', 'PATCH', 'PUT'].includes(method)) {
            event.detail.headers['X-CSRF-TOKEN'] = '{{ csrf_token() }}';
        }
    });
</script>


</html>
