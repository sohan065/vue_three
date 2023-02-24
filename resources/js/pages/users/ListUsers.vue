<template>
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Users</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item">
                            Home<a
                                href="http://"
                                target="_blank"
                                rel="noopener noreferrer"
                            ></a>
                        </li>
                        <li class="breadcrumb-item active">Users</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
    <div class="content-header">
        <div class="container-fluid">
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">ID</th>
                        <th scope="col">Name</th>
                        <th scope="col">Email</th>
                    </tr>
                </thead>
                <tbody>
                    <tr v-for="(user,index) in users" :key="user.id">
                        <th >{{ index+1 }}</th>
                        <td>{{ user.name }}</td>
                        <td>{{ user.email }}</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</template>

<script setup>
 import axios from 'axios';
import { onMounted, ref } from 'vue';
    const users=ref([]);
    const getUsers=()=>{
    
        axios.get( "http://127.0.0.1:8000/api/users")
        .then(({data})=>{
            console.log(data);
            users.value=data;
           }
        );
    }
onMounted(()=>{
    getUsers();
})
</script>
