<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card card-default">
                    <div class="card-header">{{ exercice.name }}</div>

                    <div class="card-body">
                        Holi
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {

        props: ['exercice'],

       data() {
            return {
                editMode: false
            };
        },

        mounted() {
            console.log('Component mounted.')
        }
    }
</script>
