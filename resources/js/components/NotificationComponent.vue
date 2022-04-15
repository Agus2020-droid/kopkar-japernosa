<template>
    <li class="nav-item dropdown">
        <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
           <i class="fa fa-bell" id="notify-icon"></i>
           <span>{{unreadNotifications}}</span>
        </a>

        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
            <a class="dropdown-item" href="">

            </a>
        </div>
    </li>
</template>

<script>
    export default {
        mounted() {
            this.getNotifications();
        },
        data(){
            return {
                unreadnotifications: {},
            }
        },
        methods: {
            getNotifications(){
                axio.get('unreadNotifications').then((Response)=> {
                    this.unreadnotifications = Response.data
                }).catch((errors) => {
                    console.log(errors)
                });
            }
        }
    }
</script>
