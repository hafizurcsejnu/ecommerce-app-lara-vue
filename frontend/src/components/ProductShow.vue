<template>
    <div class="container">
        
        <div class="row">
            <div class="col-md-3"></div>
            <div class="col-md-6" style="margin-top:50px">
                <h1>Product Details</h1>
                <div class="alert alert-danger mt-4" v-if="errors.length">
                    <ul class="mb-0">
                        <li v-for="(error, index) in errors" :key="index">
                            {{ error }}
                        </li>
                    </ul>
                </div>

              
                    <fieldset>
                        <div class="form-group">
                            <label class="form-label mt-4">Product Name</label>: {{product.name}}                            
                        </div>
                        <div class="form-group">
                            <label class="form-label mt-4">Price</label> : {{product.price}}
                        </div>
                        <div class="form-group">
                            <label class="form-label mt-4">Product Image</label>
                            <img v-bind:src="'http://127.0.0.1:8000/storage/app/public/' + product.image" />
                        </div>
                    </fieldset>
              
            </div>
        </div>
    </div>
</template>

<script>
import axios from 'axios';
    export default {
        name: 'ProductShow',
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
            }
        },
        mounted: function(){
            console.log('Edit Component Form Loaded');
        }

    }
</script>