<template>
    <div class="container">
       
        <div class="row">
            <div class="col-md-3"></div>
            <div class="col-md-6" style="margin-top:50px; border:2px solid grey; padding:50px">
                 <h1>Registration Form</h1>
                <div class="alert alert-danger mt-4" v-if="errors.length">
                    <ul class="mb-0">
                        <li v-for="(error, index) in errors" :key="index">
                            {{ error }}
                        </li>
                    </ul>

                </div>
                <form @submit.prevent="saveUser" novalidate>
                    <fieldset>
                        <div class="form-group">
                            <label class="form-label mt-4">Full Name</label>
                            <input type="text" class="form-control" placeholder="Enter name" v-model="user.name">
                        </div>                       
                        <div class="form-group">
                            <label class="form-label mt-4">Email Address</label>
                            <input type="email" class="form-control" placeholder="Enter email" v-model="user.email">
                        </div>
                        <div class="form-group">
                            <label class="form-label mt-4">Password</label>
                            <input type="password" class="form-control" placeholder="Enter password" v-model="user.password">
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
        name: 'Registration',
        data() {
            return {
                user: {},
                name: '',
                email: '',
                password: '',
                errors: []
            }
        },
        methods: {
            async saveUser1() {
                this.errors = [];
                if (!this.user.name) {
                    this.errors.push("Name is required!");
                }
                if (!this.user.email) {
                    this.errors.push("Email is required!");
                }
                if (!this.user.password) {
                    this.errors.push("Password num is required!");
                }

                if (!this.errors.length) {
                    //alert('Everything is ok.');
                    let formData = new FormData();
                    formData.append('name', this.user.name);
                    formData.append('email', this.user.email);
                    formData.append('password', this.user.password);
                    
                    let url = 'http://127.0.0.1:8000/api/save_user';
                    await axios.post(url, formData).then( (response) => {
                        console.log(response);
                        if(response.status == 200){
                            this.user.name = '';
                            this.user.email = '';
                            this.user.password = '';
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