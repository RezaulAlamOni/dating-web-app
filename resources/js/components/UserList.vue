<template>
    <section>
        <div class="col-md-12 row">
            <div class="col-md-8"><h2>User list around 5km </h2></div>
            <div class="col-md-4 pr-0"><a href="/home" class="btn btn-success" style="float:right;">Back</a></div>

        </div>

        <table class="table">
            <thead>
            <tr>
                <th scope="col">Image</th>
                <th scope="col">Name</th>
                <th scope="col">Distance</th>
                <th scope="col">Gender</th>
                <th scope="col">Age</th>
                <th scope="col" style="width: 12%;">Action</th>
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
                    <span class="badge badge-info" style="cursor: pointer" v-if="user.like == 0" @click="likeUser(user)">Like</span>
                    <span class="badge badge-primary" :title="'You are liked '+user.name" style="cursor: pointer" v-else-if="user.like == 1" >Liked</span>
                    <span class="badge badge-success" :title="'You are matched with '+user.name" style="cursor: pointer" v-else-if="user.like == 2" >Matched</span>
                    <span class="badge badge-danger" style="cursor: pointer" v-if="user.dislike == 0"  @click="disLikeUser(user.id)">Dislike</span>
                    <span class="badge badge-warning" :title="'You are disliked '+user.name"  style="cursor: pointer" v-else-if="user.dislike == 1"  >Disliked</span>
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
        likeUser(user){
            let _this = this;
            axios.post('like-user',{user_id : user.id})
                .then(response => response.data)
                .then(response => {
                    _this.getUserList();
                    if (response.status == 'success'){
                        Swal.fire(
                            'Successfully liked !',
                            'Your liked successfully added.',
                            'success'
                        )

                    } else if(response.status == 'match'){
                        _this.getUserList();
                        Swal.fire(
                            'You match with '+user.name,
                            'You and '+user.name+' like each other!',
                            'success'
                        )
                    } else {
                        Swal.fire(
                            'Already liked !',
                            'Your liked this user previously.',
                            'warning'
                        )
                    }

                })
                .catch(e => {
                    console.log(e)
                })
        },
        disLikeUser(id){
            let _this = this;
            axios.post('dislike-user',{user_id : id})
                .then(response => response.data)
                .then(response => {
                    console.log(response)
                    if (response.status == 'success'){
                        _this.getUserList();
                        Swal.fire(
                            'Successfully disliked !',
                            'Your disliked successfully added.',
                            'success'
                        )
                    } else {
                        _this.getUserList();
                        Swal.fire(
                            'Already disliked !',
                            'Your disliked this user previously.',
                            'warning'
                        )
                    }

                })
                .catch(e => {
                    console.log(e)
                })
        },
    }
}
</script>

<style scoped>

</style>
