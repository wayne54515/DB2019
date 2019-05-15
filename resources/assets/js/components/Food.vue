<template>
<div class="content">
    <div class="search-area">
        <div class="food_type">
            <input type="radio" id="rd_dish" class="chk" v-model="food_type_selected" value="dish" /><label for="rd_dish">主食</label>
            <input type="radio" id="rd_desert" class="chk" v-model="food_type_selected" value="desert" /><label for="rd_desert">點心</label>
            <input type="radio" id="rd_beverage" class="chk" v-model="food_type_selected" value="beverage" /><label for="rd_beverage">飲料</label>
            <!-- <input type="radio" v-model="food_type_selected" value="set" /><label>套餐</label> -->
        </div>
        <div class="trade_menu">
            <input type="checkbox" id="chk_trade" class="chk" @click="trade_model_show = true;"/>
            <label for="chk_trade">交易</label>
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
                    <input type="number" min="0" max="99" v-model="food_num[food.id]"/>
                    <button value="send" @click="addTrade(food.id, food.name, food_num[food.id])">加入交易</button>
                </div>
            </li>
        </ul>
    </div>
    <!-- 交易列表 -->
    <modal v-if="trade_model_show" @close="trade_model_show = false" >
        <div slot="header">
            <h3 >交易項目</h3>
            <input type="number" min="1" max="15" v-model="table_id" width="40px" style="margin-right:3px;"/><label>填入(1~15)桌</label>
        </div>
        <div slot="body">
            <form>
                <ul class="trade_content">
                    <li v-for="(trade, trade_index) in trade_list" :key="trade.id">
                        <label>{{trade.food_name}}</label>
                        <label>{{trade.number}}</label>
                        <button @click="removeTrade(trade_index)">取消</button>
                    </li>
                </ul>
            </form>
        </div>

        <div slot="footer">
            <button class="modal-default-button"  @click="sendTrade()">確認送出</button>
            <button class="modal-default-button" @click="trade_model_show = false">取消</button>
        </div>
    </modal>
</div>
</template>

<script>
import modal from './Modal.vue'

export default {
    data () {
        return {
            page_data: {},
            food_menu: [],
            food_type_selected: "dish",
            trade_list: [],
            food_num: [],
            trade_model_show: false,
            table_id: null,
        }
    },

    methods: {
        init: function(){
            this.getFoodMenu();
            this.foodFilter();
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

        addTrade: function(id, name, num){
            console.log("success");
            alert("新增成功");
            let self = this;
            this.new_trade = {
                food_id: id,
                food_name: name,
                number: num,
            }
            self.trade_list.push(this.new_trade);
        },

        removeTrade: function(index){
            let self = this;
            self.trade_list.splice(index, 1);
        },

        sendTrade: function(){
            let self = this;
            for(var i=0 ; i<self.trade_list.length ; i++){
                this.new_trade = {
                    food_id: self.trade_list[i].food_id,
                    table_id: self.table_id,
                    number: self.trade_list[i].number,
                }
                this.axios.post('/trade', {
                    trade: this.new_trade
                })
                .then(function(response){
                    self.trade_model_show = false;
                    console.log(response);
                    console.log("完成");
                })
                .catch(function(response){
                    console.log(response);
                });
            }
            
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

    .trade_menu{
        float: right;
        font-size: 25px;
    }
    .trade_menu label{
        cursor: pointer;
    }
    .trade_body{
        display: none;
    }
    .trade_content button{
        float: right;
    }
    .trade_content label{
        margin-top: 3px;
        margin-bottom: 3px;
    }
</style>


