<template>
<div class="content">
    <div class="m-sidemenu">
        <ul>
            <li><span class="menu" v-on:click="management = 'food'">菜單管理</span></li>
            <li><span class="menu" v-on:click="management = 'employee'">員工管理</span></li>
            <li><span class="menu" v-on:click="management = 'user'">會員管理</span></li>
        </ul>
    </div>

    <m_food v-if="management == 'food'"></m_food>
    <m_employee v-if="management == 'employee'"></m_employee>
    <m_user v-if="management == 'user'"></m_user>
    
</div>
</template>

<script>
import m_food from "./Manage_food.vue";
import m_employee from "./Manage_employee.vue";
import m_user from "./Manage_user.vue";

export default {
    data: function(){
        return {
           management: "food"
        }
    },

    methods: {
        
    },

    mounted: function(){
        
    },

    components: {
        m_food,
        m_employee,
        m_user
    }
}
</script>

<style>
    li {
        list-style-type: none;
        padding-bottom: 3px;
    }
    .menu {
        cursor: pointer;
    }
    .m-sidemenu {
        display: inline-block;
        width: 300px;
        height: auto;
        position: absolute;
    }

    .m-container {
        display: inline-block;
        width: auto;
        height: auto;
        position: relative;
        left: 250px;
    }

    table{
        margin-bottom: 30px;
    }
    table td{
        padding-right: 10px;
        padding-left: 10px;
        text-align: center;
    }
</style>


