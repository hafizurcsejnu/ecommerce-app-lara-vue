<template>
    <div class="container">
        
        <div class="row">
            <div class="col-md-3"></div>
            <div class="col-md-6">
                <h1>Edit Product</h1>
                <div class="alert alert-danger mt-4" v-if="errors.length">
                    <ul class="mb-0">
                        <li v-for="(error, index) in errors" :key="index">
                            {{ error }}
                        </li>
                    </ul>

                </div>
                <form @submit.prevent="updateProduct" novalidate>
                    <fieldset>
                        <div class="form-group">
                            <label class="form-label mt-4">Product Name</label>
                            <input type="text" class="form-control" placeholder="Enter name" v-model="product.name">
                        </div>
                        <div class="form-group">
                            <label class="form-label mt-4">Price</label>
                            <input type="text" class="form-control" placeholder="Enter price"
                                v-model="product.price">
                        </div>
                        <div class="form-group">
                            <label class="form-label mt-4">Product Image</label>
                            <input type="file" class="form-control" @change="hangleOnchage">
                        </div>
                       
                        <button class="btn btn-primary mt-4">Save</button>
                    </fieldset>
                </form>
            </div>
        </div>
    </div>
</template>

<script>
import axios from 'axios';
    export default {
        name: 'EditProduct',
        data() {
            return {
                product: {},
                name: '',
                price: '',
                image: '',
                errors: []
            }
        },
        created(){
            this.getProductById();
        },
        methods: {
             hangleOnchage(e){
                this.product.image = e.target.files[0];
            },
            async getProductById() {
                let url = `http://127.0.0.1:8000/api/get_product/${this.$route.params.id}`;
                await axios.get(url).then(response => {
                    console.log(response);
                    this.product = response.data;
                })
            },
             async updateProduct() {
                this.errors = [];
                if (!this.product.name) {
                    this.errors.push("Name is required!");
                }
                if (!this.product.image) {
                    this.errors.push("image is required!");
                }
                if (!this.product.price) {
                    this.errors.push("Price is required!");
                }

                if (!this.errors.length) {
                    //alert('Everything is ok.');
                    let formData = new FormData();
                    formData.append('name', this.product.name);
                    formData.append('price', this.product.price);
                    formData.append('image', this.product.image);
                    
                    let url = `http://127.0.0.1:8000/api/update_product/${this.$route.params.id}`;
                    await axios.post(url, formData).then( (response) => {
                        console.log(response);
                        if(response.status == 200){
                            alert(response.data.message);
                        } else{
                            console.log('error');
                        }
                    }).catch(error => {
                        this.errors.push(error.response);
                    });

                }
            }
        },
        mounted: function(){
            console.log('Edit Component Form Loaded');
        }

    }
</script>