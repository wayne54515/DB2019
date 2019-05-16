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
                    <div class="food_rating" v-if="(user_id != 0) & (user_food_rank[food.id] != null)">
                        <label>你的評分 : {{ user_food_rank[food.id] }}/10</label>
                        <button value="edit" @click="showRankEdit(food, user_food_rank[food.id])">重新評分</button>
                        <button value="delete" @click="showRankDelete(food)">刪除評分</button>
                    </div>
                    <div class="food_rating" v-if="(user_id != 0) & (user_food_rank[food.id] == null)">
                        <input type="number" min="1" max="10" v-model="user_food_rating[food.id]"/>
                        <button value="send" @click="sendRank(food.id, user_food_rating[food.id])">寫評分</button>
                    </div>
                </div>
            </li>
        </ul>
    </div>
    <!-- 推薦列表 -->
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
    <!-- 刪除/編輯評分 -->
    <modal v-if="showRankModal" @close="showRankModal = false">
        <div slot="header">
            <h3 v-if="modalState == 'delete'">刪除評分</h3>
            <h3 v-if="modalState == 'edit'">重新評分</h3>
        </div>

        <div slot="body" v-if="modalState == 'delete'">
            確定刪除 {{food.name}} 評分 ？
        </div>
        <div slot="body" v-if="modalState == 'edit'">
            <p>{{food.name}} 更新前評分 {{ rank }}</p>
            <div>
                <label>更新後評分</label>
                <input type="number" min="1" max="10" v-model="user_food_rating[food.id]"/>
            </div>
        </div>

        <div slot="footer">
            <button class="modal-default-button" @click="deleteRank(food.id)" v-if="modalState == 'delete'">刪除</button>
            <button class="modal-default-button" @click="updateRank(food.id, user_food_rating[food.id])" v-if="modalState == 'edit'">更新評分</button>
            <button class="modal-default-button" @click="showRankModal = false">取消</button>
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
            user_food_rating: [],
            rmd_model_show: false,
            showRankModal: false,
            modalState:"",
            food: [],
            rank: null,
        }
    },

    methods: {
        init: function(){
            this.getFoodMenu();
            this.foodFilter();
            this.getFoodRank();
            this.getUserRating();
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

        getUserRating: function(){
            let self = this;
            this.axios.get('/rank/' + this.user_id)
                .then(function(response){
                    self.user_food_rank = response.data.rank;
                    console.log("success");
                })
                .catch(function(response){
                    console.log(response);
                })
        },

        deleteRank: function(food_id){
            let self = this;
            this.axios({
                method: 'delete',
                url: '/rank/' + food_id,
                data:{
                    'food_id': food_id,
                    'user_id': this.user_id,
                }
            }).then((response) => {
                this.showRankModal = false;
                this.user_food_rating[food_id] = null;
                self.getFoodRank();
                self.getUserRating();
                console.log(response);
                console.log("delete");
            }).catch((response) => {
                console.log(response);
            })
        },

        showRankDelete: function(food){
            this.food = food;
            this.showRankModal = true;
            this.modalState = "delete";
        },

        updateRank: function(food_id, rank){
            let self = this;
            this.new_rank = {
                food_id: food_id,
                user_id: this.user_id,
                rank: rank,
            }

            this.axios({
                method: 'put',
                url: '/rank/' + food_id,
                data:{
                    'rank': this.new_rank
                }
            }).then((response) => {
                console.log('done');
                self.getFoodRank();
                self.getUserRating();
                self.showRankModal = false;
            }).catch((response) => {
                console.log(response);
            })

        },

        showRankEdit: function(food, rank){
            this.food = food;
            this.rank = rank;
            this.showRankModal = true;
            this.modalState = "edit";
        },

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
                self.getUserRating();
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



