<template>
    <div class="container">
       
        <div class="row">
            <div class="col-md-3"></div>
            <div class="col-md-6" style="margin-top:50px">
                 <h1>Add Contact</h1>
                <div class="alert alert-danger mt-4" v-if="errors.length">
                    <ul class="mb-0">
                        <li v-for="(error, index) in errors" :key="index">
                            {{ error }}
                        </li>
                    </ul>

                </div>
                <form @submit.prevent="saveContact" novalidate>
                    <fieldset>
                        <div class="form-group">
                            <label class="form-label mt-4">Full Name</label>
                            <input type="text" class="form-control" placeholder="Enter name" v-model="contact.name">
                        </div>
                        <div class="form-group">
                            <label class="form-label mt-4">Designation</label>
                            <input type="text" class="form-control" placeholder="Enter designation"
                                v-model="contact.designation">
                        </div>
                        <div class="form-group">
                            <label class="form-label mt-4">Email Address</label>
                            <input type="email" class="form-control" placeholder="Enter email" v-model="contact.email">
                        </div>
                        <div class="form-group">
                            <label class="form-label mt-4">Contact Number</label>
                            <input type="text" class="form-control" placeholder="Enter mobile" v-model="contact.mobile">
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
        name: 'AddContact',
        data() {
            return {
                contact: {},
                name: '',
                designation: '',
                email: '',
                mobile: '',
                errors: []
            }
        },
        methods: {
            async saveContact() {
                this.errors = [];
                if (!this.contact.name) {
                    this.errors.push("Name is required!");
                }
                if (!this.contact.email) {
                    this.errors.push("Email is required!");
                }
                if (!this.contact.mobile) {
                    this.errors.push("Contact num is required!");
                }

                if (!this.errors.length) {
                    //alert('Everything is ok.');
                    let formData = new FormData();
                    formData.append('name', this.contact.name);
                    formData.append('designation', this.contact.designation);
                    formData.append('email', this.contact.email);
                    formData.append('mobile', this.contact.mobile);
                    
                    let url = 'http://127.0.0.1:8000/api/save_contact';
                    await axios.post(url, formData).then( (response) => {
                        console.log(response);
                        if(response.status == 200){
                            this.contact.name = '';
                            this.contact.designation = '';
                            this.contact.email = '';
                            this.contact.mobile = '';
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