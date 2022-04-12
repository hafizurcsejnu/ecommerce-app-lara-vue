<template>
    <div class="container">
        <h1>Product List</h1>

        <table class="table table-hover">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Product Name</th>
                    <th scope="col">Price</th>
                </tr>
            </thead>

            <tbody v-for="product in products" :key="product.id">
                <tr>
                    <th scope="row"><img v-bind:src="'http://127.0.0.1:8000/storage/app/public/' + product.image" />  </th>
                    <th scope="row">{{ product.name }}</th>
                    <th scope="row">{{ product.price }}</th>
                    <th scope="row"><router-link :to="{ name: 'ProductShow', params: {id: product.id} }" class="btn btn-primary btn-sm">Details</router-link></th>
                   
                </tr>
            </tbody>
        </table>
    </div>
</template>

<script>
import axios from 'axios';

export default {
    name: 'Home',
    data(){
        return {
            products: Array
        }
    },
    created(){
        this.getProducts();
    },
    methods: {
        async getProducts(){
            let url = 'http://127.0.0.1:8000/api/products';
            await axios.get(url).then(response => {
                this.products = response.data.products;
                console.log(this.products);
            }).catch(error => {
                console.log(error);
            });
        },
    },
    mounted(){
        console.log('Product List Component Mounted');
    }
}
</script>