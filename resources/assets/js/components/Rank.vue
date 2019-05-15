<template>
<div class="content">
    <div class="search-area">
        <div class="food_type">
            <input type="radio" id="rd_dish" class="chk" v-model="food_type_selected" value="dish" /><label for="rd_dish">主食</label>
            <input type="radio" id="rd_desert" class="chk" v-model="food_type_selected" value="desert" /><label for="rd_desert">點心</label>
            <input type="radio" id="rd_beverage" class="chk" v-model="food_type_selected" value="beverage" /><label for="rd_beverage">飲料</label>
            <!-- <input type="radio" v-model="food_type_selected" value="set" /><label>套餐</label> -->
        </div>
        <div class="rmd_menu" v-if="user_id != 0">
            <input type="checkbox" id="chk_rmd" class="chk" @click="rmd_model_show = true;"/>
            <label for="chk_rmd">推薦</label>
        </div>
    </div>
    <div>
        <ul class="menu">
            <li v-for="food in page_data" :key="food.id">
                <div class="food_block">
                    <img :src="getIconUrl(food.id)" :style="'width:200px; height:200px;'">
                    <div class="food_info">
                        <label>{{ food.name }}</label>
                        <label>{{ food.price }}元</label>
                    </div>
                    <div class="food_rank"><label>評分 : {{ food_rank[food.id] }}/10</label></div>
                    <div class="food_rating" v-if="user_id != 0">
                        <input type="number" min="1" max="10" v-model="user_food_rank[food.id]"/>
                        <button value="send" @click="sendRank(food.id, user_food_rank[food.id])">寫評分</button>
                    </div>
                </div>
            </li>
        </ul>
    </div>
    <!-- 交易列表 -->
    <modal v-if="rmd_model_show" @close="rmd_model_show = false" >
        <div slot="header">
            <h3 >推薦食物</h3>
        </div>
        <div slot="body">
            <form>
                <ul class="rmd_content">
                    <li v-for="(rmd,rmd_index) in rmd_list" :key="rmd.id">
                        <label>{{ (rmd_index+1) }}</label>
                        <label>{{rmd.food_name}}</label>
                        <label>{{rmd.rank}}</label>
                    </li>
                </ul>
            </form>
        </div>

        <div slot="footer">
            <button class="modal-default-button" @click="rmd_model_show = false">關閉視窗</button>
        </div>
    </modal>
</div>
</template>

<script>
import modal from './Modal.vue'

export default {
    props: ['user_id'],

    data () {
        return {
            page_data: {},
            food_menu: [],
            food_type_selected: "dish",
            rmd_list: [],
            food_rank: [],
            user_food_rank: [],
            rmd_model_show: false,
        }
    },

    methods: {
        init: function(){
            this.getFoodMenu();
            this.foodFilter();
            this.getFoodRank();
        },

        getIconUrl: function(i){
            return '/img/food_pic/food' + i + '.png';
        },


        getFoodMenu: function(){
            let self = this;
            this.axios.get('/food', {
                    params:{
                        type: "",
                    }
                })
                .then(function(response){
                    self.food_menu = response.data.food;
                })
                .catch(function(response){
                    console.log(response);
                })
        },

        foodFilter: function(){
            let self = this;
            this.axios.get('/food', {
                    params:{
                        type: self.food_type_selected,
                    }
                })
                .then(function(response){
                    self.page_data = response.data.food;
                    console.log(response.data.food.type);
                })
                .catch(function(response){
                    console.log(response);
                });
        },

        getFoodRank: function(){
            let self = this;
            this.axios.get('/rank')
                .then(function(response){
                    self.food_rank = response.data.rank;
                    console.log("success");
                })
                .catch(function(response){
                    console.log(response);
                })
        },

        // removeRank: function(id, index){
        //     let self = this;
        //     this.axios({
        //         method: 'delete',
        //         url: '/rank/' + id
        //     }).then((response) => {
        //         console.log("delete");
        //     }).catch((response) => {
        //         console.log(response);
        //     })
        // },

        // editRank: function(index){
        //     let self = this;

        // },

        sendRank: function(food_id, rank){
            let self = this;
            this.new_rank = {
                food_id: food_id,
                user_id: this.user_id,
                rank: rank,
            }
            this.axios.post('/rank', {
                rank: this.new_rank
            })
            .then(function(response){
                console.log(response);
                console.log("完成");
            })
            .catch(function(response){
                console.log(response);
            });
            
        }
    },

    watch: {
        food_type_selected: function(){
            this.foodFilter()
        }
    },

    mounted: function(){
        this.init();
    },

    components: {
        modal
    }

}
</script>

<style>
    button{
        cursor: pointer;
    }

    .menu li{
        display: inline-block;
        vertical-align: top;
        padding: 5px;
        text-align: center;
        margin: 2px;
    }
    .menu{
        margin-top: 20px;
    }
    .menu label{
        margin: 5px;
        display: inline;
        font-size: 20px;
    }
    .food_info{
        border-bottom: 2px solid black;
        margin-bottom: 5px;
        display: block;
    }
    .food_rank{
        margin-bottom: 5px;
        display: block;
    }
    .food_rating{
        display: block;
        border-top: 2px solid black; 
    }

    .chk{
        position: absolute;
        visibility: hidden;
        z-index: -1111;
    }

    .food_type{
        display: inline-block;
    }
    .food_type label{
        cursor: pointer;
        margin-right: 20px;
        font-size: 25px;
        border: 2px solid transparent;
    }
    .food_type input:checked + label{
        transition: 0.8s;
        border-bottom: 2px solid blue;
    }

    .food_block{
        border: 2px solid black;
        width: 202px;
        margin: 3px;
        display: block;
    }
    .food_block img{
        margin-bottom: 3px;
    }
    .food_block input[type='number']{
        width: 30%;
        position: relative;
        display: inline-block;
        height: auto;
        margin-top: 3px;
        border-radius: 5px;
    }
    .food_block button{
        position: relative;
        display: inline-block;
        margin-bottom: 5px;
        margin-top: 3px;
        border-radius: 5px;
    }

    input::-webkit-inner-spin-button{
        appearance: none;
    }

    .rmd_menu{
        float: right;
        font-size: 25px;
    }
    .rmd_menu label{
        cursor: pointer;
    }
    .rmd_body{
        display: none;
    }
    .rmd_content button{
        float: right;
    }
    .rmd_content label{
        margin-top: 3px;
        margin-bottom: 3px;
    }
</style>



