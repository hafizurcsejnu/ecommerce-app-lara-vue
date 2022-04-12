<template>
    <div class="container">
       
        <div class="row">
            <div class="col-md-3"></div>
            <div class="col-md-6" style="margin-top:50px; border:2px solid grey; padding:50px">
                 <h1>Login Form</h1>
                <div class="alert alert-danger mt-4" v-if="errors.length">
                    <ul class="mb-0">
                        <li v-for="(error, index) in errors" :key="index">
                            {{ error }}
                        </li>
                    </ul>

                </div>
                <form>
                    <fieldset>                                            
                        <div class="form-group">
                            <label class="form-label mt-4">Email Address</label>
                            <input type="email" class="form-control" placeholder="Enter email" v-model="credentials.email">
                        </div>
                        <div class="form-group">
                            <label class="form-label mt-4">Password</label>
                            <input type="password" class="form-control" placeholder="Enter password" v-model="credentials.password">
                        </div>

                        <button class="btn btn-primary mt-4" @click.prevent="login">Save</button>
                    </fieldset>
                </form>
            </div>
       
        </div>
    </div>
</template>

<script>
import axios from 'axios';
    export default {
        name: 'Login',
        data() {
            return {
                credentials: {},
                email: '',
                password: '',
                errors: [],
                loading : true,
            }
        },
        mounted(){

        },
        methods: {
            async login() {
                this.errors = [];
               
                if (!this.credentials.email) {
                    this.errors.push("Email is required!");
                }
                if (!this.credentials.password) {
                    this.errors.push("Password num is required!");
                }



                if (!this.errors.length) {
                    
                    let url = 'http://127.0.0.1:8000/api/login';
                    await axios.post(url, this.credentials)
                        .then( (response) => {                            
                            if(response.data.success){
                                console.log(response.data);
                               //update the store
                               //this.$store.commit('setToken', response.data.token);
                                //skiping vuex part here. 
                               if(response.data.user_type =='Admin'){
                                   this.$router.push('/add-product');
                               }else{
                                  this.$router.push('/my-account'); 
                               }
                               
                                
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