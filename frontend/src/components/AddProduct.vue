<template>
    <div class="container">
        
        <div class="row">
            <div class="col-md-3"></div>
            <div class="col-md-6" style="margin-top:50px">
                <h1>Add Product</h1>
                <div class="alert alert-danger mt-4" v-if="errors.length">
                    <ul class="mb-0">
                        <li v-for="(error, index) in errors" :key="index">
                            {{ error }}
                        </li>
                    </ul>

                </div>
                <form @submit.prevent="saveProduct" novalidate>
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
                            <label class="form-label mt-4">image</label>
                            <input type="file" @change="hangleOnchage" class="form-control">
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
        name: 'AddProduct',
        data() {
            return {
                product: {},
                name: '',
                price: '',
                image: '',
                errors: []
            }
        },
        methods: {
            hangleOnchage(e){
                this.product.image = e.target.files[0];
            },
            async saveProduct() {
                this.errors = [];
                if (!this.product.name) {
                    this.errors.push("Name is required!");
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
                    console.log(this.product.image);

                    const config = {
                        headers: {
                            'content-type': 'multipart/form-data'
                        }
                    }
                    let url = 'http://127.0.0.1:8000/api/save_product';
                    await axios.post(url, formData, config).then( (response) => {
                        
                        if(response.status == 200){
                            this.product.name = '';
                            this.product.price = '';
                            this.product.image = '';
                            alert(response.data.message);
                        } else{
                            console.log('error');
                        }
                    }).catch(error => {
                        this.errors.push(error.response);
                    });

                }
            }
        }

    }
</script>