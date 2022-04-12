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
                    <th scope="row"><router-link :to="{ name: 'EditProduct', params: {id: product.id} }" class="btn btn-primary btn-sm">Edit</router-link></th>
                    <th scope="row"><button class="btn btn-danger btn-sm" @click.prevent="deleteProduct(product.id)">Delete</button></th>
                </tr>
            </tbody>
        </table>
    </div>
</template>

<script>
import axios from 'axios';

export default {
    name: 'ProductList',
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
        async deleteProduct(id){
            let url = `http://127.0.0.1:8000/api/delete_product/${id}`; // backticks is important or need to use string concatenation of id with + sigh like 
            // let url = "http://127.0.0.1:8000/api/delete_product/"+id;
            await axios.delete(url).then(response => {
                if(response.data.code == 200){
                    alert(response.data.message);
                    this.getProducts();
                }
            }).catch(error => {
                console.log(error);
            });
        }
    },
    mounted(){
        console.log('product List Component Mounted');
    }
}
</script>