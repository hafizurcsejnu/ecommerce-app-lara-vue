import Home from '../components/Home';
import Registration from '../components/Registration';
import Login from '../components/Login';
import MyAccount from '../components/MyAccount';
import ProductList from '../components/ProductList';
import AddProduct from '../components/AddProduct';
import EditProduct from '../components/EditProduct';
import ProductShow from '../components/ProductShow';
import ContactList from '../components/ContactList';
import AddContact from '../components/AddContact';
import EditContact from '../components/EditContact';
import { createRouter, createWebHistory } from 'vue-router';

const routes = [
    
    {
        name: 'Home',
        path: '/',
        component: Home
    },
    {
        name: 'Registration',
        path: '/registration',
        component: Registration
    },
    {
        name: 'Login',
        path: '/login',
        component: Login
    },
    {
        name: 'MyAccount',
        path: '/my-account',
        component: MyAccount
    },
    {
        name: 'ProductList',
        path: '/products',
        component: ProductList
    },
    {
        name: 'AddProduct',
        path: '/add-product',
        component: AddProduct
    },
    {
        name: 'EditProduct',
        path: '/product/edit/:id?',
        component: EditProduct
    },
    {
        name: 'ProductShow',
        path: '/product/show/:id?',
        component: ProductShow
    },


    {
        name: 'ContactList',
        path: '/contacts',
        component: ContactList
    },
    {
        name: 'AddContact',
        path: '/add-contact',
        component: AddContact
    },
    {
        name: 'EditContact',
        path: '/contact/edit/:id?',
        component: EditContact
    }
];


const router = createRouter({
    history: createWebHistory(),
    routes
})

export default router;