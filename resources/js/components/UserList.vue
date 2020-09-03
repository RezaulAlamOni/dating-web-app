<template>
    <section>
        <h1>User list</h1>
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
            <tr>
                <th scope="row">1</th>
                <td>Mark</td>
                <td>Otto</td>
                <td>@mdo</td>
                <td>@mdo</td>
                <td>@mdo</td>
            </tr>
            </tbody>
        </table>
    </section>
</template>

<script>
export default {
    name: "UserList",
    data() {
        return {}
    },
    mounted() {
        this.getUserList();
    },
    methods: {
        getUserList() {
            axios.get('all-user')
                .then(response => response.data)
                .then(response => {
                    console.log(response)
                })
                .catch(e => {
                    console.log(e)
                })

        }
    }
}
</script>

<style scoped>

</style>
