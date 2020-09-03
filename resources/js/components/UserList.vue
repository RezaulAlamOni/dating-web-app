<template>
    <section>
        <div class="col-md-12">
            <h2>User list around 5km </h2> <a href="/home" class="btn btn-success">Back</a>
        </div>

        <table class="table">
            <thead>
            <tr>
                <th scope="col">Image</th>
                <th scope="col">Name</th>
                <th scope="col">Distance</th>
                <th scope="col">Gender</th>
                <th scope="col">Age</th>
                <th scope="col">Action</th>
            </tr>
            </thead>
            <tbody>

            <tr v-for="user in users">
                <th scope="row">
                    <img :src="url+'storage/images/'+user.image" alt="" height="50" width="50">
                </th>
                <td>{{ user.name }} </td>
                <td>{{ user.distance.toFixed(3) }} <b>KM</b></td>
                <td class="text-capitalize">{{ user.gender }}</td>
                <td>{{ user.age }} Year</td>
                <td>
                    <span class="badge badge-info" style="cursor: pointer" @click="likeUser(user.id)">Like</span>
                </td>
            </tr>
            </tbody>
        </table>
    </section>
</template>

<script>
import Swal from 'sweetalert2'
export default {
    name: "UserList",
    data() {
        return {
            url : window.APP_URL,
            users : []
        }
    },
    mounted() {
        this.getUserList();
    },
    methods: {
        getUserList() {
            let _this = this;
            axios.get('get-all-users')
                .then(response => response.data)
                .then(response => {
                    console.log(response)
                    _this.users = response.users
                })
                .catch(e => {
                    console.log(e)
                })

        },
        likeUser(id){

        }
    }
}
</script>

<style scoped>

</style>
